from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 1, 5, 13, 15, 8, 2, 3]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)
ArvoreAVL.remover_rec(raiz, 5)
ArvoreAVL.remover_rec(raiz, 13)
ArvoreAVL.remover_rec(raiz, 1)
ArvoreAVL.remover_rec(raiz, 8)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)