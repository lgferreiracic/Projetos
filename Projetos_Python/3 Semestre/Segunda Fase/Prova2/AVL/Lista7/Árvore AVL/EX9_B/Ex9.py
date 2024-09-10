from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [20, 10, 30, 5, 15]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)
raiz = ArvoreAVL.inserir(raiz, 11)
Desenho.desenhar(raiz)