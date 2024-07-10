from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [10, 5, 20, 15]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)
raiz = ArvoreAVL.inserir(raiz, 11)
Desenho.desenhar(raiz)