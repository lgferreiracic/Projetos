<template>
	<div class="container h-100">
		<div class="row justify-content-md-center h-100">
			<div class="card-wrapper">
				<div class="card fat">
					<div v-if="!loading" class="card-body">
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
							@submit.prevent="sendEmail()"
							novalidate
						>
							<div class="form-inputs">
								<div class="form-group">
									<label for="email"
										>Informe o email de envio</label
									>
									<input
										id="email"
										type="email"
										class="form-control"
										name="email"
										placeholder=""
										v-model="email"
										required
										autofocus
									/>
								</div>
							</div>

							<div class="form-group m-0">
								<button
									type="submit"
									class="btn btn-agro btn-block"
								>
									ENVIAR
								</button>
							</div>

							<router-link
								tag="a"
								class="btn btn-link"
								to="/login"
								>Voltar para login</router-link
							>
						</form>
					</div>

					<div v-else class="card-body">
						<vue-simple-spinner
							:size="85"
							:line-size="17"
							:line-fg-color="'#25661a'"
							:message="
								'Aguarde até que o processo seja completo...'
							"
							:font-size="15"
							:speed="1.5"
						/>
					</div>
				</div>
				<div class="footer">Copyright &copy; 2019 &mdash; UESC</div>
			</div>
		</div>
	</div>
</template>

<script>
import VueSimpleSpinner from "vue-simple-spinner";

export default {
	components: {
		VueSimpleSpinner
	},

	data() {
		return {
			email: null,
			loading: false
		};
	},

	methods: {
		sendEmail() {
			this.loading = true;
			axios
				.post("/api/v1/reset", {
					email: this.email
				})
				.then(response => {
					this.loading = false;
					if (response.status === 200) {
						Swal.fire({
							title: "Email enviado com sucesso.",
							text: "Cheque sua caixa de entrada...",
							icon: "success",
							showConfirmationButton: false,
							timer: 1500
						});
						this.$router.push("/login");
					}
				})
				.catch(err => {
					this.loading = false;
					if (err) {
						Swal.fire({
							title: "Ocorreu um erro.",
							text: "Verifique se seu e-mail está correto! Se o erro persistir, tente novamente mais tarde ou entre em contato conosco.",
							icon: "error",
							showConfirmationButton: true,
						});
					}
					// console.log("Erro no email", err);
				});
		}
	}
};
</script>
