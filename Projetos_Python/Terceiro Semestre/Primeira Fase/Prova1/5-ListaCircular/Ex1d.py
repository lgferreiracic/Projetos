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
    
    def concatenar(self, inicio2: No):
        aux1=self.inicio
        aux2=inicio2

        if self.inicio==None:
            self.inicio=inicio2
        elif inicio2==None:
            return
        else:
            while aux1.prox!=self.inicio:
                aux1=aux1.prox
            while aux2.prox!=inicio2:
                aux2=aux2.prox
            aux1.prox=inicio2
            aux2.prox=self.inicio

lista1=Lista()
lista2=Lista()

for i in range(1,5):
    lista1.insereFim(No(i))
    lista2.insereFim(No(i+4))

lista1.mostrar()
print()
lista2.mostrar()
print()
lista1.concatenar(lista2.inicio)
lista1.mostrar()

