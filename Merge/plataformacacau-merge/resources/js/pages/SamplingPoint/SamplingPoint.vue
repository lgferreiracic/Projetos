<template>
	<div id="sampling-points" class="mt-5 samplingPointWrapper">
		<div class="admin-content">
			<div
				class="admin-header d-flex justify-content-between align-items-center p-2"
			>
				<div class="d-flex flex-column">
					<h1>Pontos Amostrais</h1>
					<p class="pa-limit">
						{{ stratum.label }}
						<!-- Pontos amostrais cadastrados -
						{{ stratum.total_sampling_points }}/5 -->
					</p>
				</div>
				<button
					v-if="stratum.total_sampling_points < 5"
					type="button"
					class="btn btn-agro btn-add"
					@click.prevent="addModal"
				>
					<i class="fas fa-plus"></i>
				</button>
			</div>
			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="sampling_point-table" v-else>
				<vue-good-table
					title="Pontos Amostrais"
					:columns="fields"
					:rows="sampling_points"
					:pagination-options="paginationOptions"
					:fixed-header="true"
					:row-style-class="rowStyleClassFn"
					:search-options="{
						enabled: true,
						placeholder: 'Pesquisar...',
					}"
					:sort-options="{
						enabled: true,
						initialSortBy: [
							{ field: 'status', type: 'desc' },
							{ field: 'label', type: 'asc' },
						],
					}"
					compactMode
				>
					<div slot="emptystate">
						Não há registros para esta pesquisa
					</div>
					<template slot="table-row" slot-scope="props">
						<span v-if="props.column.field == 'label'">{{
							`${props.row.label}`
						}}</span>
						<div
							v-else-if="props.column.field == 'status'"
							class="custom-control custom-switch"
						>
							<div v-if="props.row.status">
								<input
									type="checkbox"
									class="custom-control-input"
									v-bind:id="`status_${props.row.id}`"
									v-model="props.row.status"
									@click.prevent="
										props.row.status
											? changeStatus(
													props.row.id,
													(status = false)
											  )
											: changeStatus(props.row.id)
									"
								/>
								<label
									class="custom-control-label"
									v-bind:for="`status_${props.row.id}`"
									>{{
										props.row.status
											? "Desativar"
											: "Ativar"
									}}</label
								>
							</div>
							<div v-else>
								{{
									`Ponto Amostral ${
										sampling_point.label
									} desativado em ${convertDate(
										props.row.updated_at
									)}`
								}}
							</div>
						</div>
						<div v-else-if="props.column.field == 'actions'">
							<button
								v-if="props.row.status"
								title="Editar"
								class="btn btn-sm btn-secondary"
								@click.prevent="editModal(props.row)"
							>
								<i class="fas fa-cog fa-lg"></i>
							</button>

							<router-link
								v-if="props.row.status"
								title="Árvores"
								tag="button"
								class="btn btn-sm btn-success"
								v-bind:to="{
									path: '/panel/trees',
									query: { spid: props.row.id },
								}"
							>
								<i title="Árvores">
									<img
										src="/img/cocoa-tree.svg"
										class="img-fluid"
										style="width: 1.3333333333em"
									/>
								</i>
							</router-link>
						</div>
					</template>
				</vue-good-table>
			</div>

			<div
				class="modal fade"
				id="modalSamplingPoints"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalSamplingPointsLabel"
				aria-hidden="true"
			>
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5
								class="modal-title"
								id="modalSamplingPointLabel"
								v-show="!editMode"
							>
								{{
									`CADASTRAR PONTO AMOSTRAL ${
										sampling_points.length + 1
									}`
								}}
							</h5>
							<h5
								class="modal-title"
								id="modalSamplingPointsLabel"
								v-show="editMode"
							>
								{{
									`ATUALIZAR PONTO AMOSTRAL ${sampling_point.label}`
								}}
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
								<!-- <div class="form-group">
									<label for="sPointLabel">Rótulo</label>
									<input
										id="sPointLabel"
										type="number"
										min="1"
										class="form-control"
										v-model="sampling_point.label"
										required
									/>
								</div> -->

								<!-- <div class="form-group">
									<label for="sPointPeriod"
										>Período Agrícola</label
									>
									<input
										id="sPointPeriod"
										type="number"
										min="1"
										max="17"
										class="form-control"
										v-model="sampling_point.ini_period"
										required
									/>
								</div> -->

								<div class="form-group">
									<label for="sPointStratum"
										>Unidade Operacional</label
									>
									<input
										type="text"
										class="form-control"
										:value="stratum.label"
										disabled
									/>
									<!-- <select
										:id="'sPointStratum'"
										name="stratum"
										class="form-control"
										v-model="sampling_point.stratum"
										required
									>
										<option
											v-for="stratum in strata"
											v-bind:value="stratum"
											v-bind:key="stratum.id"
										>
											{{
												`${stratum.label} (${
													stratum.status
														? "Ativo"
														: "Inativo"
												})`
											}}
										</option>
									</select> -->
								</div>

								<hr />

								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="latitude">Latitude</label>
										<input
											id="latitude"
											class="form-control"
											aria-describedby="latHelp"
											maxlength="10"
											v-model="
												sampling_point.geolocation
													.latitude
											"
											required
										/>
										<small
											v-if="messages.latitude"
											id="latHelp"
											class="form-text text-danger"
											>{{ messages.latitude }}</small
										>
										<small
											v-else
											id="latHelp"
											class="form-text text-info"
											>Ex.: 14.145782</small
										>
									</div>
									<div class="form-group col-md-6">
										<label for="longitude">Longitude</label>
										<input
											id="longitude"
											class="form-control"
											aria-describedby="lgnHelp"
											maxlength="10"
											v-model="
												sampling_point.geolocation
													.longitude
											"
											required
										/>
										<small
											v-if="messages.longitude"
											id="lgnHelp"
											class="form-text text-danger"
											>{{ messages.longitude }}</small
										>
										<small
											v-else
											id="lgnHelp"
											class="form-text text-info"
											>Ex.: -175.145782</small
										>
									</div>
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
										:disabled="haveError"
									>
										Cadastrar
									</button>
									<button
										type="submit"
										class="btn btn-primary"
										v-show="editMode"
										:disabled="haveError"
									>
										Atualizar
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

<script src="./SamplingPoint.js"></script>

<style lang="scss">
.samplingPointWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 4px 48px;
	}

	.info {
		font-family: "Lexend", sans-serif;
		font-size: 14px;

		padding: 0px 0px 0px 48px;
	}

	.pa-limit {
		font-family: "Lexend", sans-serif;
		font-size: 14px;

		padding: 0px 0px 16px 48px;
	}

	.btn-add {
		margin: 16px 48px 16px 0;
	}

	.sampling_point-table {
		padding: 0 31px 48px;
		.deactivate-sp {
			background-color: #818181a6 !important;
			background: repeating-linear-gradient(
				45deg,
				#e7e7e7be,
				#e7e7e7be 10px,
				#d4d4d4a2 10px,
				#d4d4d4a2 20px
			);
		}
	}
}
</style>
