<template>
	<div id="blocks" class="mt-5 blocksWrapper">
		<div class="admin-content">
			<div class="admin-header d-flex flex-column p-2">
				<h1>
					Resumo das {{ property.area_name.toLowerCase() }}s
					cadastradas
				</h1>
				<p>{{ property.name }}</p>
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
					:sort-options="{
						enabled: true,
					}"
				>
					<div slot="emptystate">
						Não há registros para esta pesquisa
					</div>
					<template slot="table-row" slot-scope="props">
						<!-- <span v-if="props.column.field == 'id'">{{
							`${property.area_name} ${props.row.id}`
						}}</span> -->
						<span v-if="props.column.field == 'area'"
							>{{ `${props.row.area}` }} hectares</span
						>
						<span v-else-if="props.column.field == 'altitude'">{{
							`${checkAltitude(props.row.altitude)}`
						}}</span>
						<span v-else-if="props.column.field == 'relief'">{{
							`${checkRelief(props.row.relief)}`
						}}</span>
						<span v-else-if="props.column.field == 'soilClass'">{{
							`${checkSoilClass(props.row.soilClass)}`
						}}</span>
						<span v-else-if="props.column.field == 'rainfall'">{{
							`${
								checkRainfall(props.row.rainfall) > 0
									? `${checkRainfall(
											props.row.rainfall
									  )} meses com chuva média < 60mm`
									: "Nenhum mês com chuva média < 60mm"
							}`
						}}</span>
						<span v-else-if="props.column.field == 'handling'">{{
							`${checkHandlingType(props.row.handling)}`
						}}</span>
						<div v-else-if="props.column.field == 'genotypes'">
							<table
								class="table table-borderless table-sm table-responsive"
							>
								<thead>
									<tr>
										<th scope="col">Tipo</th>
										<th scope="col">% participação</th>
										<th scope="col">Idade</th>
										<th scope="col">População</th>
										<th scope="col">Safra dominante</th>
									</tr>
								</thead>
								<tbody>
									<tr
										v-html="
											createGenotypeRow(
												props.row.genotype,
												props.row.area
											)
										"
									></tr>
								</tbody>
							</table>
						</div>
					</template>
				</vue-good-table>
			</div>
		</div>
	</div>
</template>

<script src="./Overview.js"></script>

<style lang="scss" scoped>
.blocksWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;
	max-width: 78vw;
	max-height: 70vh;
	overflow-y: scroll;

	.admin-header {
		p {
			font-family: "Lexend", sans-serif;
			font-weight: 600;
			font-size: 16px;

			padding: 0 0 0 48px;
		}
	}

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 4px 48px;
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

	.vgt-table th.line-numbers {
		width: 34px !important;
	}

	.modal {
		.modal-header {
			display: flex;
			flex-direction: column;
			align-items: center;
			border-bottom: none;

			img {
				margin-top: -25px;
				padding: 0;
			}

			h5 {
				color: #000;
				font-family: "Lexend";
				font-weight: 600;
				font-size: 24px;
				margin-top: 16px;
			}
		}

		.modal-body {
			p {
				color: #000;
				font-family: "Lexend";
				font-size: 14px;
				line-height: 20px;
				text-align: justify;
			}

			p:first-of-type {
				margin-bottom: 12px;
			}

			span {
				color: #3d8160;
				font-weight: bold;
				text-decoration: underline;
			}
		}

		.modal-footer {
			border-top: none;
			margin-bottom: 24px;

			display: flex;
			justify-content: space-evenly;

			button {
				width: 220px;

				font-family: "Lexend", sans-serif;
				font-weight: 600;
				font-size: 12px;
			}

			.btn-pause {
				color: #fff;
			}

			.btn-continue {
				background-color: #3d8160;
				color: #fff;
			}

			.btn-continue:hover {
				background-color: #70a46b;
			}
		}
	}
}
</style>
