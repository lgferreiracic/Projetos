<template>
	<div id="docs" class="mt-5 docsWrapper">
		<div class="admin-content">
			<div class="admin-header d-inline-flex p-2">
				<h1>Documentações</h1>
			</div>
			<br />

			<ul class="list-group list-group-flush">
				<li
					class="list-group-item d-flex justify-content-between align-items-center"
				>
					API
					<a
						class="badge badge-primary badge-pill"
						href="/docs/index.html"
						>LINK</a
					>
				</li>
				<li
					class="list-group-item d-flex justify-content-between align-items-center"
				>
					Banco de Dados
					<a
						class="badge badge-primary badge-pill"
						href="/docs/database.html"
						>LINK</a
					>
				</li>
				<li
					class="list-group-item d-flex justify-content-between align-items-center"
				>
					Sistema Web
					<a
						@click="downloadFile()"
						class="badge badge-primary badge-pill"
						href="#!"
						>BAIXAR</a
					>
				</li>
				<li
					class="list-group-item d-flex justify-content-between align-items-center"
				>
					Aplicativo
					<a
						@click="downloadFile()"
						class="badge badge-primary badge-pill"
						href="#!"
						>BAIXAR</a
					>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {
	methods: {
		downloadFile() {},
	},
};
</script>

<style lang="scss" scoped>
.docsWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 16px 48px;
	}

	.list-group {
		color: #000000;
		overflow: clip;
		padding: 0 0 32px;

		.list-group-item {
			background-color: transparent !important;
		}
		a {
			color: #ffffff;
		}
	}
}

@media (max-width: 576px) {
	.docsWrapper {
		height: 75vh;
		max-height: 80vh;
	}
}
</style>
