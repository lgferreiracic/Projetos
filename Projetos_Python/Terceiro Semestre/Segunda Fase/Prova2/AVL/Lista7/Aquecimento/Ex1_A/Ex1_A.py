from ArvoreAVL import Arvore
from Impressao import Desenho

raiz = None
raiz = Arvore.inserir(raiz, 10)
raiz = Arvore.inserir(raiz, 5)
raiz = Arvore.inserir(raiz, 30)
raiz = Arvore.inserir(raiz, 40)
raiz = Arvore.inserir(raiz, 35)
raiz = Arvore.inserir(raiz, 11)
raiz = Arvore.inserir(raiz, 13)
raiz = Arvore.inserir(raiz, 32)

Desenho.desenhar(raiz)