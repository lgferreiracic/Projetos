<template>
	<div class="container form-add-unit mt-5 mb-5">
		<div class="row">
			<div class="col-12 col-md-12 col-lg-12">
				<h1>PlataformaCacau</h1>

				<div class="row steps">
					<div
						class="steps-box step1"
						:class="{
							'completed-step':
								actualStep === 1
									? false
									: completedSteps.includes(1),
							actualStep: actualStep === 1,
						}"
					>
						1
					</div>
					<div
						class="steps-box step2"
						:class="{
							'completed-step': completedSteps.includes(2),
							actualStep: actualStep === 2,
						}"
					>
						2
					</div>
					<div
						class="steps-box step3"
						:class="{
							'completed-step': completedSteps.includes(3),
							actualStep: actualStep === 3,
						}"
					>
						3
					</div>
					<div
						class="steps-box step4"
						:class="{
							'completed-step': completedSteps.includes(4),
							actualStep: actualStep === 4,
						}"
					>
						4
					</div>
					<div
						class="steps-box step5"
						:class="{
							'completed-step': completedSteps.includes(5),
							actualStep: actualStep === 5,
						}"
					>
						5
					</div>
					<div
						class="steps-box step6"
						:class="{
							'completed-step': completedSteps.includes(6),
							actualStep: actualStep === 6,
						}"
					>
						6
					</div>
				</div>

				<hr />

				<div class="reminder" v-if="actualStep !== 1">
					<i class="fas fa-info-circle"></i>
					<p>
						Você está editando a
						{{ block.property.area_name?.toLowerCase() }}
						{{ block.id }} da propriedade
						<strong>{{ block.property.name }}</strong>
					</p>
				</div>

				<div class="col-12 info-area mb-2">
					<!-- <div v-show="actualStep === 1" class="card-info">
						<i class="fas fa-exclamation"></i>
						<div class="card-info_message">
							<p>Qual a finalidade desse formulário?</p>
							<p>
								Para cada
								<span>{{
									block.property.area_name || "Área"
								}}</span>
								da sua propriedade, é necessário cadastrar suas
								características para análise pela
								PlataformaCacau.
							</p>
						</div>
					</div> -->

					<div v-show="actualStep === 1" class="step-5">
						<div class="card-info">
							<i class="fas fa-exclamation"></i>
							<div class="card-info_message">
								<p>Qual a finalidade desse formulário?</p>
								<p>
									Para cada
									<span>{{
										block.property.area_name || "Área"
									}}</span>
									da sua propriedade, é necessário cadastrar suas
									características para análise pela
									PlataformaCacau.
								</p>
							</div>
						</div>
						<div class="card-info">
							<i class="far fa-lightbulb"></i>
							<div class="card-info_message">
								<p>Tipos de manejo</p>
								<ol>
									<li>
										<strong>Tradicional</strong> - roçagem,
										poda e limpeza sem uso de insumo;
									</li>
									<li>
										<strong>Tecnificado</strong> - uso de
										herbicida, tratos culturais, retirada de
										vassouras, desbrota, poda, adubação.
									</li>
								</ol>
							</div>
						</div>
					</div>

					<div v-show="actualStep === 3" class="card-info">
						<i class="far fa-lightbulb"></i>
						<div class="card-info_message">
							<p>Especificações de cada solo</p>
							<ol>
								<li>
									<strong>Argissolo</strong> - Solo com
									superfície arenosa e camada de argila logo
									abaixo (horizonte B);
								</li>
								<li>
									<strong>Latossolo</strong> - Solos
									profundos, coloração uniforme e sem forte
									distinção entre os horizontes A e B;
								</li>
								<li>
									<strong>Cambissolo</strong> - Solos jovens,
									em geral mais rasos e com muito material em
									decomposição no horizonte B;
								</li>
								<li>
									<strong>Gleissolo/Hidromórfico</strong> -
									Solos de baixada, muito argilosos, cor
									cinzenta, com pontuações amarelas e
									vermelhas e conhecidos como barro de telha;
								</li>
								<li>
									<strong>Outros solos</strong> - Marcar essa
									opção quando não houver condição de
									identificar a classe.
								</li>
							</ol>
						</div>
					</div>

					<div v-show="actualStep === 4" class="card-info">
						<i class="fas fa-exclamation"></i>
						<div class="card-info_message">
							<p>Precipitação pluvial</p>
							<p>
								Marque os meses com chuva média acima de 60mm.
								Se não houver meses com chuva acima de 60mm,
								deixe as caixas desmarcadas. Caso não saiba
								informar, consulte
								<a
									style="text-decoration: underline;"
									title="Sistema INMET"
									href="https://clima.inmet.gov.br"
									target="_blank"
									>clicando aqui</a
								>.
							</p>
						</div>
					</div>

					<div v-show="actualStep === 5" class="step-5">
						<div class="card-info">
							<i class="fas fa-exclamation"></i>
							<div class="card-info_message">
								<p>Manejo por época de maior produção</p>
								<p>
									Marque a caixa que representa o manejo
									predominante em cada época de produção.
								</p>
							</div>
						</div>
						<div class="card-info">
							<i class="far fa-lightbulb"></i>
							<div class="card-info_message">
								<p>Tipos de manejo</p>
								<ol>
									<li>
										<strong>Tradicional</strong> - roçagem,
										poda e limpeza sem uso de insumo;
									</li>
									<li>
										<strong>Tecnificado</strong> - uso de
										herbicida, tratos culturais, retirada de
										vassouras, desbrota, poda, adubação.
									</li>
								</ol>
							</div>
						</div>
					</div>
					
					<div v-show="actualStep === 6" class="card-info">
						<i class="far fa-lightbulb"></i>
						<div class="card-info_message">
							<p>Sobre os campos solicitados</p>
							<ol>
								<li>
									<strong>Participação</strong> - informe a
									participação na área total (em %) do dado
									genótipo.
								</li>
								<li>
									<strong>Tipo</strong> - informe qual o tipo
									do genótipo (se aplicável).
								</li>
								<li>
									<strong>Idade</strong> - informe a idade
									aproximada em anos.
								</li>
								<li>
									<strong>Densidade</strong> - informe quantas
									plantas por hectare da área possuem o dado
									genótipo.
								</li>
								<li>
									<strong>Temporã</strong> - informe a
									participação do dado genótipo no ciclo de
									colheita temporã (em %).
								</li>
								<li>
									<strong>Principal</strong> - informe a
									participação do dado genótipo no ciclo de
									colheita principal (em %).
								</li>
								<li>
									<strong>Total</strong> - soma entre Temporã
									e Principal (cálculo automático). Essa soma
									deve totalizar 100%!
								</li>
							</ol>
						</div>
					</div>
				</div>

				<div class="form-steps">
					<edit-operational-unit-step-1
						v-if="actualStep === 1 && block.id !== null"
						v-on:area="block.area = Number($event)"
						v-on:production_temple="block.production.temple = parseFloat($event)"
						v-on:production_main="block.production.main = parseFloat($event)"
						v-on:production_total="block.production.total = parseFloat($event)"
						v-on:production_not_informed="block.production.not_informed = Number($event)"
						v-on:latitude="
							block.geolocation.latitude = parseFloat($event)
						"
						v-on:longitude="
							block.geolocation.longitude = parseFloat($event)
						"
						:block="block"
						:nextStep="nextStep"
					/>
					<edit-operational-unit-step-2
						v-if="actualStep === 2 && block.relief !== null"
						v-on:relief="block.relief = Number($event)"
						v-on:altitude="block.altitude = Number($event)"
						:block="block"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<edit-operational-unit-step-3
						v-if="
							actualStep === 3 &&
							block.soilClass.lowland.argisol !== null
						"
						v-on:soilClassLowlandArgisol="
							block.soilClass.lowland.argisol = Number($event)
						"
						v-on:soilClassLowlandLatosol="
							block.soilClass.lowland.latosol = Number($event)
						"
						v-on:soilClassLowlandCambisol="
							block.soilClass.lowland.cambisol = Number($event)
						"
						v-on:soilClassLowlandGleisol="
							block.soilClass.lowland.gleisol = Number($event)
						"
						v-on:soilClassLowlandOther="
							block.soilClass.lowland.other = Number($event)
						"
						v-on:soilClassLowerThirdArgisol="
							block.soilClass.lowerThird.argisol = Number($event)
						"
						v-on:soilClassLowerThirdLatosol="
							block.soilClass.lowerThird.latosol = Number($event)
						"
						v-on:soilClassLowerThirdCambisol="
							block.soilClass.lowerThird.cambisol = Number($event)
						"
						v-on:soilClassLowerThirdGleisol="
							block.soilClass.lowerThird.gleisol = Number($event)
						"
						v-on:soilClassLowerThirdOther="
							block.soilClass.lowerThird.other = Number($event)
						"
						v-on:soilClassMiddleThirdArgisol="
							block.soilClass.middleThird.argisol = Number($event)
						"
						v-on:soilClassMiddleThirdLatosol="
							block.soilClass.middleThird.latosol = Number($event)
						"
						v-on:soilClassMiddleThirdCambisol="
							block.soilClass.middleThird.cambisol =
								Number($event)
						"
						v-on:soilClassMiddleThirdGleisol="
							block.soilClass.middleThird.gleisol = Number($event)
						"
						v-on:soilClassMiddleThirdOther="
							block.soilClass.middleThird.other = Number($event)
						"
						v-on:soilClassUpperThirdArgisol="
							block.soilClass.upperThird.argisol = Number($event)
						"
						v-on:soilClassUpperThirdLatosol="
							block.soilClass.upperThird.latosol = Number($event)
						"
						v-on:soilClassUpperThirdCambisol="
							block.soilClass.upperThird.cambisol = Number($event)
						"
						v-on:soilClassUpperThirdGleisol="
							block.soilClass.upperThird.gleisol = Number($event)
						"
						v-on:soilClassUpperThirdOther="
							block.soilClass.upperThird.other = Number($event)
						"
						:block="block"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<edit-operational-unit-step-4
						v-if="
							actualStep === 4 && block.rainfall.january !== null
						"
						v-on:january="block.rainfall.january = $event ? 1 : 0"
						v-on:february="block.rainfall.february = $event ? 1 : 0"
						v-on:march="block.rainfall.march = $event ? 1 : 0"
						v-on:april="block.rainfall.april = $event ? 1 : 0"
						v-on:may="block.rainfall.may = $event ? 1 : 0"
						v-on:june="block.rainfall.june = $event ? 1 : 0"
						v-on:july="block.rainfall.july = $event ? 1 : 0"
						v-on:august="block.rainfall.august = $event ? 1 : 0"
						v-on:september="
							block.rainfall.september = $event ? 1 : 0
						"
						v-on:october="block.rainfall.october = $event ? 1 : 0"
						v-on:november="block.rainfall.november = $event ? 1 : 0"
						v-on:december="block.rainfall.december = $event ? 1 : 0"
						v-on:unknown="block.rainfall.unknown = $event ? 1 : 0"
						v-on:soilUseType="block.soilUse.type = Number($event)"
						v-on:soilUse="block.soilUse.description = $event"
						:block="block"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<edit-operational-unit-step-5
						v-if="actualStep === 5 && block.handling.main !== null"
						v-on:main="block.handling.main = Number($event)"
						v-on:temple="block.handling.temple = Number($event)"
						:block="block"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<edit-operational-unit-step-6
						v-if="actualStep === 6 && block.id !== null"
						v-on:commonType="
							block.genotype.common.type =
								$event !== null ? Number($event) : null
						"
						v-on:commonTotalArea="
							block.genotype.common.total_area_participation =
								Number($event)
						"
						v-on:commonAge="
							block.genotype.common.age =
								$event !== null ? Number($event) : null
						"
						v-on:commonDensity="
							block.genotype.common.density =
								$event !== null ? Number($event) : null
						"
						v-on:commonTemple="
							block.genotype.common.temple =
								$event !== null ? Number($event) : null
						"
						v-on:commonMain="
							block.genotype.common.main =
								$event !== null ? Number($event) : null
						"
						v-on:commonGlobal="
							block.genotype.common.global =
								$event !== null ? Number($event) : null
						"
						v-on:hybridTotalArea="
							block.genotype.hybrid.total_area_participation =
								Number($event)
						"
						v-on:hybridAge="
							block.genotype.hybrid.age =
								$event !== null ? Number($event) : null
						"
						v-on:hybridDensity="
							block.genotype.hybrid.density =
								$event !== null ? Number($event) : null
						"
						v-on:hybridTemple="
							block.genotype.hybrid.temple =
								$event !== null ? Number($event) : null
						"
						v-on:hybridMain="
							block.genotype.hybrid.main =
								$event !== null ? Number($event) : null
						"
						v-on:hybridGlobal="
							block.genotype.hybrid.global =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTotalArea="
							block.genotype.cloned.total_area_participation =
								Number($event)
						"
						v-on:clonedAge="
							block.genotype.cloned.age =
								$event !== null ? Number($event) : null
						"
						v-on:clonedDensity="
							block.genotype.cloned.density =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTemple="
							block.genotype.cloned.temple =
								$event !== null ? Number($event) : null
						"
						v-on:clonedMain="
							block.genotype.cloned.main =
								$event !== null ? Number($event) : null
						"
						v-on:clonedGlobal="
							block.genotype.cloned.global =
								$event !== null ? Number($event) : null
						"
						v-on:clonedType="
							block.genotype.cloned.type =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTypeDescription="
							block.genotype.cloned.type_description =
								$event !== null ? $event : null
						"
						:block="block"
						:update="update"
						:previousStep="previousStep"
					/>
				</div>

				<hr />
			</div>
			<!-- <div class="col-md-5 col-lg-5 d-none d-md-block info-area">
				<div v-show="actualStep === 1" class="card-info">
					<i class="fas fa-exclamation"></i>
					<div class="card-info_message">
						<p>Qual a finalidade desse formulário?</p>
						<p>
							Para cada
							<span>{{
								block.property.area_name || "Área"
							}}</span>
							da sua propriedade, é necessário cadastrar suas
							características para análise pela PlataformaCacau.
						</p>
					</div>
				</div>

				<div v-show="actualStep === 3" class="card-info">
					<i class="far fa-lightbulb"></i>
					<div class="card-info_message">
						<p>Especificações de cada solo</p>
						<ol>
							<li>
								<strong>Argissolo</strong> - Solo com superfície
								arenosa e camada de argila logo abaixo
								(horizonte B);
							</li>
							<li>
								<strong>Latossolo</strong> - Solos profundos,
								coloração uniforme e sem forte distinção entre
								os horizontes A e B;
							</li>
							<li>
								<strong>Cambissolo</strong> - Solos jovens, em
								geral mais rasos e com muito material em
								decomposição no horizonte B;
							</li>
							<li>
								<strong>Gleissolo/Hidromórfico</strong> - Solos
								de baixada, muito argilosos, cor cinzenta, com
								pontuações amarelas e vermelhas e conhecidos
								como barro de telha;
							</li>
							<li>
								<strong>Outros solos</strong> - Marcar essa
								opção quando não houver condição de identificar
								a classe.
							</li>
						</ol>
					</div>
				</div>

				<div v-show="actualStep === 4" class="card-info">
					<i class="fas fa-exclamation"></i>
					<div class="card-info_message">
						<p>Precipitação pluvial</p>
						<p>
							Marque os meses com chuva média acima de 60mm. Se
							não houver meses com chuva acima de 60mm, deixe as
							caixas desmarcadas. Caso não saiba informar, marque
							a opção
							<strong>Não sei informar</strong>
						</p>
					</div>
				</div>

				<div v-show="actualStep === 5" class="step-5">
					<div class="card-info">
						<i class="fas fa-exclamation"></i>
						<div class="card-info_message">
							<p>Manejo por época de maior produção</p>
							<p>
								Marque a caixa que representa o manejo
								predominante em cada época de produção.
							</p>
						</div>
					</div>
					<div class="card-info">
						<i class="far fa-lightbulb"></i>
						<div class="card-info_message">
							<p>Tipos de manejo</p>
							<ol>
								<li>
									<strong>Tradicional</strong> - roçagem, poda
									e limpeza sem uso de insumo;
								</li>
								<li>
									<strong>Tecnificado</strong> - uso de
									herbicida, tratos culturais, retirada de
									vassouras, desbrota, poda, adubação.
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div> -->
		</div>
		<!-- Modal -->
		<div
			class="modal fade"
			id="modalConfirmation"
			data-backdrop="static"
			data-keyboard="false"
			tabindex="-1"
			aria-labelledby="modalConfirmationLabel"
			aria-hidden="true"
		>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<img
							class="img-fluid"
							:src="'/img/BookmarkSimple.svg'"
						/>
						<h5 class="modal-title" id="modalConfirmationLabel">
							✅ Unidade operacional editada
						</h5>
					</div>
					<div class="modal-body">
						<p>
							Os dados da sua Unidade Operacional foram editados e
							salvos no nosso servidor.
						</p>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-primary btn-continue"
							@click="finishEditing()"
						>
							Entendi
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data() {
		return {
			block: {
				id: null,
				label: "",
				area: null,
				relief: null,
				altitude: null,
				production: {
					id: null,
					temple: null,
					main: null,
					total: null,
					not_informed: null,
				},
				property: {
					id: null,
					name: "",
					area_name: "",
				},
				rainfall: {
					january: null,
					february: null,
					march: null,
					april: null,
					may: null,
					june: null,
					july: null,
					august: null,
					september: null,
					october: null,
					november: null,
					december: null,
					unknown: null,
				},
				soilUse: {
					type: null,
					description: "",
				},
				handling: {
					temple: null,
					main: null,
				},
				genotype: {
					common: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
						type: null,
					},
					hybrid: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
					},
					cloned: {
						main: null,
						temple: null,
						global: null,
						age: null,
						density: null,
						total_area_participation: null,
						type: null,
						type_description: "",
					},
				},
				soilClass: {
					lowland: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					lowerThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					middleThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
					upperThird: {
						argisol: null,
						latosol: null,
						cambisol: null,
						gleisol: null,
						other: null,
					},
				},
				geolocation: {
					latitude: null,
					longitude: null,
					ratio: 2.0,
				},
			},
			authToken: null,
			blockId: null,
			actualStep: 1,
			completedSteps: [],
			formErrors: {},
		};
	},

	async created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.blockId = Number(urlParams.get("block"));
		this.authToken = window.token;
	},

	async mounted() {
		await this.index();
	},

	methods: {
		nextStep() {
			this.completedSteps.push(this.actualStep);
			this.actualStep += 1;
		},

		previousStep() {
			this.completedSteps.pop();
			this.actualStep -= 1;
		},

		async index() {
			await axios
				.get(`/api/v1/blocks/${this.blockId}`, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200 && response.data.success) {
						this.block = response.data.data;
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		update() {
			axios
				.put(`/api/v1/blocks/${this.blockId}`, this.block, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.data.success) {
						this.confirmationModal();
					} else {
						console.error(response.data);
					}
				})
				.catch((err) => {
					Swal.fire({
						icon: "error",
						title: `Erro na atualização da ${this.block.property.area_name}`,
						text: `${err.response.data.message}`,
						confirmButtonText: "Entendi",
					});
				});
		},

		confirmationModal() {
			$("#modalConfirmation").modal("show");
		},

		finishEditing() {
			let _this = this;
			let propid = _this.block.property.id;
			window.location.href = `/panel/blocks?propid=${propid}`;
		},
	},
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
.form-add-unit {
	background-color: #fff;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 26px;

		padding: 24px 0 31px 48px;
	}

	h2 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 22px;

		padding: 0 0 10px 48px;
	}

	.steps {
		display: flex;
		justify-content: center;

		width: 100%;

		.steps-box {
			display: flex;
			justify-content: center;
			align-items: center;

			background-color: #333333;
			border-radius: 4px;
			color: #fff;

			height: 40px;
			width: 40px;

			margin: 0 10px;
		}

		.completed-step {
			background-color: #3d8160;
		}

		.actualStep {
			color: #333333;
			background-color: #eee683;
		}
	}

	hr {
		margin: 16px 60px 16px 48px;
	}

	.reminder {
		display: flex;
		gap: 16px;

		background-color: #f5f8fd;

		border-left: 2px solid #3d8160;
		border-radius: 4px;

		padding: 8px 16px;
		margin: 0 60px 16px 48px;

		font-family: "Lexend", sans-serif;
		font-size: 16px;
		color: #333;

		p {
			margin-bottom: 0;
		}

		i {
			color: #3d8160;
			font-size: 18px;
			margin-top: 5px;
		}
	}

	.form-steps {
		margin: 0 60px 24px 48px;
	}

	.actions {
		margin: 0 48px;

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

	.form-image {
		background: url("/img/leaves.png") no-repeat;
		background-size: cover;
		border-radius: 0 20px 20px 0;
		overflow: clip;
	}

	.card-info {
		display: flex;
		gap: 20px;
		width: 93%;

		background-color: #f5f8fd;

		border-left: 2px solid #3d8160;
		border-radius: 4px;

		padding: 16px 24px;
		margin: 0 60px 0px 33px;

		i {
			color: #3d8160;
			font-size: 18px;
			margin-top: 3px;
		}

		.card-info_message {
			display: flex;
			flex-direction: column;
			align-items: flex-start;

			p:first-of-type {
				color: #333;
				font-family: "Lexend";
				font-weight: bold;
				font-size: 16px;
			}

			p {
				font-family: "Lexend";
				margin-bottom: 8px;
				line-height: 20px;

				span {
					color: #3d8160;
					font-weight: bold;
					text-decoration: underline;
				}
			}

			ol {
				color: #333;
				font-family: "Lexend";
				font-size: 16px;
				line-height: 20px;
				margin-bottom: 8px;
				padding-left: 16px;
			}
		}
	}

	.info-area {
		margin: auto;

		.card-info {
			display: flex;
			gap: 20px;

			background-color: #f5f8fd;

			border-left: 2px solid #3d8160;
			border-radius: 4px;

			padding: 16px 24px;

			i {
				color: #3d8160;
				font-size: 18px;
				margin-top: 3px;
			}

			.card-info_message {
				display: flex;
				flex-direction: column;
				align-items: flex-start;

				p:first-of-type {
					color: #333;
					font-family: "Lexend";
					font-weight: bold;
					font-size: 16px;
				}

				p {
					font-family: "Lexend";
					margin-bottom: 8px;
					line-height: 20px;

					span {
						color: #3d8160;
						font-weight: bold;
						text-decoration: underline;
					}
				}

				ol {
					color: #333;
					font-family: "Lexend";
					font-size: 16px;
					line-height: 20px;
					margin-bottom: 8px;
					padding-left: 16px;
				}
			}
		}

		.step-5 {
			display: flex;
			flex-direction: column;
			gap: 16px;
		}
	}

	.modal {
		.modal-header {
			display: flex;
			flex-direction: column;
			align-items: center;
			border-bottom: none;

			img {
				margin-top: -25px;
				padding: 0;
			}

			h5 {
				color: #000;
				font-family: "Lexend";
				font-weight: 600;
				font-size: 24px;
				margin-top: 16px;
			}
		}

		.modal-body {
			p {
				color: #000;
				font-family: "Lexend";
				font-size: 14px;
				line-height: 20px;
			}

			p:first-of-type {
				margin-bottom: 12px;
			}
		}

		.modal-footer {
			border-top: none;
			margin-bottom: 24px;

			display: flex;
			justify-content: space-evenly;

			button {
				width: 220px;

				font-family: "Lexend", sans-serif;
				font-weight: 600;
				font-size: 14px;
			}

			.btn-pause {
				color: #3d8160;
			}

			.btn-continue {
				background-color: #3d8160;
				color: #fff;
			}

			.btn-continue:hover {
				background-color: #70a46b;
			}
		}
	}
}
</style>
