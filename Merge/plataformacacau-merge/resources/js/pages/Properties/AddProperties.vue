<template>
	<div class="container form-add-property mt-5">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h1>PlataformaCacau</h1>

				<h2>Cadastro de propriedade</h2>
				<form @submit.prevent="store()">
					<div class="form-group">
						<label for="propertyName">Nome da propriedade</label>
						<input
							type="text"
							class="form-control"
							id="propertyName"
							v-model="property.name"
							required
						/>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="state">Estado</label>
							<select
								id="state"
								name="selectState"
								class="form-control"
								v-model="property.uf"
								@change="getCities($event)"
							>
								<option
									v-for="state in states"
									:value="state.sigla"
									:key="state.id"
								>
									{{ state.nome }}
								</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="propertyCity">Município</label>
							<div v-if="!cities.length || loadingCities">
								<input
									type="text"
									class="form-control"
									:placeholder="
										!loadingCities
											? 'Selecione um estado'
											: 'Carregando cidades...'
									"
									readonly
								/>
							</div>
							<div v-else>
								<select
									id="propertyCity"
									name="city"
									class="form-control"
									v-model="property.city"
								>
									<option
										v-for="city in cities"
										v-bind:value="city.nome"
										v-bind:key="city.id"
									>
										{{ city.nome }}
									</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="farmArea"
							>Área em hectáres da propriedade</label
						>
						<input
							id="farmArea"
							type="number"
							class="form-control"
							v-model="property.area"
							required
						/>
					</div>

					<h3 class="mt-4">Como a propriedade está dividida?</h3>
					<div>
						<div class="form-radio">
							<input
								type="radio"
								name="propertyAreaName"
								class="form-radio-input"
								@click="disableOtherAreaName('Roça')"
								id="fields"
								checked
							/>
							<label class="form-radio-label" for="fields"
								>Roças de Cacau</label
							>
						</div>
						<div class="form-radio">
							<input
								type="radio"
								name="propertyAreaName"
								class="form-radio-input"
								@click="disableOtherAreaName('Quadra')"
								id="blocks"
							/>
							<label class="form-radio-label" for="blocks"
								>Quadras</label
							>
						</div>
						<div class="form-radio">
							<input
								type="radio"
								name="propertyAreaName"
								class="form-radio-input"
								@click="
									disableOtherAreaName('Unidade Operacional')
								"
								id="operational-unit"
							/>
							<label
								class="form-radio-label"
								for="operational-unit"
								>Unidade Operacional</label
							>
						</div>
						<div class="form-radio">
							<input
								type="radio"
								name="propertyAreaName"
								@click="enableOtherAreaName()"
								class="form-radio-input"
								id="other"
							/>
							<label class="form-radio-label" for="other"
								>Outro nome? Qual?</label
							>
							<input
								v-if="isOtherName === false"
								class="form-control"
								type="text"
								readonly
							/>
							<input
								v-else-if="isOtherName === true"
								type="text"
								ref="areaNameInput"
								class="form-control"
								name="areaName"
								id="areaName"
								v-model="property.area_name"
								:disabled="!isOtherName"
								autocomplete="off"
							/>
						</div>
					</div>

					<h3 class="mt-4">Coordenadas geográficas</h3>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="latitude">Latitude</label>
							<input
								type="number"
								class="form-control"
								id="latitude"
								step="0.0000001"
								pattern="^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$"
								v-model="latitude"
								required
							/>
							<small
								id="latitudeHelp"
								class="form-text text-muted"
								>Ex.: -14.7815523</small
							>
						</div>
						<div class="form-group col-md-6">
							<label for="longitude">Longitude</label>
							<input
								type="number"
								class="form-control"
								id="longitude"
								step="0.0000001"
								pattern="^(\+|-)?(?:180(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$"
								v-model="longitude"
								required
							/>
							<small
								id="longitudeHelp"
								class="form-text text-muted"
								>Ex.: -39.2292649</small
							>
						</div>
					</div>

					<div class="form-group">
						<label for="propertyDescription">Descrição</label>
						<textarea
							class="form-control"
							id="propertyDescription"
							rows="3"
							v-model="property.description"
						></textarea>
					</div>

					<div class="form-row mt-2">
						<div class="row gx-1">
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 p-1">
								<router-link
									class="btn btn-outline-danger btn-lg button cancel-button"
									tag="button"
									to="/panel/properties"
								>
									Cancelar
								</router-link>
							</div>
							<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 p-1">
								<button
									type="submit"
									class="btn button btn-lg submit-button"
								>
									Concluir
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div
				class="col-md-6 col-lg-6 d-none d-sm-block"
				id="map"
				v-if="latitude || longitude"
			>
				<l-map
					class="lmap"
					:zoom="zoom"
					:center="dynamicCenterPosition"
				>
					<l-tile-layer :url="url"></l-tile-layer>
					<l-marker :lat-lng="dynamicMarkerPosition">
						<l-icon
							:icon-size="dynamicSize"
							:icon-anchor="dynamicAnchor"
							icon-url="/img/cocoa-tree(1).png"
						/>
					</l-marker>
				</l-map>
			</div>
			<div class="col-md-6 col-lg-6 d-none d-md-block" v-else>
				<div
					class="d-flex justify-content-center align-items-center h-100"
				>
					<p class="map-message">
						Mapa indisponível. Informe valores válidos de latitude e
						longitude!
					</p>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			authToken: null,
			property: {
				owner_id: null,
				name: "",
				owner_name: "",
				description: "",
				area_name: "Roça",
				city: "",
				uf: "",
				area: null,
				status: 2,
				geolocation: {
					id: null,
					latitude: null,
					longitude: null,
					ratio: 2.0,
				},
			},
			city: {},
			cities: {},
			state: {},
			states: [],
			isOtherName: false,
			loadingCities: false,
			map: null,
			latitude: null,
			longitude: null,
			url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
			zoom: 15,
			iconSize: 48,
			nextAreaAvailable: null,
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.nextAreaAvailable = /^true$/i.test(urlParams.get("nextArea"));

		this.authToken = window.token;
		this.property.owner_id = window.user.id;
		this.property.owner_name = window.user.name;
	},

	async mounted() {
		await this.getStates();
	},

	computed: {
		dynamicSize() {
			return [this.iconSize, this.iconSize * 1.15];
		},
		dynamicAnchor() {
			return [this.iconSize / 2, this.iconSize * 1.15];
		},
		dynamicMarkerPosition() {
			return [+this.latitude, +this.longitude];
		},
		dynamicCenterPosition() {
			return [+this.latitude, +this.longitude];
		},
	},

	methods: {
		async getStates() {
			await axios
				.get(
					"https://servicodados.ibge.gov.br/api/v1/localidades/estados"
				)
				.then((response) => {
					let sortedStates = response.data;
					this.states = sortedStates.sort((a, b) => {
						if (a.nome < b.nome) {
							return -1;
						}

						if (a.nome > b.nome) {
							return 1;
						}

						return 0;
					});
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

		store() {
			this.property.geolocation.latitude = parseFloat(this.latitude).toFixed(7);
			this.property.geolocation.longitude = parseFloat(this.longitude).toFixed(7);

			axios
				.post("/api/v1/properties", this.property, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 201 && response.data.success) {
						if (!this.nextAreaAvailable) {
							Swal.fire({
								icon: "success",
								title: "Propriedade cadastrada",
								text: "Você será redirecionado para a próxima etapa em poucos segundos. Aguarde!",
								showConfirmButton: false,
							});

							setTimeout(() => {
								Swal.close();
								this.$router.push({
									path: "/panel/add-operational-unit",
									query: {
										propid: `${response.data.data.id}`,
									},
								});
							}, 2000);
						} else {
							Swal.fire({
								icon: "success",
								title: "Propriedade cadastrada",
								showConfirmButton: false,
							});

							setTimeout(() => {
								window.location.href = "/panel/properties";
							}, 2000);
						}
					}
				})
				.catch((err) => {
					if (!err.response.data.success) {
						Swal.fire({
							title: err.response.data.message,
							text: `Você já cadastrou uma propriedade de nome ${this.property.name}. Defina outro nome para a nova propriedade!`,
							icon: "error",
							confirmButtonText: "Entendi",
						});
					} else {
						let errList = err.response.data.detail;
						let html = "<ul style='text-align: left'>";
						for (const [key, value] of Object.entries(errList)) {
							html += `<li>${value}</li>`;
						}
						html += "</ul>";
						Swal.fire({
							title: err.response.data.message,
							html,
							icon: "error",
							confirmButtonText: "Entendi",
						});
					}
				});
		},

		disableOtherAreaName(areaName) {
			if (this.isOtherName) {
				this.$refs.areaNameInput.value = "";
			}

			this.isOtherName = false;
			this.property.area_name = areaName;
		},

		enableOtherAreaName() {
			this.property.area_name = "";
			this.isOtherName = !this.isOtherName;
		},
	},
};
</script>

<style lang="scss" scoped>
.form-add-property {
	background-color: #fff;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 26px;

		padding: 24px 48px;
	}

	h2 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 22px;

		padding: 0 0 10px 48px;
	}

	form {
		padding: 0 48px 24px;

		h3 {
			color: #3d8160;

			font-family: "Lexend", sans-serif;
			font-weight: 600;
			font-size: 15px;
		}

		label {
			color: #3d8160;

			font-family: "Lexend", sans-serif;
			font-weight: 600;
			font-size: 12px;
		}

		.form-radio-input {
			vertical-align: middle;
		}
	}

	#map {
		height: auto;
		overflow: clip;
		border-radius: 0 20px 20px 0;
	}

	.lmap {
		height: 100%;
		width: 102.8%;
	}

	.button {
		width: 170px;
		max-width: 100%;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 14px;
	}

	.submit-button {
		background-color: #3d8160;
		color: #fff;
	}

	.submit-button:hover {
		background-color: #70a46b;
	}

	.cancel-button {
		color: #f00;
	}

	.cancel-button:hover {
		color: #fff;
	}

	.map-message {
		color: #3d8160;
		font-family: "Lexend", sans-serif;
		font-weight: 500;
		font-size: 14px;
	}
}
</style>
