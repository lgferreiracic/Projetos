<template>
	<div id="user-profile" class="p-4 p-md-5">
		<div class="admin-content">
			<div style="margin-bottom: 3%">
				<h2>Alteração de Senha</h2>
			</div>
			<div class="update-user">
				<form @submit.prevent="validateForm()">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="currentPassword">Senha atual</label>
							<div class="input-group">
								<input
									id="currentPassword"
									:type="currentPasswordField"
									class="form-control"
									name="currentPassword"
									placeholder
									v-model="currentPassword"
									required
								/>
								<div class="input-group-append">
									<button
										class="input-group-text"
										@click.prevent="
											switchVisibility('current')
										"
									>
										<i
											v-if="
												currentPasswordField ===
													'password'
											"
											class="fas fa-eye"
										></i>
										<i
											v-if="
												currentPasswordField === 'text'
											"
											class="fas fa-eye-slash"
										></i>
									</button>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="newPassword">Nova senha</label>
						<div class="input-group">
							<input
								id="newPassword"
								:type="newPasswordField"
								class="form-control"
								name="newPassword"
								placeholder
								v-model="newPassword"
								v-validate="'required'"
								ref="newPassword"
								required
							/>
							<div class="input-group-append">
								<button
									class="input-group-text"
									@click.prevent="switchVisibility('new')"
								>
									<i
										v-if="newPasswordField === 'password'"
										class="fas fa-eye"
									></i>
									<i
										v-if="newPasswordField === 'text'"
										class="fas fa-eye-slash"
									></i>
								</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="newPasswordConfirmation"
							>Confirmar nova senha</label
						>
						<div class="input-group">
							<input
								id="newPasswordConfirmation"
								:type="newPasswordConfirmationField"
								class="form-control"
								name="newPasswordConfirmation"
								placeholder
								v-model="newPasswordConfirmation"
								v-validate="'required|confirmed:newPassword'"
								data-vv-as="newPassword"
								required
							/>
							<div class="input-group-append">
								<button
									class="input-group-text"
									@click.prevent="
										switchVisibility('new_confirm')
									"
								>
									<i
										v-if="
											newPasswordConfirmationField ===
												'password'
										"
										class="fas fa-eye"
									></i>
									<i
										v-if="
											newPasswordConfirmationField ===
												'text'
										"
										class="fas fa-eye-slash"
									></i>
								</button>
							</div>
						</div>
						<small
							v-if="errors.has('newPasswordConfirmation')"
							class="form-text text-danger"
							>As senhas devem ser iguais</small
						>
					</div>

					<button type="submit" class="btn btn-agro float-right">
						Atualizar
					</button>
				</form>
			</div>
		</div>
	</div>
</template>

<script src="./ChangePassword.js"></script>
