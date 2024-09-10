from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [1, 2, 3, 4, 5, 6, 7]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)