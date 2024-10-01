<template>
	<div id="properties" class="mt-5 sharedPropertiesWrapper">
		<div class="admin-content">
			<div
				v-if="properties.length > 0"
				class="admin-header d-flex justify-content-between align-items-center p-2"
			>
				<h1>Propriedades Compartilhadas</h1>
			</div>
			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div
				class="container first-property-container"
				v-else-if="!loading && !properties.length > 0"
			>
				<i class="fas fa-warehouse property-icon"></i>
				<p class="first-property-message">
					Não há propriedades compartilhadas
				</p>
				<router-link
					class="btn btn-agro"
					tag="button"
					to="/panel"
				>
					<i class="fas fa-angle-left"></i> Voltar ao painel
				</router-link>
			</div>

			<div class="properties-table" v-if="properties.length > 0">
				<vue-good-table
					title="Propriedades"
					:columns="fields"
					:rows="properties"
					:search-options="{
						enabled: true,
						placeholder: 'Pesquisar...',
					}"
					:pagination-options="paginationOptions"
					:fixed-header="true"
					:sort-options="{
						enabled: true,
						initialSortBy: { field: 'name', type: 'desc' },
					}"
					compactMode
				>
					<div slot="emptystate">
						Não há propriedades registradas.
					</div>
					<template slot="table-row" slot-scope="props">
						<span v-if="props.column.field == 'name'">
							{{ props.row.name }}
						</span>
						<span v-if="props.column.field == 'owner_name'">
							{{ props.row.owner_name }}
						</span>
						<span v-if="props.column.field == 'city'">
							{{ props.row.city }}
						</span>
						<span v-if="props.column.field == 'uf'">
							{{ props.row.uf }}
						</span>
						<div v-if="props.column.field == 'actions'">
							<router-link
								title="Resumo"
								tag="button"
								class="btn btn-secondary"
								v-bind:to="{
									path: '/panel/overview',
									query: { propid: props.row.id },
								}"
								:disabled="props.row.status === 0"
							>
								<i class="fas fa-file fa-lg"> </i>
							</router-link>

							<button
								title="Mais informações"
								class="btn btn-info"
								@click="editModal(props.row)"
								:disabled="props.row.status === 0"
							>
								<i class="fas fa-eye fa-lg"></i>
							</button>
						</div>
					</template>
				</vue-good-table>
			</div>

			<div
				class="modal fade"
				id="modalProperties"
				ref="modal"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalPropertiesLabel"
				aria-hidden="true"
			>
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5
								class="modal-title"
								id="modalPropertiesLabel"
								v-show="!editMode"
							>
								ADICIONAR PROPRIEDADE
							</h5>
							<h5
								class="modal-title"
								id="modalPropertiesLabel"
								v-show="editMode"
							>
								VISUALIZAR PROPRIEDADE
							</h5>
							<button
								type="button"
								class="close"
								data-dismiss="modal"
								aria-label="Close"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form
								@submit.prevent="editMode ? update() : store()"
							>
								<div class="form-group">
									<label for="propertyNamae">
										Nome da Propriedade
									</label>
									<input
										id="propertyName"
										type="text"
										class="form-control"
										:value="property.name"
                    disabled
									/>
								</div>

								<div class="form-group">
									<label for="propertyOwner">
										Nome do Proprietário
									</label>
									<input
										type="text"
										class="form-control"
										:value="property.owner_name"
                    disabled
									/>
								</div>

								<div v-if="!editMode" class="form-row">
									<div class="form-group col-md-4">
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

									<div class="form-group col-md-8">
										<label for="propertyCity">
											Município
										</label>
										<div
											v-if="
												!cities.length || loadingCities
											"
										>
											<span
												v-if="!loadingCities"
												class="text-danger"
											>
												Selecione um Estado
											</span>
											<span v-else>
												Carregando cidades...
											</span>
										</div>
										<div v-else>
											<select
												:id="'propertyCity'"
												name="city"
												class="form-control"
												v-model="property.city"
												:disabled="editMode"
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

								<div v-else class="form-row">
									<div class="form-group col-md-4">
										<label for="state">Estado</label>
										<input
											id="state"
											type="text"
											class="form-control"
											v-model="property.uf"
											disabled
										/>
									</div>
									<div class="form-group col-md-8">
										<label for="city">Munícipio</label>
										<input
											id="city"
											type="text"
											class="form-control"
											v-model="property.city"
											disabled
										/>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="latitude">Latitude</label>
										<input
											type="number"
											class="form-control"
											id="latitude"
											step="0.0000001"
											pattern="^(\+|-)?(?:90(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$"
											:value="
												property.geolocation.latitude
											"
											disabled
										/>
									</div>
									<div class="form-group col-md-6">
										<label for="longitude">Longitude</label>
										<input
											type="number"
											class="form-control"
											id="longitude"
											step="0.0000001"
											pattern="^(\+|-)?(?:180(?:(?:\.0{1,7})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$"
											:value="
												property.geolocation.longitude
											"
											disabled
										/>
									</div>
								</div>

								<div class="form-group">
									<label for="propertyDescript"
										>Descrição</label
									>
									<textarea
										id="propertyDescript"
										row="2"
										class="form-control"
										:value="property.description"
                    disabled
									></textarea>
								</div>

								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-secondary"
										data-dismiss="modal"
									>
										Sair
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script src="./SharedProperties.js"></script>

<style lang="scss" scoped>
.sharedPropertiesWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 16px 48px;
	}

	.btn-add {
		margin: 16px 48px 16px 0;
	}

	.btn-agro {
		background-color: #3d8160;
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 500;
		font-size: 14px;
	}

	.btn-agro:hover {
		background-color: #70a46b !important;
	}

	.properties-table {
		padding: 0 31px 48px;
		overflow: hidden;
	}

	.vgt-global-search__input .input__icon {
		background-color: #3d8160;
	}

	.vgt-fixed-header {
	}

	.first-property-container {
		display: flex;
		flex-direction: column;
		align-items: center;

		padding: 50px 0;

		max-width: 500px;

		.property-icon {
			font-size: 250px;
			color: #3d8160;
			opacity: 20%;
		}

		.first-property-message {
			color: #3d8160;
			opacity: 50%;

			font-family: "Lexend", sans-serif;
			font-weight: 700;
			font-size: 24px;
		}
	}
}

@media (max-width: 576px) {
	.sharedSPropertiesWrapper {
		height: 75vh;
		max-height: 80vh;
	}
}
</style>
