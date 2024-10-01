export const Fields = [
	{
		field: "id",
		label: "#",
		type: "number",
		sortable: true
	},
	{
		field: "name",
		label: "Nome",
		sortable: true
	},
	{
		field: "cpf",
		label: "CPF",
		sortable: true
	},
	{
		field: "email",
		label: "Email",
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
		field: "roles",
		label: "Papéis",
		sortable: false
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
