from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 1, 5, 13, 15, 8, 2, 3]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)