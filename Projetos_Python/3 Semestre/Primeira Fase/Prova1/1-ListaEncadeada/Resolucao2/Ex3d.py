class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = proximo

class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
    inicio=None

    def mostrar (self):
        atual=self.inicio
        while atual!=None:
            print(atual.valor, end=' ')
            atual=atual.prox

    def insereOrdRev(self, novo:No):
        if self.inicio==None:
            self.inicio=novo
        else:
            anterior=self.inicio
            while anterior.prox!=None and anterior.prox.valor>novo.valor:
                anterior=anterior.prox
            novo.prox=anterior.prox
            anterior.prox=novo

#inicializa uma lista vazia
lista_1=Lista()

# Adiciona alguns nós
novo=No(1)
lista_1.insereOrdRev(novo)

novo=No(2)
lista_1.insereOrdRev(novo)

novo=No(2)
lista_1.insereOrdRev(novo)

novo=No(3)
lista_1.insereOrdRev(novo)

novo=No(1)
lista_1.insereOrdRev(novo)

lista_1.mostrar()
print()

