<template>
	<div>
		<div class="mt-2 mx-2 text-center">
			<h2 class="subtitle">‍🔐 Estamos quase lá!</h2>
		</div>
		<div class="card-body">
			<p class="card-text">
				Para a segurança dos seus dados, precisamos que você escolha um
				nome de usuário e uma senha de acesso ao sistema.
			</p>
			<p class="card-text">
				Feito esse processo, sempre que for acessar o sistema, você será
				solicitado a digitar essas informações. Então, não as perca!
			</p>
			<div>
				<div class="form-row mb-2">
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
						<label for="email">Endereço de email</label>
						<input
							type="text"
							v-model="email"
							@change="$emit('email', email)"
							class="form-control"
							placeholder="Digite seu email"
							id="email"
							autocomplete="off"
							:class="{
								'is-invalid':
									(!email || !checkEmail(email)) && formErrors.email,
								'is-valid': checkEmail(email),
							}"
						/>
						<p class="invalid-feedback" v-if="!checkEmail(email)">
							{{ formErrors.email }}
						</p>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb-2">
						<label for="password">Senha</label>
						<input
							type="password"
							v-model="userPassword"
							@change="$emit('userPassword', userPassword)"
							class="form-control"
							placeholder="Digite sua senha"
							id="password"
							autocomplete="off"
							:class="{
								'is-invalid':
									(!userPassword || !checkPassword(userPassword)) && formErrors.password,
								'is-valid': checkPassword(userPassword),
							}"
						/>
						<p class="invalid-feedback" v-if="!checkPassword(userPassword)">
							{{ formErrors.password }}
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
		checkEmail: Function,
		checkPassword: Function,
	},

	data() {
		return {
			email: "",
			userPassword: "",
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

.invalid-feedback {
	margin-bottom: 0;
}
</style>
