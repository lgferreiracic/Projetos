"""
Implemente uma função que remova todos os números múltiplos de k de uma lista  duplamente encadeada (k deve ser um inteiro recebido na função)
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

    def removeMultiplos(self, k):
        if self.inicio!=None:
            aux=self.inicio
            while aux!=None:
                if aux.valor%k==0:
                    print('a')
                    if aux.ant!=None:
                        aux.ant.prox=aux.prox
                    if aux.prox!=None:
                        aux.prox.ant=aux.ant
                aux=aux.prox
                
                    


teste=Lista()

for i in range(1,10):
    teste.inserirFim(No(i))

teste.removeMultiplos(2)
teste.mostrar()