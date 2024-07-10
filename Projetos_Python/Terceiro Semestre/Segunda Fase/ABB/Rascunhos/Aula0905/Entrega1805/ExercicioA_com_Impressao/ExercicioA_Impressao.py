import os
from graphviz import Digraph

# Obter o diretório do script
script_dir = os.path.dirname(os.path.abspath(__file__))

# Caminho completo para o arquivo de saída
output_path = os.path.join(script_dir, 'raiz_example')

# Cria um novo grafo direcionado
dot = Digraph()

class No:
    """Esta classe representa um nó/elemento de uma árvore.
       Equivalente a função criar_arvore em C -- no slide
    """ 
    def __init__(self, valor, esquerda=None, direita=None):
        self.valor = valor
        self.esquerda = esquerda
        self.direita = direita

class Arvore:
    """Esta classe contem funções para a manipulação de árvores binárias."""
    
    # Recebe um Nó de uma árvore (raiz local) e um inteiro.
    # Retorna o No que contem o valor inteiro.
    def procurar_no (raiz: No, x: int) -> No:
        
        if raiz is None:
            return None
        
        if raiz.valor == x:
            return raiz
        
        esq = Arvore.procurar_no(raiz.esquerda, x)
        if (esq is not None):
            return esq
        
        _dir = Arvore.procurar_no(raiz.direita, x)
        if (_dir is not None):
            return _dir
        
        return None

    def numero_nos(raiz: No) -> int:
        if raiz is None:
            return 0
        n_esq=Arvore.numero_nos(raiz.esquerda)
        n_dir=Arvore.numero_nos(raiz.direita)
        return n_esq+n_dir+1
    
    def altura(raiz: No) -> int:
        if raiz is None:
            return 0
        h_esq = Arvore.altura(raiz.esquerda)
        h_dir = Arvore.altura(raiz.direita)
        return 1 + max(h_esq, h_dir)

    def pre_ordem(raiz: No):
        if raiz is not None:
            print(raiz.valor, end=' ')
            Arvore.pre_ordem(raiz.esquerda)
            Arvore.pre_ordem(raiz.direita)
            
    def pos_ordem(raiz: No):
        if raiz is not None:
            Arvore.pos_ordem(raiz.esquerda)
            Arvore.pos_ordem(raiz.direita)
            print(raiz.valor, end=' ')
    
    def in_ordem(raiz: No):
        if raiz is not None:
            Arvore.in_ordem(raiz.esquerda)
            print(raiz.valor, end=' ')
            Arvore.in_ordem(raiz.direita)
            
            
    def percurso_em_largura (raiz: No):
        f = list()
        f.append(raiz) #insere no fim
        while len(f)>0:
            raiz = f.pop(0) # removo no início
            if raiz is not None:
                f.append(raiz.esquerda)
                f.append(raiz.direita)
                print(raiz.valor, end=' ') 

def listar_no_e_filhos(raiz: No):
    no_e_filhos = []
    if raiz is not None:
        no_e_filhos.append((raiz, raiz.valor, raiz.esquerda, get_valor_filho(raiz.esquerda), raiz.direita, get_valor_filho(raiz.direita)))
        no_e_filhos.extend(listar_no_e_filhos(raiz.esquerda))
        no_e_filhos.extend(listar_no_e_filhos(raiz.direita))
    return no_e_filhos

def get_valor_filho(filho):
    return filho.valor if filho else None

def desenhar(dot: Digraph, raiz: No):
    # Cria uma lista de nós e seus filhos
    no_e_filhos = listar_no_e_filhos(raiz)
    
    # Adiciona os nós ao grafo
    for i, (no, valor, no_esquerda, filho_esquerda, no_direita, filho_direita) in enumerate(no_e_filhos):
        dot.node(str(no), str(valor))
    
    # Adiciona as ligações entre os nós e seus filhos
    for i, (no, valor, no_esquerda, filho_esquerda, no_direita, filho_direita) in enumerate(no_e_filhos):
        if filho_esquerda is not None:
            dot.edge(str(no), str(no_esquerda))
        if filho_direita is not None:
            dot.edge(str(no), str(no_direita))


novo_1 = No(7)
novo_2 = No(7, novo_1, None)
novo_3 = No(6)
novo_1 = No(9, novo_3, novo_2)

novo_4 = No(5)
novo_5 = No(7)
novo_6=No(8, novo_4, novo_5)
novo_7 = No(5, None, novo_6)

novo_8=No(6, novo_1, novo_7)


desenhar(dot, novo_8)
# Renderiza o gráfico e salva em um arquivo PNG
output_file = dot.render(filename=output_path, format='png', cleanup=False)


        
    
