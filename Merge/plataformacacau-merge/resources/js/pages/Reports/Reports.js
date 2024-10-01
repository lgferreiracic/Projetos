export default {
	data() {
		return {
			authToken: null,
			target: null,
			fileFormat: null,
			pdfLoading: false,
			xlsLoading: false,
			csvLoading: false
		};
	},

	created() {
		this.authToken = window.token;
	},

	methods: {
		exportPDF() {
			this.pdfLoading = true;
			this.fileFormat = "pdf";
			let data = {
				target: this.target
			};

			axios
				.post("/api/v1/export-pdf", data, {
					responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					this.downloadFile(response, this.target, this.fileFormat);
					this.pdfLoading = false;
				})
				.catch(err => {
					console.log(err.response);
					this.pdfLoading = false;
				});
		},

		exportXLS() {
			this.xlsLoading = true;
			this.fileFormat = "xls";

			axios
				.post("/api/v1/export-xls", null, {
					responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					this.downloadFile(response, "plataforma-cacau_(contagem dos frutos)", this.fileFormat);
					this.xlsLoading = false;
				})
				.catch(err => {
					console.log(err.response);
					this.xlsLoading = false;
				});
		},

		exportCSV() {
			this.csvLoading = true;
			this.fileFormat = "csv";

			axios
				.post("/api/v1/export-csv", null, {
					responseType: "arraybuffer",
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					this.downloadFile(response, "agrocacau", this.fileFormat);
					this.csvLoading = false;
				})
				.catch(err => {
					console.log(err.response);
					this.csvLoading = false;
				});
		},

		downloadFile(response, filename, fileformat) {
			let type = "";
			switch (fileformat) {
				case "pdf":
					type = "application/pdf";
					break;
				case "xls":
					type = "application/vnd.ms-excel";
					break;
				case "csv":
					type = "text/csv";
					break;
				default:
					console.log("error - file format!");
			}

			var newBlob = new Blob([response.data], {
				type: type
			});

			const data = window.URL.createObjectURL(newBlob);
			var link = document.createElement("a");

			if (window.navigator && window.navigator.msSaveOrOpenBlob) {
				window.navigator.msSaveOrOpenBlob(newBlob);
			}

			link.href = data;
			link.download = `${filename}.${fileformat}`;
			link.click();
			// For Firefox
			setTimeout(function() {
				window.URL.revokeObjectURL(data);
			}, 100);
		}
	}
};
