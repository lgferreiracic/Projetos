class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = proximo

class Lista:
    inicio=None

    def mostrar (self):
        atual=self.inicio
        while atual!=None:
            print(atual.valor, end=' ')
            atual=atual.prox

    def insereFim (self, novo: No):
        if self.inicio==None: # se é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=None:
                ultimo=ultimo.prox

            ultimo.prox=novo

    def deslocar(self, i):
        cont=0
        aux=self.inicio
        anterior=self.inicio

        while cont!=i:
            anterior=aux
            aux=aux.prox
            cont+=1

        anterior.prox=aux.prox
        aux.prox=aux.prox.prox
        anterior.prox.prox=aux

teste=Lista()
for i in range(0,5):
    teste.insereFim(No(i))

teste.deslocar(2)

teste.mostrar()