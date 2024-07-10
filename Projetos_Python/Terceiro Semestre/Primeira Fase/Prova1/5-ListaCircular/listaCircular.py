class No:
    """Esta classe representa um nó/elemento de uma lista encadeada circular."""
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = self
class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
    inicio=None

    def mostrar (self):
        atual=self.inicio
        if (atual!=None):
            print(atual.valor, end=' ')
            atual=atual.prox
        while atual!=self.inicio:
            print(atual.valor, end=' ')
            atual=atual.prox

    def insereInicio (self, novo: No):
        if self.inicio==None:  # se lista é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            novo.prox = self.inicio
            while ultimo.prox!=self.inicio:
                ultimo=ultimo.prox
            self.inicio=novo
            ultimo.prox=self.inicio

    def insereFim (self, novo: No):
        if self.inicio==None: # se é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=self.inicio:
                ultimo=ultimo.prox

            ultimo.prox=novo
            novo.prox=self.inicio

    def insereOrdenado(self, novo: No):

        if self.inicio == None:
            self.inicio=novo
        else:
            anterior=self.inicio

            while (anterior.prox != self.inicio and anterior.prox.valor<novo.valor):
                anterior=anterior.prox

            novo.prox=anterior.prox
            anterior.prox=novo

    def removeInicio(self):

        #se lista nao ta vazia
        if self.inicio:
            alvo = self.inicio
            ultimo = self.inicio

            while ultimo.prox!=self.inicio:
                ultimo=ultimo.prox

            self.inicio=alvo.prox
            ultimo.prox=self.inicio

        return alvo # podemos retornar o elemento removido, caso a aplicação preciso usar para algum propósito
        

    def removeFim(self):
        alvo = self.inicio
        anterior = self.inicio
        
        #se lista nao ta vazia
        if self.inicio:
            while (alvo.prox != self.inicio):
                anterior = alvo
                alvo=alvo.prox
            if alvo == self.inicio:
                self.inicio=None
            anterior.prox=self.inicio

        return alvo # podemos retornar o elemento removido, caso a aplicação preciso usar para algum propósito

    def buscar (self, valor):
        alvo=self.inicio
        if alvo.valor==valor:
            return alvo
        else:
            alvo=alvo.prox
        while alvo!=self.inicio and alvo.valor!=valor:
            alvo=alvo.prox
        if alvo!=self.inicio:
            return alvo
        return None
              
            
    def removeAlvo (self, alvo: No):
        anterior=self.inicio
        ultimo=self.inicio
        
        if self.inicio:
            if self.inicio==alvo: # se é o elemento do inicio
                if(self.inicio.prox==self.inicio):
                    self.inicio=None
                else:
                    while ultimo.prox!=self.inicio:
                        ultimo=ultimo.prox

                    self.inicio=self.inicio.prox
                    ultimo.prox=self.inicio

            else:
                while anterior.prox!=alvo:
                    anterior=anterior.prox
                anterior.prox=alvo.prox
    
#inicializa uma lista vazia
lista_1=Lista()
lista_2=Lista()
lista_3=Lista()

novo=No(0)
lista_1.insereInicio(novo)
novo=No(1)
lista_1.insereInicio(novo)
novo=No(2)
lista_1.insereInicio(novo)
novo=No(3)
lista_1.insereFim(novo)
print("Lista 1: ", end=' ')
lista_1.mostrar()
print()

novo=No(2)
lista_2.insereInicio(novo)
novo=No(3)
lista_2.insereInicio(novo)
novo=No(4)
lista_2.insereInicio(novo)
print("Lista 2: ", end=' ')
lista_2.mostrar()
print()

novo=No(2)
lista_3.insereOrdenado(novo)
novo=No(5)
lista_3.insereOrdenado(novo)
novo=No(3)
lista_3.insereOrdenado(novo)
print("Lista 3: ", end=' ')
lista_3.mostrar()
print()

lista_3.removeInicio()
print("Lista 3 apos remoção no inicio: ", end=' ')
lista_3.mostrar()
print()

	
lista_3.removeFim()
print("Lista 3 apos remoção no fim: ", end=' ')
lista_3.mostrar()
print()


#removendo um elemento específico da lista 1
novo=lista_1.buscar(1)
lista_1.removeAlvo(novo)
print("Lista 1 apos remoção do valor 1: ", end=' ')
lista_1.mostrar()

"""
Lista 1: 2 1 0 3 
Lista 2: 4 3 2 
Lista 3: 2 3 5 
Lista 3 apos remoção no inicio: 3 5 
Lista 3 apos remoção no fim: 3 
Lista 1 apos remoção do valor 1: 2 0 3
"""