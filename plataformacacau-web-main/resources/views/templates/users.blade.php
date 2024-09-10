<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Relatório de Usuários - AgroCacau</title>

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
				<h2>Relatório - Usuários</h2>
			</div>

			<ul class="list-group">
				<div class="list-group-body">
					@foreach ($data as $user)
						<li class="list-group-item">
							<span class="name">{{ $user->name }} ({{ $user->status ? 'Ativo' : 'Inativo' }})</span>
							<ul>
								<li>CPF: {{ $user->cpf }}</li>
								<li>Email: {{ $user->email }}</li>
								<li>Registrado em: {{ $user->created_at->format('d/m/Y H:i:s') }}</li>
								<li>Última atualização: {{ $user->updated_at->format('d/m/Y H:i:s') }}</li>
								<li>Papéis: {{ $user->roles->pluck('title') }}</li>
							</ul>
						</li>
					@endforeach
				</div>
			</ul>
		</div>
	</body>
</html>
