import { Fields, PaginationOptions } from "./OverviewTableOptions";

export default {
	data() {
		return {
			authToken: null,
			property: {
				id: null,
				area_name: "Roça",
				name: "",
				status: null,
				total_blocks: null,
				total_homogeneous_areas: null,
			},
			block: {
				area: null,
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
					totalArgisol: null,
					totalLatosol: null,
					totalCambisol: null,
					totalGleisol: null,
					totalOther: null,
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
			csvLoading: false,
			isSharing: false,
			isClustering: false,
			clusters: [],
			editMode: false,
			userRole: "",
			fields: Fields,
			paginationOptions: PaginationOptions,
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.propertyId = Number(urlParams.get("propid"));
		this.authToken = window.token;
		this.fields[3].sortFn = this.sortStatus;
		this.userRole = window.Roles[0].label;

		this.index();
	},

	watch: {
		property: function (val) {
			if (val.status === 0) {
				Swal.fire({
					title: `Propriedade bloqueada`,
					icon: "warning",
					text: "Essa propriedade não pode mais ser acessada. Você será redirecionado dentro de alguns instantes para a tela anterior!",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 5000,
				});
				setTimeout(() => {
					this.$router.push("/panel/properties");
				}, 6500);
			} else {
				this.loading = false;
			}
		},
	},

	methods: {
		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[3].sortFn = null;
		},

		// TODO: Remove me later
		checkKeys(key, value) {
			switch (key) {
				case 1:
					return this.checkAltitude(value);
				case 2:
					return this.checkRelief(value);
				case 3:
					return this.checkSoil(value);
				case 5:
					return this.checkHandling(value);
				default:
					return value;
			}
		},

		// TODO: Remove me later
		checkSoil(soilClass) {
			switch (soilClass) {
				case 1:
					return "Argissolo";
				case 2:
					return "Latossolo";
				case 3:
					return "Cambissolo";
				case 4:
					return "Gleissolo";
				case 5:
					return "Outros solos";
				default:
					break;
			}
		},

		// TODO: Remove me later
		checkHandling(handling) {
			if (handling === 0) {
				return "Tradicional";
			}

			return "Tecnificado";
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

		indexOfMax(arr) {
			if (arr.length === 0) {
				return -1;
			}

			var max = arr[0];
			var maxIndex = 0;

			for (var i = 1; i < arr.length; i++) {
				if (arr[i] > max) {
					maxIndex = i;
					max = arr[i];
				}
			}

			return maxIndex;
		},

		checkSoilClass(soilClass) {
			let values = [
				soilClass.totalArgisol,
				soilClass.totalLatosol,
				soilClass.totalCambisol,
				soilClass.totalGleisol,
				soilClass.totalOther,
			];

			let indexOfMaxValue = this.indexOfMax(values) + 1;

			switch (indexOfMaxValue) {
				case 1:
					return "Argissolo";
				case 2:
					return "Latossolo";
				case 3:
					return "Cambissolo";
				case 4:
					return "Gleissolo";
				case 5:
					return "Outros solos";
				default:
					break;
			}
		},

		checkHandlingType(handling) {
			if (handling.main === 0) {
				return "Tradicional";
			}

			return "Tecnificado";
		},

		checkRainfall(rainfall) {
			let monthsBelowAverageRainfall = 0;

			if (rainfall.unknown === 1) {
				return monthsBelowAverageRainfall;
			}

			for (let month in rainfall) {
				if (month !== "id" && month !== "unknown") {
					// console.log(`Mês (${month}) = ${rainfall[month]}`);
					if (rainfall[month] === 0) {
						monthsBelowAverageRainfall += 1;
					}
				}
			}

			return monthsBelowAverageRainfall;
		},

		createGenotypeRow(genotypes, area) {
			let participation = [
				genotypes.common.total_area_participation,
				genotypes.hybrid.total_area_participation,
				genotypes.cloned.total_area_participation,
			];

			let indexOfMaxParticipation = this.indexOfMax(participation) + 1;
			let mainGenotypeCharacteristics = {
				type: "",
				participation: null,
				age: null,
				population: null,
				harvest: "",
			};

			switch (indexOfMaxParticipation) {
				case 1:
					mainGenotypeCharacteristics.type = "Comum";
					mainGenotypeCharacteristics.participation =
						genotypes.common.total_area_participation;
					mainGenotypeCharacteristics.age = genotypes.common.age;
					mainGenotypeCharacteristics.population =
						genotypes.common.density * area;
					mainGenotypeCharacteristics.harvest =
						genotypes.common.temple > genotypes.common.main
							? "Temporã"
							: "Principal";
					break;
				case 2:
					mainGenotypeCharacteristics.type = "Híbrido";
					mainGenotypeCharacteristics.participation =
						genotypes.hybrid.total_area_participation;
					mainGenotypeCharacteristics.age = genotypes.hybrid.age;
					mainGenotypeCharacteristics.population =
						genotypes.hybrid.density * area;
					mainGenotypeCharacteristics.harvest =
						genotypes.hybrid.temple > genotypes.hybrid.main
							? "Temporã"
							: "Principal";
					break;
				case 3:
					mainGenotypeCharacteristics.type = "Clonado";
					mainGenotypeCharacteristics.participation =
						genotypes.cloned.total_area_participation;
					mainGenotypeCharacteristics.age = genotypes.cloned.age;
					mainGenotypeCharacteristics.population =
						genotypes.cloned.density * area;
					mainGenotypeCharacteristics.harvest =
						genotypes.cloned.temple > genotypes.cloned.main
							? "Temporã"
							: "Principal";
					break;
				default:
					break;
			}

			return `<th>${mainGenotypeCharacteristics.type}</th> \
							<th>${mainGenotypeCharacteristics.participation}</th> \
							<th>${mainGenotypeCharacteristics.age}</th> \
							<th>${mainGenotypeCharacteristics.population}</th> \
							<th>${mainGenotypeCharacteristics.harvest}</th>`;
		},

		// TODO: Remove me later
		createClustersTable() {
			let table = "";
			let tableHead = "";
			let tableRows = "";
			let tableFooter = "";
			let data = this.clusters;

			data.map((cluster, index) => {
				for (const key in cluster) {
					tableHead = `<h5>Área Homogênea ${index + 1}</h5>
							<table class="table mb-4">
								<thead>
									<tr>
										<td colspan=7></td> \
										<td colspan=6 style="text-align: center;" class="border-right border-left">Genótipo</td> \
									</tr>
									<tr>
										<th scope="col">ID</th> \
										<th scope="col">Área</th> \
										<th scope="col">Altitude</th> \
										<th scope="col">Relevo</th> \
										<th scope="col">Solo</th> \
										<th scope="col">Precipitação pluvial</th> \
										<th scope="col">Manejo</th> \
										<th scope="col">Tipo</th> \
										<th scope="col">% participação</th> \
										<th scope="col">Idade</th> \
										<th scope="col">População</th> \
										<th scope="col">Safra Dominante</th> \
									</tr>
								</thead>
							<tbody>`;
					let tr = `<tr>
					<th scope="row">${key}</th>`;

					cluster[key].map((elem, index) => {
						if (index === 6) {
							if (elem === 0) {
								tr += `<td>Comum</td>`;
							} else if (elem === 1) {
								tr += `<td>Híbrido</td>`;
							} else {
								tr += `<td>Clonado</td>`;
							}
						} else if (index === 10) {
							tr += `<td>${
								elem === 0 ? "Temporã" : "Principal"
							}</td>`;
						} else {
							tr += `<td>${this.checkKeys(index, elem)}</td>`;
						}
					});

					tr += "</tr>";
					tableRows += tr;
					tableFooter = `</tbody>
								</table>`;
				}
				table += tableHead + tableRows + tableFooter;
				tableHead = "";
				tableRows = "";
				tableFooter = "";
			});

			return table;
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

		confirmationDownloadModal(mode) {
			this.isSharing = mode === 1 ? false : true;

			$("#modalConfirmation").modal("show");
		},

		// TODO: Remove me later
		clustersModal() {
			$("#clusters").modal("show");
		},

		groupingFeedbackModal() {
			$("#groupingFeedback").modal("show");
		},

		closeConfirmationDownloadModal() {
			$("#modalConfirmation").modal("hide");
		},

		dataDownloadedFeedback(status) {
			if (status === 1) {
				Swal.fire({
					title: `Download concluído`,
					icon: "success",
					text: "Seus dados foram baixados. Você será redirecionado dentro de alguns instantes!",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 5000,
				});
			} else {
				Swal.fire({
					title: `Dados da ${this.property.area_name} baixados e compartilhados`,
					icon: "success",
					text: "Agradecemos a generosidade em compartilhar os dados. Você será redirecionado dentro de alguns instantes!",
					showCancelButton: false,
					showConfirmButton: false,
					timer: 5000,
				});
			}

			setTimeout(() => {
				this.$router.push("/panel/properties");
			}, 6500);
		},

		async downloadData(status) {
			this.csvLoading = true;

			await axios
				.all([
					axios.get(
						`/api/v1/export-block-without-sharing?propid=${this.propertyId}`,
						{
							responseType: "arraybuffer",
							headers: {
								authorization: `bearer ${this.authToken}`,
							},
						}
					),
					axios.put(
						`/api/v1/properties/${this.propertyId}/status`,
						{
							status: status,
						},
						{
							headers: {
								authorization: `bearer ${this.authToken}`,
							},
						}
					),
				])
				.then(
					axios.spread((blockResponse, propertyResponse) => {
						if (
							blockResponse.status === 200 &&
							propertyResponse.status === 200
						) {
							this.downloadFile(
								`Resumo_${this.property.name}`,
								blockResponse
							);
							this.closeConfirmationDownloadModal();
							this.dataDownloadedFeedback(status);
							this.csvLoading = false;
						}
					})
				)
				.catch((err) => {
					console.error(err);
					Swal.fire({
						title: "Erro no download dos dados",
						text: `Não foi possível baixar os dados da propriedade ${this.property.name}. Tente novamente mais tarde!`,
						icon: "error",
						confirmButtonText: "Fechar",
					});
				});
		},

		// TODO: Remove me later
		testClustering() {
			this.isClustering = true;

			axios
				.get(`/api/v1/blocks-test?propid=${this.propertyId}`, {
					headers: {
						authorization: `bearer ${this.authToken}`,
					},
				})
				.then((response) => {
					if (response.status === 200) {
						this.clusters = response.data.data;
						this.clustersModal();
					}
					this.isClustering = false;
				})
				.catch((err) => {
					console.error(err);
					this.isClustering = false;
				});
		},

		clustering() {
			this.isClustering = true;

			axios
				.get(`/api/v1/blocks-clustering?propid=${this.propertyId}`, {
					headers: {
						authorization: `bearer ${this.authToken}`,
					},
				})
				.then((response) => {
					if (response.status === 200) {
						Swal.fire({
							title: "Unidades operacionais agrupadas",
							icon: "success",
							text: "Suas unidades operacionais foram agrupadas em áreas homogêneas. Você será redirecionado dentro de alguns instantes para a tela de listagem dessas áreas homogêneas.",
							showCancelButton: false,
							showConfirmButton: false,
							timer: 5000,
						});
					}

					setTimeout(() => {
						this.isClustering = false;
						this.$router.push(
							`/panel/homogeneous-area?propid=${this.propertyId}`
						);
					}, 6500);
				})
				.catch((err) => {
					console.error(err);
					this.isClustering = false;
					Swal.fire({
						title: "Erro no agrupamento",
						icon: "error",
						text: "Houve um erro durante o agrupamento. Tente novamente mais tarde!",
						showCancelButton: false,
						showConfirmButton: false,
						timer: 5000,
					});
				});
		},

		downloadFile(filename, response) {
			var newBlob = new Blob([response.data], {
				type: "application/vnd.ms-excel",
			});

			const data = window.URL.createObjectURL(newBlob);
			var link = document.createElement("a");

			if (window.navigator && window.navigator.msSaveOrOpenBlob) {
				window.navigator.msSaveOrOpenBlob(newBlob);
			}

			link.href = data;
			link.download = `${filename}.xlsx`;
			link.click();

			// For Firefox
			setTimeout(function () {
				window.URL.revokeObjectURL(data);
			}, 100);
		},
	},
};
