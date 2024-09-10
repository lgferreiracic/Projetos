<template>
	<footer class="footer theme-bg section-padding-100-0">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-sm-3 col-lg-3">
					<div class="footer-single-widget mb-5">
						<div class="footer-logo">
							<a href="#!">
								<img src="/img/agrocacau_logo.png" alt="" />
							</a>
						</div>
						<span class="mt-4">
							Plataforma integrada para controle e análise do
							cultivo do cacau, PlataformaCacau.
						</span>
						<!-- <div class="footer-contact-icon">
							<a href="#!" title="facebook">
								<i class="fab fa-facebook-f"></i>
							</a>
							<a href="#!" title="twitter">
								<i class="fab fa-twitter"></i>
							</a>
							<a href="#!" title="google-plus">
								<i class="fab fa-google"></i>
							</a>
						</div> -->
					</div>
				</div>

				<div class="col-sm-6 col-lg-6">
					<div class="footer-single-widget mb-5">
						<h4>Realização</h4>
						<div class="footer-realization-logo align-items-center">
							<a href="#!" title="uesc">
								<img src="/img/logo_uesc.png" alt="Logo UESC" />
							</a>
							<a href="#!" title="ceplac">
								<img
									src="/img/logo_ceplac.png"
									alt="Logo CEPLAC"
								/>
							</a>
							<a href="#!" title="ima">
								<img
									src="/img/ima_logo.png"
									style="filter: invert(1)"
									alt="Logo IMA"
								/>
							</a>
						</div>
					</div>
				</div>

				<div class="col-sm-3 col-lg-3">
					<div class="footer-single-widget mb-5">
						<h4>Links Úteis</h4>
						<ul>
							<li>
								<a href="#banner">Início</a>
							</li>
							<li>
								<a href="#about">Sobre</a>
							</li>
							<li>
								<a href="#team">Envolvidos</a>
							</li>
							<li>
								<a href="#contact">Contato</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- <div class="col-sm-6 col-lg-2">
					<div class="footer-single-widget mb-5">
						<h4>Download</h4>
						<div class="footer-download-logo">
							<a href="#!" title="uesc">
								<img src="/img/app-store-btn.png" alt="">
							</a>
							<a  href="#!" title="ceplac">
								<img src="/img/google-play-btn.png" alt="">
							</a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				<div
					class="col-xs-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-center"
				>
					<span class="my-4 h6">
						Esse projeto está hospedado no
						<a
							href="https://ccam.uesc.br/"
							target="_blank"
							style="color: #d65c22"
						>
							Centro de Computação Avançada e Multidisciplinar da
							UESC - CCAM/UESC.</a
						>
					</span>
				</div>
			</div>
		</div>
	</footer>
</template>

<script>
export default {
	data() {
		return {};
	},

	methods: {},
};
</script>

<style lang="scss" scoped>
ul {
	margin: 0;
	padding: 0;
}

span {
	color: white;
	font-family: "Poppins", "Roboto", sans-serif;
}

.theme-bg {
	background-color: #25661af8;
}

.section-padding-100-0 {
	padding-top: 100px;
	padding-bottom: 0;
}

.footer-logo a img {
	max-width: 70px;
	margin-bottom: 10px;
}

.footer-single-widget h4 {
	font-size: 20px;
	color: #fff;
	margin-bottom: 20px;
}

.footer-single-widget ul li {
	display: block;
	margin-bottom: 12px;
}

.footer-single-widget ul li:last-child {
	margin-bottom: 0;
}

.footer-single-widget ul li img {
	max-width: 90px;
}

.footer-single-widget ul li a {
	font-size: 15px;
	color: rgba(255, 255, 255, 0.9);
	position: relative;
	-webkit-transition-duration: 400ms;
	-o-transition-duration: 400ms;
	transition-duration: 400ms;
	font-weight: 400;
}

.footer-single-widget ul li a i {
	margin-right: 5px;
}

.footer-single-widget ul li a:hover {
	color: rgb(207, 205, 205);
}

.footer-single-widget p {
	color: rgba(255, 255, 255, 0.9);
	margin-bottom: 0;
}

.footer-single-widget ul li a::after {
	content: "";
	position: absolute;
	bottom: 0;
	right: 0;
	left: auto;
	width: 0px;
	height: 2px;
	-o-transition: ease all 0.35s;
	-webkit-transition: ease all 0.35s;
	transition: ease all 0.35s;
	background: currentColor;
}

.footer-single-widget ul li a:hover::after {
	width: 100%;
	left: 0;
	right: auto;
}

.footer-realization-logo {
	margin-top: 20px;
}

.footer-realization-logo a {
	display: inline-block;
	margin-right: 20px;
}

.footer-realization-logo a img {
	max-width: 90px;
}

.footer-contact-icon {
	margin-top: 20px;
}

.footer-contact-icon a {
	display: inline-block;
	color: #fff;
	font-size: 20px;
	text-align: center;
	margin-right: 10px;
	-webkit-transition-duration: 400ms;
	-o-transition-duration: 400ms;
	transition-duration: 400ms;
}

.footer-download-logo {
	margin-top: 20px;
}

.footer-download-logo a img {
	max-width: 150px;
	margin-bottom: 10px;
}
</style>
