class No:
    """Esta classe representa um nó/elemento de uma árvore.""" 
    def __init__(self, nome=None,  cpf=None, esquerda=None, direita=None):
        self.nome=nome
        self.cpf = cpf
        self.esquerda = esquerda
        self.direita = direita

class Arvore:
    """Esta classe contem funções para a manipulação de árvores binárias."""
    
    # Recebe um Nó de uma árvore (raiz local) e o CPF.
    # Retorna o No que contem o CPF passado e o seu nivel
    def buscar_and_nivel(raiz: No, cpf: int, nivel=1):
        if raiz==None or raiz.cpf == cpf:  # Retorna o Nó se for encontrado e seu o nivel 
            return raiz, nivel             #Caso não encontre retorna None
        
        if cpf<raiz.cpf:
            return Arvore.buscar_and_nivel(raiz.esquerda, cpf, nivel + 1) # Faz a busca a esquerda do Nó atual
        
        else:
            return Arvore.buscar_and_nivel(raiz.direita, cpf, nivel + 1) # Faz a busca a direita do Nó atual
        
    @staticmethod
    def nivel(raiz: No, cpf: int, nivel=1):
        if raiz is None:  
            return -1
        if raiz.cpf == cpf:  
            return nivel
        if cpf < raiz.cpf:  
            return Arvore.nivel(raiz.esquerda, cpf, nivel + 1)
        else:  
            return Arvore.nivel(raiz.direita, cpf, nivel + 1)
        

    # Recebe um Nó de uma árvore (raiz local), um nome e um CPF
    # Faz a criação do Nó, o insere na árvore e retora a raiz da árvore     
    def inserir(raiz: No, nome, cpf):
        if raiz==None:
            novo=No(nome, cpf)
            return novo # Se a raiz for None, criamos o Nó e o retornamos (Será feita uma atribuição na raiz com esse retorno)
        
        if cpf<raiz.cpf:
            raiz.esquerda=Arvore.inserir(raiz.esquerda, nome, cpf) # Se o CPF passado for menor que o CPF do Nó atual, vamos para a esquerda
        else:
            raiz.direita=Arvore.inserir(raiz.direita, nome, cpf) # Se o CPF passado for maior que o CPF do Nó atual, vamos para a direita
        
        return raiz # Ao encontramos a posição onde o Nó deve ser inserido, retornamos a raiz da árvore
    
N = int(input())
raiz=None
for i in range(0, N):
    acao_cpf=input() # Entrada da ação e do CPF
    acao, cpf=acao_cpf.split()
    cpf=int(cpf)
    if acao=='I': # Se for Inserção, recebe-se o nome e faz a inserção da pessoa na árvore
        nome=input()
        #OBS: Considere que nunca é pedido para inserir o mesmo elemento 2 vezes
        raiz=Arvore.inserir(raiz, nome, cpf)
        
    else: # Se for Busca, procura-se a pessoa na árvore pelo CPF e imprime-se o seu nome e nível na árvore
        #OBS: Sempre existe a pessoa buscada na base
        busca, nivel=Arvore.buscar_and_nivel(raiz, cpf)
        if busca!= None:
            print(f'{busca.nome} {nivel}')
            #cpf=5
            nivel2=Arvore.nivel(raiz, cpf)
            print(nivel2)



