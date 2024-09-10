import os
from graphviz import Digraph

# Obter o diretório do script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Caminho completo para o arquivo de saída
output_path = os.path.join(script_dir, 'tree_order')

class Node:
    def __init__(self, name):
        self.name = name
        self.left = None
        self.right = None

# Função para adicionar nós em ordem
def add_nodes_in_order(graph, node):
    if node:
        if node.left:
            add_nodes_in_order(graph, node.left)
            graph.edge(node.name, node.left.name)
        graph.node(node.name)
        if node.right:
            graph.edge(node.name, node.right.name)
            add_nodes_in_order(graph, node.right)

# Criação da árvore
root = Node('A')
root.left = Node('B')
root.right = Node('C')
root.left.left = Node('D')
root.left.right = Node('E')

# Criação do grafo
dot = Digraph()

# Adicionar nós e arestas em ordem
add_nodes_in_order(dot, root)

# Renderizar o gráfico
output_file = dot.render(filename=output_path, format='png', cleanup=False)
