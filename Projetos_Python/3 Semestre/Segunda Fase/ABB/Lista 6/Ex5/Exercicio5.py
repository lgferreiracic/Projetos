"""5. Escreva uma função para imprimir todos os elementos em um determinado intervalo."""
from Arvore import No, Arvore
from Impressao import Desenho

def imprime_intervalo(raiz: No, x, y):
    if raiz is not None:
        imprime_intervalo(raiz.esquerda, x, y)
        if raiz.valor>x and raiz.valor<y:
            print(raiz.valor, end=' ')
        imprime_intervalo(raiz.direita, x, y)

raiz=No(17)
Arvore.inserir(raiz, 3)
Arvore.inserir(raiz, 5)
Arvore.inserir(raiz, 15)
Arvore.inserir(raiz, 20)
Arvore.inserir(raiz, 23)
Arvore.inserir(raiz, 11)
Arvore.inserir(raiz, 16)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 8)
Arvore.inserir(raiz, 24)
Arvore.inserir(raiz, 11)
Arvore.inserir(raiz, 2)
Arvore.inserir(raiz, 7)
Arvore.inserir(raiz, 16)
Arvore.inserir(raiz, 4)
Arvore.inserir(raiz, 6)
Arvore.inserir(raiz, 9)
Arvore.inserir(raiz, 23)
Arvore.inserir(raiz, 22)

imprime_intervalo(raiz, 10, 20)
Desenho.desenhar(raiz)