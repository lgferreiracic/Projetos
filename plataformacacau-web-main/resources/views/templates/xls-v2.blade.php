<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>AH</th>
            <th>UO</th>
            <th>PA</th>
            <th>Árvore</th>
            <th>Acima de 210</th>
            <th>189-210</th>
            <th>168-189</th>
            <th>147-168</th>
            <th>126-147</th>
            <th>105-126</th>
            <th>84-105</th>
            <th>63-84</th>
            <th>42-63</th>
            <th>21-42</th>
            <th>0-21</th>
            <th>Podre</th>
            <th>Rato</th>
            <th>Peco</th>
            <th>Vas</th>
            <th>Perda</th>
            <th>N_Col</th>
            <th>Col Ac</th>
            <th>C 189-210</th>
            <th>C 168-189</th>
            <th>C 147-168</th>
            <th>C 126-147</th>
            <th>C 105-126</th>
            <th>C 84-105</th>
            <th>POD 63-84</th>
            <th>POD 84-105</th>
            <th>POD 105-126</th>
            <th>POD 126-147</th>
            <th>POD 147-168</th>
            <th>POD 168-189</th>
            <th>POD 189-210</th>
            <th>POD >210</th>
            <th>RAT 63-84</th>
            <th>RAT 84-105</th>
            <th>RAT 105-126</th>
            <th>RAT 126-147</th>
            <th>RAT 147-168</th>
            <th>RAT 168-189</th>
            <th>RAT 189-210</th>
            <th>RAT >210</th>
            <th>VAS 63-84</th>
            <th>VAS 84-105</th>
            <th>VAS 105-126</th>
            <th>VAS 126-147</th>
            <th>VAS 147-168</th>
            <th>VAS 168-189</th>
            <th>VAS 189-210</th>
            <th>VAS >210</th>
            <th>Peco 21-42</th>
            <th>Peco 42-63</th>
            <th>PER 21-42</th>
            <th>PER 42-63</th>
            <th>PER 63-84</th>
            <th>PER 84-105</th>
            <th>PER 105-126</th>
            <th>PER 126-147</th>
            <th>PER 147-168</th>
            <th>PER 168-189</th>
            <th>PER 189-210</th>
            <th>PER >210</th>
            <th>Safra</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $tree_visit)
            <tr>
                <td>{{ date('d/m/Y', strtotime($tree_visit->date)) }}</td>
                <td>{{ $tree_visit->tree->sampling_point->stratum->homogeneous_area->label }}</td>
                <td>{{ $tree_visit->tree->sampling_point->stratum->label }}</td>
                <td>{{ $tree_visit->tree->sampling_point->label }}</td>
                <td>{{ $tree_visit->tree->label }}</td>
                <td>{{ $tree_visit->mature4->total }}</td>
                <td>{{ $tree_visit->mature3->total }}</td>
                <td>{{ $tree_visit->mature2->total }}</td>
                <td>{{ $tree_visit->mature->total }}</td>
                <td>{{ $tree_visit->adult2->total }}</td>
                <td>{{ $tree_visit->adult->total }}</td>
                <td>{{ $tree_visit->medium3->total }}</td>
                <td>{{ $tree_visit->medium2->total }}</td>
                <td>{{ $tree_visit->medium->total }}</td>
                <td>{{ $tree_visit->small->total }}</td>
                <td>{{ $tree_visit->bobbin->total }}</td>
                <!--Modificado-->
                <td>{{ $tree_visit->medium2->rotten + $tree_visit->medium3->rotten + $tree_visit->adult->rotten + $tree_visit->adult2->rotten + $tree_visit->mature->rotten + $tree_visit->mature2->rotten + $tree_visit->mature3->rotten + $tree_visit->mature4->rotten}}</td>
                <td>{{ $tree_visit->medium2->rat + $tree_visit->medium3->rat + $tree_visit->adult->rat + $tree_visit->adult2->rat + $tree_visit->mature->rat + $tree_visit->mature2->rat + $tree_visit->mature3->rat + $tree_visit->mature4->rat}}</td>
                <td>{{ $tree_visit->small->piece + $tree_visit->medium->piece + $tree_visit->medium2->piece + $tree_visit->medium3->piece}}</td>
                <td>{{ $tree_visit->medium2->witchs_broom + $tree_visit->medium3->witchs_broom + $tree_visit->adult->witchs_broom + $tree_visit->adult2->witchs_broom + $tree_visit->mature->witchs_broom + $tree_visit->mature2->witchs_broom + $tree_visit->mature3->witchs_broom + $tree_visit->mature4->witchs_broom}}</td>
                <td>{{ $tree_visit->small->loss + $tree_visit->medium->loss + $tree_visit->medium2->loss + $tree_visit->medium3->loss + $tree_visit->adult->loss + $tree_visit->adult2->loss + $tree_visit->mature->loss + $tree_visit->mature2->loss + $tree_visit->mature3->loss + $tree_visit->mature4->loss}}</td>
                <td>{{ $tree_visit->medium3->harvested + $tree_visit->adult->harvested + $tree_visit->adult2->harvested + $tree_visit->mature->harvested + $tree_visit->mature2->harvested + $tree_visit->mature3->harvested + $tree_visit->mature4->harvested}}</td>
                <!--Modificado-->
                <td>{{ $tree_visit->mature4->harvested }}</td>
                <td>{{ $tree_visit->mature3->harvested }}</td>
                <td>{{ $tree_visit->mature2->harvested }}</td>
                <td>{{ $tree_visit->mature->harvested }}</td>
                <td>{{ $tree_visit->adult2->harvested }}</td>
                <td>{{ $tree_visit->adult->harvested }}</td>
                <td>{{ $tree_visit->medium3->harvested }}</td>
                <td>{{ $tree_visit->medium2->rotten }}</td>
                <td>{{ $tree_visit->medium3->rotten }}</td>
                <td>{{ $tree_visit->adult->rotten }}</td>
                <td>{{ $tree_visit->adult2->rotten }}</td>
                <td>{{ $tree_visit->mature->rotten }}</td>
                <td>{{ $tree_visit->mature2->rotten }}</td>
                <td>{{ $tree_visit->mature3->rotten }}</td>
                <td>{{ $tree_visit->mature4->rotten }}</td>
                <td>{{ $tree_visit->medium2->rat }}</td>
                <td>{{ $tree_visit->medium3->rat }}</td>
                <td>{{ $tree_visit->adult->rat }}</td>
                <td>{{ $tree_visit->adult2->rat }}</td>
                <td>{{ $tree_visit->mature->rat }}</td>
                <td>{{ $tree_visit->mature2->rat }}</td>
                <td>{{ $tree_visit->mature3->rat }}</td>
                <td>{{ $tree_visit->mature4->rat }}</td>
                <td>{{ $tree_visit->medium2->witchs_broom }}</td>
                <td>{{ $tree_visit->medium3->witchs_broom }}</td>
                <td>{{ $tree_visit->adult->witchs_broom }}</td>
                <td>{{ $tree_visit->adult2->witchs_broom }}</td>
                <td>{{ $tree_visit->mature->witchs_broom }}</td>
                <td>{{ $tree_visit->mature2->witchs_broom }}</td>
                <td>{{ $tree_visit->mature3->witchs_broom }}</td>
                <td>{{ $tree_visit->mature4->witchs_broom }}</td>
                <td>{{ $tree_visit->small->piece }}</td>
                <td>{{ $tree_visit->medium->piece }}</td>
                <td>{{ $tree_visit->small->loss }}</td>
                <td>{{ $tree_visit->medium->loss }}</td>
                <td>{{ $tree_visit->medium2->loss }}</td>
                <td>{{ $tree_visit->medium3->loss }}</td>
                <td>{{ $tree_visit->adult->loss }}</td>
                <td>{{ $tree_visit->adult2->loss }}</td>
                <td>{{ $tree_visit->mature->loss }}</td>
                <td>{{ $tree_visit->mature2->loss }}</td>
                <td>{{ $tree_visit->mature3->loss }}</td>
                <td>{{ $tree_visit->mature4->loss }}</td>
                <td>{{ $tree_visit->tree->sampling_point->harvest }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
