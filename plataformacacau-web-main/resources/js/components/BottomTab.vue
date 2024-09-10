<template>
	<div class="bottom-tab-area">
		<nav id="bottom-tab">
			<ul class="bottom-tab-nav">
				<li>
					<button
						v-if="$can('properties-manager') || $can('admin')"
						tag="button"
						@click="navigateTo('/panel')"
						:class="{
							btn: true,
							'bottom-link': true,
							active: path === 'map',
						}"
					>
						<i class="fas fa-globe-americas"></i>
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
							'bottom-link': true,
							active:
								path === 'properties' ||
								path === 'homogeneous-area' ||
								path === 'strata' ||
								path === 'sampling-point' ||
								path === 'trees' ||
								path === 'tree-visit',
						}"
					>
						<i class="fa fa-home"></i>
						<span class="link-text">Propriedades</span>
					</button>
				</li>
				<li>
					<button
						v-if="$can('properties-manager') || $can('admin')"
						tag="button"
						@click="navigateTo('/panel/properties/shared')"
						:class="{
							btn: true,
							'bottom-link': true,
							active: path === 'shared-properties',
						}"
					>
						<i class="fa fa-share-alt-square"></i>
						<span class="link-text small"
							>Propriedades Compartilhadas</span
						>
					</button>
				</li>
				<li>
					<button
						v-if="$can('users-manager') || $can('admin')"
						tag="button"
						@click="navigateTo('/panel/users')"
						:class="{
							btn: true,
							'bottom-link': true,
							active: path === 'users',
						}"
					>
						<i class="fas fa-user"></i
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
							'bottom-link': true,
							active: path === 'reports',
						}"
					>
						<i class="fas fa-clipboard"></i
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
							'bottom-link': true,
							active: path === 'docs',
						}"
					>
						<i class="fas fa-book"></i
						><span class="link-text">Documentações</span>
					</button>
				</li>
			</ul>
		</nav>
	</div>
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
			this.windowWidth < 768
		) {
			this.path = this.$route.name;
			localStorage.setItem("path", this.$route.name);
		} else {
			this.path = this.$route.name;
		}

		this.userName = window.user.name;
		this.userRole = window.Roles[0].label;
		this.csrfToken = document.querySelector(
			'meta[name="csrf-token"]'
		).content;
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
	},

	props: ["src"],
};
</script>
