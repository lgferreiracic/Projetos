export const Fields = [
	{
		field: "label",
		label: "Ponto Amostral",
		type: "number",
		sortable: true
	},
	// {
	// 	field: "ini_period",
	// 	label: "Período Agrícola",
	// 	type: "number",
	// 	sortable: true
	// },
	{
		field: "stratum.label",
		label: "Unidade Operacional",
		type: "number",
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
	perPage: 10,
	setCurrentPage: 1,
	nextLabel: "Próximo",
	prevLabel: "Anterior",
	rowsPerPageLabel: "Registros por página",
	ofLabel: "de",
	pageLabel: "página",
	allLabel: "Todos"
};
