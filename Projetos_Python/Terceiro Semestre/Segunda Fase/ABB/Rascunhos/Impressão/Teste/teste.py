import os
from graphviz import Digraph

# Obter o diretório do script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Caminho completo para o arquivo de saída
output_path = os.path.join(script_dir, 'tree_example')

# Cria um novo grafo direcionado
dot = Digraph()

# Adiciona nós à árvore
dot.node('A', 'Root')
dot.node('B', 'Child1')
dot.node('C', 'Child2')
dot.node('D', 'Grandchild1')
dot.node('E', 'Grandchild2')

# Adiciona arestas (conexões) entre os nós
dot.edge('A', 'B')
dot.edge('A', 'C')
dot.edge('B', 'D')
dot.edge('C', 'E')

# Renderiza o gráfico e salva em um arquivo PNG
output_file = dot.render(filename=output_path, format='png', cleanup=False)

print(f"Árvore gerada e salva como {output_file}")
