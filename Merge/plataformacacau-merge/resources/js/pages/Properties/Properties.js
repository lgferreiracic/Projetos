import { Fields, PaginationOptions } from "./TableOptions";

export default {
	data() {
		return {
			authToken: null,
			userRoles: null,
			userRole: "",
			properties: [],
			property: {
				id: "",
				name: "",
				owner_name: "",
				description: "",
				city: "",
				uf: "",
				area_name: "",
				area: null,
				status: null,
				total_homogeneous_areas: null,
				geolocation: {
					latitude: 0,
					longitude: 0,
					ratio: 2.0,
				},
			},
			city: {},
			cities: {},
			state: {},
			states: [],
			property_status: null,
			editMode: false,
			loading: false,
			loadingCities: false,
			fields: Fields,
			paginationOptions: PaginationOptions,
		};
	},

	computed: {
		totalProperties() {
			return this.properties.length > 0;
		},
	},

	created() {
		this.authToken = window.token;
		this.fields[4].sortFn = this.sortStatus;
		this.userRole = window.Roles[0].label;

		this.index();
	},

	async mounted() {
		await this.getStates();
	},

	methods: {
		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[4].sortFn = null;
		},

		editModal(property) {
			this.editMode = true;

			this.property.id = property.id;
			this.property.name = property.name;
			this.property.area = property.area;
			this.property.owner_name = property.owner_name;
			this.property.description = property.description;
			this.property.city = property.city;
			this.property.uf = property.uf;
			this.property.status = property.status;
			this.property.geolocation.latitude = Number(
				property?.geolocation?.latitude ?? 0
			).toFixed(7);
			this.property.geolocation.longitude = Number(
				property?.geolocation?.longitude ?? 0
			).toFixed(7);
			this.city = property.city;

			$("#modalProperties").modal("show");
		},

		addModal() {
			let _this = this;
			_this.clearForm();
			this.editMode = false;
			$("#modalProperties").modal("show");
		},

		async getStates() {
			await axios
				.get(
					"https://servicodados.ibge.gov.br/api/v1/localidades/estados"
				)
				.then((response) => {
					this.states = response.data;
				})
				.catch((err) => {
					console.log(err);
				});
		},

		async getCities(event) {
			let state = event.target.value;
			this.loadingCities = true;

			await axios
				.get(
					`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${state}/municipios`
				)
				.then((response) => {
					this.cities = response.data;
					this.loadingCities = false;
				})
				.catch((err) => {
					this.loadingCities = false;
					console.log(err);
				});
		},

		index() {
			this.loading = true;

			axios
				.get("/api/v1/properties", {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200) {
						console.log(response.data.data);
						this.properties = response.data.data;
					} else {
						console.log(response);
					}
					this.loading = false;
				})
				.catch((err) => {
					console.log(err);
					this.loading = false;
				});
		},

		store() {
			axios
				.post("/api/v1/properties", this.property, {
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
		},

		update() {
			axios
				.put(`/api/v1/properties/${this.property.id}`, this.property, {
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
		},

		checkStatus(status) {
			let message = "";

			switch (status) {
				case 0:
					return `<h6><span class="badge badge-pill badge-danger">Desativada</span></h6>`;
				case 1:
					return `<h6><span class="badge badge-pill badge-info text-light">Ativada</span></h6>`;
				case 2:
					return `<h6><span class="badge badge-pill badge-success">Ativada e Compartilhada</span></h6>`;
				default:
					break;
			}

			return message;
		},

		changeStatus(property_id, status = true) {
			let status_message = "";
			this.property_status = status;

			status
				? (status_message = "ativar")
				: (status_message = "desativar");

			Swal.fire({
				title: "Deseja " + status_message + " esta propriedade?",
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
							`/api/v1/properties/${property_id}/status`,
							{
								status: this.property_status,
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
			this.editMode = false;
			this.property.id = null;
			this.property.name = "";
			this.property.area = null;
			this.property.owner_name = "";
			this.property.description = "";
			this.property.city = "";
			this.property.uf = "";
			this.property.status = true;
			this.property.geolocation.latitude = null;
			this.property.geolocation.longitude = null;
			this.city = {};

			$("#modalProperties").modal("hide");
		},
	},
};
