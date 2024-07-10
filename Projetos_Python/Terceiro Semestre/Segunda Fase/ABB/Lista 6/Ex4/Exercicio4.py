"""4. Escreva uma função para imprimir os nós de uma árvore de busca em ordem inversa."""
from Arvore import No, Arvore
from Impressao import Desenho

def imprimirOrdemRev(raiz: No):
    if raiz is not None:
        imprimirOrdemRev(raiz.direita)
        print(raiz.valor, end=' ')
        imprimirOrdemRev(raiz.esquerda)

raiz=No(1)
Arvore.inserir(raiz, 5)
Arvore.inserir(raiz, 8)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 6)
Arvore.inserir(raiz, 3)
Arvore.inserir(raiz, 9)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 8)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 6)
Arvore.inserir(raiz, 1)
Arvore.inserir(raiz, 2)

imprimirOrdemRev(raiz)

Desenho.desenhar(raiz)