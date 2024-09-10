<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SamplingPointResource;
use App\Http\Resources\HomogeneousAreaResource;
use App\Http\Resources\PropertyResource;
use App\Models\Tree;
use App\Models\Small;
use App\Models\Adult;
use App\Models\Adult2;
use App\Models\Bobbin;
use App\Models\Mature;
use App\Models\Mature2;
use App\Models\Mature3;
use App\Models\Mature4;
use App\Models\Medium2;
use App\Models\Medium3;
use App\Models\Medium;
use App\Models\Stratum;
use App\Models\TreeVisit;
use App\Models\Property;
use App\Models\SamplingPoint;
use App\Models\HomogeneousArea;
use Illuminate\Http\Request;
use App\Models\VisitInformation;
use App\Http\Resources\StratumResource;
use App\User;
use Carbon\Carbon;

/**
 * @group Requisições Mobile
 *
 * @authenticated
 *
 * Endpoints e funções para requisições da aplicação mobile
 */
class MobileController extends BaseController
{
	/**
	 * Exibe todos os dados do banco de dados que estão com status ativo
	 *
	 * @responseFile responses/mobile/index.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$properties = Property::with('homogeneous_areas')
			->orderBy('id', 'asc')
			->get();

		$homogeneous_areas = HomogeneousArea::with(['strata', 'visits'])
			->orderBy('id', 'asc')
			->get();

		$strata = Stratum::with('sampling_points')
			->orderBy('id', 'asc')
			->get();

		$props = PropertyResource::collection($properties);
		$prop_data = $props->additional([
			'homogeneous_areas' => HomogeneousAreaResource::collection($homogeneous_areas)
		]);

		$hAreas = HomogeneousAreaResource::collection($homogeneous_areas);
		$hArea_data = $hAreas->additional([
			'strata' => StratumResource::collection($strata)
		]);

		$str = StratumResource::collection($strata);
		$str_data = $str->additional([
			'sampling_points' => SamplingPointResource::collection($strata)
		]);

		$info[] = PropertyResource::collection($prop_data);
		$info[] = HomogeneousAreaResource::collection($hArea_data);
		$info[] = StratumResource::collection($str_data);

		return response()->json($info);
	}

	/**
	 * Coleta os dados validados do aplicativo e envia para o banco de dados
	 *
	 * @bodyParam json_data required Série de informações sobre a visita em um ou vários pontos amostrais de um ou mais estratos. No-example
	 *
	 * @responseFile responses/mobile/send_visit.json
	 * @responseFile 404 responses/404.json
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function send_visit(Request $request)
	{
		$data = $request->all()['data'];

		foreach ($data as $stratum) {
			foreach ($stratum['sampling_points'] as $sampling_point) {
				$s_point_id = $sampling_point['sampling_point_id'];
				$s_point = SamplingPoint::where('id', '=', $s_point_id)->first();

				// Diferença em dias desde a última coleta nesse ponto amostral
				$lastVisit = Carbon::parse($s_point->lastVisit);
				$now = Carbon::now();

				$diff = $lastVisit->diffInDays($now);

				if ($diff >= 18) {
					$s_point->update([
						'label' 					=> $s_point->label,
						'ini_period' 				=> $s_point->ini_period < 17 ? $s_point->ini_period + 1 : 1,
						'status'					=> true,
						'harvest' 					=> $s_point->ini_period < 17 ? $s_point->harvest : $s_point->harvest + 1,
						'year'    					=> $s_point->ini_period < 17 ? $s_point->year : $s_point->year + 1,
						'stratum_id'				=> $s_point->stratum_id,
						'geolocation_id' 			=> null,
						'lastVisit'					=> Carbon::now(),
					]);
				}

				// Retorna o model da árvore de acordo com o id do ponto amostral
				$tree_sample = Tree::where('sampling_point_id', '=', $s_point_id)
					->first();

				/**
				 * Atualiza dados do bilro e do pequeno da visita anterior
				 */
				$previous_bobbin_id = TreeVisit::where('tree_id', '=', $tree_sample->id)
					->orderBy('id', 'desc')
					->first()
					->bobbin_id;

				$previous_bobbin_info = Bobbin::find($previous_bobbin_id);

				$bobbinPV_data = $sampling_point['trees'][0]['data']['bobbinPV'] ?? ["total" => $previous_bobbin_info->total];

				$previous_bobbin_info->update([
					'total' => $bobbinPV_data["total"],
				]);

				foreach ($sampling_point['trees'] as $trees) {
					$tree_id = $trees['tree_id'];
					$tree_data = $trees['data'];

					$last_tree_visit = TreeVisit::where('tree_id', '=', $tree_id)
						->orderBy('id', 'desc')
						->first();

					$lastTreeVisit = Carbon::parse($last_tree_visit->date);
					$diffDays = $lastTreeVisit->diffInDays($now);

					$bobbin_data = $tree_data['bobbin'];
					$small_data = $tree_data['small'];
					$medium_data = $tree_data['medium'];
					$medium2_data = $tree_data['medium2'];
					$medium3_data = $tree_data['medium3'];
					$adult_data = $tree_data['adult'];
					$adult2_data = $tree_data['adult2'];
					$mature_data = $tree_data['mature'];
					$mature2_data = $tree_data['mature2'];
					$mature3_data = $tree_data['mature3'];
					$mature4_data = $tree_data['mature4'];

					$tree = Tree::find($tree_id);

					if ($diffDays >= 18) {
						$tree_visit = new TreeVisit();

						$bobbin = Bobbin::create($bobbin_data);
						$small = Small::create($small_data);
						$medium = Medium::create($medium_data);
						$medium2 = Medium2::create($medium2_data);
						$medium3 = Medium3::create($medium3_data);
						$adult = Adult::create($adult_data);
						$adult2 = Adult2::create($adult2_data);
						$mature = Mature::create($mature_data);
						$mature2 = Mature2::create($mature2_data);
						$mature3 = Mature3::create($mature3_data);
						$mature4 = Mature4::create($mature4_data);
						$user = User::find(auth('api')->user()->id);

						$tree_visit->tree()->associate($tree);
						$tree_visit->bobbin()->associate($bobbin);
						$tree_visit->small()->associate($small);
						$tree_visit->medium()->associate($medium);
						$tree_visit->medium2()->associate($medium2);
						$tree_visit->medium3()->associate($medium3);
						$tree_visit->adult()->associate($adult);
						$tree_visit->adult2()->associate($adult2);
						$tree_visit->mature()->associate($mature);
						$tree_visit->mature2()->associate($mature2);
						$tree_visit->mature3()->associate($mature3);
						$tree_visit->mature4()->associate($mature4);
						$tree_visit->collector()->associate($user);

						$tree_visit->save();
					} else {
						$last_bobbin_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->bobbin_id;
						$last_small_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->small_id;
						$last_medium_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->medium_id;
						$last_medium2_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->medium2_id;
						$last_medium3_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->medium3_id;
						$last_adult_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->adult_id;
						$last_adult2_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->adult2_id;
						$last_mature_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->bobbin_id;
						$last_mature2_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->mature2_id;
						$last_mature3_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->mature3_id;
						$last_mature4_id = TreeVisit::where('tree_id', '=', $tree_id)
							->orderBy('id', 'desc')
							->first()
							->mature4_id;

						$bobbin = Bobbin::find($last_bobbin_id);
						$small = Small::find($last_small_id);
						$medium = Medium::find($last_medium_id);
						$medium2 = Medium2::find($last_medium2_id);
						$medium3 = Medium3::find($last_medium3_id);
						$adult = Adult::find($last_adult_id);
						$adult2 = Adult2::find($last_adult2_id);
						$mature = Mature::find($last_mature_id);
						$mature2 = Mature2::find($last_mature2_id);
						$mature3 = Mature3::find($last_mature3_id);
						$mature4 = Mature4::find($last_mature4_id);

						$bobbin->update($bobbin_data);
						$small->update($small_data);
						$medium->update($medium_data);
						$medium2->update($medium2_data);
						$medium3->update($medium3_data);
						$adult->update($adult_data);
						$adult2->update($adult2_data);
						$mature->update($mature_data);
						$mature2->update($mature2_data);
						$mature3->update($mature3_data);
						$mature4->update($mature4_data);
					}
				}
			}
		}
		return $this->send_response(null, 'Visita Registrada');
	}

	public function send_practice(Request $request)
	{
		$data = $request->all()['data'];

		foreach ($data as $property) {
			foreach ($property['homogeneous_areas'] as $homogeneous_area) {
				$ho_id = $homogeneous_area['homogeneous_area_id'];

				$visit_info_data = $homogeneous_area['visit_information'];
				$visit_info_data = $visit_info_data + ['homogeneous_area_id' => $ho_id];

				$visit_information = VisitInformation::create($visit_info_data);
				$visit_information->save();
			}
		}

		return $this->send_response(null, 'Dados da Prática Registrados');
	}
}
