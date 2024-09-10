class No:
    """Esta classe representa um nó/elemento de uma lista encadeada circular."""
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = self
class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
    inicio=None

    def mostrar (self): #Metodo para impressao da lista
        atual=self.inicio
        if (atual!=None):
            print(atual.valor, end=' ')
            atual=atual.prox
        while atual!=self.inicio:
            print(atual.valor, end=' ')
            atual=atual.prox

    def insereFim (self, novo: No): #Metodo para insercao no fim da lista
        if self.inicio==None: # se é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=self.inicio:
                ultimo=ultimo.prox

            ultimo.prox=novo
            novo.prox=self.inicio
            
    def removeAlvo (self, alvo: No): #Metodo para remocao de um no especifico
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

    def eliminacao(self, K): #Metodo da eliminacao que recebe k, sendo este o numero de eliminacao
        atual=self.inicio
        while self.inicio.prox!=self.inicio: #O laco de repeticao so encerra quando existe 1 unico elemento na lista
            for i in range(1, K): #O laco para encontrar o eliminado
                atual=atual.prox
            alvo=atual
            atual=atual.prox
            self.removeAlvo(alvo) #Remocao do eliminado

quant_testes=int(input()) #Entrada da quantidade de testes
while quant_testes:
    amigos=Lista()
    entrada=input() #Entrada do numero de amigos e do numero de eliminacao
    entrada=entrada.split()
    N=int(entrada[0])
    K=int(entrada[1])
    if N>1:
        for i in range(1,N+1): #Laço para insersão dos amigos na lista
            novo=No(i)
            amigos.insereFim(novo)

        amigos.eliminacao(K) #Chamada do metodo de eliminação
        amigos.mostrar() #Resultado
        print()
    else:
        print('1')
    
    quant_testes-=1
