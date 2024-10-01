export default {
	data() {
		return {
			authToken: null,
			target: null,
			fileFormat: null,
			csvLoading: false,
			csvFile: null,
			message: null,
			show: true,
		};
	},

	created() {
		this.authToken = window.token;
	},

	methods: {
		onChange(e) {
			if (e.target.files[0].type.match("text/csv")) {
				this.csvFile = e.target.files[0];
				this.show = false;
				this.message = "";
			} else {
				console.log("not matched");
				this.show = true;
				this.message = "Tipo de arquivo não aceito!";
			}
		},
		/*
		importCSV() {
			this.csvLoading = true;
			let formData = new FormData();

			formData.append('file', this.csvFile);

			axios
				.post("/api/import", formData, {
					// responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					console.log(response.data);
					Swal.fire({
						title: "Arquivo importado com sucesso!",
						text: "Seus dados serão mostrados no sistema dentro de alguns minutos.",
						icon: "success",
						showConfirmButton: true,
					});
				})
				.catch((err) => {
					console.log(err.response);
					this.csvLoading = false;
				});
		},*/
		importCSV() {
			this.csvLoading = true;
			let formData = new FormData();
		
			formData.append('file', this.csvFile);
		
			console.log(this.csvFile);  // Verifica se o arquivo está correto
			alert("Aguarde alguns minutos, pois o processo pode ser demorado");
		
			axios
				.post("/api/import", formData, {
					headers: { authorization: `bearer ${this.authToken}` },
				})
				.then((response) => {
					console.log(response.data);
					Swal.fire({
						title: "Arquivo importado com sucesso!",
						text: "Seus dados serão mostrados no sistema dentro de alguns minutos.",
						icon: "success",
						showConfirmButton: true,
					});
					this.csvLoading = null;
				})
				.catch((err) => {
					console.log(err.response);
					this.csvLoading = null;
				});
		}
		
	},
};
