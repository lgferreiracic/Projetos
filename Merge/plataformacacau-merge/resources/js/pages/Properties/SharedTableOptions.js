export const Fields = [
	{
		field: "name",
		label: "Nome",
		sortable: true,
	},
	{
		field: "owner_name",
		label: "Proprietário",
		sortable: true,
	},
	{
		field: "city",
		label: "Município",
		sortable: true,
	},
	{
		field: "uf",
		label: "Estado",
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
	perPage: 5,
	setCurrentPage: 1,
	nextLabel: "Próximo",
	prevLabel: "Anterior",
	rowsPerPageLabel: "Registros por página",
	ofLabel: "de",
	pageLabel: "página",
	allLabel: "Todos",
};
