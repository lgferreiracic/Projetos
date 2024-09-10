class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = proximo

class Pilha:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
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
        
    def removeFim(self):
        if self.inicio==None:
            print("Pilha Vazia")
            return
        anterior=self.inicio
        ultimo=self.inicio

        while ultimo.prox!=None:
            anterior=ultimo
            ultimo=ultimo.prox
        if self.inicio==ultimo:
            self.inicio=None
        anterior.prox=None
        return ultimo

class Fila:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
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

    def removeInicio(self):

        #se lista nao ta vazia
        if self.inicio:
            alvo = self.inicio
            self.inicio=alvo.prox

        return alvo # podemos retornar o elemento removido, caso a aplicação preciso usar para algum propósito

teste = Pilha ()
teste.insereFim(No(1))
teste.insereFim(No(1))
teste.insereFim(No(1))
teste.removeFim()
teste.mostrar()