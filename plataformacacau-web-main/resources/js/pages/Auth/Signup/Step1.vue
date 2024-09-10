<template>
	<div>
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">🔧 Como funciona</h2>
		</div>
		<div class="card-body">
			<p class="card-text mb-4">
				Para que estes serviços sejam oferecidos é necessário que o
				sistema receba alguns dados sobre o ciclo de desenvolvimento dos
				cacaueiros nas roças de cacau de uma propriedade.
			</p>
			<div class="d-flex justify-content-center">
				<img class="img-fluid" :src="'/img/signup-step-1.svg'" />
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
