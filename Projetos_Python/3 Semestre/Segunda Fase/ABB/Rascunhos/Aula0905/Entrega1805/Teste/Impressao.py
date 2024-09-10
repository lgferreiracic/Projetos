import os
from graphviz import Digraph

# Obter o diretório do script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Caminho completo para o arquivo de saída
output_path = os.path.join(script_dir, 'raiz_example')

# Cria um novo grafo direcionado
class Desenho:
    dot = Digraph()
    
    @staticmethod
    def listar_no_e_filhos(raiz):
        no_e_filhos = []
        if raiz is not None:
            no_e_filhos.append((raiz, raiz.valor, raiz.esquerda, Desenho.get_valor_filho(raiz.esquerda), raiz.direita, Desenho.get_valor_filho(raiz.direita)))
            no_e_filhos.extend(Desenho.listar_no_e_filhos(raiz.esquerda))
            no_e_filhos.extend(Desenho.listar_no_e_filhos(raiz.direita))
        return no_e_filhos

    @staticmethod
    def get_valor_filho(filho):
        return filho.valor if filho else None

    @classmethod
    def desenhar(self, raiz):
        # Cria uma lista de nós e seus filhos
        no_e_filhos = Desenho.listar_no_e_filhos(raiz)
        
        # Adiciona os nós ao grafo
        for i, (no, valor, no_esquerda, filho_esquerda, no_direita, filho_direita) in enumerate(no_e_filhos):
            self.dot.node(str(no), str(valor))
        
        # Adiciona as ligações entre os nós e seus filhos
        for i, (no, valor, no_esquerda, filho_esquerda, no_direita, filho_direita) in enumerate(no_e_filhos):
            if filho_esquerda is not None or filho_direita is not None:
                self.dot.edge(str(no), str(no_esquerda))
                self.dot.edge(str(no), str(no_direita))
        
        # Renderiza o gráfico e salva em um arquivo PNG
        self.dot.render(filename=output_path, format='png', cleanup=False)
