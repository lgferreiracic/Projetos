<template>
	<div id="trees" class="mb-5 treeWrapper">
		<div class="admin-content">
			<!-- <back-button
				title="Voltar para unidades operacionais"
			></back-button> -->
			<div
				class="admin-header d-flex justify-content-between align-items-center p-4"
			>
				<button @click="$router.go(-1)" class="btn btn-back"><i class="fas fa-arrow-left"></i></button>
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
					title="Estratos"
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

						<router-link
							v-else-if="props.column.field === 'actions'"
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
					</template>
				</vue-good-table>
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

	.info {
		font-family: "Lexend", sans-serif;
		font-size: 14px;
		margin-bottom: 0;
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