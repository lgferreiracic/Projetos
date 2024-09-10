<template>
	<form @submit.prevent="nextStep()">
		<h3>Altitude (%)</h3>
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="altitude"
				id="low"
				value="1"
				v-model="altitude"
				@change="$emit('altitude', altitude)"
			/>
			<label class="form-check-label" for="low"> Baixa (até 200m) </label>
		</div>
		<div class="form-check mb-3">
			<input
				class="form-check-input"
				type="radio"
				name="altitude"
				id="high"
				value="2"
				v-model="altitude"
				@change="$emit('altitude', altitude)"
			/>
			<label class="form-check-label" for="high">
				Alta (acima de 200m)
			</label>
		</div>

		<h3>Relevo (%)</h3>
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="relief"
				id="plain"
				value="1"
				v-model="relief"
				@change="$emit('relief', relief)"
			/>
			<label class="form-check-label" for="plain"> Plano </label>
		</div>
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="relief"
				id="gently-wavy"
				value="2"
				v-model="relief"
				@change="$emit('relief', relief)"
			/>
			<label class="form-check-label" for="gently-wavy">
				Suavemente ondulado
			</label>
		</div>
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="relief"
				id="wavy"
				value="3"
				v-model="relief"
				@change="$emit('relief', relief)"
			/>
			<label class="form-check-label" for="wavy"> Ondulado </label>
		</div>
		<div class="form-check">
			<input
				class="form-check-input"
				type="radio"
				name="relief"
				id="steep"
				value="4"
				v-model="relief"
				@change="$emit('relief', relief)"
			/>
			<label class="form-check-label" for="steep"> Escarpado </label>
		</div>
		<div class="mt-2 mb-4 actions">
			<div class="actions-buttons">
				<button
					type="button"
					class="btn btn-outline-danger button cancel-button"
					@click.prevent="previousStep()"
				>
					Voltar
				</button>
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
		previousStep: Function,
		nextStep: Function,
		blockAltitude: Number,
		blockRelief: Number,
	},

	data() {
		return {
			altitude: null,
			relief: null,
		};
	},

	mounted() {},

	created() {
		this.altitude = this.block.altitude;
		this.relief = this.block.relief;
	},

	methods: {},
};
</script>

<style lang="scss" scoped>
form {
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
