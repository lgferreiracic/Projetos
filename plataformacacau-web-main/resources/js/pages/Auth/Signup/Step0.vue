<template>
	<div>
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">🎉 Cacauicultor, bem-vindo!</h2>
		</div>
		<div class="card-body">
			<p class="card-text">
				A Plataforma Cacau é um sistema que visa fornecer serviços para
				que o cacauicultor possa realizar a gestão estratégica da sua
				propriedade de cacau.
			</p>
			<p class="card-text mb-4">
				Serviços como: previsão de produtividade de amêndoas, em que
				roça colher o cacau, alerta de vassoura de bruxa, dentre outros.
			</p>
			<div class="d-flex justify-content-center">
				<img width="300" height="300" :src="'/img/signup-step-0.svg'" />
			</div>
		</div>
	</div>
</template>

<style lang="scss" scoped>
h2.subtitle {
	color: #000;

	font-family: "Lexend", sans-serif;
	font-weight: 600;
	font-size: 24px;
}

p.card-text {
	color: #000;
	text-align: left;

	font-family: "Lexend", sans-serif;
	font-weight: 400;
	font-size: 14px;
}
</style>
