<template>
	<div id="trees" class="mb-5 treeWrapper">
		<div class="admin-content">
			<!-- <back-button
				title="Voltar para unidades operacionais"
			></back-button> -->
			<div
				class="admin-header d-flex justify-content-between align-items-center p-4"
			>
				<div class="col">
					<h1>Árvores</h1>
					<p class="info">
						{{
							`Unidade Operacional ${stratum.label} / Ponto Amostral ${this.splabel}`
						}}
					</p>
				</div>

				<button
					v-show="active_trees < 7"
					type="button"
					class="btn btn-agro"
					@click.prevent="store()"
				>
					<i class="fas fa-plus"></i>
				</button>
			</div>
			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="tree-table" v-else>
				<vue-good-table
					title="Árvores"
					:columns="fields"
					:rows="trees"
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
						<div v-if="props.column.field === 'label'">
							{{ props.row.label }}
						</div>
						<div
							v-if="props.column.field === 'status'"
							class="custom-control custom-switch"
						>
							<div v-if="props.row.status">
								<input
									type="checkbox"
									class="custom-control-input"
									v-bind:id="`status_${props.row.id}`"
									v-model="props.row.status"
									@click.prevent="deactivate(props.row.id)"
									:disabled="!props.row.status"
								/>
								<label
									class="custom-control-label"
									v-bind:for="`status_${props.row.id}`"
									>{{ "Desativar" }}</label
								>
							</div>
							<div v-else>
								{{
									`Árvore desativada em ${convertDate(
										props.row.updated_at
									)}`
								}}
							</div>
						</div>

						<div v-if="props.column.field == 'actions'">
							<div class="d-flex" style="gap: 0 8px">
								<router-link
									tag="button"
									class="btn btn-success"
									v-bind:to="{
										path: '/panel/tree-visits',
										query: {
											trid: props.row.id,
											splabel: splabel,
											stlabel: stratum.label,
										},
									}"
									>Coletas</router-link
								>

								<button
									title="Editar árvore"
									class="btn btn-md btn-info"
									@click="editModal(props.row)"
									:disabled="props.row.status === 0"
								>
									<i class="fas fa-edit fa-sm"></i>
								</button>
							</div>
						</div>
					</template>
				</vue-good-table>
			</div>

			<div
				class="modal fade"
				id="modalTrees"
				ref="modal"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalTreesLabel"
				aria-hidden="true"
			>
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5
								class="modal-title"
								id="modalTreesLabel"
								v-show="editMode"
							>
								ATUALIZAR ÁRVORE
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
							<form @submit.prevent="update()">
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="treeLabel">
											Label da árvore
										</label>
										<input
											id="treeLabel"
											type="text"
											class="form-control"
											v-model="tree.label"
											disabled
										/>
									</div>
									<div class="form-group col-md-6">
										<label for="treeRfid"> RFID </label>
										<input
											id="treeRfid"
											type="text"
											class="form-control"
											v-model="tree.rfid"
										/>
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

<script src="./Tree.js"></script>

<style lang="scss">
.treeWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;
	margin-top: 64px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;
		padding-left: 16px 0px 16px 48px;
	}

	.info {
		font-family: "Lexend", sans-serif;
		font-size: 14px;
	}

	.btn-add {
		margin: 16px 48px 16px 0;
	}

	.tree-table {
		padding: 0 31px 48px;
	}
	.unselectable {
		background-color: #ddd;
		cursor: not-allowed;
	}

	.deactivate-tree {
		background-color: #818181a6;
		background: repeating-linear-gradient(
			45deg,
			#e7e7e7be,
			#e7e7e7be 10px,
			#d4d4d4a2 10px,
			#d4d4d4a2 20px
		);
	}
}
</style>
