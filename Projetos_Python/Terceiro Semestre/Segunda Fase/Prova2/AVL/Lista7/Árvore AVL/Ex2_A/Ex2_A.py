from ArvoreAVL import ArvoreAVL
from Impressao import Desenho

raiz = None
raiz = ArvoreAVL.inserir(raiz, 10)
raiz = ArvoreAVL.inserir(raiz, 8)
raiz = ArvoreAVL.inserir(raiz, 11)
raiz = ArvoreAVL.inserir(raiz, 5)
raiz = ArvoreAVL.inserir(raiz, 9)
raiz = ArvoreAVL.inserir(raiz, 12)
raiz = ArvoreAVL.inserir(raiz, 13)
raiz = ArvoreAVL.balancearFinal(raiz)
Desenho.desenhar(raiz)