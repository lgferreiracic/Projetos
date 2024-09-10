<template>
	<form @submit.prevent="nextStep()">
		<h2>
			Editar {{ block.label }}
		</h2>
		<div class="form-group">
			<label for="farmName">Nome da propriedade</label>
			<input
				type="text"
				class="form-control"
				:placeholder="block.property.name"
				readonly
			/>
		</div>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="farmArea"
					>Área em hectares da {{ lowerCaseAreaName() }}</label
				>
				<input
					type="number"
					class="form-control"
					id="farmArea"
					v-model="area"
					min="1"
					@change="$emit('area', area)"
					required
					pattern="\d+"
				/>
				<div class="invalid-feedback">
					Por favor, forneça um valor de área válido.
				</div>
			</div>
			<div class="form-group col-md-12">
				<label for="production"
					>Produção da {{ lowerCaseAreaName() }} em arroba (1 arroba = 14.688 kg)</label
				>
				<div class="form-row">
					<div class="form-group col-md-4">
						<input
							type="number"
							class="form-control"
							id="production"
							min="0"
							step="0.1"
							v-model="temple"
							@change="calculateTotal()"
							required
							pattern="\d+"
							:disabled="!!not_informed"
						/>
						<label for="inputEmail4">Temporã</label>
					</div>
					<div class="form-group col-md-4">
						<input
							type="number"
							class="form-control"
							id="production"
							min="0"
							step="0.1"
							v-model="main"
							@change="calculateTotal()"
							required
							pattern="\d+"
							:disabled="!!not_informed"
						/>
						<label for="inputPassword4">Principal</label>
					</div>
					<div class="form-group col-md-4">
						<input
							type="number"
							class="form-control"
							id="production"
							min="0"
							step="0.1"
							v-model="total"
							@change="totalProduction()"
							required
							pattern="\d+"
							:disabled="!!not_informed"
						/>
						<label for="inputPassword4">Total</label>
					</div>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="productionCheck" @change="toggleProductionInputs()" :checked="not_informed">
					<label class="form-check-label" for="productionCheck">
						Não sei informar os dados de produção
					</label>
				</div>
			</div>
		</div>

		<h3>Coordenadas geográficas da {{ lowerCaseAreaName() }}</h3>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="latitude">Latitude</label>
				<input
					type="number"
					class="form-control"
					id="latitude"
					step="0.0000001"
					aria-describedby="latitudeHelp"
					v-model="latitude"
					@change="$emit('latitude', latitude)"
					pattern="^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,7})?))$"
					required
				/>
				<small id="latitudeHelp" class="form-text text-muted"
					>Ex.: -14.7973751</small
				>
			</div>
			<div class="form-group col-md-6">
				<label for="longitude">Longitude</label>
				<input
					type="number"
					class="form-control"
					id="longitude"
					step="0.0000001"
					aria-describedby="longitudeHelp"
					v-model="longitude"
					@change="$emit('longitude', longitude)"
					pattern="^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,7})?))$"
					required
				/>
				<small id="longitudeHelp" class="form-text text-muted"
					>Ex.: -39.0329873</small
				>
			</div>
		</div>
		<div class="mt-2 mb-4 actions">
			<div class="actions-buttons">
				<router-link
					type="button"
					class="btn btn-outline-danger button cancel-button"
					to="/panel/properties"
				>
					Cancelar
				</router-link>
				<button type="submit" class="btn button submit-button">
					Próxima etapa
				</button>
			</div>
		</div>
	</form>
</template>

<script>
export default {
	props: {
		block: Object,
		nextStep: Function,
	},

	data() {
		return {
			area: null,
			temple: null,
			main: null,
			total: null,
			not_informed: null,
			latitude: null,
			longitude: null,
		};
	},

	created() {
		this.area = this.block.area;
		this.temple = this.block.production.temple;
		this.main = this.block.production.main;
		this.total = this.block.production.total;
		this.not_informed = this.block.production.not_informed;
		this.latitude = Number(this.block.geolocation.latitude).toFixed(7);
		this.longitude = Number(this.block.geolocation.longitude).toFixed(7);
	},

	methods: {
		lowerCaseAreaName() {
			return this.block.property.area_name?.toLowerCase();
		},

		calculateTotal() {
			if (this.total > (this.temple + this.total)) {
				this.total = 0;
			}

			this.total = parseFloat(this.temple) + parseFloat(this.main);
			this.total = this.total.toFixed(1);

			this.$emit('production_temple', this.temple);
			this.$emit('production_main', this.main);
			this.$emit('production_total', this.total);
		},

		totalProduction() {
			this.temple = 0;
			this.main = 0;
			this.not_informed = 0;
			this.total = parseFloat(this.total).toFixed(1);

			this.$emit('production_temple', this.temple);
			this.$emit('production_main', this.main);
			this.$emit('production_total', this.total);
			this.$emit('production_not_informed', this.not_informed);
		},

		toggleProductionInputs() {
			this.temple = 0;
			this.main = 0;
			this.total = 0;
			this.not_informed = !this.not_informed;

			this.$emit('production_temple', this.temple);
			this.$emit('production_main', this.main);
			this.$emit('production_total', this.total);
			this.$emit('production_not_informed', this.not_informed);
		},
	},
};
</script>

<style lang="scss" scoped>
form {
	label {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 12px;
	}

	h2 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 30px;
	}

	h3 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 18px;
	}

	.actions {
		width: 100%;

		.actions-buttons {
			display: flex;
			justify-content: space-between;
		}
	}

	.button {
		width: 220px;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 14px;
	}

	.submit-button {
		background-color: #3d8160;
		color: #fff;
	}

	.submit-button:hover {
		background-color: #70a46b;
	}

	.cancel-button {
		color: #f00;
	}

	.cancel-button:hover {
		color: #fff;
	}
}
</style>
