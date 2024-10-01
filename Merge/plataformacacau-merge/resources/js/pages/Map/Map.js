import mapboxgl from "mapbox-gl";

export default {
	data() {
		return {
			authToken: null,
			map: {},
			geoJson: {
				type: "FeatureCollection",
				features: []
			},
			accessToken:
				"pk.eyJ1IjoiYWRyaWVsZmFicmljaW9zIiwiYSI6ImNrZGdlaThrazJobXgyeHBtM2xxZXd0bzIifQ.HV2jDo5aUEvvRd91L2dvEA",
			mapStyle: "mapbox://styles/mapbox/satellite-streets-v11",
			samplingPoints: {},
			sampling_point: {
				id: "",
				ini_period: "",
				label: "",
				status: true,
				stratum_id: null,
				// property_id: null,
				geolocation: {
					id: null,
					latitude: null,
					longitude: null,
					ratio: 2.0
				},
				// property: {
				// 	id: null,
				// 	name: "",
				// 	owner_name: "",
				// 	description: "",
				// 	status: true,
				// 	city: {}
				// },
				stratum: {
					id: null,
					label: "",
					status: true
				}
			},
			properties: {},
			property: {
				id: null,
				name: null,
				city: null,
				uf: null,
				owner_name: null,
				description: null,
				total_homogeneous_areas: null,
				geolocation: {
					id: null,
					latitude: null,
					longitude: null,
					ratio: 2.0
				},
			}
		};
	},

	created() {
		mapboxgl.accessToken = this.accessToken;
		this.authToken = window.token;
	},

	async mounted() {
		this.map = new mapboxgl.Map({
			container: "map",
			style: this.mapStyle,
			center: [-39.23138115409798, -14.755684248455063],
			zoom: 10
		});

		await this.loadMap();
	},

	methods: {
		async loadMap() {
			await this.getProperties();

			this.geoJson.features.forEach(property => {
				var el = document.createElement("div");

				el.className = "marker";
				el.style.backgroundImage = "url('/img/cocoa-tree.png')";
				el.style.width = "2.5em";
				el.style.height = "2.5em";

				var popup = new mapboxgl.Popup({
					offset: [0, -25]
				}).setHTML(
					`${property.properties.name}`
				);

				var marker = new mapboxgl.Marker(el)
					.setLngLat(property.geometry.coordinates)
					.setPopup(popup)
					.addTo(this.map);

				el.addEventListener("click", () => {
					this.showModal(property.properties);
				});
				el.addEventListener("mouseenter", () => {
					marker.togglePopup();
				});
				el.addEventListener("mouseleave", () => {
					marker.togglePopup();
				});
			});
		},

		async getSamplingPoints() {
			await axios
				.get(`/api/v1/sampling-points`, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 200) {
						this.samplingPoints = response.data.data;
						this.transformData(this.samplingPoints);
					}
				})
				.catch(err => {
					console.log(err.response);
				});
		},

		async getProperties() {
			await axios
				.get(`/api/v1/properties`, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 200) {
						this.properties = response.data.data;
						this.transformPropertyData(this.properties);
					}
				})
				.catch(err => {
					console.log(err.response);
				});
		},

		transformData(samplingPoints) {
			samplingPoints.forEach(samplingPoint => {
				if (samplingPoint.geolocation) {
					this.geoJson.features.push({
						type: "Feature",
						geometry: {
							type: "Point",
							coordinates: [
								samplingPoint.geolocation.longitude,
								samplingPoint.geolocation.latitude
							]
						},
						properties: {
							id: samplingPoint.id,
							label: samplingPoint.label,
							// property: samplingPoint.property,
							stratum: samplingPoint.stratum,
							geolocation: samplingPoint.geolocation,
							ini_period: samplingPoint.ini_period,
							active_trees: samplingPoint.active_trees,
							total_trees: samplingPoint.total_trees
						}
					});
				}
			});
		},

		transformPropertyData(properties) {
			properties.forEach(property => {
				if (property.geolocation) {
					this.geoJson.features.push({
						type: "Feature",
						geometry: {
							type: "Point",
							coordinates: [
								property.geolocation.longitude,
								property.geolocation.latitude
							]
						},
						properties: {
							id: property.id,
							name: property.name,
							city: property.city,
							uf: property.uf,
							owner_name: property.owner_name,
							description: property.description,
							total_homogeneous_areas: property.total_homogeneous_areas,
						}
					});
				}
			});
		},

		store() {
			let _this = this;
			this.sampling_point.property_id = _this.sampling_point.property.id;
			this.sampling_point.stratum_id = _this.sampling_point.stratum.id;

			axios
				.post(`/api/v1/sampling-points`, this.sampling_point, {
					headers: { authorization: `bearer ${this.authToken}` }
				})
				.then(response => {
					if (response.status === 201 && response.data.success) {
						Swal.fire({
							title: response.data.message,
							icon: "success",
							showCancelButton: false,
							timer: 1500
						});
					} else {
						console.log(response);
					}
					this.loadMap();
					this.clearForm();
				})
				.catch(err => {
					Swal.fire({
						title: err.response.data.message,
						text: err.response.data.detail,
						icon: "error",
						showCancelButton: false,
						cancelButtonText: "Fechar"
					});
				});
		},

		update() {
			let _this = this;
			this.sampling_point.property_id = _this.sampling_point.property.id;
			this.sampling_point.stratum_id = _this.sampling_point.stratum.id;

			axios
				.put(
					`/api/v1/sampling-points/${this.sampling_point.id}`,
					this.sampling_point,
					{
						headers: { authorization: `bearer ${this.authToken}` }
					}
				)
				.then(response => {
					if (response.status === 200 && response.data.success) {
						Swal.fire({
							title: response.data.message,
							icon: "success",
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						console.log(response);
					}
					this.loadMap();
					this.clearForm();
				})
				.catch(err => {
					Swal.fire({
						title: err.response.data.message,
						text: err.response.data.detail,
						icon: "error",
						showCancelButton: false,
						cancelButtonText: "Fechar"
					});
					console.log(err);
				});
		},

		showModal(property) {
			this.property = property;

			$("#propertyInfo").modal("show");
		}
	}
};
