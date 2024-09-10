import os
from graphviz import Digraph

# Obter o diretório do script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Caminho completo para o arquivo de saída
output_path = os.path.join(script_dir, 'tree_pre_order')

class Node:
    def __init__(self, name):
        self.name = name
        self.left = None
        self.right = None

# Função para adicionar nós em pré-ordem
def add_nodes_pre_order(graph, node):
    if node:
        graph.node(node.name)
        if node.left:
            graph.edge(node.name, node.left.name)
            add_nodes_pre_order(graph, node.left)
        if node.right:
            graph.edge(node.name, node.right.name)
            add_nodes_pre_order(graph, node.right)

# Criação da árvore
root = Node('A')
root.left = Node('B')
root.right = Node('C')
root.left.left = Node('D')
root.left.right = Node('E')

# Criação do grafo
dot = Digraph()

# Adicionar nós e arestas em pré-ordem
add_nodes_pre_order(dot, root)

# Renderizar o gráfico
output_file = dot.render(filename=output_path, format='png', cleanup=False)

# Abrir a imagem gerada
if os.name == 'posix':  # Para sistemas Unix (macOS, Linux)
    os.system(f'xdg-open "{output_file}.png"')
elif os.name == 'nt':  # Para sistemas Windows
    os.system(f'start {output_file}.png')
