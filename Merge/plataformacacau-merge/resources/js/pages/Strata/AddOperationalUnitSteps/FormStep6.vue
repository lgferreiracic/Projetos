<template>
	<form @submit.prevent="checkForm()">
		<h3>Genótipo</h3>

		<div class="genotypes-form">
			<div class="ground-classes">
				<div class="table-responsive">
					<table class="table table-borderless table-hover">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Genótipo</th>
								<th scope="col">Participação</th>
								<th scope="col">Tipo</th>
								<th scope="col">Idade</th>
								<th scope="col">Densidade</th>
								<th scope="col">Temporã</th>
								<th scope="col">Principal</th>
								<th scope="col">Total</th>
							</tr>
						</thead>
						<tbody>
							<!-- Comum -->
							<tr>
								<th scope="row" class="genotype">Comum</th>
								<td>
									<input
										type="number"
										class="form-control"
										id="common-total-participation"
										min="0"
										max="100"
										v-model="
											common.total_area_participation
										"
										@change="checkCommonInputs()"
										:class="{
											'is-invalid':
												formErrors.areaParticipation
													.message,
										}"
										required
									/>
								</td>
								<td>
									<select
										id="common-type"
										class="form-control"
										v-model="common.type"
										@change="
											$emit('commonType', common.type)
										"
										:required="!isCommonInputsDisabled"
										:disabled="isCommonInputsDisabled"
									>
										<option value="1">Forasteiro</option>
										<option value="2">Crioulo</option>
										<option value="3">Trinitário</option>
									</select>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="common-age"
										min="0"
										max="100"
										v-model="common.age"
										@change="$emit('commonAge', common.age)"
										:required="!isCommonInputsDisabled"
										:disabled="isCommonInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="common-density"
										min="0"
										v-model="common.density"
										@change="
											$emit(
												'commonDensity',
												common.density
											)
										"
										:required="!isCommonInputsDisabled"
										:disabled="isCommonInputsDisabled"
									/>
								</td>
								<td>
									<div
										class="d-flex align-items-center"
										style="gap: 0 8px"
									>
										<input
											type="number"
											class="form-control"
											id="common-temple"
											min="0"
											max="100"
											v-model="common.temple"
											@change="
												$emit(
													'commonTemple',
													common.temple
												)
											"
											:class="{
												'is-invalid':
													formErrors.common
														.totalParticipation,
											}"
											:required="!isCommonInputsDisabled"
											:disabled="isCommonInputsDisabled"
										/>
									</div>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="common-main"
										min="0"
										max="100"
										v-model="common.main"
										@change="
											$emit('commonMain', common.main)
										"
										:class="{
											'is-invalid':
												formErrors.common
													.totalParticipation,
										}"
										:required="!isCommonInputsDisabled"
										:disabled="isCommonInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="common-global"
										min="0"
										max="100"
										:value="
											computedCommonGlobal === 0
												? null
												: computedCommonGlobal
										"
										:class="{
											'is-invalid':
												formErrors.common
													.totalParticipation,
										}"
										disabled
									/>
								</td>
							</tr>
							<!-- Híbrido -->
							<tr>
								<th scope="row" class="genotype">Híbrido</th>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-total-area"
										min="0"
										max="100"
										v-model="
											hybrid.total_area_participation
										"
										@change="checkHybridInputs()"
										:class="{
											'is-invalid':
												formErrors.areaParticipation
													.message,
										}"
										required
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										placeholder=""
										disabled
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-age"
										min="0"
										max="100"
										v-model="hybrid.age"
										@change="$emit('hybridAge', hybrid.age)"
										:required="!isHybridInputsDisabled"
										:disabled="isHybridInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-density"
										min="0"
										v-model="hybrid.density"
										@change="
											$emit(
												'hybridDensity',
												hybrid.density
											)
										"
										:required="!isHybridInputsDisabled"
										:disabled="isHybridInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-temple"
										min="0"
										max="100"
										v-model="hybrid.temple"
										@change="
											$emit('hybridTemple', hybrid.temple)
										"
										:class="{
											'is-invalid':
												formErrors.hybrid
													.totalParticipation,
										}"
										:required="!isHybridInputsDisabled"
										:disabled="isHybridInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-main"
										min="0"
										max="100"
										v-model="hybrid.main"
										@change="
											$emit('hybridMain', hybrid.main)
										"
										:class="{
											'is-invalid':
												formErrors.hybrid
													.totalParticipation,
										}"
										:required="!isHybridInputsDisabled"
										:disabled="isHybridInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="hybrid-global"
										min="0"
										max="100"
										:value="
											computedHybridGlobal === 0
												? null
												: computedHybridGlobal
										"
										:class="{
											'is-invalid':
												formErrors.hybrid
													.totalParticipation,
										}"
										disabled
									/>
								</td>
							</tr>
							<!-- Clonado -->
							<tr>
								<th scope="row" class="genotype">Clonado</th>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-total-area"
										min="0"
										max="100"
										v-model="
											cloned.total_area_participation
										"
										@change="checkClonedInputs()"
										:class="{
											'is-invalid':
												formErrors.areaParticipation
													.message,
										}"
										required
									/>
								</td>
								<td>
									<select
										id="cloned-type"
										class="form-control"
										v-model="cloned.type"
										@change="
											$emit('clonedType', cloned.type)
										"
										:required="!isClonedInputsDisabled"
										:disabled="isClonedInputsDisabled"
									>
										<option value="1">CCN-10</option>
										<option value="2">CCN-51</option>
										<option value="3">CEPEC 2204</option>
										<option value="4">PH 09</option>
										<option value="5">PH 16</option>
										<option value="6">IPIANGA 01</option>
										<option value="7">BN 34</option>
										<option value="8">PS 1319</option>
										<option value="9">CEPEC 2002</option>
										<option value="10">SJ 02</option>
										<option value="11">Outro</option>
									</select>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-age"
										min="0"
										max="100"
										v-model="cloned.age"
										@change="$emit('clonedAge', cloned.age)"
										:required="!isClonedInputsDisabled"
										:disabled="isClonedInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-density"
										min="0"
										v-model="cloned.density"
										@change="
											$emit(
												'clonedDensity',
												cloned.density
											)
										"
										:required="!isClonedInputsDisabled"
										:disabled="isClonedInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-temple"
										min="0"
										max="100"
										v-model="cloned.temple"
										@change="
											$emit('clonedTemple', cloned.temple)
										"
										:class="{
											'is-invalid':
												formErrors.cloned
													.totalParticipation,
										}"
										:required="!isClonedInputsDisabled"
										:disabled="isClonedInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-main"
										min="0"
										max="100"
										v-model="cloned.main"
										@change="
											$emit('clonedMain', cloned.main)
										"
										:class="{
											'is-invalid':
												formErrors.cloned
													.totalParticipation,
										}"
										:required="!isClonedInputsDisabled"
										:disabled="isClonedInputsDisabled"
									/>
								</td>
								<td>
									<input
										type="number"
										class="form-control"
										id="cloned-global"
										min="0"
										max="100"
										:value="
											computedClonedGlobal === 0
												? null
												: computedClonedGlobal
										"
										:class="{
											'is-invalid':
												formErrors.cloned
													.totalParticipation,
										}"
										disabled
									/>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- <div class="ground-classes"> -->
			<!-- Comum -->
			<!-- <div class="ground-class">
				<p>Comum</p>
				<div class="inputs-box">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label
								for="common-total-participation"
								title="Participação na área total"
								>Participação na área total (%)</label
							>
							<div
								class="d-flex align-items-center"
								style="gap: 0 4px"
							>
								<p><strong>a)</strong></p>
								<input
									type="number"
									class="form-control"
									id="common-total-participation"
									min="0"
									max="100"
									v-model="common.total_area_participation"
									@change="checkCommonInputs()"
									:class="{
										'is-invalid':
											formErrors.areaParticipation
												.message,
									}"
									required
								/>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label for="common-type" title="Tipo de cacau comum"
								>Tipo de cacau comum</label
							>
							<select
								id="common-type"
								class="form-control"
								v-model="common.type"
								@change="$emit('commonType', common.type)"
								:required="!isCommonInputsDisabled"
								:disabled="isCommonInputsDisabled"
							>
								<option value="1">Forasteiro</option>
								<option value="2">Crioulo</option>
								<option value="3">Trinitário</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="common-age"
								>Idade aproximada em anos</label
							>
							<input
								type="number"
								class="form-control"
								id="common-age"
								min="0"
								max="100"
								v-model="common.age"
								@change="$emit('commonAge', common.age)"
								:required="!isCommonInputsDisabled"
								:disabled="isCommonInputsDisabled"
							/>
						</div>
						<div class="form-group col-md-6">
							<label
								for="common-density"
								title="Plantas por hectare"
								>Densidade (plantas/hectare)</label
							>
							<input
								type="number"
								class="form-control"
								id="common-density"
								min="0"
								v-model="common.density"
								@change="$emit('commonDensity', common.density)"
								:required="!isCommonInputsDisabled"
								:disabled="isCommonInputsDisabled"
							/>
						</div>
						<div class="col-12">
							<h4>Participação por ciclo de colheita (%)</h4>
							<p
								class="text-mute mb-2"
								v-if="!isCommonInputsDisabled"
							>
								A soma dos 3 ciclos deve somar 100%
							</p>
						</div>
						<div class="form-group col-3">
							<label for="common-temple">Temporã</label>
							<input
								type="number"
								class="form-control"
								id="common-temple"
								min="0"
								max="100"
								v-model="common.temple"
								@change="$emit('commonTemple', common.temple)"
								:class="{
									'is-invalid':
										formErrors.common.totalParticipation,
								}"
								:required="!isCommonInputsDisabled"
								:disabled="isCommonInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkblue;
							"
						>
							+
						</div>
						<div class="form-group col-3">
							<label for="common-main">Principal</label>
							<input
								type="number"
								class="form-control"
								id="common-main"
								min="0"
								max="100"
								v-model="common.main"
								@change="$emit('commonMain', common.main)"
								:class="{
									'is-invalid':
										formErrors.common.totalParticipation,
								}"
								:required="!isCommonInputsDisabled"
								:disabled="isCommonInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkgreen;
							"
						>
							=
						</div>
						<div class="form-group col-3">
							<label for="common-global">Global</label>
							<input
								type="number"
								class="form-control"
								id="common-global"
								min="0"
								max="100"
								:value="
									computedCommonGlobal === 0
										? null
										: computedCommonGlobal
								"
								:class="{
									'is-invalid':
										formErrors.common.totalParticipation,
								}"
								disabled
							/>
						</div>
						<div
							class="form-group col-md-12"
							v-if="formErrors.common.totalParticipation !== null"
						>
							<small class="invalid">
								{{ formErrors.common.totalParticipation }}
							</small>
						</div>
					</div>
				</div>
			</div> -->
			<!-- Híbrido -->
			<!-- <div class="ground-class">
				<p>Híbrido</p>
				<div class="inputs-box">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label
								for="hybrid-total-area"
								title="Participação na área total"
								>Participação na área total (%)</label
							>
							<div
								class="d-flex align-items-center"
								style="gap: 0 4px"
							>
								<p><strong>b)</strong></p>
								<input
									type="number"
									class="form-control"
									id="hybrid-total-area"
									min="0"
									max="100"
									v-model="hybrid.total_area_participation"
									@change="checkHybridInputs()"
									:class="{
										'is-invalid':
											formErrors.areaParticipation
												.message,
									}"
									required
								/>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="hybrid-age"
								>Idade aproximada em anos</label
							>
							<input
								type="number"
								class="form-control"
								id="hybrid-age"
								min="0"
								max="100"
								v-model="hybrid.age"
								@change="$emit('hybridAge', hybrid.age)"
								:required="!isHybridInputsDisabled"
								:disabled="isHybridInputsDisabled"
							/>
						</div>
						<div class="form-group col-md-6">
							<label
								for="hybrid-density"
								title="Plantas por hectare"
								>Densidade (plantas/hectare)</label
							>
							<input
								type="number"
								class="form-control"
								id="hybrid-density"
								min="0"
								v-model="hybrid.density"
								@change="$emit('hybridDensity', hybrid.density)"
								:required="!isHybridInputsDisabled"
								:disabled="isHybridInputsDisabled"
							/>
						</div>
						<div class="col-12">
							<h4>Participação por ciclo de colheita (%)</h4>
							<p
								class="text-mute mb-2"
								v-if="!isHybridInputsDisabled"
							>
								A soma dos 3 ciclos deve somar 100%
							</p>
						</div>
						<div class="form-group col-3">
							<label for="hybrid-temple">Temporã</label>
							<input
								type="number"
								class="form-control"
								id="hybrid-temple"
								min="0"
								max="100"
								v-model="hybrid.temple"
								@change="$emit('hybridTemple', hybrid.temple)"
								:class="{
									'is-invalid':
										formErrors.hybrid.totalParticipation,
								}"
								:required="!isHybridInputsDisabled"
								:disabled="isHybridInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkblue;
							"
						>
							+
						</div>
						<div class="form-group col-3">
							<label for="hybrid-main">Principal</label>
							<input
								type="number"
								class="form-control"
								id="hybrid-main"
								min="0"
								max="100"
								v-model="hybrid.main"
								@change="$emit('hybridMain', hybrid.main)"
								:class="{
									'is-invalid':
										formErrors.hybrid.totalParticipation,
								}"
								:required="!isHybridInputsDisabled"
								:disabled="isHybridInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkgreen;
							"
						>
							=
						</div>
						<div class="form-group col-3">
							<label for="hybrid-global">Global</label>
							<input
								type="number"
								class="form-control"
								id="hybrid-global"
								min="0"
								max="100"
								:value="
									computedHybridGlobal === 0
										? null
										: computedHybridGlobal
								"
								:class="{
									'is-invalid':
										formErrors.hybrid.totalParticipation,
								}"
								disabled
							/>
						</div>
						<div
							class="form-group col-md-12"
							v-if="formErrors.hybrid.totalParticipation !== null"
						>
							<small class="invalid">
								{{ formErrors.hybrid.totalParticipation }}
							</small>
						</div>
					</div>
				</div>
			</div> -->
			<!-- Clonado -->
			<!-- <div class="ground-class">
				<p>Clonado</p>
				<div class="inputs-box">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label
								for="cloned-total-area"
								title="Participação na área total"
								>Participação na área total (%)</label
							>
							<div
								class="d-flex align-items-center"
								style="gap: 0 4px"
							>
								<p><strong>c)</strong></p>
								<input
									type="number"
									class="form-control"
									id="cloned-total-area"
									min="0"
									max="100"
									v-model="cloned.total_area_participation"
									@change="checkClonedInputs()"
									:class="{
										'is-invalid':
											formErrors.areaParticipation
												.message,
									}"
									required
								/>
							</div>
						</div>
						<div class="form-group col-12">
							<label
								for="cloned-type"
								title="Tipo de cacau clonado"
								>Tipo de cacau clonado</label
							>
							<select
								id="cloned-type"
								class="form-control"
								v-model="cloned.type"
								@change="$emit('clonedType', cloned.type)"
								:required="!isClonedInputsDisabled"
								:disabled="isClonedInputsDisabled"
							>
								<option value="1">CCN-10</option>
								<option value="2">CCN-51</option>
								<option value="3">CEPEC 2204</option>
								<option value="4">PH 09</option>
								<option value="5">PH 16</option>
								<option value="6">IPIANGA 01</option>
								<option value="7">BN 34</option>
								<option value="8">PS 1319</option>
								<option value="9">CEPEC 2002</option>
								<option value="10">SJ 02</option>
								<option value="11">Outro</option>
							</select>
							<div v-if="cloned.type === '11'">
								<label
									for="cloned-type-description"
									title="Participação na área total"
									class="mt-2"
									>Especifique o tipo de cacau clonado</label
								>
								<input
									class="form-control"
									type="text"
									id="cloned-type-description"
									v-model="cloned.type_description"
									@change="
										$emit(
											'clonedTypeDescription',
											cloned.type_description
										)
									"
									:required="!isClonedInputsDisabled"
									:disabled="isClonedInputsDisabled"
								/>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label for="cloned-age">Idade aproximada</label>
							<input
								type="number"
								class="form-control"
								id="cloned-age"
								min="0"
								max="100"
								v-model="cloned.age"
								@change="$emit('clonedAge', cloned.age)"
								:required="!isClonedInputsDisabled"
								:disabled="isClonedInputsDisabled"
							/>
						</div>
						<div class="form-group col-md-6">
							<label
								for="cloned-density"
								title="Plantas por hectare"
								>Densidade (plantas/hectare)</label
							>
							<input
								type="number"
								class="form-control"
								id="cloned-density"
								min="0"
								v-model="cloned.density"
								@change="$emit('clonedDensity', cloned.density)"
								:required="!isClonedInputsDisabled"
								:disabled="isClonedInputsDisabled"
							/>
						</div>
						<div class="col-12">
							<h4>Participação por ciclo de colheita (%)</h4>
							<p
								class="text-mute mb-2"
								v-if="!isClonedInputsDisabled"
							>
								A soma dos 3 ciclos deve somar 100%
							</p>
						</div>
						<div class="form-group col-3">
							<label for="cloned-temple">Temporã</label>
							<input
								type="number"
								class="form-control"
								id="cloned-temple"
								min="0"
								max="100"
								v-model="cloned.temple"
								@change="$emit('clonedTemple', cloned.temple)"
								:class="{
									'is-invalid':
										formErrors.cloned.totalParticipation,
								}"
								:required="!isClonedInputsDisabled"
								:disabled="isClonedInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkblue;
							"
						>
							+
						</div>
						<div class="form-group col-3">
							<label for="cloned-main">Principal</label>
							<input
								type="number"
								class="form-control"
								id="cloned-main"
								min="0"
								max="100"
								v-model="cloned.main"
								@change="$emit('clonedMain', cloned.main)"
								:class="{
									'is-invalid':
										formErrors.cloned.totalParticipation,
								}"
								:required="!isClonedInputsDisabled"
								:disabled="isClonedInputsDisabled"
							/>
						</div>
						<div
							class="col-1 d-flex justify-content-center align-items-center"
							style="
								font-size: 20px;
								font-weight: 600;
								color: darkgreen;
							"
						>
							=
						</div>
						<div class="form-group col-3">
							<label for="cloned-global">Global</label>
							<input
								type="number"
								class="form-control"
								id="cloned-global"
								min="0"
								max="100"
								:value="
									computedClonedGlobal === 0
										? null
										: computedClonedGlobal
								"
								:class="{
									'is-invalid':
										formErrors.cloned.totalParticipation,
								}"
								disabled
							/>
						</div>
						<div
							class="form-group col-md-12"
							v-if="formErrors.cloned.totalParticipation !== null"
						>
							<small class="invalid">
								{{ formErrors.cloned.totalParticipation }}
							</small>
						</div>
					</div>
				</div>
			</div> -->
		<!-- </div> -->

		<div class="alert alert-danger mt-4" role="alert" v-if="hasErrors">
			<h4>Há os seguintes erros no seu formulário:</h4>
			<ol>
				<li v-show="formErrors.areaParticipation.message">
					<strong>Participação na área total:</strong>
					{{ formErrors.areaParticipation.message }}
				</li>
				<li v-show="formErrors.common.totalParticipation">
					<strong>Comum:</strong>
					{{ formErrors.common.totalParticipation }}
				</li>
				<li v-show="formErrors.hybrid.totalParticipation">
					<strong>Híbrido:</strong>
					{{ formErrors.hybrid.totalParticipation }}
				</li>
				<li v-show="formErrors.cloned.totalParticipation">
					<strong>Clonado:</strong>
					{{ formErrors.cloned.totalParticipation }}
				</li>
			</ol>
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
					Concluir
				</button>
			</div>
		</div>
	</form>
</template>

<script>
export default {
	props: {
		store: Function,
		previousStep: Function,
	},

	data() {
		return {
			isCommonInputsDisabled: false,
			isHybridInputsDisabled: false,
			isClonedInputsDisabled: false,
			hasErrors: false,
			formErrors: {
				areaParticipation: {
					message: null,
				},
				common: {
					totalParticipation: null,
				},
				hybrid: {
					totalParticipation: null,
				},
				cloned: {
					totalParticipation: null,
				},
			},
			common: {
				main: 0,
				temple: 0,
				global: 0,
				age: 0,
				density: 0,
				total_area_participation: 0,
				type: null,
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
				type: null,
				type_description: "",
			},
		};
	},

	computed: {
		computedCommonGlobal: function () {
			let totalCommonGlobal =
				Number(this.common.temple) + Number(this.common.main);
			this.$emit("commonGlobal", totalCommonGlobal);

			return totalCommonGlobal;
		},
		computedHybridGlobal: function () {
			let totalHybridGlobal =
				Number(this.hybrid.temple) + Number(this.hybrid.main);
			this.$emit("hybridGlobal", totalHybridGlobal);

			return totalHybridGlobal;
		},
		computedClonedGlobal: function () {
			let totalClonedGlobal =
				Number(this.cloned.temple) + Number(this.cloned.main);
			this.$emit("clonedGlobal", totalClonedGlobal);

			return totalClonedGlobal;
		},
	},

	created() {
		this.checkCommonInputs();
		this.checkHybridInputs();
		this.checkClonedInputs();
	},

	methods: {
		checkForm() {
			this.formErrors = {
				areaParticipation: {
					message: null,
				},
				common: {
					totalParticipation: null,
				},
				hybrid: {
					totalParticipation: null,
				},
				cloned: {
					totalParticipation: null,
				},
			};
			this.hasErrors = false;

			let areaParticipation =
				Number(this.common.total_area_participation) +
				Number(this.hybrid.total_area_participation) +
				Number(this.cloned.total_area_participation);

			let commonTotalParticipation =
				Number(this.common.temple) + Number(this.common.main);

			let hybridTotalParticipation =
				Number(this.hybrid.temple) + Number(this.hybrid.main);

			let clonedTotalParticipation =
				Number(this.cloned.temple) + Number(this.cloned.main);

			if (areaParticipation === 0) {
				this.hasErrors = true;
				this.formErrors.areaParticipation.message =
					"Deve haver ao menos um genótipo de cacau presente na área!";
			} else if (!(areaParticipation === 100)) {
				this.hasErrors = true;
				this.formErrors.areaParticipation.message =
					"O total de participação dos três genótipos deve somar 100%!";
			}

			if (
				!this.isCommonInputsDisabled &&
				!(commonTotalParticipation === 100)
			) {
				this.hasErrors = true;
				this.formErrors.common.totalParticipation =
					"A soma dos campos Temporã e Principal deve totalizar 100%!";
			}

			if (
				!this.isHybridInputsDisabled &&
				!(hybridTotalParticipation === 100)
			) {
				this.hasErrors = true;
				this.formErrors.hybrid.totalParticipation =
					"A soma dos campos Temporã e Principal deve totalizar 100%!";
			}

			if (
				!this.isClonedInputsDisabled &&
				!(clonedTotalParticipation === 100)
			) {
				this.hasErrors = true;
				this.formErrors.cloned.totalParticipation =
					"A soma dos campos Temporã e Principal deve totalizar 100%!";
			}

			if (!this.hasErrors) {
				this.store();
			}
		},

		checkCommonInputs() {
			if (Number(this.common.total_area_participation) === 0) {
				this.isCommonInputsDisabled = true;
				this.common.temple = null;
				this.common.main = null;
				this.common.global = null;
				this.common.age = null;
				this.common.density = null;
				this.common.type = null;
				this.$emit("commonType", this.common.type);
				this.$emit(
					"commonTotalArea",
					this.common.total_area_participation
				);
			} else {
				this.isCommonInputsDisabled = false;
				this.common.temple = 0;
				this.common.main = 0;
				this.common.global = 0;
				this.common.age = 0;
				this.common.density = 0;
				this.common.type = 1;
				this.$emit("commonType", this.common.type);
				this.$emit(
					"commonTotalArea",
					this.common.total_area_participation
				);
			}
		},

		checkHybridInputs() {
			if (Number(this.hybrid.total_area_participation) === 0) {
				this.isHybridInputsDisabled = true;
				this.hybrid.temple = null;
				this.hybrid.main = null;
				this.hybrid.global = null;
				this.hybrid.age = null;
				this.hybrid.density = null;
				this.$emit(
					"hybridTotalArea",
					this.hybrid.total_area_participation
				);
			} else {
				this.isHybridInputsDisabled = false;
				this.hybrid.temple = 0;
				this.hybrid.main = 0;
				this.hybrid.global = 0;
				this.hybrid.age = 0;
				this.hybrid.density = 0;
				this.$emit(
					"hybridTotalArea",
					this.hybrid.total_area_participation
				);
			}
		},

		checkClonedInputs() {
			if (Number(this.cloned.total_area_participation) === 0) {
				this.isClonedInputsDisabled = true;
				this.cloned.temple = null;
				this.cloned.main = null;
				this.cloned.global = null;
				this.cloned.age = null;
				this.cloned.density = null;
				this.cloned.type = null;
				this.cloned.type_description = "";
				this.$emit(
					"clonedTotalArea",
					this.cloned.total_area_participation
				);
			} else {
				this.isClonedInputsDisabled = false;
				this.cloned.temple = 0;
				this.cloned.main = 0;
				this.cloned.global = 0;
				this.cloned.age = 0;
				this.cloned.density = 0;
				this.cloned.type = 0;
				this.cloned.type_description = "";
				this.$emit(
					"clonedTotalArea",
					this.cloned.total_area_participation
				);
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

	h4 {
		color: #333333;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 14px;
	}

	.invalid {
		color: #f00;
		font-family: "Lexend", sans-serif;
		font-size: 0.875em;
	}

	.invalid-box {
		border-left: 1px solid #f00;
	}

	.genotypes-form {
		overflow-x: scroll;

		.ground-classes {
			margin-top: 12px;

			.genotype {
				vertical-align: middle;
			}

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
