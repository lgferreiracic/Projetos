class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, valor, proximo=None, anterior=None):
        self.valor = valor
        self.prox = proximo
        self.ant = anterior

class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""

    inicio = None

    def mostrar (self): #Metodo para imprimir a lista
        atual=self.inicio
        while atual!=None:
            print(atual.valor, end=' ')
            atual=atual.prox

    def inserirFim (self, novo: No): #Metodo para inserir no fim da lista
        if self.inicio==None:
            self.inicio=novo
        else:
            ultimo=self.inicio
            while ultimo.prox!=None:
                ultimo=ultimo.prox

            ultimo.prox=novo
            novo.ant=ultimo


    #Metodo para realizar a soma inversa, recebe o inicio de duas listas
    def somaInversa(self, inicio_1, inicio_2 ): 
        aux1=inicio_1       
        aux2=inicio_2
        while aux2.prox!=None: #Percorre ate o final da segunda lista
            aux2=aux2.prox
        while aux2!=None: #Poderia ser aux1!=None pois as listas tem o mesmo tamanho
            novo=No(aux1.valor+aux2.valor) 
            self.inserirFim(novo) 
            aux1=aux1.prox #Percorre a primeira lista na ordem normal
            aux2=aux2.ant #Percorre a lista de tras pra frente


while True:
    sequencia_1=Lista()
    sequencia_2=Lista()
    sequencia_3=Lista() #Lista que tera os valores da soma inversa
    N=int(input())
    if N==0: #Condicao de parada da iteracao
        break
    ent_sequencia_1=input() #Entrada dos valores da primeira lista  
    ent_sequencia_2=input() #Entrada dos valores da segunda lista
    ent_sequencia_1=ent_sequencia_1.split()
    ent_sequencia_2=ent_sequencia_2.split()

    for i in range (0,N): #Iteracao para insercao nas listas dos valores das entradas
        novo=No(int(ent_sequencia_1[i]))
        sequencia_1.inserirFim(novo)
        novo=No(int(ent_sequencia_2[i]))
        sequencia_2.inserirFim(novo)


    sequencia_3.somaInversa(sequencia_1.inicio, sequencia_2.inicio) #Chamada do metodo de somaInversa
    sequencia_3.mostrar() #Saida
    print()


