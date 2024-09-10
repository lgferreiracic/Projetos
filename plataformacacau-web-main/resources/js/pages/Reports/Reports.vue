<template>
	<div id="reports" class="mt-5 reportsWrapper">
		<div class="admin-content">
			<div class="admin-header d-flex">
				<h1 style="padding-right: 0.5% !important">Relatórios</h1>
			</div>
		</div>

		<div class="report-box">
			<div class="container">
				<!-- PDF Export -->
				<div class="d-flex flex-column">
					<h4>PDF</h4>
					<div class="w-100 p-2 align-self-start">
						<form @submit.prevent="exportPDF()">
							<div class="form-row">
								<div class="form-group col-md-4">
									<label for="entities">Entidades</label>
									<select
										id="entities"
										v-model="target"
										class="form-control"
										required
									>
										<option selected disabled value="">
											Escolha uma...
										</option>
										<option value="users">Usuários</option>
										<option value="homogeneous_areas">
											Áreas Homogêneas
										</option>
										<option value="properties">
											Propriedades
										</option>
										<option value="strata">
											Unidades Operacionais
										</option>
										<option value="sampling_points">
											Pontos Amostrais
										</option>
										<option value="visits">Visitas</option>
									</select>
								</div>
							</div>

							<button
								type="submit"
								class="btn btn-agro float-right"
								:disabled="this.pdfLoading || this.xlsLoading"
							>
								<span
									v-if="pdfLoading"
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
								></span>
								<span v-if="pdfLoading">Carregando...</span>
								<span v-else>Exportar para PDF</span>
							</button>
						</form>
					</div>
				</div>
				<!-- ./ PDF Export -->

				<!-- XLS Export -->
				<div class="d-flex flex-column">
					<h4>XSL (Excel)</h4>
					<div class="w-100 p-2 align-self-end">
						<div style="margin-bottom: 2%">
							<span>
								Ao exportar neste formato, o resultado será uma
								tabela com todo o conteúdo das coletas,
								relacionadas com cada entidade do banco de dados
							</span>
						</div>
						<form @submit.prevent="exportXLS()">
							<button
								type="submit"
								class="btn btn-agro float-right"
								:disabled="this.pdfLoading || this.xlsLoading"
							>
								<span
									v-if="xlsLoading"
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
								></span>
								<span v-if="xlsLoading">Carregando...</span>
								<span v-else>Exportar para XSL</span>
							</button>
						</form>
					</div>
				</div>
				<!-- ./ XLS Export -->

				<!-- CSV Export -->
				<!-- <div class="d-flex flex-column">
					<h4>CSV (Texto)</h4>
					<div class="w-100 p-2 align-self-end">
						<div style="margin-bottom: 2%">
							<span>
								Ao exportar neste formato, o resultado será uma
								tabela com todo o conteúdo das coletas,
								relacionadas com cada entidade do banco de dados
							</span>
						</div>
						<form @submit.prevent="exportCSV()">
							<button
								type="submit"
								class="btn btn-agro float-right"
								:disabled="this.pdfLoading || this.xlsLoading || this.csvLoading"
							>
								<span
									v-if="csvLoading"
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
								></span>
								<span v-if="csvLoading">Carregando...</span>
								<span v-else>Exportar para CSV</span>
							</button>
						</form>
					</div>
				</div> -->
				<!-- ./ CSV Export -->
			</div>
		</div>
	</div>
</template>

<script src="./Reports"></script>

<style lang="scss">
.reportsWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 16px 48px;
	}

	.report-box {
		padding: 2.7%;
	}
}

@media (max-width: 576px) {
	.reportsWrapper {
		height: 75vh;
		max-height: 80vh;
	}
}
</style>
