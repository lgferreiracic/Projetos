<template>
	<div class="container h-100">
		<div class="row d-flex justify-content-md-center h-100">
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
						<h4 class="card-title text-center">
							PlataformaCacau
						</h4>
						<form
							method="POST"
							@submit.prevent="login()"
							class="login-validation"
							autocomplete="off"
						>
							<div class="form-inputs">
								<div class="form-group">
									<label for="email">E-mail</label>
									<input
										id="email"
										type="email"
										class="form-control"
										name="email"
										placeholder=""
										value
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
											placeholder=""
											v-model="password"
											required
										/>
										<div class="input-group-append">
											<a
												href="#!"
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
											</a>
										</div>
									</div>
								</div>

								<!-- <div class="form-group">
									<div class="custom-checkbox custom-control">
										<input
											type="checkbox"
											name="remember"
											id="remember"
											class="custom-control-input"
										/>
										<label
											for="remember"
											class="custom-control-label"
											>Lembrar-me</label
										>
									</div>
								</div> -->
							</div>

							<div class="form-group m-0">
								<button
									type="submit"
									class="btn btn-agro btn-block"
								>
									ENTRAR
								</button>
							</div>

							<router-link
								tag="a"
								class="btn btn-link"
								to="/reset"
							>
								Esqueceu sua senha?
							</router-link>
						</form>
					</div>
				</div>
				<div class="footer">Copyright &copy; 2019 &mdash; UESC</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			email: null,
			password: null,
			passwordField: "password"
		};
	},

	methods: {
		login() {
			axios
				.post("/login", {
					email: this.email,
					password: this.password
				})
				.then(response => {
					if (response.status === 200) {
						window.location.href = "/panel";
					} else {
						console.log(response);
					}
				})
				.catch(err => {
					Swal.fire({
						title: err.response.data.error,
						text: "Tente novamente ou redefina sua senha...",
						icon: "warning",
						showCancelButton: false,
						confirmButtonColor: "#3085d6",
						confirmButtonText: "Retornar"
					});
					console.log(err.response);
				});
		},

		switchVisibility() {
			this.passwordField =
				this.passwordField === "password" ? "text" : "password";
		}
	}
};
</script>

<style lang="scss" scoped>
.input-group-append > a {
	text-decoration: none;
	&:hover {
		color: inherit;
	}
}
</style>
