import { Fields, PaginationOptions } from "./TreeTableOptions";

export default {
	data() {
		return {
			authToken: null,
			trees: [],
			range: null,
			tree: {
				id: "",
				label: "",
				status: true,
				sampling_point_id: "",
				created_at: null,
				updated_at: null
			},
			stratum: {
				id: null,
				label: "",
			},
			spid: "",
			splabel: "",
			active_trees: null,
			loading: false,
			editMode: false,
			fields: Fields,
			paginationOptions: PaginationOptions
		};
	},

	created() {
		this.authToken = window.token;
		this.fields[1].sortFn = this.sortStatus;

		this.index();
	},

	methods: {
		rowStyleClassFn(row) {
			if (!row.status) {
				return "deactivate-tree";
			}
		},

		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[1].sortFn = null;
		},

		index() {
			this.loading = true;

			let urlParams = new URLSearchParams(window.location.search);
			let sampPointID = urlParams.get("spid");
			this.spid = urlParams.get("spid");

			axios
				.get(`/api/v1/sampling-points/${sampPointID}`, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					// console.log("response.data.data: ", response.data.data);
					this.stratum = response.data.data.stratum;
					this.range = response.data.data.active_trees;
					this.active_trees = response.data.data.active_trees;
					this.trees = response.data.data.trees;
					this.splabel = response.data.data.label;
					this.loading = false;
				})
				.catch(err => {
					console.log(err);
					this.loading = false;
				});
		},

		store() {
			let urlParams = new URLSearchParams(window.location.search);
			let sampPointID = urlParams.get("spid");

			let number_trees = this.range - this.active_trees;

			Swal.fire({
				title: "Adicionar nova árvore?",
				text: "",
				icon: "info",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Sim",
				cancelButtonText: "Cancelar"
			}).then(result => {
				if (result.value) {
					axios
						.post(
							`/api/v1/trees`,
							{ range: number_trees },
							{
								params: { spid: sampPointID },
								headers: {
									authorization: `bearer ${this.authToken}`
								}
							}
						)
						.then(response => {
							if (response.status === 200) {
								Swal.fire({
									title: response.data.message,
									icon: response.data.success
										? "success"
										: "error",
									showConfirmButton: false,
									timer: 1500
								});
							} else {
								console.log(response);
							}
							this.index();
						})
						.catch(err => {
							console.log(err);
						});
				}
			});
		},

		deactivate(tree_id) {
			Swal.fire({
				title: "Deseja desativar permanentemente esta árvore?",
				text: "Esta ação não poderá ser desfeita.",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Sim",
				cancelButtonText: "Cancelar"
			}).then(result => {
				if (result.value) {
					axios
						.delete(`/api/v1/trees/${tree_id}`, {
							headers: {
								authorization: `bearer ${this.authToken}`
							}
						})
						.then(response => {
							if (response.status === 200) {
								Swal.fire({
									title: response.data.message,
									icon: "success",
									showConfirmButton: false,
									timer: 1500
								});
							} else {
								console.log(response);
							}
							this.index();
						})
						.catch(err => {
							console.log(err);
						});
				}
			});
		},

		convertDate(date) {
			function checkZero(data) {
				if (data.length === 1) {
					data = "0" + data;
				}
				return data;
			}
			let newDate = new Date(date);
			let day = newDate.getDate() + "";
			let month = newDate.getMonth() + 1 + "";
			let year = newDate.getFullYear() + "";
			let hour = newDate.getHours() + "";
			let minutes = newDate.getMinutes() + "";
			let seconds = newDate.getSeconds() + "";

			day = checkZero(day);
			month = checkZero(month);
			year = checkZero(year);
			hour = checkZero(hour);
			minutes = checkZero(minutes);
			seconds = checkZero(seconds);

			return (
				day +
				"/" +
				month +
				"/" +
				year
			);
		}
	}
};