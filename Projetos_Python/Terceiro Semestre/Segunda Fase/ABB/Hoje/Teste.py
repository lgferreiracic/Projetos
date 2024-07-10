from Arvore import No, Arvore
from Impressao import Desenho

raiz=No(15)
Arvore.inserir(raiz, 10)
Arvore.inserir(raiz, 20)
Arvore.inserir(raiz, 5)
Arvore.inserir(raiz, 12)
Arvore.inserir(raiz, 17)

Desenho.desenhar(raiz)