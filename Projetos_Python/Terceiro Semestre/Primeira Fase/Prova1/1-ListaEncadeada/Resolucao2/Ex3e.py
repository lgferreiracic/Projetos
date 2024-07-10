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

    def removeTerceiro(self):
        if self.inicio==None:
            print('Lista Vazia')
            return
        cont=1
        terceiro=self.inicio
        anterior=self.inicio

        while terceiro.prox!=None and cont<3:
            anterior=terceiro
            terceiro=terceiro.prox
            cont+=1

        anterior.prox=terceiro.prox
        return terceiro

#inicializa uma lista vazia
lista_1=Lista()

# Adiciona alguns nós
novo=No(1)
lista_1.insereFim(novo)

novo=No(2)
lista_1.insereFim(novo)

novo=No(2)
lista_1.insereFim(novo)

novo=No(3)
lista_1.insereFim(novo)

lista_1.removeTerceiro()

lista_1.mostrar()
print()

