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

    def insereInicio (self, novo: No):
        if self.inicio==None:  # se lista é vazia
            self.inicio=novo
        else:
            novo.prox = self.inicio
            self.inicio=novo

    def insereFim (self, novo: No):
        if self.inicio==None: # se é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=None:
                ultimo=ultimo.prox

            ultimo.prox=novo


    def insereOrdenado(self, novo: No):

        if self.inicio == None:
            self.inicio=novo
        
        else:
            anterior=self.inicio

            while (anterior.prox != None and anterior.prox.valor<novo.valor):
                anterior=anterior.prox

            novo.prox=anterior.prox
            anterior.prox=novo

    def removeInicio(self):

        #se lista nao ta vazia
        if self.inicio:
            alvo = self.inicio
            self.inicio=alvo.prox

        return alvo # podemos retornar o elemento removido, caso a aplicação preciso usar para algum propósito
        

    def removeFim(self):
        alvo = self.inicio
        anterior = self.inicio
        
        #se lista nao ta vazia
        if self.inicio:
            while (alvo.prox != None):
                anterior = alvo
                alvo=alvo.prox
            if alvo == self.inicio:
                self.inicio=None
            anterior.prox=None

        return alvo # podemos retornar o elemento removido, caso a aplicação preciso usar para algum propósito

    def buscar (self, valor):
        alvo=self.inicio
        while alvo!=None and alvo.valor!=valor:
            alvo=alvo.prox
        return alvo
        
            
    def removeAlvo (self, alvo: No):
        anterior=self.inicio
        
        if self.inicio==alvo: # se é o elemento do inicio
            self.inicio=self.inicio.prox
        else:
            while (anterior.prox != alvo):
                anterior=anterior.prox
            anterior.prox=alvo.prox
    
def func (inicio: No)->int:
    atual=inicio
    if atual is not None:
        while atual.prox is not None:
            if atual.prox.valor > atual.valor:
                print('a')
                return 0
            atual=atual.prox
    return 1

lista=Lista()
for i in range(0, 5):
    novo=No(i)
    lista.insereFim(novo)
novo=No(1)
lista.insereFim(novo)
lista2=Lista()
for i in range(5, 0, -1):
    novo=No(i)
    lista.insereFim(novo)

print(func(lista.inicio))
print(func(lista2.inicio))
