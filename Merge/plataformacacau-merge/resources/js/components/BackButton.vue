<template>
	<div id="back-button">
		<a href="#!" class="back" @click.prevent="$router.go(-1)">
			<i class="fas fa-arrow-left fa-2x"></i>
		</a>
	</div>
</template>

<style lang="scss" scoped>
#back-button {
	position: absolute;
	top: 1%;
	left: 15vh;

	.back {
		// background-color: #ffffff;
		background-color: transparent;

		display: inline-block;
		position: relative;
		box-sizing: border-box;
		text-decoration: none;
		color: #414141;
		width: 40px;
		height: 40px;
		line-height: 30px;
		border-radius: 50%;
		text-align: center;
		vertical-align: middle;
		// box-shadow: 0 0 3px 3px #535353;
		transition: 0.3s;
		border: solid 5px transparent;
	}
}
</style>
