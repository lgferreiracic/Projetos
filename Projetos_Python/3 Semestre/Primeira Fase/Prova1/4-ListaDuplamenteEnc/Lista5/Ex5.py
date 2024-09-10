"""
Implemente uma função que, dada uma lista, retorne duas outras listas, a primeira  com todos 
os elementos pares e a segunda com todos os elementos ímpares da  lista inicial. 
Mantenha a ordem relativa dos elementos. 
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
    
    def parImpar(self):
        aux = self.inicio
        lista_pares = Lista()  # Lista para armazenar os números pares
        lista_impares = Lista()  # Lista para armazenar os números ímpares
        
        while aux != None:
            if aux.valor % 2 == 0:  # Se for par, adiciona à lista de pares
                valorMover = aux.valor
                novo = No(valorMover)
                lista_pares.inserirFim(novo)
            else:  # Se for ímpar, adiciona à lista de ímpares e remove da lista principal
                valorMover = aux.valor
                novo = No(valorMover)
                lista_impares.inserirFim(novo)
                self.removerAlvo(aux)
            aux = aux.prox
        
        return lista_pares, lista_impares
    
    def parImpar2(self):
        par=Lista()
        impar=Lista()
        if self.inicio!=None:
            aux=self.inicio
            while aux!=None:
                if aux.valor%2==0:
                    par.inserirFim(No(aux.valor))
                else:
                    impar.inserirFim(No(aux.valor))
                aux=aux.prox
            return par, impar

lista1 = Lista()
for i in range(1, 6):
    novo = No(i)
    lista1.inserirFim(novo)

lista_pares, lista_impares = lista1.parImpar2()

print("Lista de números pares:")
lista_pares.mostrar()

print("\nLista de números ímpares:")
lista_impares.mostrar()