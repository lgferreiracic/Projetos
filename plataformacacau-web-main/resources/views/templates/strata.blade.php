<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Relatório de Estratos - AgroCacau</title>

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
				<h2>Relatório - Estratos</h2>
			</div>

			<ul class="list-group">
				<div class="list-group-body">
					@foreach ($data as $stratum)
						<li class="list-group-item">
							<span class="name">{{ $stratum->label }} ({{ $stratum->status ? 'Ativo' : 'Inativo' }})</span>
							<ul>
								<li>Total de pontos amostrais: {{ $stratum->sampling_points->count() }}</li>
								<li>Criado em: {{ $stratum->created_at->format('d/m/Y H:i:s') }}</li>
								<li>Última atualização: {{ $stratum->updated_at->format('d/m/Y H:i:s') }}</li>
							</ul>
						</li>
					@endforeach
				</div>
			</ul>
		</div>
	</body>
</html>