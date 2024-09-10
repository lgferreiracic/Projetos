<template>
	<form @submit.prevent="checkForm()">
		<h3>Classe de Solo (forneça o valor em %)</h3>

		<div class="ground-classes">
			<div class="table-responsive">
				<table class="table table-borderless table-hover">
					<caption
						style="font-size: 14px; color: red"
						v-show="formErrors.total"
					>
						{{
							formErrors.total
						}}
					</caption>
					<thead class="thead-dark">
						<tr>
							<th scope="col">Topografia</th>
							<th scope="col">Argissolo</th>
							<th scope="col">Latossolo</th>
							<th scope="col">Cambissolo</th>
							<th scope="col">Gleissolo/Hidromórfico</th>
							<th scope="col">Outros solos</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
						<!-- Baixada -->
						<tr>
							<th scope="row">Baixada</th>
							<td>
								<input
									type="number"
									class="form-control"
									id="lowland-argisol"
									min="0"
									max="100"
									v-model="lowland.argisol"
									@change="
										$emit(
											'soilClassLowlandArgisol',
											lowland.argisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lowland-latosol"
									min="0"
									max="100"
									v-model="lowland.latosol"
									@change="
										$emit(
											'soilClassLowlandLatosol',
											lowland.latosol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lowland-cambisol"
									min="0"
									max="100"
									v-model="lowland.cambisol"
									@change="
										$emit(
											'soilClassLowlandCambisol',
											lowland.cambisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lowland-gleisol"
									min="0"
									max="100"
									v-model="lowland.gleisol"
									@change="
										$emit(
											'soilClassLowlandGleisol',
											lowland.gleisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lowland-other"
									min="0"
									max="100"
									v-model="lowland.other"
									@change="
										$emit(
											'soilClassLowlandOther',
											lowland.other
										)
									"
									required
								/>
							</td>
						</tr>
						<!-- Terço inferior -->
						<tr>
							<th scope="row">Terço inferior</th>
							<td>
								<input
									type="number"
									class="form-control"
									id="lower-third-argisol"
									value="0"
									min="0"
									max="100"
									v-model="lowerThird.argisol"
									@change="
										$emit(
											'soilClassLowerThirdArgisol',
											lowerThird.argisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lower-third-latosol"
									value="0"
									min="0"
									max="100"
									v-model="lowerThird.latosol"
									@change="
										$emit(
											'soilClassLowerThirdLatosol',
											lowerThird.latosol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lower-third-cambisol"
									min="0"
									max="100"
									v-model="lowerThird.cambisol"
									@change="
										$emit(
											'soilClassLowerThirdCambisol',
											lowerThird.cambisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lower-third-gleisol"
									min="0"
									max="100"
									v-model="lowerThird.gleisol"
									@change="
										$emit(
											'soilClassLowerThirdGleisol',
											lowerThird.gleisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="lower-third-other"
									min="0"
									max="100"
									v-model="lowerThird.other"
									@change="
										$emit(
											'soilClassLowerThirdOther',
											lowerThird.other
										)
									"
									required
								/>
							</td>
						</tr>
						<!-- Terço médio -->
						<tr>
							<th scope="row">Terço médio</th>
							<td>
								<input
									type="number"
									class="form-control"
									id="middle-third-argisol"
									min="0"
									max="100"
									v-model="middleThird.argisol"
									@change="
										$emit(
											'soilClassMiddleThirdArgisol',
											middleThird.argisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="middle-third-latosol"
									min="0"
									max="100"
									v-model="middleThird.latosol"
									@change="
										$emit(
											'soilClassMiddleThirdLatosol',
											middleThird.latosol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="middle-third-cambisol"
									min="0"
									max="100"
									v-model="middleThird.cambisol"
									@change="
										$emit(
											'soilClassMiddleThirdCambisol',
											middleThird.cambisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="middle-third-gleisol"
									min="0"
									max="100"
									v-model="middleThird.gleisol"
									@change="
										$emit(
											'soilClassMiddleThirdGleisol',
											middleThird.gleisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="middle-third-other"
									min="0"
									max="100"
									v-model="middleThird.other"
									@change="
										$emit(
											'soilClassMiddleThirdOther',
											middleThird.other
										)
									"
									required
								/>
							</td>
						</tr>
						<!-- Terço superior -->
						<tr>
							<th scope="row">Terço superior</th>
							<td>
								<input
									type="number"
									class="form-control"
									id="upper-third-argisol"
									v-model="upperThird.argisol"
									@change="
										$emit(
											'soilClassUpperThirdArgisol',
											upperThird.argisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="upper-third-latosol"
									v-model="upperThird.latosol"
									@change="
										$emit(
											'soilClassUpperThirdLatosol',
											upperThird.latosol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="upper-third-cambisol"
									v-model="upperThird.cambisol"
									@change="
										$emit(
											'soilClassUpperThirdCambisol',
											upperThird.cambisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="upper-third-gleisol"
									v-model="upperThird.gleisol"
									@change="
										$emit(
											'soilClassUpperThirdGleisol',
											upperThird.gleisol
										)
									"
									required
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									id="upper-third-other"
									v-model="upperThird.other"
									@change="
										$emit(
											'soilClassUpperThirdOther',
											upperThird.other
										)
									"
									required
								/>
							</td>
						</tr>
						<!-- Total -->
						<tr>
							<th scope="row"></th>
							<td class="w-100 d-flex align-items-center">
								<input
									type="number"
									class="form-control"
									:value="computedArgisol"
									disabled
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									:value="computedLatosol"
									disabled
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									:value="computedCambisol"
									disabled
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									:value="computedGleisol"
									disabled
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									:value="computedOther"
									disabled
								/>
							</td>
							<td>
								<input
									type="number"
									class="form-control"
									:value="computedTotal"
									:class="{
										'is-invalid': formErrors.total,
									}"
									disabled
								/>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
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
	},

	data() {
		return {
			formErrors: {
				lowland: null,
				lowerThird: null,
				middleThird: null,
				upperThird: null,
				total: null,
			},
			lowland: {
				argisol: null,
				latosol: null,
				cambisol: null,
				gleisol: null,
				other: null,
			},
			lowerThird: {
				argisol: 0,
				latosol: 0,
				cambisol: 0,
				gleisol: 0,
				other: 0,
			},
			middleThird: {
				argisol: 0,
				latosol: 0,
				cambisol: 0,
				gleisol: 0,
				other: 0,
			},
			upperThird: {
				argisol: 0,
				latosol: 0,
				cambisol: 0,
				gleisol: 0,
				other: 0,
			},
		};
	},

	computed: {
		computedArgisol: function () {
			return (
				Number(this.lowland.argisol) +
				Number(this.lowerThird.argisol) +
				Number(this.middleThird.argisol) +
				Number(this.upperThird.argisol)
			);
		},
		computedLatosol: function () {
			return (
				Number(this.lowland.latosol) +
				Number(this.lowerThird.latosol) +
				Number(this.middleThird.latosol) +
				Number(this.upperThird.latosol)
			);
		},
		computedCambisol: function () {
			return (
				Number(this.lowland.cambisol) +
				Number(this.lowerThird.cambisol) +
				Number(this.middleThird.cambisol) +
				Number(this.upperThird.cambisol)
			);
		},
		computedGleisol: function () {
			return (
				Number(this.lowland.gleisol) +
				Number(this.lowerThird.gleisol) +
				Number(this.middleThird.gleisol) +
				Number(this.upperThird.gleisol)
			);
		},
		computedOther: function () {
			return (
				Number(this.lowland.other) +
				Number(this.lowerThird.other) +
				Number(this.middleThird.other) +
				Number(this.upperThird.other)
			);
		},
		computedTotal: function () {
			return (
				this.computedArgisol +
				this.computedLatosol +
				this.computedCambisol +
				this.computedGleisol +
				this.computedOther
			);
		},
	},

	created() {
		this.lowland.argisol = this.block.soilClass.lowland.argisol;
		this.lowland.latosol = this.block.soilClass.lowland.latosol;
		this.lowland.cambisol = this.block.soilClass.lowland.cambisol;
		this.lowland.gleisol = this.block.soilClass.lowland.gleisol;
		this.lowland.other = this.block.soilClass.lowland.other;

		this.lowerThird.argisol = this.block.soilClass.lowerThird.argisol;
		this.lowerThird.latosol = this.block.soilClass.lowerThird.latosol;
		this.lowerThird.cambisol = this.block.soilClass.lowerThird.cambisol;
		this.lowerThird.gleisol = this.block.soilClass.lowerThird.gleisol;
		this.lowerThird.other = this.block.soilClass.lowerThird.other;

		this.middleThird.argisol = this.block.soilClass.middleThird.argisol;
		this.middleThird.latosol = this.block.soilClass.middleThird.latosol;
		this.middleThird.cambisol = this.block.soilClass.middleThird.cambisol;
		this.middleThird.gleisol = this.block.soilClass.middleThird.gleisol;
		this.middleThird.other = this.block.soilClass.middleThird.other;

		this.upperThird.argisol = this.block.soilClass.upperThird.argisol;
		this.upperThird.latosol = this.block.soilClass.upperThird.latosol;
		this.upperThird.cambisol = this.block.soilClass.upperThird.cambisol;
		this.upperThird.gleisol = this.block.soilClass.upperThird.gleisol;
		this.upperThird.other = this.block.soilClass.upperThird.other;
	},

	methods: {
		checkForm() {
			this.formErrors = {
				lowland: null,
				lowerThird: null,
				middleThird: null,
				upperThird: null,
				total: null,
			};
			let hasErrors = false;

			let totalLowland =
				Number(this.lowland.argisol) +
				Number(this.lowland.latosol) +
				Number(this.lowland.cambisol) +
				Number(this.lowland.gleisol) +
				Number(this.lowland.other);
			let totalLowerThird =
				Number(this.lowerThird.argisol) +
				Number(this.lowerThird.latosol) +
				Number(this.lowerThird.cambisol) +
				Number(this.lowerThird.gleisol) +
				Number(this.lowerThird.other);
			let totalMiddleThird =
				Number(this.middleThird.argisol) +
				Number(this.middleThird.latosol) +
				Number(this.middleThird.cambisol) +
				Number(this.middleThird.gleisol) +
				Number(this.middleThird.other);
			let totalUpperThird =
				Number(this.upperThird.argisol) +
				Number(this.upperThird.latosol) +
				Number(this.upperThird.cambisol) +
				Number(this.upperThird.gleisol) +
				Number(this.upperThird.other);

			if (
				!(
					totalLowland +
						totalLowerThird +
						totalMiddleThird +
						totalUpperThird ===
					100
				)
			) {
				hasErrors = true;
				this.formErrors.total =
					"Revise os números passados. O total deve totalizar 100%!";
			}

			if (!hasErrors) {
				this.nextStep();
			}
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

	.invalid {
		color: #f00;
		font-family: "Lexend", sans-serif;
		font-size: 0.875em;
	}

	.invalid-box {
		border-left: 1px solid #f00;
	}

	.ground-classes {
		margin-top: 12px;

		.ground-class {
			margin-bottom: 12px;

			p {
				font-family: "Lexend", sans-serif;
				font-size: 14px;
				margin: 0;
			}

			.inputs-box {
				background-color: #f5f8fd;
				border-radius: 10px;

				padding: 14px;
			}
		}
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
