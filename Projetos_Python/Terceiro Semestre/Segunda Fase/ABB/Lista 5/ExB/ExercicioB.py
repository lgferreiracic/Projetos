from Arvore import No, Arvore
from Impressao import Desenho
#unção recursiva que apaga todas as folhas de uma árvore que tenham a chave
#igual a um valor dado
def removeFolhas(raiz: No, valor):
    if raiz==None:
        return None
    if raiz.esquerda==None and raiz.direita==None and raiz.valor==valor:
        raiz=None
        return raiz
    raiz.esquerda=removeFolhas(raiz.esquerda, valor)
    raiz.direita=removeFolhas(raiz.direita, valor)

    return raiz
    

novo_1 = No(7)
novo_2 = No(7, novo_1, None)
novo_3 = No(6)
novo_1 = No(9, novo_3, novo_2)

novo_4 = No(5)
novo_5 = No(7)
novo_6=No(8, novo_4, novo_5)
novo_4 = No(5, None, novo_6)

novo_2=No(6, novo_1, novo_4)

print("Árvore:")
removeFolhas(novo_2, 7)
Desenho.desenhar(novo_2)      