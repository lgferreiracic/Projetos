<template>
	<div class="container form-add-unit mt-5 mb-5">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
						Você está cadastrando a
						{{ property.area_name?.toLowerCase() }}
						{{ property?.total_blocks + 1 }} da propriedade
						<strong>{{ property.name }}</strong>
					</p>
				</div>

				<div class="col-12 info-area my-3">
					<div v-show="actualStep === 1" class="card-info">
						<i class="fas fa-exclamation"></i>
						<div class="card-info_message">
							<p>Qual a finalidade desse formulário?</p>
							<p>
								Para cada
								<span>{{ property.area_name || "Área" }}</span>
								da sua propriedade, é necessário cadastrar suas
								características para análise pela
								PlataformaCacau.
							</p>
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
									style="text-decoration: underline"
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
					<add-operational-unit-step-1
						v-show="actualStep === 1"
						v-on:area="block.area = Number($event)"
						v-on:production_temple="
							block.production.temple = parseFloat($event)
						"
						v-on:production_main="
							block.production.main = parseFloat($event)
						"
						v-on:production_total="
							block.production.total = parseFloat($event)
						"
						v-on:production_not_informed="
							block.production.not_informed = Number($event)
						"
						v-on:latitude="
							block.geolocation.latitude = parseFloat($event)
						"
						v-on:longitude="
							block.geolocation.longitude = parseFloat($event)
						"
						:propertyName="property.name"
						:areaName="property.area_name"
						:totalBlocks="property.total_blocks"
						:label="block.label"
						:nextStep="nextStep"
					/>
					<add-operational-unit-step-2
						v-show="actualStep === 2"
						v-on:relief="block.relief = Number($event)"
						v-on:altitude="block.altitude = Number($event)"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<add-operational-unit-step-3
						v-show="actualStep === 3"
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
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<add-operational-unit-step-4
						v-show="actualStep === 4"
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
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<add-operational-unit-step-5
						v-show="actualStep === 5"
						v-on:main="block.handling.main = Number($event)"
						v-on:temple="block.handling.temple = Number($event)"
						:nextStep="nextStep"
						:previousStep="previousStep"
					/>
					<add-operational-unit-step-6
						v-show="actualStep === 6"
						v-on:commonType="
							block.genotypes.common.type =
								$event !== null ? Number($event) : null
						"
						v-on:commonTotalArea="
							block.genotypes.common.total_area_participation =
								Number($event)
						"
						v-on:commonAge="
							block.genotypes.common.age =
								$event !== null ? Number($event) : null
						"
						v-on:commonDensity="
							block.genotypes.common.density =
								$event !== null ? Number($event) : null
						"
						v-on:commonTemple="
							block.genotypes.common.temple =
								$event !== null ? Number($event) : null
						"
						v-on:commonMain="
							block.genotypes.common.main =
								$event !== null ? Number($event) : null
						"
						v-on:commonGlobal="
							block.genotypes.common.global =
								$event !== null ? Number($event) : null
						"
						v-on:hybridTotalArea="
							block.genotypes.hybrid.total_area_participation =
								Number($event)
						"
						v-on:hybridAge="
							block.genotypes.hybrid.age =
								$event !== null ? Number($event) : null
						"
						v-on:hybridDensity="
							block.genotypes.hybrid.density =
								$event !== null ? Number($event) : null
						"
						v-on:hybridTemple="
							block.genotypes.hybrid.temple =
								$event !== null ? Number($event) : null
						"
						v-on:hybridMain="
							block.genotypes.hybrid.main =
								$event !== null ? Number($event) : null
						"
						v-on:hybridGlobal="
							block.genotypes.hybrid.global =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTotalArea="
							block.genotypes.cloned.total_area_participation =
								Number($event)
						"
						v-on:clonedAge="
							block.genotypes.cloned.age =
								$event !== null ? Number($event) : null
						"
						v-on:clonedDensity="
							block.genotypes.cloned.density =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTemple="
							block.genotypes.cloned.temple =
								$event !== null ? Number($event) : null
						"
						v-on:clonedMain="
							block.genotypes.cloned.main =
								$event !== null ? Number($event) : null
						"
						v-on:clonedGlobal="
							block.genotypes.cloned.global =
								$event !== null ? Number($event) : null
						"
						v-on:clonedType="
							block.genotypes.cloned.type =
								$event !== null ? Number($event) : null
						"
						v-on:clonedTypeDescription="
							block.genotypes.cloned.type_description =
								$event !== null ? $event : null
						"
						:previousStep="previousStep"
						:store="store"
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
							<span>{{ property.area_name || "Área" }}</span> da
							sua propriedade, é necessário cadastrar suas
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
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<img
							class="img-fluid"
							:src="'/img/BookmarkSimple.svg'"
						/>
						<h5 class="modal-title" id="modalConfirmationLabel">
							✅ >{{
								property.area_name
									?.toLowerCase()
									.charAt(0)
									.toUpperCase() + property.area_name?.slice(1)
							}}
							> registrada
						</h5>
					</div>
					<div class="modal-body">
						<p>
							Os dados da sua
							<strong
								>{{
									property.area_name?.toLowerCase()
								}}s</strong
							>
							foram salvos no nosso servidor.
						</p>
						<p>
							Você pode continuar registrando mais
							<strong
								>{{
									property.area_name?.toLowerCase()
								}}s</strong
							>
							ou, se desejar prosseguir em um outro momento, é só
							continuar de onde parou.
						</p>
					</div>
					<div class="modal-footer">
						<button
							type="button"
							class="btn btn-light btn-pause"
							@click="pauseRegister()"
							:disabled="isClustering"
						>
							Pausar
						</button>
						<button
							type="button"
							class="btn btn-primary btn-continue"
							@click="continueRegister()"
							:disabled="isClustering"
						>
							Continuar registrando
						</button>
						<button
							type="button"
							class="btn btn-info btn-success"
							@click="clusterBlocks()"
							:disabled="isClustering"
						>
							<div
								class="spinner-border spinner-border-sm text-light"
								role="status"
								v-if="isClustering"
							>
								<span class="sr-only">Loading...</span>
							</div>
							Finalizar cadastro
						</button>
						<!-- <router-link
							data-dismiss="modal"
							tag="button"
							class="btn btn-info btn-success"
							v-bind:to="{
								path: '/panel/overview',
								query: { propid: property.id },
							}"
						>
							Finalizar cadastro
						</router-link> -->
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
			property: {
				id: null,
				name: null,
				area_name: null,
				total_blocks: null,
			},
			block: {
				area: 0,
				relief: 1,
				altitude: 1,
				label: "",
				propertyId: null,
				production: {
					id: null,
					temple: 0,
					main: 0,
					total: 0,
					not_informed: 0,
				},
				rainfall: {
					january: 0,
					february: 0,
					march: 0,
					april: 0,
					may: 0,
					june: 0,
					july: 0,
					august: 0,
					september: 0,
					october: 0,
					november: 0,
					december: 0,
					unknown: 0,
				},
				soilUse: {
					type: 1,
					description: "",
				},
				handling: {
					temple: 1,
					main: 1,
				},
				genotypes: {
					common: {
						main: 0,
						temple: 0,
						global: 0,
						age: 0,
						density: 0,
						total_area_participation: 0,
						type: 1,
					},
					hybrid: {
						main: 0,
						temple: 0,
						global: 0,
						age: 0,
						density: 0,
						total_area_participation: 0,
					},
					cloned: {
						main: 0,
						temple: 0,
						global: 0,
						age: 0,
						density: 0,
						total_area_participation: 0,
						type: 1,
						type_description: "",
					},
				},
				soilClass: {
					lowland: {
						argisol: 0,
						latosol: 0,
						cambisol: 0,
						gleisol: 0,
						other: 0,
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
				},
				geolocation: {
					latitude: null,
					longitude: null,
					ratio: 2.0,
				},
			},
			authToken: null,
			propertyId: null,
			areaName: null,
			actualStep: 1,
			isClustering: false,
			completedSteps: [],
			formErrors: {},
		};
	},

	created() {
		let urlParams = new URLSearchParams(window.location.search);
		this.propertyId = Number(urlParams.get("propid"));
		this.authToken = window.token;

		this.index();
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

		index() {
			axios
				.get(`/api/v1/properties/${this.propertyId}`, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					if (response.status === 200 && response.data.success) {
						this.property = response.data.data;
						this.block.propertyId = this.property.id;
						this.block.label = `${this.property.area_name} ${this.property.total_blocks + 1}`
					} else {
						console.log(response);
					}
				})
				.catch((err) => {
					console.log(err);
				});
		},

		store() {
			this.block.soilUse.description =
				this.block.soilUse.type === 2
					? JSON.stringify(this.block.soilUse.description)
					: this.block.soilUse.description;

			// console.error('this.block ==> ', this.block);

			axios
				.post("/api/v1/blocks", this.block, {
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
					console.log(err.response.data);
					Swal.fire({
						icon: "error",
						title: `${this.property.area_name} não registrada`,
						text: "Ocorreu um erro no cadastro dos dados. Revise as informações passadas ou tente novamente mais tarde!",
						confirmButtonText: "Fechar",
					});
				});
		},

		confirmationModal() {
			$("#modalConfirmation").modal("show");
		},

		continueRegister() {
			let _this = this;
			let areaname = _this.property.area_name;
			let propid = _this.property.id;

			if ("URLSearchParams" in window) {
				var searchParams = new URLSearchParams(window.location.search);
				searchParams.set("propid", `${propid}`);
				window.location.href =
					window.location.pathname + "?" + searchParams.toString();
			}
		},

		pauseRegister() {
			let _this = this;
			let areaname = _this.property.area_name;
			let propid = _this.property.id;

			if ("URLSearchParams" in window) {
				var searchParams = new URLSearchParams(window.location.search);
				searchParams.set("propid", `${propid}`);
				window.location.href =
					"/panel/blocks" + "?" + searchParams.toString();
			}
		},

		clusterBlocks() {
			this.isClustering = true;

			axios
				.get(`/api/v1/blocks-clustering?propid=${this.propertyId}`, {
					headers: {
						authorization: `bearer ${this.authToken}`,
					},
				})
				.then((response) => {
					if (response.status === 200) {
						$("#modalConfirmation").modal("hide");
						Swal.fire({
							title: "Unidades operacionais agrupadas",
							icon: "success",
							text: "Suas unidades operacionais foram agrupadas em áreas homogêneas. Você será redirecionado dentro de alguns instantes para a tela de listagem dessas áreas homogêneas.",
							showCancelButton: false,
							showConfirmButton: false,
							timer: 5000,
						});
					}

					setTimeout(() => {
						this.isClustering = false;
						this.$router.push(
							`/panel/homogeneous-area?propid=${this.propertyId}`
						);
					}, 6500);
				})
				.catch((err) => {
					console.error(err);
					this.isClustering = false;
					Swal.fire({
						title: "Erro no agrupamento",
						icon: "error",
						text: "Houve um erro durante o agrupamento. Tente novamente mais tarde!",
						showCancelButton: false,
						showConfirmButton: false,
						timer: 5000,
					});
				});
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

			.btn-success {
				color: #fff;
			}
		}
	}
}
</style>
