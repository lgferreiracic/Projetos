<template>
	<div style="overflow: clip">
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">🎲 Sobre a coleta de dados</h2>
		</div>
		<div class="card-body">
			<p class="card-text">
				Não é necessário coletar estes dados em todas as plantas de
				cacau da propriedade, mas em alguns cacaueiros, de tal forma que
				esses servem para estimar informações de toda a plantação.
			</p>
			<p class="card-text">
				Os dados serão coletados por pessoas/funcionários da propriedade
				durante os meses de outubro de um ano a setembro do ano
				seguinte.
			</p>
			<div
				class="d-flex justify-content-flex-start"
				style="margin-left: -22px"
			>
				<img width="300" height="300" :src="'/img/signup-step-2.svg'" />
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
