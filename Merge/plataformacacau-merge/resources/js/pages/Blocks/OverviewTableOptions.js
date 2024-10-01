export const Fields = [
	{
		field: "id",
		label: "ID",
		sortable: true,
	},
	{
		field: "area",
		label: "Área",
		sortable: false,
	},
	{
		field: "altitude",
		label: "Altitude",
		sortable: false,
	},
	{
		field: "relief",
		label: "Relevo",
		sortable: false,
	},
	{
		field: "soilClass",
		label: "Solo",
		sortable: false,
	},
	{
		field: "rainfall",
		label: "Precipitação pluvial",
		sortable: false,
	},
	{
		field: "handling",
		label: "Manejo",
		sortable: false,
	},
	{
		field: "genotypes",
		label: "Genótipo",
		sortable: false,
	},
	// {
	// 	field: "actions",
	// 	label: "Ações",
	// 	sortFn: null,
	// 	sortable: false,
	// },
];

export const PaginationOptions = {
	enabled: true,
	mode: "pages",
	perPage: 10,
	setCurrentPage: 1,
	nextLabel: "Próximo",
	prevLabel: "Anterior",
	rowsPerPageLabel: "Registros por página",
	ofLabel: "de",
	pageLabel: "página",
	allLabel: "Todos",
};
