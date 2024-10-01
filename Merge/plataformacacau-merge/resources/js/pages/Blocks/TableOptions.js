export const Fields = [
	{
		field: "label",
		label: "Identificação",
		sortable: true,
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
		field: "area",
		label: "Área",
		sortable: true,
	},
	{
		field: "actions",
		label: "Ações",
		sortFn: null,
		sortable: false,
	},
];

export const PaginationOptions = {
	enabled: true,
	mode: "pages",
	perPage: 5,
	setCurrentPage: 1,
	nextLabel: "Próximo",
	prevLabel: "Anterior",
	rowsPerPageLabel: "Registros por página",
	ofLabel: "de",
	pageLabel: "página",
	allLabel: "Todos",
};
