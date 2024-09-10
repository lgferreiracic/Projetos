import { Fields, PaginationOptions } from "./TableOptions";

export default {
	data() {
		return {
			authToken: null,
			property: {
				id: null,
				area_name: "Roça",
			},
			block: {
				area: null,
				label: null,
				relief: null,
				altitude: null,
				propertyId: null,
				rainfall: {
					january: null,
					february: null,
					march: null,
					april: null,
					may: null,
					june: null,
					july: null,
					august: null,
					september: null,
					october: null,
					november: null,
					december: null,
				},
				soilUse: {
					type: null,
					description: "",
				},
				handling: {
					temple: null,
					main: null,
				},
				genotypes: {
					common: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
					},
					hybrid: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
					},
					cloned: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
					},
				},
				soilClass: {
					lowland: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					lowerThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					middleThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					upperThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
				},
				geolocation: {
					latitude: null,
					longitude: null,
					ratio: 2.0,
				},
			},
			propertyId: null,
			blocks: [],
			loading: false,
			editMode: false,
			fields: Fields,
			paginationOptions: PaginationOptions,
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.propertyId = Number(urlParams.get("propid"));
		this.authToken = window.token;
		this.fields[3].sortFn = this.sortStatus;

		this.index();
	},

	methods: {
		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[3].sortFn = null;
		},

		editModal(block) {
			this.editMode = true;

			// this.stratum.id = stratum.id;
			// this.stratum.label = stratum.label;
			// this.stratum.homogeneous_area = stratum.homogeneous_area;
			// this.stratum.homogeneous_area_id = stratum.homogeneous_area.id;

			$("#modalStrata").modal("show");
		},

		checkAltitude(altitude) {
			if (altitude === 1) {
				return "Baixo (até 200m)";
			}

			return "Alto (acima de 200m)";
		},

		checkRelief(relief) {
			let reliefType = "";
			switch (relief) {
				case 1:
					reliefType = "Plano";
					break;
				case 2:
					reliefType = "Suavemente ondulado";
					break;
				case 3:
					reliefType = "Ondulado";
					break;
				case 4:
					reliefType = "Escarpado";
					break;
				default:
					reliefType = "Indefinido";
					break;
			}

			return reliefType;
		},

		index() {
			this.loading = true;
			axios
				.all([
					axios.get(`/api/v1/properties/${this.propertyId}`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
					axios.get(`/api/v1/blocks?propid=${this.propertyId}`, {
						headers: { authorization: `bearer ${this.authToken}` },
					}),
				])
				.then(
					axios.spread((propertyResponse, blockResponse) => {
						if (propertyResponse.status === 200) {
							this.property = propertyResponse.data.data;
						} else {
							console.error(propertyResponse);
						}
						if (blockResponse.status === 200) {
							this.blocks = blockResponse.data.data;
						} else {
							console.error(blockResponse);
						}
						this.loading = false;
					})
				)
				.catch((err) => {
					console.log(err);
					this.loading = false;
				});
		},

		update() {
			// let _this = this;
			// this.stratum.id = _this.stratum.id;
			// this.stratum.homogeneous_area_id =
			// 	_this.stratum.homogeneous_area.id;
			// console.log("this.stratum", this.stratum);
			// axios
			// 	.put(`/api/v1/strata/${this.stratum.id}`, this.stratum, {
			// 		headers: { authorization: `bearer ${this.authToken}` },
			// 	})
			// 	.then((response) => {
			// 		if (response.status === 200 && response.data.success) {
			// 			Swal.fire({
			// 				title: response.data.message,
			// 				icon: "success",
			// 				showConfirmButton: false,
			// 				timer: 1500,
			// 			});
			// 		} else {
			// 			console.log(response);
			// 		}
			// 		console.log(response);
			// 		this.clearForm();
			// 		this.index();
			// 	})
			// 	.catch((err) => {
			// 		Swal.fire({
			// 			title: err.response.data.message,
			// 			text: err.response.data.detail,
			// 			icon: "error",
			// 			confirmButtonText: "Fechar",
			// 		});
			// 		console.log(err.response);
			// 	});
		},

		clearForm() {
			// this.editMode = false;
			// this.stratum.id = null;
			// this.stratum.label = "";
			// this.stratum.status = true;
			// this.stratum.homogeneous_area = {};
			// this.stratum.homogeneous_area_id = null;

			$("#modalStrata").modal("hide");
		},
	},
};
