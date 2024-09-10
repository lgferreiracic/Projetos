import Vue from "vue";
import VeeValidate from "vee-validate";

Vue.use(VeeValidate, {
	fieldsBagName: "veeFields"
});

export default {
	data() {
		return {
			authToken: null,
			currentPassword: null,
			newPassword: null,
			newPasswordConfirmation: null,
			currentPasswordField: "password",
			newPasswordField: "password",
			newPasswordConfirmationField: "password"
		};
	},

	created() {
		this.authToken = window.token;
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
				this.changePassword();
			}
		},

		changePassword() {
			axios
				.post(
					"/change-password",
					{
						current_password: this.currentPassword,
						new_password: this.newPassword,
						new_password_confirmation: this.newPasswordConfirmation
					},
					{
						headers: { authorization: `bearer ${this.authToken}` }
					}
				)
				.then(response => {
					if (response.status === 200 && response.data.success) {
						Swal.fire({
							title: response.data.message,
							icon: "success",
							showConfirmationButton: false,
							timer: 1500
						});
						this.clearForm();
						location.reload();
					} else {
						Swal.fire({
							title: response.data.message
						});
					}
					console.log(response);
				})
				.catch(err => {
					console.log(err);
				});
		},

		clearForm() {
			this.currentPassword = null;
			this.newPassword = null;
			this.newPasswordConfirmation = null;
		},

		switchVisibility(attr) {
			switch (attr) {
				case "current":
					this.currentPasswordField =
						this.currentPasswordField === "password"
							? "text"
							: "password";
					break;
				case "new":
					this.newPasswordField =
						this.newPasswordField === "password"
							? "text"
							: "password";
					break;
				case "new_confirm":
					this.newPasswordConfirmationField =
						this.newPasswordConfirmationField === "password"
							? "text"
							: "password";
					break;
			}
		}
	}
};
