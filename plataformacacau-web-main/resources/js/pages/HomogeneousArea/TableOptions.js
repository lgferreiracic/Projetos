export const Fields = [
	{
		field: "label",
		label: "Área Homogênea",
		sortable: true
	},
	{
		field: "status",
		label: "Status",
		type: "boolean",
		sortFn: null,
		sortable: true
	},
	{
		field: "actions",
		label: "Ações",
		sortable: false
	}
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
	allLabel: "Todos"
};