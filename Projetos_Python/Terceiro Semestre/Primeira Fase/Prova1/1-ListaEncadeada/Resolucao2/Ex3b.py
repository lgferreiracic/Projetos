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
    
    def removeTudo (self, valor):
        alvo=self.buscar(valor)
        while alvo:
            self.removeAlvo(alvo)
            alvo=self.buscar(valor)

    def contar(self):
        contagem=0
        atual=self.inicio
        while atual.prox!=None:
            atual=atual.prox
            contagem+=1
        return contagem

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

print(lista_1.contar())

