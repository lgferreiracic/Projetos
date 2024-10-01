import { Fields, PaginationOptions } from "./TableOptions";

export default {
	data() {
		return {
			authToken: null,
			//Modificado
			target: null,
			//Modificado
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
			exportProperty: {
				id: "",
				startDate: '',
				endDate: '',
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
			//Modificado
			selectedDatePeriod: null,
        	datePeriods: [],
			xlsLoading: null,
			pdfLoading: null,
			startDate: '',//Antes era NULL
			endDate: '',//Antes era NULL
			startDates: [],
			endDates: [],
			//Modificado
		};
	},

	computed: {
		totalProperties() {
			return this.properties.length > 0;
		},
		filteredStartDates() {
			if (!this.endDate) {
			  return this.startDates; // Se não há endDate selecionada, retorna todas as startDates
			}
			const endYear = parseInt(this.endDate.split('/')[1], 10); // Extrai o ano de endDate
			return this.startDates.filter((date) => {
			  const startYear = parseInt(date.split('/')[1], 10); // Extrai o ano de startDate
			  return startYear < endYear; // Retorna datas menores ou iguais ao ano da endDate
			});
		  },
		  // Filtra as endDates para não exibir opções menores que a startDate selecionada
		  filteredEndDates() {
			if (!this.startDate) {
			  return this.endDates; // Se não há startDate selecionada, retorna todas as endDates
			}
			const startYear = parseInt(this.startDate.split('/')[1], 10); // Extrai o ano de startDate
			return this.endDates.filter((date) => {
			  const endYear = parseInt(date.split('/')[1], 10); // Extrai o ano de endDate
			  return endYear > startYear; // Retorna datas maiores ou iguais ao ano da startDate
			});
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
		await this.fetchVisitDates();
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
		addModalExport(property) {
			let _this = this;
			this.clearFormExport();
			this.exportProperty.id = property.id;
			$("#modalPropertiesExport").modal("show");
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
					console.log(this.cities);
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
						console.log('Dados recebidos:', response.data.data);
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
						//this.properties.push(response.data.data); 
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

		clearFormExport() {
			this.startDate='',
			this.endDate='',

			$("#modalPropertiesExport").modal("hide");
		},
		//Modificado
		
		exportPropertyXls() {
			this.xlsLoading = this.exportProperty.id;
			const fileFormat = "xls";
			const { id, startDate, endDate } = this.exportProperty; // Pega os dados da exportação
			alert("Aguarde alguns minutos, pois o processo pode ser demorado");
			axios
				.post("/api/v1/exportProperty-xls", { propertyId: id, startDate, endDate }, {
					responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then(response => {
					this.downloadFile(response, "property_" + id, fileFormat);
					this.xlsLoading = null;
				})
				.catch(err => {
					console.log(err.response);
					this.xlsLoading = null;
				});
		},

		exportPropertyPdf(propertyId) {
			this.pdfLoading = propertyId;
			const fileFormat = "pdf";
			let data = {
				property_id: propertyId
			};
		
			axios
				.post("/api/v1/export-pdf2", data, {
					responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					this.downloadFile(response, "property_" + propertyId, fileFormat);
					this.pdfLoading = null;
				})
				.catch(err => {
					console.log(err.response);
					this.pdfLoading = null;
				});
		},

		downloadFile(response, filename, fileformat) {
			let type = "";
			switch (fileformat) {
				case "pdf":
					type = "application/pdf";
					break;
				case "xls":
					type = "application/vnd.ms-excel";
					break;
				case "csv":
					type = "text/csv";
					break;
				default:
					console.log("error - file format!");
			}
		
			var newBlob = new Blob([response.data], { type: type });
			const data = window.URL.createObjectURL(newBlob);
			var link = document.createElement("a");
		
			if (window.navigator && window.navigator.msSaveOrOpenBlob) {
				window.navigator.msSaveOrOpenBlob(newBlob);
			}
		
			link.href = data;
			link.download = `${filename}.${fileformat}`;
			link.click();
			// For Firefox
			setTimeout(function() {
				window.URL.revokeObjectURL(data);
			}, 100);
		},

		async handleExport() {
			console.log(this.selectedDatePeriod);
			
			try {
				// Chamar o método para gerar as datas a partir do período selecionado
				this.parseSelectedPeriod();
		
				// Verificar se há datas para exportação
				if (!this.startDate || !this.endDate) {
					return;
				}
				console.log(this.startDate);
				console.log(this.endDate);
				this.exportProperty.startDate = this.startDate;
				this.exportProperty.endDate = this.endDate;
		
				// Chamar a função de exportação, passando os parâmetros necessários
				this.exportPropertyXls(this.property.id, this.startDate, this.endDate);
			} catch (error) {
				console.error(error);
			}
		},
		  
		async fetchVisitDates() {
			try {
				const response = await axios.get('/api/v1/get-visit-dates', {
					headers: { authorization: `bearer ${this.authToken}` },
				});
				const { oldestVisit, latestVisit } = response.data;
				
				if (oldestVisit && latestVisit) {
					this.generateDateOptions(oldestVisit, latestVisit);
				} else {
					// Limpar as datas se não houver visitas
					this.datePeriods = [];
				}
			} catch (error) {
				if (error.response && error.response.status === 404) {
					// Limpar as datas se não houver visitas
					this.datePeriods = [];
				} else {
					console.error(error);
				}
			}
		},
		
		generateDateOptions(oldestVisit, latestVisit) {
			const oldestYear = new Date(oldestVisit).getFullYear();
			const latestYear = new Date(latestVisit).getFullYear();
			const currentYear = new Date().getFullYear(); // Ano atual
			const currentMonth = new Date().getMonth(); // Mês atual (0 = Janeiro, 9 = Outubro)
			
			// Se o mês atual for menor que Outubro (mês 9), a última safra válida será até o ano anterior
			const limitYear = currentMonth < 9 ? currentYear - 1 : currentYear;
		
			this.datePeriods = [];
		
			for (let year = oldestYear; year <= latestYear && year <= limitYear; year++) {
				const nextYear = year + 1;
				this.datePeriods.push(`Outubro/${year} - Setembro/${nextYear}`);
			}
		},
		

		parseSelectedPeriod() {
			if (!this.selectedDatePeriod) {
				return;
			}
		
			// Exemplo: "Outubro/2022 - Setembro/2023"
			const periodParts = this.selectedDatePeriod.split(' - ');
		
			// Pegar o ano da parte "Outubro/YYYY"
			const startYear = periodParts[0].split('/')[1];
			// Pegar o ano da parte "Setembro/YYYY"
			const endYear = periodParts[1].split('/')[1];
		
			// Definir a data de início no formato "Outubro/2022"
			this.startDate = `Outubro/${startYear}`;
			
			// Definir a data de fim no formato "Setembro/2023"
			this.endDate = `Setembro/${endYear}`;
		},

		//Modificado
	},/*Reponsável por sumir com os estados e o erro 404 assim que vai para propriedades
	mounted() {
		this.fetchVisitDates();
	  },*/
};
