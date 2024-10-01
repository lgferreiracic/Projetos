import Vue from "vue";
import VueTheMask from "vue-the-mask";
import { Fields, PaginationOptions } from "./TableOptions";

Vue.use(VueTheMask);

export default {
	data() {
		return {
			authToken: null,
			sampling_points: [],
			sampling_point: {
				id: "",
				ini_period: "",
				harvest: "",
				year: "",
				label: "",
				status: true,
				stratum_id: null,
				geolocation: {
					id: null,
					latitude: 0.0,
					longitude: 0.0,
					ratio: 2.0,
				},
				stratum: {
					id: null,
					label: "",
					status: true,
				},
			},
			s_point_status: false,
			stratum: {
				id: null,
				label: null,
				status: null,
				total_sampling_points: 0,
			},
			messages: [],
			haveError: false,
			editMode: false,
			loading: false,
			fields: Fields,
			paginationOptions: PaginationOptions,
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.strId = Number(urlParams.get("strid"));
		this.authToken = window.token;
		this.fields[2].sortFn = this.sortStatus;

		this.index();
	},

	computed: {
		latitude() {
			return this.sampling_point.geolocation.latitude;
		},

		longitude() {
			return this.sampling_point.geolocation.longitude;
		},
	},

	watch: {
		latitude(latitude) {
			this.sampling_point.geolocation.latitude = latitude;
			this.latitudeValidate(latitude);
		},

		longitude(longitude) {
			this.sampling_point.geolocation.longitude = longitude;
			this.longitudeValidate(longitude);
		},
	},

	methods: {
		rowStyleClassFn(row) {
			if (!row.status) {
				return "deactivate-sp";
			}
		},

		latitudeValidate(latitude) {
			if (latitude) {
				if (
					latitude.length <= 10 &&
					isFinite(latitude) &&
					Math.abs(latitude) <= 90 &&
					(latitude[0] === "-" ||
						latitude[0] === "+" ||
						latitude.match(/^[0-9]/))
				) {
					this.messages["latitude"] = null;
					this.haveError = false;
				} else {
					this.messages["latitude"] = "Latitude inválida";
					this.haveError = true;
				}
			}
		},

		longitudeValidate(longitude) {
			if (longitude) {
				if (
					longitude.length <= 11 &&
					isFinite(longitude) &&
					Math.abs(longitude) <= 180 &&
					(longitude[0] === "-" ||
						longitude[0] === "+" ||
						longitude.match(/^[0-9]/))
				) {
					this.messages["longitude"] = null;
					this.haveError = false;
				} else {
					this.messages["longitude"] = "Longitude inválida";
					this.haveError = true;
				}
			}
		},

		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[4].sortFn = null;
		},

		editModal(s_point) {
			this.editMode = true;

			this.sampling_point.id = s_point.id;
			this.sampling_point.label = s_point.label;
			this.sampling_point.ini_period = s_point.ini_period;
			this.sampling_point.stratum_id = s_point.stratum_id;
			this.sampling_point.stratum = s_point.stratum;
			this.sampling_point.geolocation = s_point.geolocation;
			this.sampling_point.status = s_point.status;

			$("#modalSamplingPoints").modal("show");
		},

		addModal() {
			this.clearForm();
			this.editMode = false;

			$("#modalSamplingPoints").modal("show");
		},

		index() {
			this.loading = true;

			axios
				.all([
					axios.get(`/api/v1/sampling-points?strid=${this.strId}`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
					axios.get(`/api/v1/strata/${this.strId}`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
				])
				.then(
					axios.spread((spRes, strRes) => {
						if (spRes.status === 200) {
							this.sampling_points = spRes.data.data;
						} else {
							console.log(spRes);
						}

						if (strRes.status === 200) {
							this.stratum = strRes.data.data;
							console.error(strRes.data.data);
						} else {
							console.log(strRes);
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
			this.sampling_point.stratum_id = _this.stratum.id;
			this.sampling_point.geolocation.ratio = 2.0;

			// FIXME Esses campos devem ser preenchidos via formulário
			this.sampling_point.ini_period = "1";
			this.sampling_point.harvest = 2025;
			this.sampling_point.year = 1;

			if (!this.haveError) {
				axios
					.post(`/api/v1/sampling-points`, this.sampling_point, {
						headers: { authorization: `bearer ${this.authToken}` },
					})
					.then((response) => {
						if (response.status === 201 && response.data.success) {
							Swal.fire({
								title: response.data.message,
								icon: "success",
								showCancelButton: false,
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
							showCancelButton: false,
							cancelButtonText: "Fechar",
						});
						console.log(err.response.data);
					});
			}
		},

		update() {
			let _this = this;
			this.sampling_point.stratum_id = _this.sampling_point.stratum.id;
			this.sampling_point.geolocation.ratio = 2.0;

			axios
				.put(
					`/api/v1/sampling-points/${this.sampling_point.id}`,
					this.sampling_point,
					{
						headers: { authorization: `bearer ${this.authToken}` },
					}
				)
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
						showCancelButton: false,
						cancelButtonText: "Fechar",
					});
					console.log(err);
				});
		},

		changeStatus(s_point_id, status = true) {
			let status_message = "";
			this.s_point_status = status;

			status
				? (status_message = "ativar")
				: (status_message = "desativar");

			Swal.fire({
				title: "Deseja " + status_message + " este ponto amostral?",
				text: "Esta ação não poderá ser desfeita.",
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
							`/api/v1/sampling-points/${s_point_id}/status`,
							{
								stratum_id: this.sampling_point.stratum_id,
								status: this.s_point_status,
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

		convertDate(date) {
			function checkZero(data) {
				if (data.length === 1) {
					data = "0" + data;
				}
				return data;
			}
			let newDate = new Date(date);
			let day = newDate.getDate() + "";
			let month = newDate.getMonth() + 1 + "";
			let year = newDate.getFullYear() + "";
			let hour = newDate.getHours() + "";
			let minutes = newDate.getMinutes() + "";
			let seconds = newDate.getSeconds() + "";

			day = checkZero(day);
			month = checkZero(month);
			year = checkZero(year);
			hour = checkZero(hour);
			minutes = checkZero(minutes);
			seconds = checkZero(seconds);

			return (
				day +
				"/" +
				month +
				"/" +
				year
			);
		},

		clearForm() {
			this.sampling_point.id = null;
			this.sampling_point.label = "";
			this.sampling_point.ini_period = "";
			this.sampling_point.status = true;
			this.sampling_point.stratum = {};
			this.sampling_point.geolocation = {};

			$("#modalSamplingPoints").modal("hide");
		},
	},
};
