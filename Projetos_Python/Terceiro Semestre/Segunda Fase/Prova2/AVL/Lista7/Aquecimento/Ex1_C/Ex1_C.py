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
raiz = Arvore.remover_rec(raiz, 40)
raiz = Arvore.remover_rec(raiz, 30)
print('Pre-Ordem')
Arvore.pre_ordem(raiz)
print('\nPos-Ordem')
Arvore.pos_ordem(raiz)
print('\nIn-Ordem')
Arvore.in_ordem(raiz)
Desenho.desenhar(raiz)