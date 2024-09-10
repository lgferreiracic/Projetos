<template>
	<form @submit.prevent="nextStep()">
		<h3>Manejo por época de produção</h3>

		<h4>Temporã (outubro-abril)</h4>
		<div class="custom-control custom-radio">
			<input
				type="radio"
				class="custom-control-input"
				id="temple-traditional"
				name="temple"
				value="1"
				v-model="temple"
				@change="$emit('temple', temple)"
			/>
			<label class="custom-control-label" for="temple-traditional"
				>Tradicional</label
			>
		</div>
		<div class="custom-control custom-radio mb-3">
			<input
				type="radio"
				id="temple-tecnified"
				name="temple"
				class="custom-control-input"
				value="2"
				v-model="temple"
				@change="$emit('temple', temple)"
			/>
			<label class="custom-control-label" for="temple-tecnified"
				>Tecnificado</label
			>
		</div>

		<h4>Principal (maio-setembro)</h4>
		<div class="custom-control custom-radio">
			<input
				type="radio"
				class="custom-control-input"
				id="main-traditional"
				name="main"
				value="1"
				v-model="main"
				@change="$emit('main', main)"
			/>
			<label class="custom-control-label" for="main-traditional"
				>Tradicional</label
			>
		</div>
		<div class="custom-control custom-radio">
			<input
				type="radio"
				class="custom-control-input"
				id="main-tecnified"
				name="main"
				value="2"
				v-model="main"
				@change="$emit('main', main)"
			/>
			<label class="custom-control-label" for="main-tecnified"
				>Tecnificado</label
			>
		</div>

		<div class="mt-4 mb-4 actions">
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
	},

	data() {
		return {
			temple: null,
			main: null,
		};
	},

	mounted() {},

	created() {
		this.temple = this.block.handling.temple;
		this.main = this.block.handling.main;
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

	h4 {
		color: #1e1e1e;

		font-family: "Lexend", sans-serif;
		font-size: 16px;
	}

	label {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 12px;
	}

	.custom-control-input:checked ~ .custom-control-label::before {
		color: #fff;
		border-color: #3d8160;
		background-color: #3d8160;
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
