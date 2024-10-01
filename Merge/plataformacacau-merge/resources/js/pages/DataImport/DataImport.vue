<template>
	<div id="reports" class="p-4 p-md-5">
		<div class="admin-content">
			<div class="admin-header d-flex">
				<h2 style="padding-right: 0.5% !important">Importar Dados</h2>
			</div>
		</div>

		<div class="data-box">
			<div class="container">
				<form @submit.prevent="importCSV" class="container">
					<div class="d-flex">
						<div class="form-group">
							<label for="exampleFormControlFile1"
								>Escolha um arquivo .CSV para importar os
								dados</label
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
							<button type="submit" class="btn btn-success" :disabled="show">
								<i class="fas fa-download"></i> Importar
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
.data-box {
	height: 20vh;
	padding: 1.7%;
	border-radius: 3px;
	box-shadow: 2px 10px 15px #0000002d;
}
</style>
