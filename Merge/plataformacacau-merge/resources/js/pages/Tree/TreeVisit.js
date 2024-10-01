import { Fields, PaginationOptions } from "./TreeVisitTableOptions";

export default {
	data() {
		return {
			authToken: null,
			tree_visits: [],
			tree_visit: {
				id: null,
				bobbin: {},
				small: {},
				medium: {},
				medium2: {},
				medium3: {},
				adult: {},
				adult2: {},
				mature: {},
				mature2: {},
				mature3: {},
				mature4: {},
				collector: {},
				geolocation: {},
				total_good: null,
				total_wb: null,
				total_loss: null,
				total_piece: null,
				total_rotten: null,
				total_rat: null,
				total_harvested: null,
				date: "",
				created_at: "",
			},
			tree: {
				id: null,
				label: ""
			},
			stratum: {
				id: null,
				label: ""
			},
			sampling_point: {
				id: null,
				label: null,
				status: null,
				stratum: null,
				active_trees: null,
				sampling_point_tree_range: null,
				total_trees: null
			},
			spid: "",
			splabel: "",
			visit_index: null,
			showAreaInfo: false,
			loading: false,
			icon: null,
			fields: Fields,
			paginationOptions: PaginationOptions
		};
	},

	created() {
		this.authToken = window.token;
		this.index();
		this.getTree();
		// this.getSpInfo();
	},

	methods: {
		index() {
			this.loading = true;

			let urlParams = new URLSearchParams(window.location.search);
			let treeID = urlParams.get("trid");
			this.splabel = urlParams.get("splabel");
			this.stratum.label = urlParams.get("stlabel");

			axios
				.get(`/api/v1/tree-visits`, {
					params: { trid: treeID },
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 200) {
						this.tree_visits = response.data.data;
					} else {
						console.log(response);
					}
					this.loading = false;
				})
				.catch(err => {
					console.log(err);
					this.loading = false;
				});
		},

		getTree() {
			let urlParams = new URLSearchParams(window.location.search);
			let treeID = urlParams.get("trid");

			axios
				.get(`/api/v1/trees/${treeID}`, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					this.tree = response.data.data;
					this.spid = response.data.data.sampling_point_id;
				})
				.catch(err => {
					console.log(err.response);
				});
		},

		// generalAreaInfo(info) {
		// 	switch (info) {
		// 		case 0:
		// 			return "Nenhuma/Ruim";
		// 		case 1:
		// 			return "Pouca/Regular";
		// 		case 2:
		// 		case 3:
		// 			return "Muita/Boa";
		// 		default:
		// 			console.log("error");
		// 	}
		// },

		showModal(tree_visit, index) {
			this.tree_visit = tree_visit;
			this.visit_index = index;

			$("#modalShow").modal("show");
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

			return day + "/" + month + "/" + year;
		}
	}
};
