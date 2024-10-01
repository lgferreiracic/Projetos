<template>
	<form @submit.prevent="nextStep()">
		<h3>Precipitação pluvial</h3>
		<div class="form-group mb-3">
			<label>Selecione os meses com chuva média acima de 60mm</label>
			<div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="january"
						value="1"
						v-model="january"
						ref="january"
						@change="$emit('january', january)"
					/>
					<label class="form-check-label" for="january"
						>Janeiro</label
					>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="february"
						v-model="february"
						ref="february"
						@change="$emit('february', february)"
					/>
					<label class="form-check-label" for="february"
						>Fevereiro</label
					>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="march"
						v-model="march"
						ref="march"
						@change="$emit('march', march)"
					/>
					<label class="form-check-label" for="march">Março</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="april"
						v-model="april"
						ref="april"
						@change="$emit('april', april)"
					/>
					<label class="form-check-label" for="april">Abril</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="may"
						v-model="may"
						ref="may"
						@change="$emit('may', may)"
					/>
					<label class="form-check-label" for="may">Maio</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="june"
						v-model="june"
						ref="june"
						@change="$emit('june', june)"
					/>
					<label class="form-check-label" for="june">Junho</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="july"
						v-model="july"
						ref="july"
						@change="$emit('july', july)"
					/>
					<label class="form-check-label" for="july">Julho</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="august"
						v-model="august"
						ref="august"
						@change="$emit('august', august)"
					/>
					<label class="form-check-label" for="august">Agosto</label>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="september"
						v-model="september"
						ref="september"
						@change="$emit('september', september)"
					/>
					<label class="form-check-label" for="september"
						>Setembro</label
					>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="october"
						v-model="october"
						ref="october"
						@change="$emit('october', october)"
					/>
					<label class="form-check-label" for="october"
						>Outubro</label
					>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="november"
						v-model="november"
						ref="november"
						@change="$emit('november', november)"
					/>
					<label class="form-check-label" for="november"
						>Novembro</label
					>
				</div>
				<div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="december"
						v-model="december"
						ref="december"
						@change="$emit('december', december)"
					/>
					<label class="form-check-label" for="december"
						>Dezembro</label
					>
				</div>
				<!-- <div class="form-check form-check-inline">
					<input
						class="form-check-input"
						type="checkbox"
						id="unknown"
						v-model="unknown"
						@click="toggleCheckboxesStatus()"
						@change="$emit('unknown', unknown)"
					/>
					<label class="form-check-label" for="unknown"
						>Não sei informar</label
					>
				</div> -->
			</div>
		</div>

		<h3>Uso do solo</h3>
		<div class="custom-control custom-radio">
			<input
				type="radio"
				class="custom-control-input"
				id="cocoa"
				name="ground-use"
				value="1"
				checked
				v-model="soilUseType"
				@change="disableConsortiumInput()"
			/>
			<label class="custom-control-label" for="cocoa"
				>Somente cacau</label
			>
		</div>
		<div class="custom-control custom-radio">
			<input
				type="radio"
				id="consortium"
				name="ground-use"
				class="custom-control-input"
				value="2"
				v-model="soilUseType"
				@change="enableConsortiumInput()"
			/>
			<label class="custom-control-label" for="consortium"
				>Consórcio? Especifique abaixo</label
			>
			<input
				v-if="isConsortium === false"
				class="form-control"
				type="text"
				readonly
			/>
			<multiselect
				v-else-if="isConsortium === true"
				v-model="soilUse"
				:options="options"
				:multiple="true"
				:taggable="true"
				:allow-empty="false"
				@tag="addTag"
				placeholder="Selecione algumas das opções acima ou clique aqui e digite um novo consórcio"
				tag-placeholder="Adicione esse item à lista apertando Enter"
				autocomplete="off"
				required
			></multiselect>
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
		previousStep: Function,
		nextStep: Function,
	},

	data() {
		return {
			january: false,
			february: false,
			march: false,
			april: false,
			may: false,
			june: false,
			july: false,
			august: false,
			september: false,
			october: false,
			november: false,
			december: false,
			unknown: false,
			soilUseType: 1,
			soilUse: null,
			isConsortium: false,
			disabled: false,
			options: ["Manga", "Acerola", "Côco", "Banana"],
		};
	},

	watch: {
		soilUse: function (val) {
			if (this.isConsortium && this.soilUse !== "") {
				this.$emit("soilUse", JSON.stringify(this.soilUse));
			}
		},
	},

	methods: {
		disableConsortiumInput() {
			if (this.isConsortium) {
				this.options = ["Cacau", "Manga", "Acerola"];
			}

			this.isConsortium = false;
			this.soilUse = "";
			this.$emit("soilUseType", this.soilUseType);
			this.$emit("soilUse", this.soilUse);
		},

		enableConsortiumInput() {
			this.soilUse = "";
			this.isConsortium = true;
			this.$emit("soilUseType", this.soilUseType);
			this.$emit("soilUse", JSON.stringify(["Cacau"]));
		},

		toggleCheckboxesStatus() {
			let self = this;
			if (!this.disabled) {
				this.disabled = true;
				this.$emit("january", false);
				this.$emit("february", false);
				this.$emit("march", false);
				this.$emit("april", false);
				this.$emit("may", false);
				this.$emit("june", false);
				this.$emit("july", false);
				this.$emit("august", false);
				this.$emit("september", false);
				this.$emit("october", false);
				this.$emit("november", false);
				this.$emit("december", false);
			} else {
				this.disabled = false;
			}

			this.january = false;
			this.$refs.january.disabled = this.disabled;
			this.february = false;
			this.$refs.february.disabled = this.disabled;
			this.march = false;
			this.$refs.march.disabled = this.disabled;
			this.april = false;
			this.$refs.april.disabled = this.disabled;
			this.may = false;
			this.$refs.may.disabled = this.disabled;
			this.june = false;
			this.$refs.june.disabled = this.disabled;
			this.july = false;
			this.$refs.july.disabled = this.disabled;
			this.august = false;
			this.$refs.august.disabled = this.disabled;
			this.september = false;
			this.$refs.september.disabled = this.disabled;
			this.october = false;
			this.$refs.october.disabled = this.disabled;
			this.november = false;
			this.$refs.november.disabled = this.disabled;
			this.december = false;
			this.$refs.december.disabled = this.disabled;
		},

		addTag(newTag) {
			let arr = [...this.soilUse, newTag];
			this.soilUse = arr;
			this.options.push(newTag);
		},
	},
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

	.custom-consortium {
		display: flex;
		gap: 10px;

		.btn-consortium {
			height: 37px;
		}
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
