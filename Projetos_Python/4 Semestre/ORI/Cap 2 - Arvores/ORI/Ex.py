from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [21, 32, 40, 45, 15, 7, 2, 33, 41, 52, 61]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)
Desenho.desenhar(raiz)