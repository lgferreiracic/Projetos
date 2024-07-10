from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
valores = [30, 11, 50, 25, 35, 100, 36]
for valor in valores:
    raiz = ArvoreAVL.inserir(raiz, valor)
raiz = ArvoreAVL.remover_rec(raiz, 11)
Desenho.desenhar(raiz)