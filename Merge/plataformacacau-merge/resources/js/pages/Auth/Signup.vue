<template>
	<div class="container py-4">
		<div class="row">
			<div class="col-12 d-flex justify-content-center mb-3">
				<h1>PlataformaCacau</h1>
			</div>
			<div class="col-12 d-flex justify-content-center">
				<div class="card shadow">
					<div class="card-header d-flex justify-content-center">
						<img
							class="img-fluid"
							:src="'/img/BookmarkSimple.svg'"
						/>
					</div>
					<div class="signup-steps">
						<step-0 v-show="step === 0"></step-0>
						<step-1 v-show="step === 1"></step-1>
						<step-2 v-show="step === 2"></step-2>
						<step-3
							v-show="step === 3"
							v-on:isTermsAccepted="
								isTermsAccepted = !isTermsAccepted
							"
							v-on:isPoliticsAccepted="
								isPoliticsAccepted = !isPoliticsAccepted
							"
						></step-3>
						<step-4
							v-show="step === 4"
							:checkName="checkName"
							:checkPhone="checkPhone"
							:formErrors="formErrors"
							:propertyAreaName="propertyAreaName"
							v-on:name="name = $event"
							v-on:phone="phone = $event"
						></step-4>
						<step-5
							v-show="step === 5"
							:formErrors="formErrors"
							:checkEmail="checkEmail"
							:checkPassword="checkPassword"
							v-on:email="email = $event"
							v-on:userPassword="password = $event"
						></step-5>
					</div>
					<div class="row d-flex justify-content-center my-3">
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 0 || step > 0 }"
							title="Boas vindas!"
						></div>
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 1 || step > 1 }"
							title="Como funciona"
						></div>
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 2 || step > 2 }"
							title="Sobre os dados coletados"
						></div>
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 3 || step > 3 }"
							title="Termos e condições de uso"
						></div>
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 4 || step > 4 }"
							title="Informações pessoais"
						></div>
						<div
							class="step-indicator mx-1"
							:class="{ on: step === 5 }"
							title="Informações de acesso ao sistema"
						></div>
					</div>
					<div class="d-flex justify-content-center mx-5 my-3">
						<div v-show="step === 0">
							<a
								@click.prevent="nextStep()"
								class="btn btn-success"
								>Próximo</a
							>
						</div>
						<div v-show="step === 1">
							<a
								@click.prevent="previousStep()"
								class="btn btn-light mr-2"
								>Voltar</a
							>
							<a
								@click.prevent="nextStep()"
								class="btn btn-success"
								>Próximo</a
							>
						</div>
						<div v-show="step === 2">
							<a
								@click.prevent="previousStep()"
								class="btn btn-light mr-2"
								>Voltar</a
							>
							<a
								@click.prevent="nextStep()"
								class="btn btn-success"
								>Próximo</a
							>
						</div>
						<div v-show="step === 3">
							<a
								@click.prevent="previousStep()"
								class="btn btn-light mr-2"
								>Voltar</a
							>
							<a
								@click.prevent="nextStep()"
								class="btn btn-success"
								:class="{
									disabled:
										!isTermsAccepted || !isPoliticsAccepted,
								}"
								>Próximo</a
							>
						</div>
						<div v-show="step === 4">
							<a
								@click.prevent="previousStep()"
								class="btn btn-light mr-2"
								>Voltar</a
							>
							<a
								@click.prevent="checkForm(step)"
								class="btn btn-success"
								>Próximo</a
							>
						</div>
						<div v-show="step === 5">
							<a
								@click.prevent="previousStep()"
								class="btn btn-light mr-2"
								>Voltar</a
							>
							<a
								@click.prevent="checkForm(step)"
								class="btn btn-success"
								>Concluir cadastro</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			step: 0,
			isTermsAccepted: false,
			isPoliticsAccepted: false,
			propertyAreaName: "Roça",
			name: null,
			email: null,
			phone: null,
			password: null,
			formErrors: {},
		};
	},

	watch: {},

	methods: {
		nextStep() {
			this.step += 1;
		},
		previousStep() {
			this.step -= 1;
		},
		checkName(name) {
			if (!name) {
				return false;
			}

			// Verifica se o nome contém apenas letras e espaços
			if (!/^[a-zA-Z\s]+$/.test(name)) {
				return false;
			}

			// Verifica se o nome não começa ou termina com espaço em branco
			if (name.trim() !== name) {
				return false;
			}

			return true;
		},
		checkPhone(phone) {
			if (!phone) {
				return false;
			}

			// Remove todos os caracteres não numéricos
			const clearPhone = phone.replace(/\D/g, "");

			// Verifica se o número possui 11 dígitos
			if (clearPhone.length !== 11) {
				return false;
			}

			// Verifica se o primeiro dígito após o DDD é 9
			if (clearPhone.charAt(2) !== "9") {
				return false;
			}

			return true;
		},
		checkEmail(email) {
			// Expressão regular para validar o formato do e-mail
			const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

			// Verifica se o e-mail atende ao formato esperado
			if (!regexEmail.test(email)) {
				return false;
			}

			// Se atender a todas as condições, o e-mail é considerado válido
			return true;
		},
		checkPassword(password) {
			if (
				password.length < 8 ||
				!/[A-Z]/.test(password) ||
				!/[a-z]/.test(password) ||
				!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)
			) {
				return false;
			}

			return true;
		},
		checkForm(step) {
			this.formErrors = {
				// propertyAreaName: "",
				name: "",
				phone: "",
				email: "",
				password: "",
			};

			switch (step) {
				// case 3:
				// 	if (this.propertyAreaName) {
				// 		this.nextStep();
				// 	} else {
				// 		this.formErrors.propertyAreaName =
				// 			"Você deve informar o nome da divisão da áreas da sua propriedade!";
				// 	}
				// 	break;
				case 4:
					if (
						this.checkName(this.name) &&
						this.checkPhone(this.phone) &&
						this.name &&
						this.phone
					) {
						this.nextStep();
					} else {
						if (!this.checkName(this.name)) {
							this.formErrors.name =
								"O nome informado é inválido.";
						}

						if (!this.checkPhone(this.phone)) {
							this.formErrors.phone =
								"O telefone informado está no formato inválido. Informe um número no formato (00) 9 0000-0000";
						}
					}
					break;
				case 5:
					if (
						this.checkEmail(this.email) &&
						this.checkPassword(this.password) &&
						this.email &&
						this.password
					) {
						this.signup();
					} else {
						if (!this.checkEmail(this.email)) {
							this.formErrors.email =
								"O formato do email é inválido.";
						}

						if (!this.checkPassword(this.password)) {
							this.formErrors.password =
								"Sua senha deve ter no mínimo 8 caracteres, 1 letra maiúscula, 1 letra minúscula e 1 caractere especial (!@#$%^&*()_+{})";
						}
					}
					break;
			}
		},
		signup() {
			axios
				.post("/signup", {
					// propertyAreaName: this.propertyAreaName,
					name: this.name,
					password: this.password,
					email: this.email,
					phone: this.phone,
				})
				.then((response) => {
					if (response.status === 200) {
						Swal.fire({
							icon: "success",
							title: "Cadastro realizado com sucesso",
							text: "Você será redirecionado para a tela de login dentro de alguns instantes. Aguarde!",
							showConfirmButton: false,
						});

						setTimeout(() => {
							window.location.href = "/login";
						}, 2000);
					} else {
						Swal.fire({
							icon: "error",
							title: "Houve algum problema",
							text: "Seu cadastro não foi realizado com sucesso. Tente novamente mais tarde!",
							showConfirmButton: false,
							timer: 3000,
						});
						console.log(response);
					}
				})
				.catch((err) => {
					let html = "<ul style='text-align: left'>";
					let errList = err.response.data.message[0];
					for (const [key, value] of Object.entries(errList)) {
						html += `<li>${value}</li>`;
					}
					html += "</ul>";
					console.log(`${html}`);
					Swal.fire({
						title: err.response.data.error,
						html,
						icon: "warning",
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						confirmButtonText: "Retornar",
					});
					console.log(err.response);
				});
		},
	},
};
</script>

<style lang="scss" scoped>
.card {
	background-color: #f5f8fd;
	max-width: 530px;

	.card-header {
		background-color: #f5f8fd;
		padding: 0;
		margin: 0;

		border-bottom: none;

		img {
			margin-top: -10px;
			padding: 0;
		}
	}
}

.step-indicator {
	background-color: #d9d9d9;
	border-radius: 50px;
	width: 12px;
	height: 12px;
}

.step-indicator.on {
	background-color: #3d8160;
}

h1 {
	color: #fff;

	font-family: "Lexend", sans-serif;
	font-weight: 600;
	font-size: 30px;
}
</style>
