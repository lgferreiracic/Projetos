import { Fields, PaginationOptions } from "./HomogeneousAreaPracticeOptions";

export default {
	data() {
		return {
			authToken: null,
			visits_information: [],
			visit_information: {
				id: null,
				date: "",
				note: "",
				flowering: null,
				refoliation: null,
				top: null,
				pruned: null,
				mowing: null,
				weeding: null,
				grated: null,
				renewed: null,
				fertilized: null,
				pulverized: null,
				unbounded: null,
				wind: null,
				brown_rot: null,
				drought: null,
				rain: null,
				rat: null,
				flood: null,
				insect: null,
				absence_of_shadow: null,
				excess_shade: null,
				homogeneous_area_id: null
			},
			haid: "",
			halabel: "",
			loading: false,
			fields: Fields,
			paginationOptions: PaginationOptions
		};
	},

	created() {
		this.authToken = window.token;
		this.fields[0].sortFn = this.sortStatus;

		this.index();
	},

	methods: {
		sortStatus(x, y) {
			if (!(typeof x === "boolean")) {
				return x < y ? -1 : x > y ? 1 : 0;
			}
			this.fields[0].sortFn = null;
		},

		index() {
			this.loading = true;

			let urlParams = new URLSearchParams(window.location.search);
			let homogeneousAreaId = urlParams.get("haid");
			this.halabel = urlParams.get("halabel");

			axios
				.get(`/api/v1/visits-information`, {
					params: { haid: homogeneousAreaId },
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 200) {
						this.visits_information = response.data.data.map(
							(visit, index) => ({
								...visit,
								id: index + 1,
							})
						);
					} else {
						console.log('response ==> ', response);
					}
					this.loading = false;
				})
				.catch(err => {
					console.log('err ==> ', err);
					this.loading = false;
				});
		},

		generalAreaInfo(info) {
			switch (info) {
				case 0:
					return "Nenhuma/Ruim";
				case 1:
					return "Pouca/Regular";
				case 2:
				case 3:
					return "Muita/Boa";
				default:
					console.log("error");
			}
		},

		showModal(visit_information, index) {
			this.visit_information = visit_information;
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
