@php
    class Format
    {
        public function checkAltitude($altitude)
        {
            if ($altitude === 1) {
                return 'Baixo (até 200m)';
            }

            return 'Alto (acima de 200m)';
        }

        public function checkRelief($relief)
        {
            $reliefType = '';
            switch ($relief) {
                case 1:
                    $reliefType = 'Plano';
                    break;
                case 2:
                    $reliefType = 'Suavemente ondulado';
                    break;
                case 3:
                    $reliefType = 'Ondulado';
                    break;
                case 4:
                    $reliefType = 'Escarpado';
                    break;
                default:
                    $reliefType = 'Indefinido';
                    break;
            }

            return $reliefType;
        }

        public function checkSoilClass($soilClass)
        {
            $totalArgisol =
                $soilClass->lowland['argisol'] +
                $soilClass->lowerThird['argisol'] +
                $soilClass->middleThird['argisol'] +
                $soilClass->upperThird['argisol'];

            $totalLatosol =
                $soilClass->lowland['latosol'] +
                $soilClass->lowerThird['latosol'] +
                $soilClass->middleThird['latosol'] +
                $soilClass->upperThird['latosol'];

            $totalCambisol =
                $soilClass->lowland['cambisol'] +
                $soilClass->lowerThird['cambisol'] +
                $soilClass->middleThird['cambisol'] +
                $soilClass->upperThird['cambisol'];

            $totalGleisol =
                $soilClass->lowland['gleisol'] +
                $soilClass->lowerThird['gleisol'] +
                $soilClass->middleThird['gleisol'] +
                $soilClass->upperThird['gleisol'];

            $totalOther =
                $soilClass->lowland['other'] +
                $soilClass->lowerThird['other'] +
                $soilClass->middleThird['other'] +
                $soilClass->upperThird['other'];

            $values = [$totalArgisol, $totalLatosol, $totalCambisol, $totalGleisol, $totalOther];

            $indexOfMaxValue = array_keys($values, max($values));

            switch ($indexOfMaxValue[0] + 1) {
                case 1:
                    return 'Argissolo';
                case 2:
                    return 'Latossolo';
                case 3:
                    return 'Cambissolo';
                case 4:
                    return 'Gleissolo';
                case 5:
                    return 'Outros solos';
                default:
                    break;
            }
        }

        public function checkRainfall($rainfall)
        {
            $monthsBelowAverageRainfall = 0;

            $rainfall = json_decode($rainfall);

            if ($rainfall->unknown === 1) {
                return $monthsBelowAverageRainfall;
            }

            foreach ($rainfall as $key => $month) {
                if ($key !== 'id' && $key !== 'unknown') {
                    if ($month === 0) {
                        $monthsBelowAverageRainfall += 1;
                    }
                }
            }

            return $monthsBelowAverageRainfall;
        }

        public function checkHandlingType($handling)
        {
            if ($handling->main === 0) {
                return 'Tradicional';
            }

            return 'Tecnificado';
        }

        public function createGenotypeRow($genotypes, $area)
        {
            $participation = [
                $genotypes->common['total_area_participation'],
                $genotypes->hybrid['total_area_participation'],
                $genotypes->cloned['total_area_participation'],
            ];

            $indexOfMaxParticipation = array_keys($participation, max($participation));
            $mainGenotypeCharacteristics = (object) [
                'type' => '',
                'participation' => null,
                'age' => null,
                'population' => null,
                'harvest' => '',
            ];

            switch ($indexOfMaxParticipation[0] + 1) {
                case 1:
                    $mainGenotypeCharacteristics->type = 'Comum';
                    $mainGenotypeCharacteristics->participation = $genotypes->common['total_area_participation'];
                    $mainGenotypeCharacteristics->age = $genotypes->common['age'];
                    $mainGenotypeCharacteristics->population = $genotypes->common['density'] * $area;
                    $mainGenotypeCharacteristics->harvest =
                        $genotypes->common['temple'] > $genotypes->common['main'] ? 'Temporã' : 'Principal';
                    break;
                case 2:
                    $mainGenotypeCharacteristics->type = 'Híbrido';
                    $mainGenotypeCharacteristics->participation = $genotypes->hybrid['total_area_participation'];
                    $mainGenotypeCharacteristics->age = $genotypes->hybrid['age'];
                    $mainGenotypeCharacteristics->population = $genotypes->hybrid['density'] * $area;
                    $mainGenotypeCharacteristics->harvest =
                        $genotypes->hybrid['temple'] > $genotypes->hybrid['main'] ? 'Temporã' : 'Principal';
                    break;
                case 3:
                    $mainGenotypeCharacteristics->type = 'Clonado';
                    $mainGenotypeCharacteristics->participation = $genotypes->cloned['total_area_participation'];
                    $mainGenotypeCharacteristics->age = $genotypes->cloned['age'];
                    $mainGenotypeCharacteristics->population = $genotypes->cloned['density'] * $area;
                    $mainGenotypeCharacteristics->harvest =
                        $genotypes->cloned['temple'] > $genotypes->cloned['main'] ? 'Temporã' : 'Principal';
                    break;
                default:
                    break;
            }

            return $mainGenotypeCharacteristics;
        }
    }
@endphp

<table>
    <thead>
        <tr>
            <th>UO</th>
            <th>Área (ha)</th>
            <th>Altitude</th>
            <th>Relevo</th>
            <th>Solo</th>
            <th>Meses com chuva média &lt; 60 mm</th>
            <th>Tipo de manejo</th>
            <th>Safra do tipo de manejo</th>
            <th>Tipo</th>
            <th>% participação</th>
            <th>Idade</th>
            <th>População</th>
            <th>Safra dominante</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blocks as $key => $block)
            <tr>
                <td>UO {{ $block->id }}</td>
                <td>{{ $block->area }}</td>
                <td>
                    {{ (new Format())->checkAltitude($block->area) }}
                </td>
                <td>{{ (new Format())->checkRelief($block->relief) }}</td>
                <td>{{ (new Format())->checkSoilClass($block->soilClass) }}</td>
                <td>{{ (new Format())->checkRainfall($block->rainfall) }}</td>
                <td>{{ (new Format())->checkHandlingType($block->handling) }}</td>
                <td>Principal</td>
                @foreach ((new Format())->createGenotypeRow($block->genotype, $block->area) as $key => $genotype)
                    <td>{{ $genotype }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
