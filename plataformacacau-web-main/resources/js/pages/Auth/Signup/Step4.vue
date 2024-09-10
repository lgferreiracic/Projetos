<template>
	<div>
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">
				👨🏽‍🌾 Nos conte um pouco <br />
				sobre você
			</h2>
		</div>
		<div class="card-body">
			<p class="card-text">
				Para auxiliar na recuperação dos seus dados, é necessário
				informar algumas informações extras. Não se preocupe, não iremos
				compartilhar esses dados com ninguém.
			</p>
			<div>
				<div class="form-row mb-2">
					<div class="col-12 mb-2">
						<label for="name">Nome completo</label>
						<input
							type="text"
							class="form-control"
							placeholder="Digite seu nome completo"
							id="name"
							v-model="name"
							@change="$emit('name', name)"
							:class="{
								'is-invalid':
									(!name || !checkName(name)) &&
									formErrors.name,
								'is-valid': checkName(name),
							}"
							autocomplete="off"
						/>
						<p class="invalid-feedback" v-if="!checkName(name)">
							{{ formErrors.name }}
						</p>
					</div>
				</div>
				<div class="form-row">
					<div class="col-12">
						<label for="phone">Telefone</label>
						<input
							type="tel"
							v-mask="['(##) ####-####', '(##) #####-####']"
							class="form-control"
							placeholder="Digite seu telefone"
							id="phone"
							v-model="phone"
							@change="$emit('phone', phone)"
							:class="{
								'is-invalid':
									(!phone || !checkPhone(phone)) &&
									formErrors.phone,
								'is-valid': checkPhone(phone),
							}"
							autocomplete="off"
						/>
						<p class="invalid-feedback" v-if="!checkPhone(phone)">
							{{ formErrors.phone }}
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		formErrors: Object,
		checkName: Function,
		checkPhone: Function,
	},

	data() {
		return {
			name: "",
			phone: "",
		};
	},

	methods: {},
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
	color: #3d8160;
	font-family: "Lexend", sans-serif;
	font-weight: 400;
	font-size: 14px;

	a {
		color: #3d8160;
		text-decoration: underline;
	}
}

span {
	color: #3d8160;
	font-weight: 600;
	text-decoration: underline;
}

.invalid-feedback {
	margin-bottom: 0;
}
</style>
