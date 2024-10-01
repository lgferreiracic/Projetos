<template>
	<div class="mapWrapper mt-5">
		<div id="map"></div>
		<div
			class="modal fade"
			id="propertyInfo"
			tabindex="-1"
			role="dialog"
			aria-labelledby="propertyInfoLabel"
			aria-hidden="true"
		>
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="propertyInfoLabel">
							{{
								`${property.name}`
							}}
						</h5>
						<button
							type="button"
							class="close"
							data-dismiss="modal"
							aria-label="Fechar"
						>
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="list-group text-dark">
							<span
								class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
							>
								Proprietário
								<span>{{ property.owner_name }}</span>
							</span>
							<span
								class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
							>
								Áreas Homogêneas Ativas
								<span>{{
									`${property.total_homogeneous_areas}`
								}}</span>
							</span>
							<span
								class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
							>
								Cidade
								<span>{{ property.city }} - {{ property.uf }}</span>
							</span>
							<span
								class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
							>
								Descrição
								<span>{{ property.description ?? "-" }}</span>
							</span>
						</div>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-secondary"
							data-dismiss="modal"
						>
							Fechar
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script src="./Map.js"></script>

<style lang="scss">
.mapWrapper {
	border-radius: 20px;
	overflow: clip;

	#samplingPointInfo {
		.modal-header {
			border-bottom: 0px !important;
		}

		.modal-footer {
			border-top: 0px !important;
		}
	}

	#map {
		height: 90vh;
	}

	.marker {
		background-image: url("/img/cocoa-tree.png");
		background-size: cover;
		cursor: pointer;
	}
}

@media (max-width: 576px) {
	.mapWrapper {
		height: 75vh;
		max-height: 80vh;
	}
}
</style>
