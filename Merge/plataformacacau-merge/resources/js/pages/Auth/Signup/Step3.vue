<template>
	<div>
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">✅ Termos e condições</h2>
		</div>
		<div class="card-body">
			<!-- <h5 class="card-title">Special title treatment</h5> -->
			<p class="card-text">
				Para isso, é necessário que você forneça alguns dados sobre seu
				cultivo de cacau.
			</p>
			<p class="card-text">
				Os dados do cultivo poderão ser utilizados para pesquisas que
				trarão novas funções à Plataforma. Quanto mais funções, mais
				benefícios para você.
			</p>
			<p class="card-text">
				Porém, antes de prosseguir com o uso do sistema, você deve
				concordar com as nossas diretrizes que estão disponibilizadas
				logo abaixo. É muito importante que você as leio com atenção.
			</p>
			<div>
				<div class="form-check">
					<input
						type="checkbox"
						class="form-check-input"
						@click="$emit('isTermsAccepted')"
						id="termsAndConditions"
					/>
					<label class="form-check-label" for="termsAndConditions"
						>Eu concordo com os
						<a href="#">Termos e Condições</a>
					</label>
				</div>
				<div class="form-check">
					<input
						type="checkbox"
						class="form-check-input"
						@click="$emit('isPoliticsAccepted')"
						id="termsPrivacyPolitics"
					/>
					<label class="form-check-label" for="termsPrivacyPolitics"
						>Eu concordo com as
						<a href="#">Políticas de Privacidade</a>
					</label>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {},
};
</script>

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

label {
	color: #000;
	font-family: "Lexend", sans-serif;
	font-weight: 400;
	font-size: 14px;

	a {
		color: #3d8160;
		text-decoration: underline;
	}
}
</style>
