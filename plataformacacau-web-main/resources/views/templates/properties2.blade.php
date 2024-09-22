<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório de Propriedade - AgroCacau</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .list-group-item {
            margin-bottom: 1vh;
            border: 0;
        }
        .name {
            font-size: 17px;
            font-weight: bold;
        }
        .section-title {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="text-center">
            <h2>Relatório</h2>
        </div>

        <!-- Informações da Propriedade -->
        @if($property)
            <h3>Propriedade: {{ $property->name }}</h3>
            <ul>
                <li>Proprietário: {{ $property->owners->name ?? 'Não disponível' }}</li>
                <li>Criada em: {{ $property->created_at->format('d/m/Y H:i:s') }}</li>
                <li>Última atualização: {{ $property->updated_at->format('d/m/Y H:i:s') }}</li>
            </ul>
        @endif

        <!-- Áreas Homogêneas -->
        @if($property->homogeneous_areas->isNotEmpty())
            <div class="section-title">Áreas Homogêneas</div>
            @foreach ($property->homogeneous_areas as $homogeneous_area)
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="name">Área Homogênea: {{ $homogeneous_area->label }}</span>
                        <ul>
                            <li>Criada em: {{ $homogeneous_area->created_at->format('d/m/Y H:i:s') }}</li>
                        </ul>

                        <!-- Estratos -->
                        @if($homogeneous_area->strata->isNotEmpty())
                            <div class="section-title">Unidades Operacionais</div>
                            @foreach ($homogeneous_area->strata as $stratum)
                                <ul>
                                    <li class="name">{{ $stratum->label }} ({{ $stratum->status ? 'Ativo' : 'Inativo' }})</li>
                                    <ul>
                                        <li>Total de Pontos Amostrais: {{ $stratum->sampling_points->count() }}</li>
                                        <li>Criado em: {{ $stratum->created_at->format('d/m/Y H:i:s') }}</li>
                                        <li>Última atualização: {{ $stratum->updated_at->format('d/m/Y H:i:s') }}</li>

                                        <!-- Pontos Amostrais -->
                                        @if($stratum->sampling_points->isNotEmpty())
                                            <div class="section-title">Pontos Amostrais</div>
                                            @foreach ($stratum->sampling_points as $sampling_point)
                                                <li class="name">Ponto Amostral {{ $sampling_point->label }} ({{ $sampling_point->status ? 'Ativo' : 'Inativo' }})</li>
                                                <ul>
                                                    <li>Árvores ativas: {{ $sampling_point->trees->where('status', true)->count() }}</li>
                                                    <li>Total de Árvores: {{ $sampling_point->trees->count() }}</li>
                                                </ul>
                                            @endforeach
                                        @else
                                            <li>Pontos Amostrais não cadastrados.</li>
                                        @endif
                                    </ul>
                                </ul>
                            @endforeach
                        @else
                            <li>Unidades Operacionais não cadastradas.</li>
                        @endif
                    </li>
                </ul>
            @endforeach
        @else
            <p>A propriedade não possui Áreas Homogêneas cadastradas.</p>
        @endif
    </div>
</body>
</html>
