from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 8, 15, 5, 9, 20, 3, 7, 17]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)

raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)