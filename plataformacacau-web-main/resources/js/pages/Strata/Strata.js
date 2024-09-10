import { Fields, PaginationOptions } from "./TableOptions";

export default {
	data() {
		return {
			authToken: null,
			strata: [],
			stratum: {
				id: "",
				label: "",
				status: true,
				homogeneous_area_id: null,
				homogeneous_area: {
					id: null,
					label: "",
					status: true
				}
			},
			homogeneous_areas: [],
			loading: false,
			editMode: false,
			fields: Fields,
			paginationOptions: PaginationOptions
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.haId = Number(urlParams.get("haid"));
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

		editModal(stratum) {
			this.editMode = true;

			this.stratum.id = stratum.id;
			this.stratum.label = stratum.label;
			this.stratum.homogeneous_area = stratum.homogeneous_area;
			this.stratum.homogeneous_area_id = stratum.homogeneous_area.id;

			$("#modalStrata").modal("show");
		},

		addModal() {
			this.clearForm();
			this.editMode = false;

			$("#modalStrata").modal("show");
		},

		index() {
			this.loading = true;

			axios
				.all([
					axios.get(`/api/v1/strata?haid=${this.haId}`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
					axios.get(`/api/v1/homogeneous-area`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
				])
				.then(
					axios.spread((strRes, haRes) => {
						if (strRes.status === 200) {
							this.strata = strRes.data.data;
						} else {
							console.log(strRes);
						}

						if (haRes.status === 200) {
							this.homogeneous_areas = haRes.data.data;
						} else {
							console.log(haRes);
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
			this.stratum.homogeneous_area_id = _this.stratum.homogeneous_area.id;

			axios
				.post(`/api/v1/strata`, this.stratum, {
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
			this.stratum.id = _this.stratum.id;
			this.stratum.homogeneous_area_id =
				_this.stratum.homogeneous_area.id;

			console.log("this.stratum", this.stratum);
			axios
				.put(`/api/v1/strata/${this.stratum.id}`, this.stratum, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
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

		changeStatus(stratum_id, status = true) {
			let status_message = "";
			this.stratum_status = status;

			status
				? (status_message = "ativar")
				: (status_message = "desativar");

			Swal.fire({
				title: "Deseja " + status_message + " este estrato?",
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
							`/api/v1/strata/${stratum_id}/status`,
							{
								status: this.stratum_status
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
			this.stratum.id = null;
			this.stratum.label = "";
			this.stratum.status = true;
			this.stratum.homogeneous_area = {};
			this.stratum.homogeneous_area_id = null;

			$("#modalStrata").modal("hide");
		}
	}
};
