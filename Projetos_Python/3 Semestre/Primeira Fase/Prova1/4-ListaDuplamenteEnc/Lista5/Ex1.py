"""
Implemente uma função para concatenar duas listas duplamente encadeadas
"""

class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, valor, proximo=None, anterior=None):
        self.valor = valor
        self.prox = proximo
        self.ant = anterior

class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""

    inicio = None

    def mostrar (self):
        atual=self.inicio
        while atual!=None:
            print(atual.valor, end=' ')
            atual=atual.prox

    def mostrarOrdemReversa(self):
        ultimo = self.inicio
        
        while ultimo.prox != None:
            ultimo = ultimo.prox
        
        while ultimo != None:
            print(ultimo.valor)
            ultimo = ultimo.ant

    def inserirInicio (self, novo: No):
        if self.inicio==None:
            self.inicio=novo
        else:
            novo.prox = self.inicio
            self.inicio.ant=novo
            self.inicio=novo
       

    def inserirFim (self, novo: No):
        if self.inicio==None:
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=None:
                ultimo=ultimo.prox

            ultimo.prox=novo
            novo.ant=ultimo

    def inserirOrdenado(self, novo: No):
        atual=self.inicio

        if self.inicio == None:
            self.inicio=novo
        
        else:
            # verifico primeiro se atual prox não é none, e só então checo seu valor
            while (atual.prox and atual.prox.valor<novo.valor):
                atual=atual.prox

            novo.prox=atual.prox
            novo.ant=atual
            if atual.prox != None:
                atual.prox.ant=novo
            atual.prox=novo

    def removerInicio(self):
        alvo=self.inicio
        
        #se lista nao ta vazia
        if self.inicio:
            self.inicio=self.inicio.prox
            #se lista está vazia apos remoção -- tinha apenas 1 elemento
            if self.inicio:
                self.inicio.ant=None
        
        alvo.prox=None
        alvo.ant=None
        return alvo

    def buscar (self, valor):
        alvo=self.inicio
        while alvo!=None and alvo.valor!=valor:
            alvo=alvo.prox
        return alvo
        
            
    def removerAlvo (self, alvo: No):
        anterior=alvo.ant
        proximo=alvo.prox
        
        if anterior!=None:
            anterior.prox=alvo.prox
        
        if proximo!=None:
            proximo.ant=alvo.ant
        
        if alvo==self.inicio:
            self.inicio=alvo.prox

    def concatenar (self, lista2: list):
        atual=self.inicio
        while atual.prox!=None:
            atual=atual.prox
        atual.prox=lista2.inicio
        lista2.inicio.ant=atual

    def concatenar2(self, inicio2: No):
        aux=self.inicio
        if self.inicio==None:
            self.inicio=inicio2
            return
        if inicio2!=None:
            while aux.prox!=None:
                aux=aux.prox
            aux.prox=inicio2
            inicio2.ant=aux


lista1=Lista()
lista2=Lista()

for i in range(0,3):
    novo=No(i)
    lista1.inserirFim(novo)

for i in range(3,6):
    novo=No(i)
    lista2.inserirFim(novo)

#lista1.concatenar(lista2)
lista1.concatenar2(lista2.inicio)
lista1.mostrar()
