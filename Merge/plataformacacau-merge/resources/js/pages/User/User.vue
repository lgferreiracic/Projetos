<template>
	<div id="users" class="mt-5 usersWrapper">
		<div class="admin-content">
			<div
				class="admin-header d-flex justify-content-between align-items-center p-2"
			>
				<h1>Usuários</h1>
				<button
					type="button"
					class="btn btn-agro btn-add"
					@click="addModal"
				>
					<i class="fas fa-plus"></i>
				</button>
			</div>
			<br />

			<div v-if="loading" class="loader-overlay">
				<loader :loading="loading"></loader>
			</div>

			<div class="users-table" v-else>
				<vue-good-table
					title="Usuários"
					:columns="fields"
					:rows="users"
					:search-options="{
						enabled: true,
						placeholder: 'Pesquisar...',
					}"
					:pagination-options="paginationOptions"
					:sort-options="{
						enabled: true,
						initialSortBy: [
							{ field: 'status', type: 'desc' },
							{ field: 'id', type: 'asc' },
						],
					}"
					compactMode
				>
					<div slot="emptystate">
						Não há registros para esta pesquisa
					</div>
					<template slot="table-row" slot-scope="props">
						<span v-if="props.column.field == 'cpf'">{{
							props.row.cpf | VMask("###.###.###-##")
						}}</span>

						<span v-else-if="props.column.field == 'roles'">
							<span
								v-for="role in props.row.roles"
								v-bind:key="role.id"
							>
								{{ role.title }}
								<br />
							</span>
						</span>

						<div
							v-else-if="props.column.field == 'status'"
							class="custom-control custom-switch"
						>
							<input
								type="checkbox"
								class="custom-control-input"
								v-bind:id="`status_${props.row.id}`"
								v-model="props.row.status"
								@click.prevent="
									props.row.status
										? changeStatus(
												props.row.id,
												(status = false)
										  )
										: changeStatus(props.row.id)
								"
							/>
							<label
								class="custom-control-label"
								v-bind:for="`status_${props.row.id}`"
								>{{
									props.row.status ? "Desativar" : "Ativar"
								}}</label
							>
						</div>

						<button
							v-else-if="props.column.field == 'actions'"
							title="Editar"
							class="btn btn-secondary"
							@click.prevent="editModal(props.row)"
						>
							<i class="fas fa-cog fa-lg"></i>
						</button>
					</template>
				</vue-good-table>
			</div>

			<div
				class="modal fade"
				id="modalUsers"
				ref="modal"
				tabindex="-1"
				role="dialog"
				aria-labelledby="modalUsersLabel"
				aria-hidden="true"
			>
				<div
					class="modal-dialog modal-dialog-centered modal-lg"
					role="document"
				>
					<div class="modal-content">
						<div class="modal-header">
							<h5
								class="modal-title"
								id="modalUsersLabel"
								v-show="!editMode"
							>
								ADICIONAR NOVO USUÁRIO
							</h5>
							<h5
								class="modal-title"
								id="modalUsersLabel"
								v-show="editMode"
							>
								{{
									`ATUALIZAR USUÁRIO: ${user.name.toUpperCase()}`
								}}
							</h5>
							<button
								type="button"
								class="close"
								data-dismiss="modal"
								aria-label="Close"
							>
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form
								@submit.prevent="editMode ? update() : store()"
							>
								<div class="form-group">
									<label for="name">Nome Completo</label>
									<input
										id="name"
										type="text"
										class="form-control"
										v-model="user.name"
										required
									/>
								</div>

								<div class="form-group">
									<label for="phone">Telefone</label>
									<input
										id="phone"
										type="phone"
										class="form-control"
										aria-describedby="phoneHelp"
										v-model="user.phone"
										v-mask="[
											'(##) ####-####',
											'(##) #####-####',
										]"
										placeholder="(99) 9999-9999"
										pattern="(\([0-9]{2}\))\s([9]{1})?([0-9]{4})-([0-9]{4})"
										required
									/>
									<small
										v-if="messages.phone"
										id="phoneHelp"
										class="form-text text-danger"
										>{{ messages.phone }}</small
									>
								</div>

								<div class="form-group">
									<label for="cpf">CPF</label>
									<input
										id="cpf"
										type="text"
										class="form-control"
										aria-describedby="cpfHelp"
										v-model="user.cpf"
										v-mask="'###.###.###-##'"
										required
									/>
									<small
										v-if="messages.cpf"
										id="cpfHelp"
										class="form-text text-danger"
										>{{ messages.cpf }}</small
									>
								</div>

								<div class="form-group">
									<label for="email">E-mail</label>
									<input
										id="email"
										type="email"
										class="form-control"
										aria-describedby="emailHelp"
										v-model="user.email"
										required
									/>
									<small
										v-if="messages.email"
										id="emailHelp"
										class="form-text text-danger"
										>{{ messages.email }}</small
									>
								</div>

								<div v-if="!editMode" class="form-group">
									<label for="email_confirmation"
										>Confirmação de e-mail</label
									>
									<input
										id="email_confirmation"
										type="email"
										class="form-control"
										aria-describedby="emailConfirmHelp"
										v-model="email_confirm"
										required
									/>
									<small
										v-if="messages.email_confirm"
										id="emailConfirmHelp"
										class="form-text text-danger"
										>{{ messages.email_confirm }}</small
									>
								</div>

								<div v-if="!editMode" class="form-group">
									<label for="password">Senha</label>
									<input
										id="password"
										type="password"
										class="form-control"
										aria-describedby="passwordHelp"
										v-model="user.password"
										required
									/>
									<small
										v-if="messages.password"
										id="passwordHelp"
										class="form-text text-danger"
										>{{ messages.password }}</small
									>
								</div>

								<div v-if="!editMode" class="form-group">
									<label for="password_confirmation"
										>Confimação de senha</label
									>
									<input
										id="password_confirmation"
										type="password"
										class="form-control"
										aria-describedby="passwordHelp"
										v-model="password_confirm"
										required
									/>
									<small
										v-if="messages.password_confirm"
										id="passwordHelp"
										class="form-text text-danger"
										>{{
											messages.password_confirm
										}}</small
									>
								</div>

								<hr />
								<div class="form-row">
									<div class="col-md-6 col-sm-12 form-group">
										<label for="roles">Papéis</label>
										<div
											v-for="role in roles"
											v-bind:key="role.id"
										>
											<div class="form-check">
												<label
													class="form-check-label"
													v-bind:for="
														'role_' + role.id
													"
												>
													<input
														v-bind:id="
															'role_' + role.id
														"
														type="checkbox"
														name="roles[]"
														v-bind:value="role"
														v-model="currentRoles"
														v-bind:checked="
															user.roles
														"
													/>
													<span>{{
														role.title
													}}</span>
												</label>
											</div>
										</div>
									</div>

									<div
										v-show="true"
										class="col-md-6 col-sm-12 form-group"
									>
										<label for="homogeneous_areas">
											Áreas Homogêneas
										</label>
										<multiselect
											v-model="user.homogeneous_areas"
											:placeholder="
												userIsCollector
													? 'Selecione as áreas homogêneas'
													: 'Usuário não autorizado'
											"
											selectLabel="Pressione para selecionar"
											deselectLabel="Pressione para remover"
											selectedLabel="Selecionado"
											track-by="id"
											:custom-label="
												customHomogeneousAreaLabel
											"
											:options="homogeneous_areas"
											:multiple="true"
											:close-on-select="false"
											:clear-on-select="false"
											:preserve-search="true"
											:preselect-first="true"
											:disabled="!userIsCollector"
										>
											<template
												slot="option"
												slot-scope="props"
											>
												<div class="option__desc">
													<span class="option__title">
														{{
															`Área Homogênea ${props.option.label}`
														}}
													</span>
												</div>
											</template>
											>
										</multiselect>
									</div>

									<div
										v-show="true"
										class="col-md-6 col-sm-12 form-group"
									>
										<label for="sampling_points">
											Pontos Amostrais
										</label>
										<multiselect
											v-model="user.sampling_points"
											:placeholder="
												userIsCollector
													? 'Selecione os pontos'
													: 'Usuário não autorizado'
											"
											selectLabel="Pressione para selecionar"
											deselectLabel="Pressione para remover"
											selectedLabel="Selecionado"
											track-by="id"
											:custom-label="customLabel"
											:options="sampling_points"
											:multiple="true"
											:close-on-select="false"
											:clear-on-select="false"
											:preserve-search="true"
											:preselect-first="true"
											:disabled="!userIsCollector"
										>
											<template
												slot="option"
												slot-scope="props"
											>
												<div class="option__desc">
													<span class="option__title">
														{{
															`U.O. ${props.option.stratum.label}: Ponto Amostral ${props.option.label}`
														}}
													</span>
												</div>
											</template>
											>
										</multiselect>
									</div>
								</div>

								<!-- <div class="form-group">
								<label for="permissions">Permissões</label>
								<div
									v-for="permission in permissions"
									v-bind:key="permission.id"
								>
									<div class="form-check">
										<label
											v-bind:for="
												'permission_' + permission.id
											"
											class="form-check-label"
										>
											<input
												v-bind:id="
													'permission_' +
														permission.id
												"
												type="checkbox"
												name="permissions[]"
												v-bind:value="permission"
												v-model="currentPermissions"
												v-bind:checked="
													user.permissions
												"
											/>
											<span>{{ permission.title }}</span>
										</label>
									</div>
								</div>
                                </div>-->

								<div class="modal-footer">
									<button
										type="button"
										class="btn btn-secondary"
										data-dismiss="modal"
									>
										Sair
									</button>
									<button
										type="submit"
										class="btn btn-primary"
										v-show="!editMode"
										:disabled="haveError"
									>
										Cadastrar
									</button>
									<button
										type="submit"
										class="btn btn-primary"
										v-show="editMode"
									>
										Atualizar
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script src="./User.js"></script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss" scoped>
.usersWrapper {
	background-color: #f5f8fd;
	border-radius: 20px;

	h1 {
		color: #3d8160;

		font-family: "Lexend", sans-serif;
		font-weight: 600;
		font-size: 24px;

		padding: 16px 0px 16px 48px;
	}

	.btn-add {
		margin: 16px 48px 16px 0;
	}

	.users-table {
		padding: 0 31px 48px;
	}
}

@media (max-width: 768px) {
	.usersWrapper {
		height: 70vh;
		max-height: 80vh;
		overflow-y: scroll;
	}
}
</style>
