from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 8, 11, 5, 9, 15, 14, 16]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)