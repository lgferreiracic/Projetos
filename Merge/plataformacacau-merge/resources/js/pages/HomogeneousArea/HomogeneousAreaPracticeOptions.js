export const Fields = [
	{
		field: "id",
		label: "Visita",
		type: "number",
		sortable: true,
	},
	{
		field: "date",
		label: "Data da Visita",
		sortable: true,
	},
	{
		field: "actions",
		label: "Ações",
		sortable: false,
	},
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
	allLabel: "Todos"
};
