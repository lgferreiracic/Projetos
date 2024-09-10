class No:
    def __init__(self, valor, proximo=None):
        self.valor = valor
        self.prox = proximo

class Lista:
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
    def compara(self, inicio2: No):
        tamanho=0
        aux1=self.inicio
        aux2=inicio2
        while aux1!=None and aux2!=None:
            if aux1.prox==None and aux2.prox!=None:
                tamanho = 1
                break
            elif aux1.prox!=None and aux2.prox==None:
                tamanho=-1
                break
            aux1=aux1.prox
            aux2=aux2.prox

        if aux1==None and aux2!=None:
            tamanho=1
            return tamanho
        elif aux1!=None and aux2==None:
            tamanho=-1
            return tamanho
        return tamanho
    
lista1=Lista()
listaIgual=Lista()
listaMaior=Lista()
listaMenor=Lista()

for i in range(1,6):
    lista1.insereFim(No(i))
    listaIgual.insereFim(No(i))

for i in range(1,8):
    listaMaior.insereFim(No(i))

for i in range(1,4):
    listaMenor.insereFim(No(i))

print(lista1.compara(listaIgual.inicio))
print(lista1.compara(listaMenor.inicio))
print(lista1.compara(listaMaior.inicio))



