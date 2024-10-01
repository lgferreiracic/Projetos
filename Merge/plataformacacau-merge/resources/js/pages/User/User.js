import Vue from "vue";
import VueMask from "v-mask";
import VueTheMask from "vue-the-mask";
import Multiselect from "vue-multiselect";
import { validate } from "gerador-validador-cpf";
import { Fields, PaginationOptions } from "./TableOptions";

Vue.use(VueMask);
Vue.use(VueTheMask);
Vue.component("multiselect", Multiselect);

export default {
	components: { Multiselect },
	data() {
		return {
			authToken: null,
			isAdmin: false,
			users: [],
			user: {
				id: "",
				name: "",
				cpf: "",
				phone: "",
				email: "",
				password: "",
				status: true,
				homogeneous_areas: [],
				homogeneous_areas_id: null,
				sampling_points: [],
				sampling_points_id: null,
				roles: [],
				permissions: [],
			},
			userIsCollector: false,
			currentUser: null,
			email_confirm: "",
			password_confirm: "",
			roles: [],
			permissions: [],
			homogeneousAreasIds: [],
			samplingPointsIds: [],
			rolesId: [],
			permissionsId: [],
			currentRoles: {
				id: "",
				title: "",
				label: "",
			},
			currentPermissions: {
				id: "",
				title: "",
				label: "",
			},
			homogeneous_areas: [],
			sampling_points: [],
			messages: [],
			haveError: false,
			editMode: false,
			loading: false,
			fields: Fields,
			paginationOptions: PaginationOptions,
			value: null,
			options: ["list", "of", "options"],
		};
	},

	created() {
		this.authToken = window.token;
		this.fields[4].sortFn = this.sortStatus;

		this.checkAdmin(window.Roles);
		this.index();
		this.allRoles();
		this.allSamplingPoints();
		this.allHomogeneousAreas();
		// this.allPermissions();
	},

	computed: {
		userRoles() {
			return this.user.roles;
		},
		email() {
			return this.user.email;
		},
		password() {
			return this.user.password;
		},
		cpf() {
			return this.user.cpf;
		},
	},

	watch: {
		currentRoles(userRoles) {
			this.user.roles = userRoles;
			this.isCollector(userRoles);
		},

		email(email) {
			this.user.email = email;
			this.emailValidate(email);
		},

		email_confirm(email_confirm) {
			this.email_confirm = email_confirm;
			this.emailConfirmation(email_confirm);
		},

		password(password) {
			this.user.password = password;
			this.passwordValidate(password);
		},

		password_confirm(password_confirm) {
			this.password_confirm = password_confirm;
			this.passwordConfirmation(password_confirm);
		},

		cpf(cpf) {
			this.user.cpf = cpf;
			this.cpfValidate(cpf);
		},
	},

	methods: {
		customLabel({ stratum, label }) {
			return `${stratum.label}: P.A. ${label}`;
		},

		customHomogeneousAreaLabel({ label }) {
			return `Área Homogênea ${label}`;
		},

		isCollector(roles) {
			roles.forEach((role) => {
				if (role.label === "collector") {
					this.userIsCollector = true;
				}
			});
		},

		checkAdmin(roles) {
			roles.forEach((role) => {
				if (role.label === "admin") {
					this.isAdmin = true;
				}
			});
		},

		cpfValidate(cpf) {
			if (!(cpf.length < 11)) {
				if (!validate(cpf)) {
					this.messages["cpf"] = "CPF inválido";
					this.haveError = true;
				} else {
					this.messages["cpf"] = null;
					this.haveError = false;
				}
			}
		},

		emailValidate(email) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
				this.messages["email"] = null;
				this.haveError = false;
			} else {
				this.messages["email"] = "Endereço de email inválido";
				this.haveError = true;
			}
		},

		emailConfirmation(email_confirm) {
			if (this.user.email != email_confirm) {
				this.messages["email_confirm"] = "Confirme o endereço de email";
				this.haveError = true;
			} else {
				this.messages["email_confirm"] = null;
				this.haveError = false;
			}
		},

		passwordValidate(password) {
			if (!(password.length < 8)) {
				this.messages["password"] = null;
				this.haveError = false;
			} else {
				this.messages["password"] =
					"Senha deve ter ao menos 8 caracteres";
				this.haveError = true;
			}
		},

		passwordConfirmation(password_confirm) {
			if (this.user.password != password_confirm) {
				this.messages["password_confirm"] = "Senhas não são iguais";
				this.haveError = true;
			} else {
				this.messages["password_confirm"] = null;
				this.haveError = false;
			}
		},

		format(cpf) {
			if (cpf.length == 14) {
				cpf = cpf.replace(".", "");
				cpf = cpf.replace(".", "");
				cpf = cpf.replace("-", "");
			}

			return cpf;
		},

		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[4].sortFn = null;
		},

		editModal(user) {
			this.editMode = true;
			this.fill_roles(user);

			this.user.id = user.id;
			this.user.name = user.name;
			this.user.email = user.email;
			this.user.phone = user.phone;
			this.user.cpf = user.cpf;
			this.user.roles = user.roles;
			this.user.sampling_points = user.sampling_points;
			this.user.homogeneous_areas = user.homogeneous_areas;

			$("#modalUsers").modal("show");
		},

		addModal() {
			this.clearForm();
			this.editMode = false;

			$("#modalUsers").modal("show");
		},

		allHomogeneousAreas() {
			axios
				.get("/api/v1/homogeneous-area", {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						this.homogeneous_areas = response.data.data;
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		allSamplingPoints() {
			axios
				.get("/api/v1/sampling-points", {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						this.sampling_points = response.data.data;
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		allRoles() {
			const roles = window.Roles;

			axios
				.get(`/api/v1/roles`, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						this.roles = response.data.data.filter((role) => {
							console.log(role);
							if (roles[0].label === "admin") {
								return role;
							} else if (roles[0].label === "users-manager") {
								if (role.label !== "pre-registered") {
									return role;
								}
							} else if (roles[0].label === "pre-registered") {
								if (
									role.label === "collector" ||
									role.label === "pre-registered"
								) {
									return role;
								}
							}
						});
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		allPermissions() {
			axios
				.get(`/api/v1/permissions`, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						this.permissions = response.data.data;
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		getHomogeneousAreaID(homogeneous_areas) {
			homogeneous_areas.forEach((homogeneous_area) => {
				this.homogeneousAreasIds.push(homogeneous_area.id);
			});
		},

		getSamplingPointID(sampling_points) {
			sampling_points.forEach((sampling_point) => {
				this.samplingPointsIds.push(sampling_point.id);
			});
		},

		getRoleId(roles) {
			roles.forEach((role) => {
				this.rolesId.push(role.id);
			});
		},

		// getPermissionId(permissions) {
		// 	permissions.forEach(permission => {
		// 		this.permissionsId.push(permission.id);
		// 	});
		// },

		index() {
			this.loading = true;

			axios
				.get("/api/v1/users", {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						this.users = response.data.data;
					} else {
						console.log(response);
					}
					this.loading = false;
				})
				.catch((err) => {
					this.loading = false;
				});
		},

		store() {
			this.getRoleId(this.currentRoles);
			this.getSamplingPointID(this.user.sampling_points);
			this.getHomogeneousAreaID(this.user.homogeneous_areas);
			this.user.roles = this.rolesId;
			this.user.sampling_points_id = this.samplingPointsIds;
			this.user.homogeneous_areas_id = this.homogeneousAreasIds;

			if (!this.haveError) {
				axios
					.post(`/api/v1/users`, this.user, {
						headers: { authorization: `bearer ${this.authToken}` },
					})
					.then((response) => {
						if (response.status === 201 && response.data.success) {
							Swal.fire({
								title: response.data.message,
								icon: "success",
								showConfirmButton: false,
								timer: 1500,
							});
						} else {
							console.log(response);
						}
						this.clearForm();
						this.index();
					})
					.catch((err) => {
						Swal.fire({
							title: err.response.data.message,
							text: err.response.data.detail,
							icon: "error",
							confirmButtonText: "Fechar",
						});
					});
			}
		},

		update() {
			this.getRoleId(this.currentRoles);
			this.getSamplingPointID(this.user.sampling_points);
			this.getHomogeneousAreaID(this.user.homogeneous_areas);
			this.user.roles = this.rolesId;
			this.user.sampling_points_id = this.samplingPointsIds;
			this.user.homogeneous_areas_id = this.homogeneousAreasIds;

			if (!this.haveError) {
				axios
					.put(`/api/v1/users/${this.user.id}`, this.user, {
						headers: { authorization: `bearer ${this.authToken}` },
					})
					.then((response) => {
						if (response.status === 200 && response.data.success) {
							Swal.fire({
								title: response.data.message,
								icon: "success",
								showConfirmButton: false,
								timer: 1500,
							});
						} else {
							console.log(response);
						}
						this.clearForm();
						this.index();
					})
					.catch((err) => {
						Swal.fire({
							title: err.response.data.message,
							text: err.response.data.detail,
							icon: "error",
							confirmButtonText: "Fechar",
						});
					});
			}
		},

		changeStatus(user_id, status = true) {
			let status_message = "";
			this.user_status = status;

			status
				? (status_message = "ativar")
				: (status_message = "desativar");

			Swal.fire({
				title: "Deseja " + status_message + " este usuário?",
				text: "",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Sim",
				cancelButtonText: "Cancelar",
			}).then((result) => {
				if (result.value) {
					axios
						.put(
							`/api/v1/users/${user_id}/status`,
							{
								status: this.user_status,
							},
							{
								headers: {
									authorization: `bearer ${this.authToken}`,
								},
							}
						)
						.then((response) => {
							if (response.status === 200) {
								Swal.fire({
									title: response.data.message,
									icon: "success",
									showConfirmButton: false,
									timer: 1500,
								});
							} else {
								console.log(response);
							}
							this.index();
						})
						.catch((err) => {
							console.log(err);
						});
				}
			});
		},

		clearForm() {
			this.user.id = null;
			this.user.name = "";
			this.user.email = "";
			this.user.phone = "";
			this.email_confirm = "";
			this.user.password = "";
			this.password_confirm = "";
			this.user.cpf = "";
			this.user.status = true;
			this.user.roles = [];
			this.userIsCollector = false;
			this.currentRoles = [];
			this.samplingPointsIds = [];
			this.homogeneousAreasIds = [];
			this.rolesId = [];
			this.messages = [];

			$("#modalUsers").modal("hide");
		},

		fill_roles: function (user) {
			let roles = this.roles;

			this.currentUser = user;
			this.currentRoles = _.map(user.roles, function (roles) {
				return roles;
			});
		},

		fill_permissions: function (user) {
			let permissions = this.permissions;

			this.currentUser = user;
			this.currentPermissions = _.map(
				user.permissions,
				function (permissions) {
					return permissions;
				}
			);
		},
	},
};
