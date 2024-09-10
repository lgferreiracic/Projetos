<template>
	<!-- <div v-if="hide" id="profile-button" class="dropdown dropleft"> -->
	<div id="profile-button" class="dropdown dropleft">
		<button
			class="btn btn-user"
			data-toggle="dropdown"
			aria-haspopup="true"
			aria-expanded="false"
		>
			<!-- <i class="far fa-user-circle"></i> -->
			<i class="fas fa-user"></i>
			<span>{{ name }}</span>
		</button>
		<!-- <a
			id="profileDropdown"
			data-toggle="dropdown"
			aria-haspopup="true"
			aria-expanded="false"
			href="#!"
			class="circle_fl profile float-left"
		>
			<i class="far fa-user-circle fa-2x"></i>
		</a> -->

		<div class="dropdown-menu" aria-labelledby="profileDropdown">
			<router-link
				tag="a"
				class="dropdown-item"
				to="/panel/change-password"
			>
				Alterar Senha
			</router-link>
			<div class="dropdown-divider"></div>
			<a
				href="#!"
				class="dropdown-item"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
			>
				Sair
			</a>
			<form
				id="logout-form"
				action="/logout"
				method="POST"
				style="display: none;"
			>
				<input :value="csrfToken" name="_token" type="hidden" />
			</form>
		</div>
	</div>
</template>

<script>
export default {
	props: ["name"],

	data() {
		return {
			csrfToken: null,
			hide: false,
		};
	},

	mounted() {
		this.csrfToken = document.querySelector(
			'meta[name="csrf-token"]'
		).content;

		this.hide = window.Roles[0].label !== 'pre-registered'
	}
};
</script>

<style lang="scss" scoped>
#profile-button {
	position: absolute;
	top: 1%;
	right: 2%;
	z-index: 9999;

	.dropleft:hover .dropdown-menu {
		display: block;
	}

	.btn-user {
		border-radius: 3px;
		background-color: #ffffffb9;
		box-shadow: 0px 8px 15px #0000002d;
		font-size: 1.2em;
	}
}

// .circle_fl {
// 	display: inline-block;
// 	position: relative;
// 	box-sizing: border-box;
// 	text-decoration: none;
// 	color: #414141;
// 	width: 40px;
// 	height: 40px;
// 	line-height: 30px;
// 	border-radius: 50%;
// 	text-align: center;
// 	vertical-align: middle;
// 	box-shadow: 0 0 3px 3px #c9c9c9;
// 	transition: 0.3s;
// }

// .circle_fl .far {
// 	line-height: 30px;
// }

// .circle_fl:hover {
// 	box-shadow: none;
// }

// .circle_fl.profile {
// 	border: solid 5px transparent;
// }
</style>
