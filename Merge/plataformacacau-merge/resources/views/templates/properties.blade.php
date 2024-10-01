<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Relatório de Propriedades - PlataformaCacau</title>

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
				<h2>Relatório - Propriedades</h2>
			</div>

			<ul class="list-group">
				<div class="list-group-body">
					@foreach ($data as $property)
						<li class="list-group-item">
							<span class="name">{{ $property->name }} ({{ $property->status ? 'Ativo' : 'Inativo' }})</span>
							<ul>
								<li>Proprietário(a): {{ $property->owner_name }}</li>
								<li>Município: {{ $property->city }}</li>
								{{-- <li>Áreas Homogêneas pertencentes à essa propriedade: {{ intval($property->homogeneous_areas->count()) }}</li> --}}
								<li>Criado em: {{ $property->created_at->format('d/m/Y H:i:s') }}</li>
								<li>Última atualização: {{ $property->updated_at->format('d/m/Y H:i:s') }}</li>
							</ul>
						</li>
					@endforeach
				</div>
			</ul>
		</div>
	</body>
</html>
