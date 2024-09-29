<template>
	<nav id="sidebar">
		<div class="sidebar-top">
			<h1>PlataformaCacau</h1>

			<div class="avatar">
				<img
					title="PlataformaCacau"
					class="img-fluid"
					:src="'/img/farmer_avatar.png'"
				/>

				<p class="userName">{{ userName }}</p>
				<p class="userRole">{{ userRole }}</p>

				<div class="nav-links">
					<ul class="sidebar-links">
						<li class="sidebar-item">
							<button
								v-if="
									$can('properties-manager') || $can('admin') || $can('pre-registered')
								"
								tag="button"
								@click="navigateTo('/panel')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'map',
								}"
							>
								<span
									class="fas fa-globe-americas fa-lg"
								></span>
								<span class="link-text">Mapa</span>
							</button>
						</li>
						<li>
							<button
								v-if="
									$can('properties-manager') ||
									$can('admin') ||
									$can('pre-registered')
								"
								tag="button"
								@click="navigateTo('/panel/properties')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active:
										path === 'properties' ||
										path === 'homogeneous-area' ||
										path === 'strata' ||
										path === 'sampling-point' ||
										path === 'trees' ||
										path === 'tree-visit',
								}"
							>
								<span class="fa fa-home fa-lg"></span>
								<span class="link-text">Propriedades</span>
							</button>
						</li>
						<li>
							<button
								v-if="$can('pre-registered')"
								tag="button"
								disabled
								:class="{
									btn: true,
									'sidebar-link': true,
								}"
							>
								<i class="fas fa-cogs fa-lg"></i>
								<span class="link-text">Serviços</span>
							</button>
						</li>
						<li>
							<button
								v-if="$can('admin')"
								tag="button"
								@click="navigateTo('/panel/properties/shared')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'shared-properties',
								}"
							>
								<span
									class="fa fa-share-alt-square fa-lg"
								></span>
								<span class="link-text"
									>Propriedades Compartilhadas</span
								>
							</button>
						</li>
						<li>
							<button
								v-if="
									$can('users-manager') ||
									$can('admin') ||
									$can('pre-registered')
								"
								tag="button"
								@click="navigateTo('/panel/users')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'users',
								}"
							>
								<span class="fas fa-user fa-lg"></span
								><span class="link-text">Usuários</span>
							</button>
						</li>
						<li>
							<button
								v-if="$can('reports-manager') || $can('admin')"
								tag="button"
								@click="navigateTo('/panel/reports')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'reports',
								}"
							>
								<span class="fas fa-clipboard fa-lg"></span
								><span class="link-text">Relatórios</span>
							</button>
						</li>
						<li>
							<button
								v-if="$can('admin')"
								tag="button"
								@click="navigateTo('/panel/docs')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'docs',
								}"
							>
								<span class="fas fa-book fa-lg"></span
								><span class="link-text">Documentações</span>
							</button>
						</li>
						<li>
							<button
								v-if="$can('admin')"
								tag="button"
								@click="navigateTo('/panel/data-import')"
								:class="{
									btn: true,
									'sidebar-link': true,
									active: path === 'data-import',
								}"
							>
								<span class="fas fa-file-upload fa-lg"></span
								><span class="link-text">Importar</span>
							</button>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="nav-footer">
			<button
				class="btn btn-footer"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
			>
				<i class="fas fa-sign-out-alt fa-lg"></i> Sair
			</button>
			<form
				id="logout-form"
				action="/logout"
				method="POST"
				style="display: none"
			>
				<input :value="csrfToken" name="_token" type="hidden" />
			</form>
		</div>
	</nav>
</template>

<script>
export default {
	data() {
		return {
			url: window.location.origin,
			csrfToken: null,
			roles: [],
			can: {},
			userName: null,
			userRole: null,
			actualPath: null,
			path: null,
			windowWidth: window.innerWidth,
		};
	},

	created() {
		if (
			localStorage.getItem("path") !== this.$route.name &&
			this.windowWidth > 767
		) {
			this.path = this.$route.name;
			localStorage.setItem("path", this.$route.name);
		} else {
			this.path = this.$route.name;
		}

		this.userName = window.user.name;
		this.csrfToken = document.querySelector(
			'meta[name="csrf-token"]'
		).content;

		this.userRole = this.checkRole(window.Roles[0].label);
	},

	mounted() {
		this.$nextTick(() => {
			window.addEventListener("resize", this.onResize);
		});
	},

	beforeDestroy() {
		window.removeEventListener("resize", this.onResize);
	},

	methods: {
		navigateTo(path) {
			this.$router.push({ path });
			this.updatePath();
		},

		updatePath() {
			this.path = this.$route.name;
			localStorage.setItem("path", this.$route.name);
		},

		onResize() {
			this.windowWidth = window.innerWidth;

			if (
				localStorage.getItem("path") !== this.$route.name &&
				this.windowWidth < 768
			) {
				this.path = this.$route.name;
				localStorage.setItem("path", this.$route.name);
			} else {
				this.path = this.$route.name;
			}
		},

		checkRole(role) {
			switch (role) {
				case "admin":
					return "Administrador";
				case "properties-manager":
					return "Gerente de Propriedades";
				case "homogeneous_area-manager":
					return "Gerente de ÁHs";
				case "strata-manager":
					return "Gerente de UOs";
				case "sampling_points-manager":
					return "Gerente de PAs";
				case "users-manager":
					return "Gerente de Usuários";
				case "pre-registered":
					return "Cacauicultor";

				default:
					break;
			}
		},
	},

	props: ["src"],
};
</script>
