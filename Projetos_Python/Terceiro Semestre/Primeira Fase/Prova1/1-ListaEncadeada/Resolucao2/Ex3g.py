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

    def combinar (self, inicio1:No, inicio2:No):
        aux1=inicio1
        aux2=inicio2

        while aux1!=None or aux2!=None:
            if aux1!=None and aux2!=None:
                if aux1.valor<aux2.valor:
                    novo=No(aux1.valor)
                    self.insereFim(novo)
                    aux1=aux1.prox
                else:
                    novo=No(aux2.valor)
                    self.insereFim(novo)
                    aux2=aux2.prox

            elif (aux1==None and aux2!=None):
                novo=No(aux2.valor)
                self.insereFim(novo)
                aux2=aux2.prox
            else:
                novo=No(aux1.valor)
                self.insereFim(novo)
                aux1=aux1.prox
                
                

#inicializa uma lista vazia
lista_1=Lista()
lista_2=Lista()
# Adiciona alguns nós
for i in range(1,15,2):
    lista_1.insereFim(No(i))

for i in range(1,15,3):    
    lista_2.insereFim(No(i))

lista_1.mostrar()
print()
lista_2.mostrar()
print()

lista_3=Lista()
lista_3.combinar(lista_1.inicio, lista_2.inicio)
lista_3.mostrar()