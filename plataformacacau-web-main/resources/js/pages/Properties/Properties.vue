<template>
	<div id="properties" class="mt-5 propertiesWrapper">
		<div class="admin-content">
			<div
				v-if="properties.length > 0"
				class="admin-header d-flex justify-content-between align-items-center p-2"
			>
				<h1>Propriedades</h1>
				<div v-if="userRole === 'pre-registered'">
					<router-link
						tag="button"
						class="btn btn-agro btn-add"
						v-bind:to="{
							path: '/panel/add-property',
							query: { nextArea: `${totalProperties}` },
						}"
					>
						<i class="fas fa-plus"></i> Registrar propriedade
					</router-link>
				</div>
				<div v-else>
					<button
						class="btn btn-agro btn-add"
						tag="button"
						@click="addModal()"
					>
						<i class="fas fa-plus"></i> Registrar propriedade
					</button>
				</div>
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
					Registre sua primeira propriedade
				</p>
				<router-link
					class="btn btn-agro"
					tag="button"
					to="/panel/add-property"
				>
					<i class="fas fa-plus"></i> Registrar propriedade
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
					:sort-options="{
						enabled: true,
						initialSortBy: { field: 'name', type: 'desc' },
					}"
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
						<span v-if="props.column.field == 'description'">
							{{ props.row.description || "-" }}
						</span>
						<span
							v-if="props.column.field == 'status'"
							v-html="checkStatus(props.row.status)"
						>
						</span>
						<div v-if="props.column.field == 'actions'">
							<div class="d-flex">
								<router-link
									v-if="userRole === 'pre-registered'"
									title="Resumo"
									tag="button"
									class="btn btn-md btn-secondary"
									style="margin: 0.2rem"
									v-bind:to="{
										path: '/panel/overview',
										query: { propid: props.row.id },
									}"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-file fa-sm"> </i>
								</router-link>

								<button
									title="Editar propriedade"
									class="btn btn-md btn-info"
									style="margin: 0.2rem"
									@click="editModal(props.row)"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-edit fa-sm"></i>
								</button>
								<!--Modificado-->
								<!--
								<form @submit.prevent="exportPropertyXls(props.row.id)">
									<button
										title="Exportar XLS"
										type="submit"
										class="btn btn-md btn-warning"
										style="margin: 0.2rem; background-color: #55A97F; border-color: #55A97F;"
									>
										<i class="fas fa-file-excel"></i>
									</button>
								</form>
								-->
								<button
										title="Exportar XLS"
										class="btn btn-md btn-warning"
										style="margin: 0.2rem; background-color: #55A97F; border-color: #55A97F;"
										@click="addModalExport(props.row)"
									>
										<i class="fas fa-file-excel"></i>
								</button>
								<template>
									<form @submit.prevent="exportPropertyPdf(props.row.id)">
										<button
											title="Exportar PDF"
											type="submit"
											class="btn btn-md btn-danger"
											style="margin: 0.2rem"
											:disabled="pdfLoading === props.row.id"
										>
											<span v-if="pdfLoading === props.row.id" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
											<i v-else class="fas fa-file-pdf"></i>
										</button>
									</form>
								</template>
								<!--Modificado-->
								<router-link
									v-if="userRole === 'pre-registered'"
									:title="props.row.area_name"
									tag="button"
									class="btn btn-md btn-success"
									style="margin: 0.2rem"
									v-bind:to="{
										path: '/panel/blocks',
										query: { propid: props.row.id },
									}"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-eye fa-sm"> </i>
								</router-link>

								<router-link
									v-if="
										userRole === 'pre-registered' &&
										props.row.total_homogeneous_areas > 0
									"
									title="Áreas Homogêneas"
									tag="button"
									class="btn btn-md btn-success"
									style="margin: 0.2rem"
									v-bind:to="{
										path: '/panel/homogeneous-area',
										query: { propid: props.row.id },
									}"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-layer-group fa-sm"> </i>
								</router-link>

								<router-link
									v-if="userRole !== 'pre-registered'"
									:title="props.row.area_name"
									tag="button"
									class="btn btn-md btn-success"
									style="margin: 0.2rem"
									v-bind:to="{
										path: '/panel/homogeneous-area',
										query: { propid: props.row.id },
									}"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-layer-group fa-sm"> </i>
								</router-link>
							</div>
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
								ATUALIZAR PROPRIEDADE
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
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="propertyName">
											Nome da Propriedade
										</label>
										<input
											id="propertyName"
											type="text"
											class="form-control"
											v-model="property.name"
										/>
									</div>
									<div class="form-group col-md-6">
										<label for="propertyArea">
											Área em hectares
										</label>
										<input
											id="propertyArea"
											type="number"
											class="form-control"
											v-model="property.area"
										/>
									</div>
								</div>

								<div class="form-group">
									<label for="propertyOwner">
										Nome do Proprietário
									</label>
									<input
										type="text"
										class="form-control"
										v-model="property.owner_name"
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

								<div
									class="form-row"
									v-if="property.geolocation !== null"
								>
									<div class="form-group col-md-6">
										<label for="latitude">Latitude</label>
										<input
											type="number"
											class="form-control"
											id="latitude"
											step="0.0000001"
											pattern="^(\+|-)?(?:100(?:(?:\.0{1,7})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$"
											v-model="
												property.geolocation.latitude
											"
											required
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
											v-model="
												property.geolocation.longitude
											"
											required
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
										v-model="property.description"
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
									<button
										type="submit"
										class="btn btn-primary"
										v-show="!editMode"
									>
										Cadastrar
									</button>
									<button
										type="submit"
										class="btn btn-primary"
										v-show="editMode"
									>
										Atualizar
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<template>
				<div class="modal fade" id="modalPropertiesExport" ref="modal" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">EXPORTAÇÃO DE DADOS</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form @submit.prevent="handleExport">
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="datePeriod">Selecione o período</label>
											<select id="datePeriod" class="form-control" v-model="selectedDatePeriod">
												<option v-if="datePeriods.length === 0">Não há visitas cadastradas</option>
												<option v-for="date in datePeriods" :key="date" :value="date">{{ date }}</option>
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
										<button type="submit" class="btn btn-primary" :disabled="datePeriods.length === 0 || xlsLoading === exportProperty.id">
											<span v-if="xlsLoading && xlsLoading === exportProperty.id" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
											<span v-if="xlsLoading && xlsLoading === exportProperty.id">Carregando...</span>
											<span v-else>Exportar para XLS</span>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</template>

			<!--Modal com opções fixas
			<template>
				<div
					class="modal fade"
					id="modalPropertiesExport"
					ref="modal"
					tabindex="-1"
					role="dialog"
					aria-labelledby="modalPropertiesLabel"
					aria-hidden="true"
				>
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="modalPropertiesLabel">EXPORTAÇÃO DE DADOS</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form @submit.prevent="exportPropertyXls(property.id, startDate, endDate)">
									Formulário de seleção de período 
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="startDate">Selecione o período inicial</label>
											<select id="startDate" class="form-control" v-model="startDate">
												<option value="2022-10-01">Outubro/2022</option>
												<option value="2023-10-01">Outubro/2023</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="endDate">Selecione o período final</label>
											<select id="endDate" class="form-control" v-model="endDate">
												<option value="2023-09-30">Setembro/2023</option>
												<option value="2024-09-30">Setembro/2024</option>
											</select>
										</div>
									</div>
									Botões de ação do modal 
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
										<button type="submit" class="btn btn-primary">Exportar para XLS</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</template>-->
					<!-- Modal de Exportação XLS (Usando calendário)-->
					<!--
					<div
						class="modal fade"
						id="modalPropertiesExport"
						ref="modal"
						tabindex="-1"
						role="dialog"
						aria-labelledby="modalPropertiesLabel"
						aria-hidden="true"
					>
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalPropertiesLabel">EXPORTAÇÃO DE DADOS</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form @submit.prevent="exportPropertyXls(property.id, startDate, endDate)">
										Formulário de seleção de período 
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="startDate">Selecione o período inicial</label>
												<input id="startDate" type="date" class="form-control" v-model="startDate" />
											</div>
											<div class="form-group col-md-6">
												<label for="endDate">Selecione o período final</label>
												<input id="endDate" type="date" class="form-control" v-model="endDate" />
											</div>
										</div>
										 Botões de ação do modal 
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
											<button type="submit" class="btn btn-primary">Exportar para XLS</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				-->
		</div>
	</div>
</template>

<script src="./Properties.js"></script>

<style lang="scss" scoped>
.propertiesWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;
	height: auto;
	max-height: 90vh;
	overflow-y: scroll;

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
	.propertiesWrapper {
		height: auto;
		max-height: 75vh;
		width: 90vw;
		max-width: 90vw;
	}
}
</style>
