"""
3. Implemente as operações:
a. encontrar antecessor
b. encontrar máximo
"""
from Impressao import Desenho

class No:
    """Esta classe representa um nó/elemento de uma árvore.
       Equivalente a função criar_arvore em C -- no slide
    """ 
    def __init__(self, valor, esquerda=None, direita=None, pai=None):
        self.valor = valor
        self.esquerda = esquerda
        self.direita = direita
        self.pai = pai

class Arvore:
    """Esta classe contém funções para a manipulação de árvores binárias."""

    def procurar_no(raiz: No, x: int) -> No:
        if raiz is None or raiz.valor == x:
            return raiz
        if x < raiz.valor:
            return Arvore.procurar_no(raiz.esquerda, x)
        return Arvore.procurar_no(raiz.direita, x)

    def numero_nos(raiz: No) -> int:
        if raiz is None:
            return 0
        return 1 + Arvore.numero_nos(raiz.esquerda) + Arvore.numero_nos(raiz.direita)
    
    def altura(raiz: No) -> int:
        if raiz is None:
            return 0
        return 1 + max(Arvore.altura(raiz.esquerda), Arvore.altura(raiz.direita))

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
            
    def percurso_em_largura(raiz: No):
        f = list()
        f.append(raiz)  # insere no fim
        while len(f) > 0:
            raiz = f.pop(0)  # removo no início
            if raiz is not None:
                f.append(raiz.esquerda)
                f.append(raiz.direita)
                print(raiz.valor, end=' ')

    def buscar(raiz: No, valor):
        if raiz is None or valor == raiz.valor:
            return raiz
        if valor < raiz.valor:
            return Arvore.buscar(raiz.esquerda, valor)
        else:
            return Arvore.buscar(raiz.direita, valor)
        
    def inserir(raiz: No, valor):
        if raiz is None:
            return No(valor)
        if valor < raiz.valor:
            novo_no = Arvore.inserir(raiz.esquerda, valor)
            raiz.esquerda = novo_no
            novo_no.pai = raiz
        else:
            novo_no = Arvore.inserir(raiz.direita, valor)
            raiz.direita = novo_no
            novo_no.pai = raiz
        return raiz
    
    def minimo(raiz: No):
        atual = raiz
        while atual is not None and atual.esquerda is not None:
            atual = atual.esquerda
        return atual

    def maximo(raiz: No):
        atual = raiz
        while atual is not None and atual.direita is not None:
            atual = atual.direita
        return atual
    
    def sucessor(x: No):
        if x.direita is not None:
            return Arvore.minimo(x.direita)
        atual = x.pai
        while atual is not None and x == atual.direita:
            x = atual
            atual = atual.pai
        return atual
    
    def antecessor(x: No):
        if x.esquerda is not None:
            return Arvore.maximo(x.esquerda)
        atual = x.pai
        while atual is not None and x == atual.esquerda:
            x = atual
            atual = atual.pai
        return atual

# Criando a árvore e inserindo valores
raiz = No(0)
raiz = No(5)
Arvore.inserir(raiz, 3)
Arvore.inserir(raiz, 8)
Arvore.inserir(raiz, 2)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 7)
Arvore.inserir(raiz, 9)

# Testando a função antecessor
no = Arvore.procurar_no(raiz, 8)
antecessor = Arvore.antecessor(no)
print("Antecessor de 8:", antecessor.valor if antecessor else "None")

# Testando a função máximo
#maximo = Arvore.maximo(raiz)
#print("Máximo da árvore:", maximo.valor)
Desenho.desenhar(raiz)