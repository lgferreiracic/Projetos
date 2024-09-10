from Impressao import Desenho
class No:
    """Esta classe representa um nó/elemento de uma árvore.
       Equivalente a função criar_arvore em C -- no slide
    """ 
    def __init__(self, valor, esquerda=None, direita=None):
        self.valor = valor
        self.esquerda = esquerda
        self.direita = direita

# Função para contar o número de folhas na árvore
def contar_folhas(raiz):
    if raiz is None:
        return 0
    if raiz.esquerda is None and raiz.direita is None:
        return 1
    return contar_folhas(raiz.esquerda) + contar_folhas(raiz.direita)

# Função para apagar folhas com um valor especificado
def apagar_folhas(raiz, chave):
    if raiz is None:
        return None

    if raiz.esquerda is None and raiz.direita is None and raiz.valor == chave:
        del raiz
        return None

    raiz.esquerda = apagar_folhas(raiz.esquerda, chave)
    raiz.direita = apagar_folhas(raiz.direita, chave)

    return raiz

# Função para comparar se duas árvores binárias são iguais
def sao_iguais(raiz1, raiz2):
    if raiz1 is None and raiz2 is None:
        return True

    if (raiz1 is None and raiz2 is not None) or (raiz1 is not None and raiz2 is None):
        return False

    if raiz1.valor != raiz2.valor:
        return False

    return sao_iguais(raiz1.esquerda, raiz2.esquerda) and sao_iguais(raiz1.direita, raiz2.direita)

# Função para imprimir a árvore em ordem
def imprimir_arvore_em_ordem(raiz):
    if raiz is None:
        return
    imprimir_arvore_em_ordem(raiz.esquerda)
    print(raiz.valor, end=" ")
    imprimir_arvore_em_ordem(raiz.direita)

# Criando a árvore binária
raiz1 = No(1)

raiz2 = No(1)
raiz2 = apagar_folhas(raiz2, 1)

# Impressão da árvore após remoção das folhas
imprimir_arvore_em_ordem(raiz2)
Desenho.desenhar(raiz2)
print()

