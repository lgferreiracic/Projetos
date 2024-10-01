<template>
	<div id="blocks" class="mt-5 blocksWrapper">
		<div class="admin-content">
			<div
				class="admin-header d-flex justify-content-between align-items-center p-2"
			>
				<h1>{{ property.area_name }}s</h1>
				<div>
					<router-link
						tag="button"
						class="btn btn-agro btn-add"
						v-bind:to="{
							path: '/panel/add-operational-unit',
							query: { propid: `${propertyId}` },
						}"
					>
						<i class="fas fa-plus"></i> Registrar
						{{ property.area_name }}
					</router-link>
				</div>
			</div>
			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="blocks-table" v-else>
				<vue-good-table
					:title="property.area_name"
					:columns="fields"
					:rows="blocks"
					:pagination-options="paginationOptions"
					:fixed-header="true"
					:search-options="{
						enabled: true,
						placeholder: 'Pesquisar...',
					}"
					:sort-options="{
						enabled: true,
						initialSortBy: [{ field: 'label', type: 'asc' }],
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
						<span v-else-if="props.column.field == 'altitude'">{{
							`${checkAltitude(props.row.altitude)}`
						}}</span>
						<span v-else-if="props.column.field == 'relief'">{{
							`${checkRelief(props.row.relief)}`
						}}</span>
						<span v-else-if="props.column.field == 'area'"
							>{{ `${props.row.area}` }} hectares</span
						>
						<router-link
							v-if="props.column.field == 'actions'"
							tag="button"
							class="btn btn-secondary"
							v-bind:to="{
								path: '/panel/edit-block',
								query: { block: `${props.row.id}` },
							}"
						>
							<i class="fas fa-edit fa-lg"></i>
						</router-link>
					</template>
				</vue-good-table>
			</div>
		</div>
	</div>
</template>

<script src="./ListBlocks.js"></script>

<style lang="scss" scoped>
.blocksWrapper {
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

	.blocks-table {
		padding: 0 31px 48px;
		overflow: hidden;
	}

	.vgt-global-search__input .input__icon {
		background-color: #3d8160;
	}
}
</style>
