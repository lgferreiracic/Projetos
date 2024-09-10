<?php

namespace App\Http\Controllers\API;

use Phpml\Clustering\DBSCAN;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Block;
use App\Models\Common;
use App\Models\Hybrid;
use App\Models\Cloned;
use App\Models\Lowland;
use App\Models\SoilUse;
use App\Models\Stratum;
use App\Models\Genotype;
use App\Models\Rainfall;
use App\Models\Handling;
use App\Models\SoilClass;
use App\Models\Production;
use App\Models\LowerThird;
use App\Models\UpperThird;
use App\Models\MiddleThird;
use App\Models\Geolocation;
use App\Models\SamplingPoint;
use App\Models\HomogeneousArea;

use App\Http\Resources\BlockResource;
use App\Models\Property;
use App\Models\Tree;

class BlockController extends BaseController
{
    protected $messages = [
        'area.required' => 'Informe a área em hectáres da sua Unidade Operacional',
        'relief.required' => 'Informe qual o relevo da sua Unidade Operacional',
        // 'production.required' => 'Informe a produção em arroba da sua Unidade Operacional',
        'altitude.required' => 'Informe a altitude em se encontra a sua Unidade Operacional',
        'propertyId.required' => 'Informa a área em hectáres da sua Unidade Operacional',
        'rainfall.january.required' => 'Informe um valor válido para o mês de Janeiro',
    ];

    public function index(Request $request)
    {
        $property_id = $request->query('propid');

        $blocks = Block::where('property_id', '=', $property_id)
            ->orderBy('id', 'asc')
            ->get();

        return $this->send_response(BlockResource::collection($blocks));
    }

    public function store(Request $request)
    {
        $validate = array(
            'label' => 'bail|required',
            'area' => 'bail|required|integer',
            'production.temple' => 'bail|required|decimal:0,1',
            'production.main' => 'bail|required|decimal:0,1',
            'production.total' => 'bail|required|decimal:0,1',
            'production.not_informed' => 'bail|required|regex:/^[01]$/',
            'relief' => 'bail|required|regex:/^[1234]$/',
            'altitude' => 'bail|required|regex:/^[12]$/',
            'propertyId' => 'bail|required|integer',
            'rainfall.january' => 'bail|required|regex:/^[01]$/',
            'rainfall.february' => 'bail|required|regex:/^[01]$/',
            'rainfall.march' => 'bail|required|regex:/^[01]$/',
            'rainfall.april' => 'bail|required|regex:/^[01]$/',
            'rainfall.may' => 'bail|required|regex:/^[01]$/',
            'rainfall.june' => 'bail|required|regex:/^[01]$/',
            'rainfall.july' => 'bail|required|regex:/^[01]$/',
            'rainfall.august' => 'bail|required|regex:/^[01]$/',
            'rainfall.september' => 'bail|required|regex:/^[01]$/',
            'rainfall.october' => 'bail|required|regex:/^[01]$/',
            'rainfall.november' => 'bail|required|regex:/^[01]$/',
            'rainfall.december' => 'bail|required|regex:/^[01]$/',
            'rainfall.unknown' => 'bail|required|regex:/^[01]$/',
            'soilUse.type' => 'bail|required|regex:/^[12]$/',
            'soilUse.description' => 'nullable|string',
            'handling.temple' => 'bail|required|regex:/^[12]$/',
            'handling.main' => 'bail|required|regex:/^[12]$/',
            'genotypes.common.main' => 'bail|nullable|integer|max:100',
            'genotypes.common.temple' => 'bail|nullable|integer|max:100',
            'genotypes.common.global' => 'bail|nullable|integer|max:100',
            'genotypes.common.age' => 'bail|nullable|integer',
            'genotypes.common.density' => 'bail|nullable|integer',
            'genotypes.common.type' => 'bail|nullable|regex:/^[123]$/',
            'genotypes.common.total_area_participation' => 'bail|required|integer|max:100',
            'genotypes.hybrid.main' => 'bail|nullable|integer|max:100',
            'genotypes.hybrid.temple' => 'bail|nullable|integer|max:100',
            'genotypes.hybrid.global' => 'bail|nullable|integer|max:100',
            'genotypes.hybrid.age' => 'bail|nullable',
            'genotypes.hybrid.density' => 'bail|nullable',
            'genotypes.hybrid.total_area_participation' => 'bail|required|integer|max:100',
            'genotypes.cloned.main' => 'bail|nullable|integer|max:100',
            'genotypes.cloned.temple' => 'bail|nullable|integer|max:100',
            'genotypes.cloned.global' => 'bail|nullable|integer|max:100',
            'genotypes.cloned.age' => 'bail|nullable',
            'genotypes.cloned.density' => 'bail|nullable',
            'genotypes.cloned.type' => 'bail|nullable|regex:/\d/',
            'genotypes.cloned.type_description' => 'bail|nullable|string',
            'genotypes.cloned.total_area_participation' => 'bail|required|integer|max:100',
            'soilClass.lowland.argisol' => 'bail|required|integer|max:100',
            'soilClass.lowland.latosol' => 'bail|required|integer|max:100',
            'soilClass.lowland.cambisol' => 'bail|required|integer|max:100',
            'soilClass.lowland.gleisol' => 'bail|required|integer|max:100',
            'soilClass.lowland.other' => 'bail|required|integer|max:100',
            'soilClass.lowerThird.argisol' => 'bail|required|integer|max:100',
            'soilClass.lowerThird.latosol' => 'bail|required|integer|max:100',
            'soilClass.lowerThird.cambisol' => 'bail|required|integer|max:100',
            'soilClass.lowerThird.gleisol' => 'bail|required|integer|max:100',
            'soilClass.lowerThird.other' => 'bail|required|integer|max:100',
            'soilClass.middleThird.argisol' => 'bail|required|integer|max:100',
            'soilClass.middleThird.latosol' => 'bail|required|integer|max:100',
            'soilClass.middleThird.cambisol' => 'bail|required|integer|max:100',
            'soilClass.middleThird.gleisol' => 'bail|required|integer|max:100',
            'soilClass.middleThird.other' => 'bail|required|integer|max:100',
            'soilClass.upperThird.argisol' => 'bail|required|integer|max:100',
            'soilClass.upperThird.latosol' => 'bail|required|integer|max:100',
            'soilClass.upperThird.cambisol' => 'bail|required|integer|max:100',
            'soilClass.upperThird.gleisol' => 'bail|required|integer|max:100',
            'soilClass.upperThird.other' => 'bail|required|integer|max:100',
            'geolocation.latitude' => 'bail|required|min:-90.0000000|max:90.0000000',
            'geolocation.longitude' => 'bail|required|min:-180.0000000|max:180.0000000',
            'geolocation.ratio' => 'required',
        );

        $validator = Validator::make($request->all(), $validate);

        if ($validator->fails()) {
            return $this->send_error(
                'Erro ao tentar cadastrar a Unidade Operacional',
                $validator->errors()
            );
        }

        $is_geolocation_valid = $this->checkBlockLocalization($request->geolocation['latitude'], $request->geolocation['longitude']);
        if (!$is_geolocation_valid) {
            return $this->send_error(
                'Já existe uma Unidade Operacional nas coordenadas informadas',
            );
        }

        $block_production = new Production();
        $block_production->fill($request->get('production'));
        $block_production->save();

        $block_soil_use = new SoilUse();
        $block_soil_use->fill($request->get('soilUse'));
        $block_soil_use->save();

        $block_soil_class = new SoilClass();
        $block_soil_class->save();

        $lowland = new Lowland();
        $lowland->fill($request->get('soilClass')['lowland']);
        $lowland->soilClass()->associate($block_soil_class);
        $lowland->save();

        $lower_third = new LowerThird();
        $lower_third->fill($request->get('soilClass')['lowerThird']);
        $lower_third->soilClass()->associate($block_soil_class);
        $lower_third->save();

        $middle_third = new MiddleThird();
        $middle_third->fill($request->get('soilClass')['middleThird']);
        $middle_third->soilClass()->associate($block_soil_class);
        $middle_third->save();

        $upper_third = new UpperThird();
        $upper_third->fill($request->get('soilClass')['upperThird']);
        $upper_third->soilClass()->associate($block_soil_class);
        $upper_third->save();

        $block_handling = new Handling();
        $block_handling->fill($request->get('handling'));
        $block_handling->save();

        $block_genotypes = new Genotype();
        $block_genotypes->save();

        $common = new Common();
        $common->fill($request->get('genotypes')['common']);
        $common->genotype()->associate($block_genotypes);
        $common->save();

        $hybrid = new Hybrid();
        $hybrid->fill($request->get('genotypes')['hybrid']);
        $hybrid->genotype()->associate($block_genotypes);
        $hybrid->save();

        $cloned = new Cloned();
        $cloned->fill($request->get('genotypes')['cloned']);
        $cloned->genotype()->associate($block_genotypes);
        $cloned->save();

        $block_rainfall = new Rainfall();
        $block_rainfall->fill($request->get('rainfall'));
        $block_rainfall->save();

        $block_geolocation = new Geolocation();
        $block_geolocation->fill($request->get('geolocation'));
        $block_geolocation->save();

        $block = new Block();
        $block->area = $request->get('area');
        $block->label = $request->get('label');
        $block->relief = $request->get('relief');
        $block->altitude = $request->get('altitude');
        $block->property_id = $request->get('propertyId');
        $block->soilUse()->associate($block_soil_use);
        $block->rainfall()->associate($block_rainfall);
        $block->handling()->associate($block_handling);
        $block->genotype()->associate($block_genotypes);
        $block->soilClass()->associate($block_soil_class);
        $block->production()->associate($block_production);
        $block->geolocation()->associate($block_geolocation);
        $block->save();

        return $this->send_response(
            new BlockResource($block),
            'Unidade operacional registrada',
            201
        );
    }

    public function show(Block $block)
    {
        if (!$block) {
            return $this->send_error('Unidade Operacional não encontrada');
        }

        return $this->send_response(new BlockResource($block));
    }

    public function update(Request $request, $block)
    {
        if (!$blockEntity = Block::find(intval($block))) {
            return $this->send_error('Unidade operacional não encontrada');
        }

        $is_geolocation_valid = $this->checkBlockLocalizationById($request->geolocation['latitude'], $request->geolocation['longitude'], $blockEntity->id);
        if (!$is_geolocation_valid) {
            return $this->send_error(
                'Já existe uma Unidade Operacional nas coordenadas informadas',
            );
        }

        $blockEntity->area = $request->get('area');
        $blockEntity->label = $request->get('label');
        $blockEntity->relief = $request->get('relief');
        $blockEntity->altitude = $request->get('altitude');
        $blockEntity->property_id = $request->get('property')['id'];
        $blockEntity->update();

        $block_production = $request->only('production')['production'];
        $block_rainfall = $request->only('rainfall')['rainfall'];
        $block_soil_use = $request->only('soilUse')['soilUse'];
        $block_handling = $request->only('handling')['handling'];
        $block_genotypes = $request->only('genotype')['genotype'];
        $block_soil_class = $request->only('soilClass')['soilClass'];
        $block_geolocation = $request->only('geolocation');

        $filtered['latitude'] = $block_geolocation['geolocation']['latitude'];
        $filtered['longitude'] = $block_geolocation['geolocation']['longitude'];
        $filtered['ratio'] = $block_geolocation['geolocation']['ratio'];

        $block_genotype_entity = Genotype::find($blockEntity->genotypes_id);
        $block_soil_class_entity = SoilClass::find($blockEntity->soil_class_id);

        $blockEntity->geolocation()->update($filtered);
        $blockEntity->soilUse()->update($block_soil_use);
        $blockEntity->rainfall()->update($block_rainfall);
        $blockEntity->handling()->update($block_handling);
        $blockEntity->production()->update($block_production);
        $block_genotype_entity->common()->update($block_genotypes['common']);
        $block_genotype_entity->hybrid()->update($block_genotypes['hybrid']);
        $block_genotype_entity->cloned()->update($block_genotypes['cloned']);
        $block_soil_class_entity->lowland()->update($block_soil_class['lowland']);
        $block_soil_class_entity->lowerThird()->update($block_soil_class['lowerThird']);
        $block_soil_class_entity->middleThird()->update($block_soil_class['middleThird']);
        $block_soil_class_entity->upperThird()->update($block_soil_class['upperThird']);

        return $this->send_response(
            new BlockResource($blockEntity),
            'Unidade Operacional atualizada'
        );
    }

    public function clustering(Request $request)
    {
        $property_id = $request->query('propid');

        $property = Property::where('id', '=', $property_id)->first();

        $blocks = Block::where('property_id', '=', $property_id)
            ->orderBy('id', 'asc')
            ->get();

        $blocksCollection = BlockResource::collection($blocks);

        /**
         * Verifica qual informação das roças será utilizado para agrupá-las
         * 0 - Dados de produção (se todas as roças tem a informação ou em último caso)
         * 1 - Tipo de safra
         * 2 - Genótipo
         * 3 - Topografia
         */
        $clusteringMethod = 0;

        /**
         * Se houver algum dado de produção não informado,
         * verificamos uma outra informação para clusterizar
         */
        foreach ($blocksCollection as $key => $block) {
            if ($block->production->not_informed === 1) {
                $clusteringMethod = 1;
                break;
            }
        }

        /**
         * Se todos forem iguais utilizaremos outro método,
         * caso contrário, o agrupamento será feito utilizando
         * a informação de qual manejo foi usado na safra principal
         * 
         * 0 - Tradicional
         * 1 - Tecnificado
         */
        $crops = [];
        if ($clusteringMethod === 1) {
            foreach ($blocksCollection as $key => $block) {
                if ($block->handling->temple === 1 && $block->handling->main === 0) {
                    $crops[] = 0;
                } elseif ($block->handling->temple === 0 && $block->handling->main === 1) {
                    $crops[] = 1;
                } elseif ($block->handling->temple === 1 && $block->handling->main === 1) {
                    $crops[] = 1;
                }
            }

            $crop = implode('', $crops);

            if (!(str_contains($crop, '0') && str_contains($crop, '1'))) {
                $clusteringMethod = 2;
            }
        }

        /**
         * Se todos os genótipos forem iguais, checaremos se outro método é possível
         * caso contrário, o agrupamento será feito utilizando o genótipo predominante
         * das roças
         * 
         * 0 - Comum
         * 1 - Híbrido
         * 2 - Clonado
         */
        $genotypes = [];
        if ($clusteringMethod === 2) {
            foreach ($blocksCollection as $key => $block) {
                $participation = [
                    $block->genotype->common['total_area_participation'],
                    $block->genotype->hybrid['total_area_participation'],
                    $block->genotype->cloned['total_area_participation'],
                ];

                $indexOfMaxParticipation = array_keys($participation, max($participation));
                $genotypes[] = $indexOfMaxParticipation[0];
            }

            $genotype = implode('', $genotypes);

            if (!(str_contains($genotype, '0') &&
                str_contains($genotype, '1') &&
                str_contains($genotype, '2')
            )) {
                $clusteringMethod = 3;
            }
        }

        /**
         * 0 - argissolo
         * 1 - latossolo
         * 2 - cambissolo
         * 3 - gleissolo/hidromórfico
         * 4 - outros
         */
        $soilClasses = [];
        if ($clusteringMethod === 3) {
            foreach ($blocksCollection as $key => $block) {
                $totalArgisol =
                    $block->soilClass->lowland['argisol'] +
                    $block->soilClass->lowerThird['argisol'] +
                    $block->soilClass->middleThird['argisol'] +
                    $block->soilClass->upperThird['argisol'];

                $totalLatosol =
                    $block->soilClass->lowland['latosol'] +
                    $block->soilClass->lowerThird['latosol'] +
                    $block->soilClass->middleThird['latosol'] +
                    $block->soilClass->upperThird['latosol'];

                $totalCambisol =
                    $block->soilClass->lowland['cambisol'] +
                    $block->soilClass->lowerThird['cambisol'] +
                    $block->soilClass->middleThird['cambisol'] +
                    $block->soilClass->upperThird['cambisol'];

                $totalGleisol =
                    $block->soilClass->lowland['gleisol'] +
                    $block->soilClass->lowerThird['gleisol'] +
                    $block->soilClass->middleThird['gleisol'] +
                    $block->soilClass->upperThird['gleisol'];

                $totalOther =
                    $block->soilClass->lowland['other'] +
                    $block->soilClass->lowerThird['other'] +
                    $block->soilClass->middleThird['other'] +
                    $block->soilClass->upperThird['other'];

                $values = [$totalArgisol, $totalLatosol, $totalCambisol, $totalGleisol, $totalOther];

                $indexOfMaxValue = array_keys($values, max($values));
                $soilClasses[] = $indexOfMaxValue[0];
            }

            $soilClass = implode('', $soilClasses);

            // Se todos as classes de solo forem iguais, usaremos as informações da produção
            if (!(str_contains($soilClass, '0') &&
                str_contains($soilClass, '1') &&
                str_contains($soilClass, '2') &&
                str_contains($soilClass, '3') &&
                str_contains($soilClass, '4')
            )) {
                $clusteringMethod = 0;
            }
        }

        $dbscan = null;
        $clusters = null;
        switch ($clusteringMethod) {
            case 0:
                $dbscan = new DBSCAN(4, 1);
                $clusters = $dbscan->cluster($this->clusterByProduction($blocksCollection));
                break;
            case 1:
                $dbscan = new DBSCAN(1, 1);
                $clusters = $dbscan->cluster($this->clusterByCrop($blocksCollection, $crops));
                break;
            case 2:
                $dbscan = new DBSCAN(1, 1);
                $clusters = $dbscan->cluster($this->clusterByGenotype($blocksCollection, $genotypes));
                break;
            case 3:
                $dbscan = new DBSCAN(1, 1);
                $clusters = $dbscan->cluster($this->clusterBySoilClass($blocksCollection, $soilClasses));
                break;
            default:
                break;
        }

        foreach ($clusters as $key => $cluster) {
            $homogeneous_area = new HomogeneousArea();
            $homogeneous_area->label = "A.H. " . $key + 1;
            $homogeneous_area->property_id = $property_id;
            $homogeneous_area->save();

            foreach ($cluster as $label => $data) {
                $rule = Stratum::where('label', "{$property->area_name} " . $label + 1)
                    ->where('status', true)
                    ->where('homogeneous_area_id', $homogeneous_area->id)
                    ->first();

                if (!$rule) {
                    $stratum = new Stratum();
                    $stratum->label = "{$property->area_name} " . $label + 1;
                    $stratum->homogeneous_area_id = $homogeneous_area->id;
                    $stratum->save();

                    $sp_geolocation = new Geolocation();
                    $sp_geolocation->latitude = 0.0;
                    $sp_geolocation->longitude = 0.0;
                    $sp_geolocation->save();

                    for ($i = 0; $i < 5; $i++) {
                        $rule = SamplingPoint::where('label', $i + 1)
                            ->where('status', true)
                            ->where('stratum_id', $stratum->id)
                            ->first();

                        if (!$rule) {
                            $s_point = new SamplingPoint();
                            $s_point->label = $i + 1;
                            $s_point->year = 1;
                            $s_point->harvest = 2025;
                            $s_point->status = true;
                            $s_point->stratum_id = $stratum->id;

                            $s_point->geolocation()->associate($sp_geolocation);
                            $s_point->save();

                            for ($j = 0; $j < 7; $j++) {
                                $ruleSp = Tree::where('label', $j + 1)
                                    ->where('status', true)
                                    ->where('sampling_point_id', $s_point->id)
                                    ->first();

                                if (!$ruleSp) {
                                    $tree = new Tree();
                                    $tree->label = $j + 1;
                                    $tree->status = true;
                                    $tree->sampling_point_id = $s_point->id;
                                    $tree->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        return $this->send_response('', "Propriedade clusterizada", 200);
    }

    protected function clusterByProduction($blocksCollection)
    {
        $samples = [];
        $key = '';
        $label = 1;

        foreach ($blocksCollection as $key => $block) {
            $key = $label;
            $production = $block->production->total;

            $samples[$key] = [$production];
            $label++;
        }

        return $samples;
    }

    protected function clusterByCrop($blocksCollection, $crops)
    {
        $samples = [];
        $key = '';
        $index = 0;
        $label = 1;

        foreach ($blocksCollection as $key => $block) {
            $key = $label;
            $crop = $crops[$index];

            $samples[$key] = [$crop];
            $index++;
            $label++;
        }

        return $samples;
    }

    protected function clusterByGenotype($blocksCollection, $genotypes)
    {
        $samples = [];
        $key = '';
        $index = 0;
        $label = 1;

        foreach ($blocksCollection as $key => $block) {
            $key = $label;
            $genotype = $genotypes[$index];

            $samples[$key] = [$genotype];
            $index++;
            $label++;
        }

        return $samples;
    }

    protected function clusterBySoilClass($blocksCollection, $soilClasses)
    {
        $samples = [];
        $key = '';
        $index = 0;
        $label = 1;

        foreach ($blocksCollection as $key => $block) {
            $key = $label;
            $soilClass = $soilClasses[$index];

            $samples[$key] = [$soilClass];
            $index++;
            $label++;
        }

        return $samples;
    }

    protected function checkBlockLocalization($latitude, $longitude)
    {
        $rule = Block::whereHas(
            'geolocation',
            function ($geolocation) use ($latitude, $longitude) {
                $geolocation->where('latitude', '=', $latitude)
                    ->where('longitude', '=', $longitude);
            }
        )->first();

        if ($rule) {
            return false;
        }

        return true;
    }

    protected function checkBlockLocalizationById($latitude, $longitude, $block_id)
    {
        $rule = Block::whereHas(
            'geolocation',
            function ($geolocation) use ($latitude, $longitude) {
                $geolocation->where('latitude', '=', $latitude)
                    ->where('longitude', '=', $longitude);
            }
        )->first();

        if (!$rule) {
            return true;
        } else if ($rule->id === $block_id) {
            return true;
        }

        return false;
    }
}
