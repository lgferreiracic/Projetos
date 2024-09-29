<template>
	<div id="reports" class="mt-5 dataImportWrapper">
		<div class="admin-content">
			<div class="admin-header d-flex">
				<h1>Importar Dados</h1>
			</div>
		</div>

		<div class="data-box">
			<div class="container">
				<form @submit.prevent="importCSV" class="container">
					<div class="d-flex">
						<div class="form-group">
							<label for="exampleFormControlFile1"
								>Escolha um arquivo .CSV para importar os dados</label
							>
							<input
								type="file"
								name="file"
								class="form-control-file"
								accept=".csv"
								label="Selecione um arquivo CSV..."
								@change="onChange"
							/>
							<p style="color: red" v-show="show">{{ message }}</p>
						</div>
						<div class="form-group ml-5">
							<button 
								type="submit" 
								class="btn btn-agro float-right" 
								:disabled="show || this.csvLoading"
							>
								<span
									v-if="csvLoading"
									class="spinner-border spinner-border-sm"
									role="status"
									aria-hidden="true"
								></span>
								<span v-if="csvLoading">Carregando...</span>
								<span v-else><i class="fas fa-download"></i> Importar</span>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script src="./DataImport"></script>

<style lang="scss">
.dataImportWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;
		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;
		padding: 16px 0px 16px 48px;
	}

	.data-box {
		padding: 2.7%;
		box-shadow: 2px 10px 15px #0000002d;
		border-radius: 20px;
	}

	.container {
    	margin-left: 0; 
		margin-right: 0;
	}
}

@media (max-width: 576px) {
	.dataImportWrapper {
		height: 75vh;
		max-height: 80vh;
	}
}
</style>
