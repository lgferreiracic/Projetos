export const Fields = [
	{
		field: "id",
		label: "Coleta",
		type: "number",
		sortable: true
	},
	{
		field: "date",
		label: "Data de Coleta",
		sortable: true
	},
	{
		field: "actions",
		label: "Informações",
		sortable: false
	}
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
