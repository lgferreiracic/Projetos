<?php

namespace App\Imports;

use App\Models\Tree;
use App\Models\Small;
use App\Models\Adult;
use App\Models\Adult2;
use App\Models\Bobbin;
use App\Models\Mature;
use App\Models\Medium;
use App\Models\Mature2;
use App\Models\Mature3;
use App\Models\Mature4;
use App\Models\Medium2;
use App\Models\Medium3;
use App\Models\Stratum;
use App\Models\Property;
use App\Models\TreeVisit;
use App\Models\Geolocation;
use App\Models\SamplingPoint;
use App\Models\HomogeneousArea;
use App\Models\VisitInformation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class DataImport implements
	ToCollection,
	WithHeadingRow,
	WithCalculatedFormulas,
	WithChunkReading,
	WithBatchInserts,
	ShouldQueue
{
	/**
	 * Transform a date value into a Carbon object.
	 *
	 * @return \Carbon\Carbon|null
	 */
	public function transformDate($value, $format = 'Y-m-d')
	{
		try {
			return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
		} catch (\ErrorException $e) {
			return \Carbon\Carbon::createFromFormat($format, $value);
		}
	}

	public function invertDate($date)
	{
		if (count(explode("/", $date)) > 1) {
			return implode("/", array_reverse(explode("/", $date)));
		} elseif (count(explode("-", $date)) > 1) {
			return implode("/", array_reverse(explode("-", $date)));
		}
	}

	public function sanitizeDate($date)
	{
		$splittedDate = explode(" ", $date);
		if (count($splittedDate) >= 1) {
			return $this->invertDate($splittedDate[0]);
		}
	}

	public function check_attr($attr)
	{
		return $attr == 'S' ? 1 : 0;
	}

	public function check_farm_identifier($number)
	{
		switch ($number) {
			case 3:
				return "Fazenda 3A";
			case 4:
				return "Fazenda 4B";
			case 5:
				return "Fazenda 5C";
			case 11:
				return "Fazenda 11H";
			case 12:
				return "Fazenda 12I";
			case 13:
				return "Fazenda 13J";
			case 14:
				return "Fazenda 14K";
			case 15:
				return "Fazenda 15L";
			default:
				return;
		}
	}

	function previousCollectGenerator($data)
	{
		foreach ($data as $row) {
			yield $row;
		}
	}

	public function collection(Collection $rows)
	{
		$data = $this->previousCollectGenerator($rows);

		$current_date = date('Y/m/d');

		foreach ($data as $row) {
			// create a new property or get an existent

			$farmName = $this->check_farm_identifier(intval($row['faz']));
    
			if (is_null($farmName)) {
				$farmName = '11'; 
			}
		
			// create a new property or get an existent
			$property = Property::firstOrCreate([
				'id'           => $row['faz'],
				'name'         => $farmName,
				'owner_name'   => 'CEPLAC',
				'owner_id'     => 1,
				'status'       => true,
				'city'         => 'Ilhéus',
				'uf'           => 'BA',
				'area_name'    => 'Roça',
			]);

			// associate geolocation if the property doesn't have one yet
			if (!$property->geolocation_id) {
				$property_geolocation = Geolocation::create([
					'latitude' => -14.755684248455063,
					'longitude' => -39.23138115409798,
				]);

				$property->update([
					'geolocation_id' => $property_geolocation->id,
				]);
			}
			
			if (isset($row['ah'])) {
				$homogeneous_area = HomogeneousArea::firstOrCreate([
					'label' => strval($row['ah']),
					'property_id' => $property->id
				]);
			} else {
				$homogeneous_area = HomogeneousArea::firstOrCreate([
					'label' => "AH - Fazenda " . $property->id,
					'property_id' => $property->id
				]);
			}

			// Modificado
			if (isset($row['uo'])) {
				$stratum = Stratum::firstOrCreate([
					'label' => strval($row['uo']),
					'homogeneous_area_id' => $homogeneous_area->id,
				]);
			} else {
				// create new stratum if it does't exist
				$stratum = Stratum::firstOrCreate([
					'label' => "UO - " . $homogeneous_area->label,
					'homogeneous_area_id' => $homogeneous_area->id,
				]);
			}

			$sampling_point = SamplingPoint::where('label', $row['pa'])
				->whereHas('stratum', function ($query) use ($row) {
					$query->where('label', $row['uo']) 
						->whereHas('homogeneous_area', function ($query) use ($row) {
							$query->where('label', $row['ah']); 
						});
				})
				->latest()
				->first();

			if (!$sampling_point) {
				$geolocation = Geolocation::create([
					'latitude' => '1',
					'longitude' => '1',
				]);

				$sampling_point = SamplingPoint::create([
					'label' 			=> $row['pa'],
					'ini_period' 		=> $row['periodo'],
					'status'			=> true,
					'harvest'			=> $row['safra'],
					'year'				=> $row['ano'],
					'property_id' 		=> $property->id,
					'stratum_id'		=> $stratum->id,
					'geolocation_id' 	=> $geolocation->id,
					'lastVisit' 		=> strval($this->sanitizeDate($row['data'])),
				]);

				// $sampling_point->geolocation()->associate($geolocation);
			} else {
				if ($sampling_point->property_id === $property->id) {
					$sampling_point->update([
						'label' 			=> $row['pa'],
						'ini_period' 		=> $row['periodo'],
						'status'			=> true,
						'harvest'			=> $row['safra'],
						'year'				=> $row['ano'],
						'property_id' 		=> $sampling_point->property_id,
						'stratum_id'		=> $sampling_point->stratum_id,
						// 'geolocation_id' 	=> null,
						'lastVisit' 		=> strval($this->sanitizeDate($row['data'])),
					]);
				} else if ($sampling_point->property_id !== $property->id) {
					$sampling_point = SamplingPoint::create([
						'label' 			=> $row['pa'],
						'ini_period' 		=> $row['periodo'],
						'status'			=> true,
						'harvest'			=> $row['safra'],
						'year'				=> $row['ano'],
						'property_id' 		=> $property->id,
						'stratum_id'		=> $stratum->id,
						// 'geolocation_id' 	=> $geolocation->id,
						'lastVisit' 		=> strval($this->sanitizeDate($row['data'])),
					]);
				} else {
					$sampling_point->update([
						'label' 			=> $row['pa'],
						'ini_period' 		=> $row['periodo'],
						'status'			=> true,
						'harvest'			=> $row['safra'],
						'year'				=> $row['ano'],
						'property_id' 		=> $sampling_point->property_id,
						'stratum_id'		=> $sampling_point->stratum_id,
						// 'geolocation_id' 	=> null,
						'lastVisit' 		=> strval($this->sanitizeDate($row['data'])),
					]);
				}
			}
			

			// tree of visit
			$tree = Tree::firstOrCreate([
				'label'				=> intval($row['arvore']),
				'status' 			=> true,
				'sampling_point_id' => $sampling_point->id,
			]);

			// visit information
			$visit_information = VisitInformation::firstOrCreate([
				'note'				=> '',
				'date'				=> strval($this->sanitizeDate($row['data'])),
				'flowering'			=> 0,
				'refoliation'		=> 0,
				'top'				=> 0,
				// 'flowering'			=> $row['flora'] ? $row['flora'] : 0,
				// 'refoliation'		=> $row['refol'] ? $row['refol'] : 1,
				// 'top'				=> $row['copa'] ? $row['copa'] : 1,
				'pruned'			=> 0,
				'mowing'			=> 0,
				'weeding'			=> 0,
				'grated'			=> 0,
				'renewed'			=> 0,
				'fertilized'		=> 0,
				'pulverized'		=> 0,
				'unbounded'			=> 0,
				'wind'				=> 0,
				'brown_rot'			=> 0,
				'drought'			=> 0,
				'rain'				=> 0,
				'rat'				=> 0,
				'flood'				=> 0,
				'insect'			=> 0,
				'absence_of_shadow'	=> 0,
				'excess_shade'		=> 0,
				// 'pruned'			=> $this->check_attr($row['podada']),
				// 'mowing'			=> $this->check_attr($row['rocada']),
				// 'weeding'			=> $this->check_attr($row['capinada']),
				// 'grated'			=> $this->check_attr($row['raleada']),
				// 'renewed'			=> $this->check_attr($row['renovada']),
				// 'fertilized'		=> $this->check_attr($row['adubada']),
				// 'pulverized'		=> $this->check_attr($row['pulveriz']),
				// 'unbounded'			=> $this->check_attr($row['desbrota']),
				// 'wind'				=> $this->check_attr($row['outros']),
				// 'brown_rot'			=> $this->check_attr($row['outros']),
				// 'drought'			=> $this->check_attr($row['controlpp']),
				// 'rain'				=> $this->check_attr($row['controlpp']),
				// 'rat'				=> $this->check_attr($row['outros']),
				// 'flood'				=> $this->check_attr($row['outros']),
				// 'insect'			=> $this->check_attr($row['outros']),
				// 'absence_of_shadow'	=> $this->check_attr($row['outros']),
				// 'excess_shade'		=> $this->check_attr($row['outros']),
				'homogeneous_area_id' => $homogeneous_area->id
			]);

			// cocoa fruit
			$bobbin = Bobbin::create([
				'total' 		=> $row['0_21'] ? $row['0_21'] : 0,
				'loss' 			=> $row['per_0_21'] ? $row['per_0_21'] : 0,
				'piece' 		=> $row['peco_0_21'] ? $row['peco_0_21'] : 0,
				//'witchs_broom'  => $row['vas_0_21'] ? $row['vas_0_21'] : 0,
			]);

			$small = Small::create([
				'total' 		=> $row['21_42'] ? $row['21_42'] : 0,
				'loss' 			=> $row['per_21_42'] ? $row['per_21_42'] : 0,
				'piece' 		=> $row['peco_21_42'] ? $row['peco_21_42'] : 0,
				'witchs_broom'  => 0,
			]);

			$medium = Medium::create([
				'total' 		=> $row['42_63'] ? $row['42_63'] : 0,
				//'harvested' 	=> $row['c_42_63'] ? intval($row['c_42_63']) : 0,
				//'rotten' 		=> $row['pod_42_63'] ? $row['pod_42_63'] : 0,
				//'rat' 			=> $row['rat_42_63'] ? $row['rat_42_63'] : 0,
				//'witchs_broom' 	=> $row['vas_42_63'] ? $row['vas_42_63'] : 0,
				'loss' 			=> $row['per_42_63'] ? $row['per_42_63'] : 0,
				'piece' 		=> $row['peco_42_63'] ? $row['peco_42_63'] : 0,
			]);

			$medium2 = Medium2::create([
				'total' 		=> $row['63_84'] ? $row['63_84'] : 0,
				//'harvested' 	=> $row['c_63_84'] ? intval($row['c_63_84']) : 0,
				'rotten' 		=> $row['pod_63_84'] ? $row['pod_63_84'] : 0,
				'rat' 			=> $row['rat_63_84'] ? $row['rat_63_84'] : 0,
				'witchs_broom' 	=> $row['vas_63_84'] ? $row['vas_63_84'] : 0,
				'loss' 			=> $row['per_63_84'] ? $row['per_63_84'] : 0,
				'piece' 		=> 0,
			]);

			$medium3 = Medium3::create([
				'total' 		=> $row['84_105'] ? $row['84_105'] : 0,
				'harvested' 	=> $row['c_84_105'] ? intval($row['c_84_105']) : 0,
				'rotten' 		=> $row['pod_84_105'] ? $row['pod_84_105'] : 0,
				'rat' 			=> $row['rat_84_105'] ? $row['rat_84_105'] : 0,
				'witchs_broom' 	=> $row['vas_84_105'] ? $row['vas_84_105'] : 0,
				'loss' 			=> $row['per_84_105'] ? $row['per_84_105'] : 0,
				'piece' 		=> 0,
			]);

			$adult = Adult::create([
				'total' 		=> $row['105_126'] ? $row['105_126'] : 0,
				'harvested' 	=> $row['c_105_126'] ? intval($row['c_105_126']) : 0,
				'rotten' 		=> $row['pod_105_126'] ? $row['pod_105_126'] : 0,
				'rat' 			=> $row['rat_105_126'] ? $row['rat_105_126'] : 0,
				'witchs_broom' 	=> $row['vas_105_126'] ? $row['vas_105_126'] : 0,
				'loss' 			=> $row['per_105_126'] ? $row['per_105_126'] : 0,
			]);

			$adult2 = Adult2::create([
				'total' 		=> $row['126_147'] ? $row['126_147'] : 0,
				'harvested' 	=> $row['c_126_147'] ? intval($row['c_126_147']) : 0,
				'rotten' 		=> $row['pod_126_147'] ? $row['pod_126_147'] : 0,
				'rat' 			=> $row['rat_126_147'] ? $row['rat_126_147'] : 0,
				'witchs_broom' 	=> $row['vas_126_147'] ? $row['vas_126_147'] : 0,
				'loss' 			=> $row['per_126_147'] ? $row['per_126_147'] : 0,
			]);

			$mature = Mature::create([
				'total' 		=> $row['147_168'] ? $row['147_168'] : 0,
				'harvested' 	=> $row['c_147_168'] ? intval($row['c_147_168']) : 0,
				'rotten' 		=> $row['pod_147_168'] ? $row['pod_147_168'] : 0,
				'rat' 			=> $row['rat_147_168'] ? $row['rat_147_168'] : 0,
				'witchs_broom' 	=> $row['vas_147_168'] ? $row['vas_147_168'] : 0,
				'loss' 			=> $row['per_147_168'] ? $row['per_147_168'] : 0,
			]);

			$mature2 = Mature2::create([
				'total' 		=> $row['168_189'] ? $row['168_189'] : 0,
				'harvested' 	=> $row['c_168_189'] ? intval($row['c_168_189']) : 0,
				'rotten' 		=> $row['pod_168_189'] ? $row['pod_168_189'] : 0,
				'rat' 			=> $row['rat_168_189'] ? $row['rat_168_189'] : 0,
				'witchs_broom' 	=> $row['vas_168_189'] ? $row['vas_168_189'] : 0,
				'loss' 			=> $row['per_168_189'] ? $row['per_168_189'] : 0,
			]);

			$mature3 = Mature3::create([
				'total' 		=> $row['189_210'] ? $row['189_210'] : 0,
				'harvested' 	=> $row['c_189_210'] ? intval($row['c_189_210']) : 0,
				'rotten' 		=> $row['pod_189_210'] ? $row['pod_189_210'] : 0,
				'rat' 			=> $row['rat_189_210'] ? $row['rat_189_210'] : 0,
				'witchs_broom' 	=> $row['vas_189_210'] ? $row['vas_189_210'] : 0,
				'loss' 			=> $row['per_189_210'] ? $row['per_189_210'] : 0,
			]);

			$mature4 = Mature4::create([
				'total' 		=> $row['acima_de_210'] ? intval($row['acima_de_210']) : 0,
				'harvested' 	=> $row['col_ac'] ? intval($row['col_ac']) : 0,
				'rotten' 		=> $row['pod_210'] ? $row['pod_210'] : 0,
				'rat' 			=> $row['rat_210'] ? $row['rat_210'] : 0,
				'witchs_broom' 	=> $row['vas_210'] ? $row['vas_210'] : 0,
				'loss' 			=> $row['per_210'] ? $row['per_210'] : 0,
			]);

			$tree_visit = TreeVisit::create([
				'tree_id'					=> $tree->id,
				'bobbin_id'					=> $bobbin->id,
				'small_id'					=> $small->id,
				'medium_id'					=> $medium->id,
				'medium2_id'				=> $medium2->id,
				'medium3_id'				=> $medium3->id,
				'adult_id'					=> $adult->id,
				'adult2_id'					=> $adult2->id,
				'mature_id'					=> $mature->id,
				'mature2_id'				=> $mature2->id,
				'mature3_id'				=> $mature3->id,
				'mature4_id'				=> $mature4->id,
				'user_id'					=> 1,
				'date'						=> strval($this->sanitizeDate($row['data'])),
			]);
		}
	}

	public function chunkSize(): int
	{
		return 1000;
	}

	public function batchSize(): int
	{
		return 500;
	}
}
