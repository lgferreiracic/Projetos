<table>
	<thead>
		<tr>
			<th>Visita</th>
			<th>Ponto Amostral</th>
			<th>Data</th>
			<th>Árvore</th>
			<th>Bilro</th>
			<th>Pequeno</th>
			<th>Médio</th>
			<th>Adulto</th>
			<th>Maduro</th>
			<th>Floração</th>
			<th>Refoliação</th>
			<th>Copa</th>
			<th>Podada</th>
			<th>Roçada</th>
			<th>Capinada</th>
			<th>Raleada</th>
			<th>Renovada</th>
			<th>Desbrotada</th>
			<th>Fertilizada</th>
			<th>Pulverizada</th>
			<th>C.P Parda</th>
			<th>Vento</th>
			<th>Estiagem</th>
			<th>Chuva</th>
			<th>Ratos</th>
			<th>Enchente</th>
			<th>Insetos</th>
			<th>Ausência de sombra</th>
			<th>Excesso de sombra</th>
			{{-- <th>Propriedade</th>
			<th>Proprietário</th>
			<th>Município</th>
			<th>UF</th> --}}
		</tr>
	</thead>
	<tbody>
		@foreach ($data as $key => $visits)
			@foreach ($visits as $tree_visit)
				<tr>
					<td>{{ $key }}</td>
					<td>{{ $tree_visit->tree->sampling_point()->first()->label }}</td>
					<td>{{ date('d/m/Y', strtotime($tree_visit->visit_information->date)) }}</td>
					<td>{{ $tree_visit->tree->label }}</td>
					<td>{{ $tree_visit->bobbin->total }}</td>
					<td>{{ $tree_visit->small->total }}</td>
					<td>{{ $tree_visit->medium->total }}</td>
					<td>{{ $tree_visit->adult->total }}</td>
					<td>{{ $tree_visit->mature->total }}</td>
					<td>{{ $tree_visit->visit_information->flowering }}</td>
					<td>{{ $tree_visit->visit_information->refoliation }}</td>
					<td>{{ $tree_visit->visit_information->top }}</td>
					<td>{{ $tree_visit->visit_information->pruned ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->mowing ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->weeding ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->grated ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->renewed ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->unbounded ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->fertilized ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->pulverized ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->brown_rot ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->wind ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->drought ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->rain ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->rat ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->flood ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->insect ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->absence_of_shadow ? 'S' : 'N' }}</td>
					<td>{{ $tree_visit->visit_information->excess_shade ? 'S' : 'N' }}</td>
				</tr>
			@endforeach
		@endforeach
	</tbody>
</table>