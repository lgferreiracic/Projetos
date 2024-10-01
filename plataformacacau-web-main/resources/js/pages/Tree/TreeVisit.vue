<template>
	<div id="tree-visits" class="mt-5 mb-5 treeVisitsWrapper">
		<div class="admin-content">
			<!-- <back-button title="Voltar para árvores"></back-button> -->
			<div class="admin-header d-flex align-items-center p-2">
				<button @click="$router.go(-1)" class="btn btn-back"><i class="fas fa-arrow-left"></i></button>
				<div class="col">
					<h1>{{ `Coletas da Árvore ${tree.label}` }}</h1>
					<p class="info">
						{{
							`Unidade Operacional ${stratum.label} / Ponto Amostral ${this.splabel}`
						}}
					</p>
				</div>
			</div>

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="tree_visits-table" v-else>
				<vue-good-table
					title="Visitas"
					:columns="fields"
					:rows="tree_visits"
					:pagination-options="paginationOptions"
					:search-options="{
						enabled: true,
						placeholder: 'Pesquisar...',
					}"
					:sort-options="{
						enabled: true,
						initialSortBy: {
							field: 'id',
							type: 'asc',
						},
					}"
					compactMode
				>
					<div slot="emptystate">
						Não há registros para esta pesquisa
					</div>
					<template slot="table-row" slot-scope="props">
						<span v-if="props.column.field == 'id'">
							{{ `${props.index + 1}` }}
						</span>
						<span v-else-if="props.column.field == 'date'">{{
							`${convertDate(props.row.date)}`
						}}</span>
						<button
							v-else-if="props.column.field == 'actions'"
							title="Informações da Visita"
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
										`Informações da Coleta ${this.visit_index} - Árvore ${tree.label}`
									}}
								</h5>
								<p>
									{{
										`Unidade Operacional ${splabel} Área Homogênea ${stratum.label}`
									}}
								</p>
							</div>
						</div>
						<div class="modal-body">
							<div
								id="collection_information"
								v-if="!showAreaInfo"
								class="table-responsive"
							>
								<table class="table table-hover">
									<thead>
										<tr>
											<th scope="col"></th>
											<th>V.B.</th>
											<th>Perda</th>
											<th>Peco</th>
											<th>Podre</th>
											<th>Rato</th>
											<th>Colhido</th>
											<th>Frutos bons</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>0-21 dias</th>
											<td>
												{{
													tree_visit.bobbin
														.witchs_broom
														? tree_visit.bobbin
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.bobbin.loss
														? tree_visit.bobbin.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.bobbin.piece
														? tree_visit.bobbin
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.bobbin.rotten
														? tree_visit.bobbin
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.bobbin.rat
														? tree_visit.bobbin.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.bobbin.harvested
														? tree_visit.bobbin
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.bobbin.total }}
											</td>
										</tr>
										<tr>
											<th>21-42 dias</th>
											<td>
												{{
													tree_visit.small
														.witchs_broom
														? tree_visit.small
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.small.loss
														? tree_visit.small.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.small.piece
														? tree_visit.small.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.small.rotten
														? tree_visit.small
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.small.rat
														? tree_visit.small.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.small.harvested
														? tree_visit.small
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.small.total }}
											</td>
										</tr>
										<tr>
											<th>42-63 dias</th>
											<td>
												{{
													tree_visit.medium
														.witchs_broom
														? tree_visit.medium
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium.loss
														? tree_visit.medium.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium.piece
														? tree_visit.medium
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium.rotten
														? tree_visit.medium
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium.rat
														? tree_visit.medium.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium.harvested
														? tree_visit.medium
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.medium.total }}
											</td>
										</tr>
										<tr>
											<th>63-84 dias</th>
											<td>
												{{
													tree_visit.medium2
														.witchs_broom
														? tree_visit.medium2
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium2.loss
														? tree_visit.medium2
																.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium2.piece
														? tree_visit.medium2
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium2.rotten
														? tree_visit.medium2
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium2.rat
														? tree_visit.medium2.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium2.harvested
														? tree_visit.medium2
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.medium2.total }}
											</td>
										</tr>
										<tr>
											<th>84-105 dias</th>
											<td>
												{{
													tree_visit.medium3
														.witchs_broom
														? tree_visit.medium3
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium3.loss
														? tree_visit.medium3
																.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium3.piece
														? tree_visit.medium3
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium3.rotten
														? tree_visit.medium3
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium3.rat
														? tree_visit.medium3.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.medium3.harvested
														? tree_visit.medium3
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.medium3.total }}
											</td>
										</tr>
										<tr>
											<th>105-126 dias</th>
											<td>
												{{
													tree_visit.adult
														.witchs_broom
														? tree_visit.adult
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult.loss
														? tree_visit.adult.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult.piece
														? tree_visit.adult.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult.rotten
														? tree_visit.adult
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult.rat
														? tree_visit.adult.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult.harvested
														? tree_visit.adult
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.adult.total }}
											</td>
										</tr>
										<tr>
											<th>126-147 dias</th>
											<td>
												{{
													tree_visit.adult2
														.witchs_broom
														? tree_visit.adult2
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult2.loss
														? tree_visit.adult2.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult2.piece
														? tree_visit.adult2
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult2.rotten
														? tree_visit.adult2
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult2.rat
														? tree_visit.adult2.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.adult2.harvested
														? tree_visit.adult2
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.adult2.total }}
											</td>
										</tr>
										<tr>
											<th>147-168 dias</th>
											<td>
												{{
													tree_visit.mature
														.witchs_broom
														? tree_visit.mature
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature.loss
														? tree_visit.mature.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature.piece
														? tree_visit.mature
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature.rotten
														? tree_visit.mature
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature.rat
														? tree_visit.mature.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature.harvested
														? tree_visit.mature
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.mature.total }}
											</td>
										</tr>
										<tr>
											<th>168-189 dias</th>
											<td>
												{{
													tree_visit.mature2
														.witchs_broom
														? tree_visit.mature2
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature2.loss
														? tree_visit.mature2
																.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature2.piece
														? tree_visit.mature2
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature2.rotten
														? tree_visit.mature2
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature2.rat
														? tree_visit.mature2.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature2.harvested
														? tree_visit.mature2
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.mature2.total }}
											</td>
										</tr>
										<tr>
											<th>189-210 dias</th>
											<td>
												{{
													tree_visit.mature3
														.witchs_broom
														? tree_visit.mature3
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature3.loss
														? tree_visit.mature3
																.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature3.piece
														? tree_visit.mature3
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature3.rotten
														? tree_visit.mature3
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature3.rat
														? tree_visit.mature3.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature3.harvested
														? tree_visit.mature3
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.mature3.total }}
											</td>
										</tr>
										<tr>
											<th>Mais de 210 dias</th>
											<td>
												{{
													tree_visit.mature4
														.witchs_broom
														? tree_visit.mature4
																.witchs_broom
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature4.loss
														? tree_visit.mature4
																.loss
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature4.piece
														? tree_visit.mature4
																.piece
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature4.rotten
														? tree_visit.mature4
																.rotten
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature4.rat
														? tree_visit.mature4.rat
														: "-"
												}}
											</td>
											<td>
												{{
													tree_visit.mature4.harvested
														? tree_visit.mature4
																.harvested
														: "-"
												}}
											</td>
											<td>
												{{ tree_visit.mature4.total }}
											</td>
										</tr>
										<tr>
											<th scope="row">Total</th>
											<td>{{ tree_visit.total_wb }}</td>
											<td>{{ tree_visit.total_loss }}</td>
											<td>
												{{ tree_visit.total_piece }}
											</td>
											<td>
												{{ tree_visit.total_rotten }}
											</td>
											<td>{{ tree_visit.total_rat }}</td>
											<td>
												{{ tree_visit.total_harvested }}
											</td>
											<td>{{ tree_visit.total_good }}</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="4">
												{{
													`Coletado por ${
														tree_visit.collector
															.name
													} em ${convertDate(
														tree_visit.date
													)}`
												}}
											</td>
										</tr>
									</tfoot>
								</table>
							</div>

							<!-- <div class="container" v-else>
								<div id="area_information">
									<div class="row">
										<div class="col-sm">
											<span>
												Floração:
												{{
													generalAreaInfo(
														tree_visit
															.visit_information
															.flowering
													)
												}}
											</span>
										</div>
										<div class="col-sm">
											<span>
												Refoliação:
												{{
													generalAreaInfo(
														tree_visit
															.visit_information
															.refoliation
													)
												}}
											</span>
										</div>
										<div class="col-sm">
											<span>
												Copa:
												{{
													generalAreaInfo(
														tree_visit
															.visit_information
															.top
													)
												}}
											</span>
										</div>
									</div>

									<div class="row">
										<div class="col-sm">
											<i
												v-if="
													tree_visit.visit_information
														.pruned
												"
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
												v-if="
													tree_visit.visit_information
														.mowing
												"
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
												v-if="
													tree_visit.visit_information
														.weeding
												"
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
												v-if="
													tree_visit.visit_information
														.grated
												"
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
												v-if="
													tree_visit.visit_information
														.renewed
												"
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
													tree_visit.visit_information
														.fertilized
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
													tree_visit.visit_information
														.pulverized
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
												v-if="
													tree_visit.visit_information
														.wind
												"
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
													tree_visit.visit_information
														.brown_rot
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
												v-if="
													tree_visit.visit_information
														.drought
												"
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
												v-if="
													tree_visit.visit_information
														.rain
												"
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
												v-if="
													tree_visit.visit_information
														.rat
												"
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
												v-if="
													tree_visit.visit_information
														.flood
												"
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
												v-if="
													tree_visit.visit_information
														.insect
												"
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
													tree_visit.visit_information
														.absence_of_shadow
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

								<div class="row">
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
								</div>
							</div> -->

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

<script src="./TreeVisit.js"></script>

<style lang="scss" scoped>
.treeVisitsWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

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

	.tree_visits-table {
		padding: 0 31px 48px;
	}

	i {
		&.fa-check-circle {
			color: #06c000;
		}
		&.fa-times-circle {
			color: #cf0000;
		}
	}

	#area_information {
		margin: 2em;
		font-size: 16px;

		.row {
			margin-bottom: 1em;
		}
	}

	.modal-header {
		border-bottom: 0px !important;
	}

	.modal-footer {
		border-top: 0px !important;
	}

	.subtitle {
		background-color: rgb(230, 230, 230);
		border-radius: 5px;
		padding: 5px;
	}
}
</style>
