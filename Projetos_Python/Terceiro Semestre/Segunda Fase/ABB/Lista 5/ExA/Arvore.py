class No:
    """Esta classe representa um nó/elemento de uma árvore.
       Equivalente a função criar_arvore em C -- no slide
    """ 
    def __init__(self, valor, esquerda=None, direita=None, pai=None):
        self.valor = valor
        self.esquerda = esquerda
        self.direita = direita
        self.pai=pai

class Arvore:
    """Esta classe contem funções para a manipulação de árvores binárias."""
    
    # Recebe um Nó de uma árvore (raiz local) e um inteiro.
    # Retorna o No que contem o valor inteiro.
    def procurar_no (raiz: No, x: int) -> No:
        
        if raiz is None:
            return None
        
        if raiz.valor == x:
            return raiz
        
        left = Arvore.procurar_no(raiz.esquerda, x)
        if (left is not None):
            return left
        
        right = Arvore.procurar_no(raiz.direita, x)
        if (right is not None):
            return right
        
        return None

    def numero_nos(raiz: No) -> int:
        if raiz is None:
            return 0
        n_left=Arvore.numero_nos(raiz.esquerda)
        n_right=Arvore.numero_nos(raiz.direita)
        return n_left+n_right+1
    
    def altura(raiz: No) -> int:
        if raiz is None:
            return 0
        h_left = Arvore.altura(raiz.esquerda)
        h_right = Arvore.altura(raiz.direita)
        return 1 + max(h_left, h_right)

    def pre_ordem(raiz: No):
        if raiz is not None:
            print(raiz.valor, end=' ')
            Arvore.pre_ordem(raiz.esquerda)
            Arvore.pre_ordem(raiz.direita)
            
    def pos_ordem(raiz: No):
        if raiz is not None:
            Arvore.pos_ordem(raiz.esquerda)
            Arvore.pos_ordem(raiz.direita)
            print(raiz.valor, end=' ')
    
    def in_ordem(raiz: No):
        if raiz is not None:
            Arvore.in_ordem(raiz.esquerda)
            print(raiz.valor, end=' ')
            Arvore.in_ordem(raiz.direita)
            
            
    def percurso_em_largura (raiz: No):
        f = list()
        f.append(raiz) #insere no fim
        while len(f)>0:
            raiz = f.pop(0) # removo no início
            if raiz is not None:
                f.append(raiz.esquerda)
                f.append(raiz.direita)
                print(raiz.valor, end=' ')

    def buscar(raiz: No, valor):
        if raiz==None or valor == raiz.valor:
            return raiz
        
        if valor<raiz.valor:
            return Arvore.buscar(raiz.esquerda, valor)
        
        else:
            return Arvore.buscar(raiz.direita, valor)
        
    def inserir(raiz: No, valor):
        if raiz==None:
            novo=No(valor)
            return novo
        
        if valor<raiz.valor:
            raiz.esquerda=Arvore.inserir(raiz.esquerda, valor)
        else:
            raiz.direita=Arvore.inserir(raiz.direita, valor)
        
        return raiz
    
