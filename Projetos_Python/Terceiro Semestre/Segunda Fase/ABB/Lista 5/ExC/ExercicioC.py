from Arvore import No, Arvore
from Impressao import Desenho

def comparar(raiz1: No, raiz2: No):
    if raiz1 == None and raiz2 == None:
        return True
    if raiz1 == None and raiz2 !=None or raiz1 != None and raiz2 == None:
        return False
    if raiz1.valor != raiz2.valor:
        return False
    if comparar(raiz1.esquerda, raiz2.esquerda) == False or comparar(raiz1.direita, raiz2.direita)== False:
        return False
    return True

folha1 = No(6, None, None)
folha2 = No(9, folha1, None)
folha3 = No(5, None, None)
folha4 = No(8, None, folha3)
folha5 = No(7, folha4, None)
folha6 = No(6, folha2, folha5)

folha11 = No(6, None, None)
folha22 = No(9, folha11, None)
folha33 = No(5, None, None)
folha44 = No(8, folha33, None)
folha55 = No(7, None, folha44)
folha66 = No(6, folha2, folha55)

if comparar(folha6, folha66):
    print('Verdadeiro')
else:
    print('Falso')

if comparar(folha6, folha6):
    print('Verdadeiro')
else:
    print('Falso')

Desenho.desenhar(folha6)