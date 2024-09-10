class No:
    """Esta classe representa um nó/elemento de uma lista encadeada."""
    def __init__(self, cor, tamanho, nome, proximo=None): #Cada nó é uma camisa que possui cor, tamanho e nome do comprador
        self.cor = cor
        self.tamanho = tamanho
        self.nome = nome
        self.prox = proximo

class Lista:
    """Esta classe contem funções para a manipulação de lista encadeada."""
    
    inicio=None #Inicio da lista inicializado com None
   
    def mostrar (self): #Método para impressão das camisas na lista
        atual=self.inicio
        while atual!=None:
            print(atual.cor, atual.tamanho, atual.nome)
            atual=atual.prox

    def insereOrdenado(self, novo: No): #Método para inserir as camisas de forma ordenada
                                        #Segue o seguinte critério: Cor(Ordem ascendente) -> Tamanho(Ordem descendente) -> Nome(Ordem alfabética)
        if self.inicio == None: #Se a lista estiver vazia, insere no inicio
            self.inicio=novo 
        
        else: #Senão, percorremos a lista para definir onde inserir
            anterior=self.inicio

            while (anterior.prox != None and self.compara(novo, anterior.prox)!=-1): #Enquanto pelo critério de ordenação, a camisa for maior ou igual, caminhar na lista
                anterior=anterior.prox
            if (self.compara(novo, self.inicio)==-1): #Se a primeira camisa da lista for maior, a nova camisa é o a primeira da lista
                novo.prox=self.inicio
                self.inicio=novo
                return
            
            novo.prox=anterior.prox #Encontrando a posicao, inserimos a camisa na lista
            anterior.prox=novo

    def comparaCor(self, aux1: No, aux2: No): #Método para comparar a camisa por critério de cor
        if aux1.cor < aux2.cor: #-1 se a primeiro for menor
            return -1
        elif aux1.cor > aux2.cor: #1 se a primeiro for maior
            return 1
        return 0 #0 se forem iguais
        
    def comparaTamanho(self, aux1: No, aux2: No): #Método para comparar a camisa por critério de tamanho
        if aux1.tamanho > aux2.tamanho: #-1 se a primeiro for menor
            return -1
        elif aux1.tamanho < aux2.tamanho: #1 se a primeiro for maior
            return 1
        return 0 #0 se forem iguais
        
    def comparaNome(self, aux1: No, aux2: No): #Método para comparar a camisa por critério de nome
        if aux1.nome < aux2.nome: #-1 se a primeiro for menor
            return -1
        elif aux1.nome > aux2.nome: #1 se a primeiro for maior
            return 1
        return 0 #0 se forem iguais

    def compara(self, aux1: No, aux2: No): #Método para comparar a camisa pelos três critérios definidos anteriormente
        compara=self.comparaCor(aux1, aux2)
        if(compara==0):
            compara=self.comparaTamanho(aux1, aux2)
            if(compara==0):
                compara=self.comparaNome(aux1, aux2)
        return compara 
           
N=int(input()) #Entrada do número de camisas
primeiro_caso = True #Booleano para impressão correta no beecrowd
while(N!=0):
    if not primeiro_caso: #Assim evitamos o presentation error
        print() 
    primeiro_caso = False
    
    camisas=Lista() #Lista encadeada de camisas
    for i in range(0, N): 
        nome=input() #Entrada do nome
        cor_tamanho=input() #Entrada da cor e tamanho
        cor, tamanho = cor_tamanho.split()

        novo=No(cor, tamanho, nome) 
        camisas.insereOrdenado(novo)
    camisas.mostrar() #Impressão das camisas
    N=int(input()) #Entrada do número de camisas


        