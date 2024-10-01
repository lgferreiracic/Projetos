<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Relatório de Visitas - AgroCacau</title>

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
				<h2>Relatório - Visitas</h2>
			</div>

			<ul class="list-group">
				<div class="list-group-body">
					@foreach ($data as $key => $visits)
						<li class="list-group-item">
							<h3>Visita {{ $key }}</h3>
							<span class="name">Ponto Amostral {{ $visits[0]->tree()->first()->sampling_point->label }}</span>
							<hr>
							@foreach ($visits as $tree_visit)
								<span class="name">Árvore {{ $tree_visit->tree->label }}</span>
								<ul>
									<li>Bilros: {{ $tree_visit->bobbin->total }}</li>
									<li>Pequenos: {{ $tree_visit->small->total }}</li>
									<li>Médios: {{ $tree_visit->medium->total }}</li>
									<li>Adultos: {{ $tree_visit->adult->total }}</li>
									<li>Maduros: {{ $tree_visit->mature->total }}</li>
									{{-- <li>Coletado em: {{ date('d/m/Y', strtotime($tree_visit->visit_information->date)) }}</li> --}}
								</ul>
							@endforeach
						</li>
					@endforeach
				</div>
			</ul>
		</div>	
	</body>
</html>