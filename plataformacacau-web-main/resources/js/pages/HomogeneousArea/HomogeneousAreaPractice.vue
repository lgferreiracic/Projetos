<template>
	<div id="tree-visits" class="p-4 p-md-5 homogeneousAreaPracticeWrapper">
		<div class="admin-content">
			<div class="admin-header d-flex align-items-center p-2">
				<button @click="$router.go(-1)" class="btn btn-back"><i class="fas fa-arrow-left"></i></button>
				<div class="col">
					<h2>
						{{ `Coletas da Prática da Área Homogênea ${halabel}` }}
					</h2>
				</div>
			</div>
			<div class="homogeneous_area_practice-table">
				<div v-if="loading" class="loader-overlay">
					<loader :loading="loading"></loader>
				</div>

				<div v-else>
					<vue-good-table
						title="Áreas Homogêneas"
						:columns="fields"
						:rows="visits_information"
						:pagination-options="paginationOptions"
						:fixed-header="true"
						:search-options="{
							enabled: true,
							placeholder: 'Pesquisar...'
						}"
						:sort-options="{
							enabled: true,
							initialSortBy: {
								field: 'id',
								type: 'asc'
							},
						}"
						compactMode
					>
						<div slot="emptystate">
							Não há registros para esta pesquisa
						</div>
						<template slot="table-row" slot-scope="props">
							<span v-if="props.column.field == 'date'">{{
								`${convertDate(props.row.date)}`
							}}</span>
							<button
								v-else-if="props.column.field == 'actions'"
								title="Informações da Prática"
								class="btn btn-secondary"
								@click.prevent="
									showModal(props.row, props.index + 1)
								"
							>
								<i class="fas fa-info-circle fa-lg"></i>
							</button>
						</template>
					</vue-good-table>
				</div>
			</div>
			

			<div
				class="modal fade"
				id="modalShow"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalShowLabel"
				aria-hidden="true"
			>
				<div
					class="modal-dialog modal-dialog-centered modal-lg"
					role="document"
				>
					<div class="modal-content">
						<div class="modal-header justify-content-center">
							<div class="col text-center">
								<h5 class="modal-title" id="modalShowLabel">
									{{
										`Informações da Prática: Área Homogênea ${halabel} - Visita ${visit_information.id}`
									}}
								</h5>
							</div>
						</div>
						<div class="modal-body">
							<div class="container">
								<div id="area_information">
									<div class="row">
										<div class="col-sm">
											<span>
												Floração:
												{{
													generalAreaInfo(
														visit_information.flowering
													)
												}}
											</span>
										</div>
										<div class="col-sm">
											<span>
												Refoliação:
												{{
													generalAreaInfo(
														visit_information.refoliation
													)
												}}
											</span>
										</div>
										<div class="col-sm">
											<span>
												Copa:
												{{
													generalAreaInfo(
														visit_information.top
													)
												}}
											</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="visit_information.pruned"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Podada</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.mowing"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Roçada</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.weeding"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Capinada</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="visit_information.grated"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Raleada</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.renewed"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Renovada</span>
										</div>
										<div class="col-sm">
											<i
												v-if="
													visit_information.fertilized
												"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Adubada</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="
													visit_information.pulverized
												"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Pulverizada</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.wind"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Vento</span>
										</div>
										<div class="col-sm">
											<i
												v-if="
													visit_information.brown_rot
												"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Podridão Parda</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="visit_information.drought"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Estiagem</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.rain"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Chuva</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.rat"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Rato</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="visit_information.flood"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Enchente</span>
										</div>
										<div class="col-sm">
											<i
												v-if="visit_information.insect"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Inseto</span>
										</div>
										<div class="col-sm">
											<i
												v-if="
													visit_information.absence_of_shadow
												"
												class="fas fa-check-circle"
											></i>
											<i
												v-else
												class="fas fa-times-circle"
											></i>
											<span>Sombra</span>
										</div>
									</div>
								</div>

								<div class="row mb-3 ml-3 subtitle">
									<div class="col-sm">
										<span>Legenda:</span>
									</div>

									<div class="col-sm">
										<i class="fas fa-check-circle"></i>
										Tarefa realizada
									</div>

									<div class="col-sm">
										<i class="fas fa-times-circle"></i>
										Tarefa não realizada
									</div>
								</div>

								<!-- <div class="row">
									<div class="col">
										<button
											type="button"
											class="btn btn-success"
											@click="showAreaInfo = false"
										>
											<i class="fas fa-arrow-left"></i>
											<span>Informações dos Frutos</span>
										</button>
									</div>
								</div> -->
							</div>

							<div class="modal-footer">
								<button
									type="button"
									class="btn btn-secondary"
									data-dismiss="modal"
									@click="showAreaInfo = false"
								>
									Sair
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script src="./HomogeneousAreaPractice.js"></script>

<style lang="scss" scoped>

	.homogeneousAreaPracticeWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;
	margin-top: 3% !important;
	padding: 0% !important;


	h2 {
		color: #3d8160;
		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;
		padding: 16px 0px 8px 16px;
		margin: auto;
	}
	}

	.admin-header {
		display: flex;
		align-items: center;
	}

	.homogeneous_area_practice-table {
		padding: 0 31px 48px;
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

	@media (max-width: 576px) {
	.homogeneousAreaPracticeWrapper {
		height: 75vh;
		max-height: 80vh;
	}


	}

</style>
