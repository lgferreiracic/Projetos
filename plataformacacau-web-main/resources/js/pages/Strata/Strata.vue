<template>
	<div id="strata" class="mt-5 operationalUnitWrapper">
		<div class="admin-content">
			<div
				class="admin-header d-flex align-items-center justify-content-between p-2"
			>
				<div class="d-flex align-items-center">
					<button @click="$router.go(-1)" class="btn btn-back">
						<i class="fas fa-arrow-left"></i>
					</button>
					<h1 class="ml-3">Unidades Operacionais</h1> <!-- Adicionada uma margem para o título -->
				</div>
				
				<button
					type="button"
					class="btn btn-agro btn-add"
					@click="addModal"
					v-if="userRole !== 'pre-registered'"
				>
					<i class="fas fa-plus"></i>
				</button>
			</div>

			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="operational_unit-table" v-else>
				<vue-good-table
					title="Unidades Operacionais"
					:columns="fields"
					:rows="strata"
					:pagination-options="paginationOptions"
					:fixed-header="true"
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
						<div
							v-if="props.column.field == 'status'"
							class="custom-control custom-switch"
						>
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
							>
								{{ props.row.status ? "Desativar" : "Ativar" }}
							</label>
						</div>

						<div v-else-if="props.column.field == 'actions'">
							<button
								title="Editar"
								class="btn btn-sm btn-secondary"
								@click="editModal(props.row)"
								v-if="userRole !== 'pre-registered'"
							>
								<i class="fas fa-cog fa-lg"></i>
							</button>

							<router-link
								title="Pontos Amostrais"
								tag="button"
								class="btn btn-sm btn-secondary"
								v-bind:to="{
									path: '/panel/sampling-points',
									query: { strid: props.row.id },
								}"
							>
								<i class="fas fa-map-marker-alt fa-lg"></i>
							</router-link>
						</div>
					</template>
				</vue-good-table>
			</div>

			<div
				class="modal fade"
				id="modalStrata"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalStrataLabel"
				aria-hidden="true"
			>
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5
								class="modal-title"
								id="modalStrataLabel"
								v-show="!editMode"
							>
								ADICIONAR UNIDADE OPERACIONAL
							</h5>
							<h5
								class="modal-title"
								id="modalStrataLabel"
								v-show="editMode"
							>
								{{ `ATUALIZAR ${stratum.label.toUpperCase()}` }}
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
									<label for="label">Rótulo</label>
									<input
										id="label"
										type="text"
										class="form-control"
										placeholder="Nova Unidade Operacional"
										v-model="stratum.label"
									/>
								</div>

								<div class="form-group">
									<label for="stratumHArea"
										>Área Homogênea</label
									>
									<select
										:id="'stratumHArea'"
										name="stratum"
										class="form-control"
										v-model="stratum.homogeneous_area"
										required
									>
										<option
											v-for="homogeneous_area in homogeneous_areas"
											v-bind:value="homogeneous_area"
											v-bind:key="homogeneous_area.id"
										>
											{{
												`${homogeneous_area.label} (${
													homogeneous_area.status
														? "Ativo"
														: "Inativo"
												})`
											}}
										</option>
									</select>
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
		</div>
	</div>
</template>

<script src="./Strata.js"></script>

<style lang="scss" scoped>
.operationalUnitWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 16px 16px;
		margin: auto;
	}

	.btn-back {
		background-color: #25661a;
		color: #fff;
		border: none;
		padding: 6px 12px;
		margin: 16px 0 16px 48px;
		border-radius: 5px;
		font-size: 16px;
		font-weight: 600;
		cursor: pointer;
		transition: background-color 0.3s ease;

		&:hover {
			background-color: #2f6649;
		}
	}

	.btn-add {
		margin: 16px 48px 16px 0;
	}

	.operational_unit-table {
		padding: 0 31px 48px;
	}
}
</style>
