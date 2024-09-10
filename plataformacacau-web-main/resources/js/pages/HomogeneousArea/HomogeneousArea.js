import { Fields, PaginationOptions } from "./TableOptions";

export default {
	data() {
		return {
			authToken: null,
			homogeneous_areas: [],
			homogeneous_area: {
				id: "",
				label: "",
				status: true,
				property_id: null,
				property: {
					id: null,
					name: "",
					status: true
				}
			},
			properties: [],
			loading: false,
			editMode: false,
			fields: Fields,
			paginationOptions: PaginationOptions
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.propertyId = Number(urlParams.get("propid"));
		this.authToken = window.token;
		this.fields[1].sortFn = this.sortStatus;
		this.userRole = window.Roles[0].label;

		this.index();
	},

	methods: {
		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[1].sortFn = null;
		},

		editModal(homogeneous_area) {
			this.editMode = true;

			this.homogeneous_area.id = homogeneous_area.id;
			this.homogeneous_area.label = homogeneous_area.label;
			this.homogeneous_area.property = homogeneous_area.property;
			this.homogeneous_area.property_id = homogeneous_area.property.id;

			$("#modalHomogeneousArea").modal("show");
		},

		addModal() {
			this.clearForm();
			this.editMode = false;

			$("#modalHomogeneousArea").modal("show");
		},

		index() {
			this.loading = true;

			axios
				.all([
					axios.get(
						`/api/v1/homogeneous-area?propid=${this.propertyId}`,
						{
							headers: {
								authorization: `bearer ${this.authToken}`,
							},
						}
					),
					axios.get("/api/v1/properties", {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
				])
				.then(
					axios.spread((haRes, propRes) => {
						if (haRes.status === 200) {
							this.homogeneous_areas = haRes.data.data;
						} else {
							console.log(haRes);
						}

						if (propRes.status === 200) {
							this.properties = propRes.data.data;
						} else {
							console.log(propRes);
						}

						this.loading = false;
					})
				)
				.catch((err) => {
					console.log(err);
					this.loading = false;
				});
		},

		store() {
			let _this = this;
			this.homogeneous_area.property_id =
				_this.homogeneous_area.property.id;

			axios
				.post(`/api/v1/homogeneous-area`, this.homogeneous_area, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 201 && response.data.success) {
						Swal.fire({
							title: response.data.message,
							icon: "success",
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						console.log(response);
					}
					this.clearForm();
					this.index();
				})
				.catch(err => {
					Swal.fire({
						title: err.response.data.message,
						text: err.response.data.detail,
						icon: "error",
						confirmButtonText: "Fechar"
					});
				});
		},

		update() {
			let _this = this;
			this.homogeneous_area.id = _this.homogeneous_area.id;
			this.homogeneous_area.property_id =
				_this.homogeneous_area.property.id;

			console.log("this.homogeneous_area", this.homogeneous_area);
			axios
				.put(`/api/v1/homogeneous-area/${this.homogeneous_area.id}`,
					this.homogeneous_area,
					{
						headers: { authorization: `bearer ${this.authToken}` }
					}
				)
				.then(response => {
					if (response.status === 200 && response.data.success) {
						Swal.fire({
							title: response.data.message,
							icon: "success",
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						console.log(response);
					}
					console.log(response);
					this.clearForm();
					this.index();
				})
				.catch(err => {
					Swal.fire({
						title: err.response.data.message,
						text: err.response.data.detail,
						icon: "error",
						confirmButtonText: "Fechar"
					});
					console.log(err.response);
				});
		},

		changeStatus(homogeneous_area_id, status = true) {
			let status_message = "";
			this.homogeneous_area_status = status;

			status
				? (status_message = "ativar")
				: (status_message = "desativar");

			Swal.fire({
				title: "Deseja " + status_message + " esta área homogênea?",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Sim",
				cancelButtonText: "Cancelar"
			}).then(result => {
				if (result.value) {
					axios
						.put(
							`/api/v1/homogeneous-area/${homogeneous_area_id}/status`,
							{
								status: this.homogeneous_area_status
							},
							{
								headers: {
									authorization: `bearer ${this.authToken}`
								}
							}
						)
						.then(response => {
							if (
								response.status === 200 &&
								response.data.success
							) {
								Swal.fire({
									title: response.data.message,
									icon: "success",
									showConfirmButton: false,
									timer: 1500
								});
							} else {
								console.log(response);
							}
							this.index();
						})
						.catch(err => {
							console.log(err);
						});
				}
			});
		},

		clearForm() {
			this.editMode = false;
			this.homogeneous_area.id = null;
			this.homogeneous_area.label = "";
			this.homogeneous_area.status = true;
			this.homogeneous_area.property = {};

			$("#modalHomogeneousArea").modal("hide");
		}
	}
};
