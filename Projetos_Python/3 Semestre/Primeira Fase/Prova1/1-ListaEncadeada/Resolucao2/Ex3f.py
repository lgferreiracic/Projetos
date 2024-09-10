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

    def insereFim (self, novo: No):
        if self.inicio==None: # se é vazia
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=None:
                ultimo=ultimo.prox

            ultimo.prox=novo

    def buscar (self, valor):
        alvo=self.inicio
        while alvo!=None and alvo.valor!=valor:
            alvo=alvo.prox
        return alvo
        
            
    def removeAlvo (self, alvo: No):
        if self.inicio==None:
            return None
        anterior=self.inicio
        
        if self.inicio==alvo: # se é o elemento do inicio
            self.inicio=self.inicio.prox
        else:
            while (anterior.prox != alvo):
                anterior=anterior.prox
            anterior.prox=alvo.prox
        return alvo

    def parImpar(self):
        if self.inicio==None:
            print('Lista vazia')
            exit(1)
        par=Lista()
        impar=Lista()
        auxiliar=self.inicio

        while auxiliar!=None:
            if auxiliar.valor%2==0:
                novo=No(auxiliar.valor)
                par.insereFim(novo)
            else:
                novo=No(auxiliar.valor)
                impar.insereFim(novo)
            auxiliar=auxiliar.prox
        return par, impar

#inicializa uma lista vazia
lista_1=Lista()

# Adiciona alguns nós
for i in range(1,10):
    lista_1.insereFim(No(i))
lista_1.mostrar()
print()

lista_par=Lista()
lista_impar=Lista()

lista_par, lista_impar = lista_1.parImpar()
lista_par.mostrar()
print()
lista_impar.mostrar()


