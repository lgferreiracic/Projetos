<template>
	<div class="container h-100">
		<div class="row justify-content-md-center h-100">
			<div class="card-wrapper">
				<div class="card fat">
					<div class="card-body">
						<div class="brand text-center">
							<img
								class="img-fluid"
								:src="'/img/agrocacau_logo.png'"
								alt="card image"
							/>
						</div>
						<h4 class="card-title text-center">PlataformaCacao</h4>
						<form
							method="POST"
							@submit.prevent="validateForm()"
							novalidate
						>
							<div class="form-inputs">
								<div class="form-group">
									<label for="email">Email</label>
									<input
										id="email"
										type="email"
										class="form-control"
										name="email"
										v-model="email"
										required
										autofocus
									/>
								</div>

								<div class="form-group">
									<label for="password">Senha</label>
									<div class="input-group">
										<input
											id="password"
											:type="passwordField"
											class="form-control"
											name="password"
											v-model="password"
											ref="password"
											v-validate="'required'"
											required
										/>
										<div class="input-group-append">
											<button
												class="input-group-text"
												@click.prevent="
													switchVisibility()
												"
											>
												<i
													v-if="
														passwordField ===
															'password'
													"
													class="fas fa-eye"
												></i>
												<i
													v-if="
														passwordField === 'text'
													"
													class="fas fa-eye-slash"
												></i>
											</button>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="password"
										>Confirmação de senha</label
									>
									<div class="input-group">
										<input
											id="passwordConfirmation"
											:type="passwordConfirmationField"
											class="form-control"
											name="passwordConfirmation"
											v-model="passwordConfirmation"
											v-validate="
												'required|confirmed:password'
											"
											data-vv-as="password"
											required
										/>
										<div class="input-group-append">
											<button
												class="input-group-text"
												@click.prevent="
													switchVisibility(true)
												"
											>
												<i
													v-if="
														passwordConfirmationField ===
															'password'
													"
													class="fas fa-eye"
												></i>
												<i
													v-if="
														passwordConfirmationField ===
															'text'
													"
													class="fas fa-eye-slash"
												></i>
											</button>
										</div>
									</div>
									<!-- <small
										v-if="
											errors.has('passwordConfirmation')
										"
										class="form-text text-danger"
									>
										As senhas devem ser iguais
									</small> -->
									<small
										v-if="
											errors.has('passwordConfirmation')
										"
										class="form-text text-danger"
									>
										As senhas devem ser iguais
									</small>
								</div>
							</div>

							<div class="form-group m-0">
								<button
									type="submit"
									class="btn btn-agro btn-block"
								>
									ALTERAR
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="footer">Copyright &copy; 2019 &mdash; UESC</div>
			</div>
		</div>
	</div>
</template>

<script>
import Vue from "vue";
import VeeValidate from "vee-validate";

Vue.use(VeeValidate, {
	fieldsBagName: "veeFields"
});

export default {
	data() {
		return {
			token: null,
			email: null,
			password: null,
			passwordConfirmation: null,
			passwordField: "password",
			passwordConfirmationField: "password",
			messages: [],
			hasError: true
		};
	},

	methods: {
		validateForm() {
			if (this.errors.items.length > 0) {
				Swal.fire({
					title: "Algo esta errado...",
					icon: "error",
					text: "Por favor, verifica o formulário e tente novamente.",
					showConfirmButton: true,
					timer: 2000
				});
			} else {
				this.resetPassword();
			}
		},

		resetPassword() {
			axios
				.post("/api/v1/reset/password", {
					token: this.$route.params.token,
					email: this.email,
					password: this.password,
					password_confirmation: this.passwordConfirmation
				})
				.then(response => {
					if (response.status === 200) {
						Swal.fire({
							title: "Senha Alterada",
							icon: "success",
							text:
								"Você será redirecionado para a tela de login...",
							showConfirmButton: true,
							timer: 2000
						});
						this.$router.push("/login");
					}
				})
				.catch(err => {
					console.log(err);
				});
		},

		switchVisibility(passwordConfirmation = false) {
			if (passwordConfirmation) {
				this.passwordConfirmationField =
					this.passwordConfirmationField === "password"
						? "text"
						: "password";
			} else {
				this.passwordField =
					this.passwordField === "password" ? "text" : "password";
			}
		}
	}
};
</script>
