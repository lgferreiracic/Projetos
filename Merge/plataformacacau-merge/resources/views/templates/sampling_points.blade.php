<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Relatório de Pontos Amostrais - AgroCacau</title>

			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
			<style lang="scss">
				.list-group-item {
					margin-bottom: 1vh;
					border: 0;
				}
		
				.name {
					font-size: 17px;
					font-weight: bold
				}
			</style>
	</head>
	<body>
		<div class="container-fluid">
			<div class="text-center">
				<h2>Relatório - Pontos Amostrais</h2>
			</div>
			@foreach ($data as $key => $sampling_points)
				<h3>Estrato {{ $sampling_points[0]->stratum()->first()->label }}</h3>
				<hr>
				<ul class="list-group">
					<div class="list-group-body">
						@foreach ($sampling_points as $sampling_point)
							<li class="list-group-item">
								<span class="name">Ponto Amostral {{ $sampling_point->label }} ({{ $sampling_point->status ? 'Ativo': 'Inativo' }})</span>
								<ul>
									<li>Árvores ativas: {{ $sampling_point->trees->where('status', true)->count() }}</li>
									<li>Total de árvores: {{ $sampling_point->trees->count() }}</li>
									<li>Localizado em: {{ $sampling_point->property->pluck('name')->first() }}</li>
								</ul>
							</li>
						@endforeach
					</div>
				</ul>
			@endforeach
		</div>
	</body>
</html>