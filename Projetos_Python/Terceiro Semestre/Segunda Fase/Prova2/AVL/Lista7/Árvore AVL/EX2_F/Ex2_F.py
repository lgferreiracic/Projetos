from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 8, 12, 5, 9, 11, 15, 3, 7, 16, 2]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)