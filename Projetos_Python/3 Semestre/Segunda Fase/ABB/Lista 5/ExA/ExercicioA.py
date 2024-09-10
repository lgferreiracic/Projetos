from Arvore import No, Arvore
from Impressao import Desenho

#Função que calcula o número de folhas em uma árvore dada

def contaFolhas(raiz: No):
    if raiz == None:
        return 0
    if raiz.esquerda==None and raiz.direita==None:
        return 1
    n_esquerda=contaFolhas(raiz.esquerda)
    n_direita=contaFolhas(raiz.direita)
    return n_esquerda + n_direita


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
Arvore.pre_ordem(novo_2)
print(f"Número de folhas na árvore: {contaFolhas(novo_2)}")
Desenho.desenhar(novo_2)      