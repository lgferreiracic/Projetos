from Impressao import Desenho
class No:
    """Esta classe representa um nó/elemento de uma árvore.
       Equivalente a função criar_arvore em C -- no slide
    """ 
    def __init__(self, valor, esquerda=None, direita=None):
        self.valor = valor
        self.esquerda = esquerda
        self.direita = direita
        self.pai = None


class Arvore:
    """Esta classe contem funções para a manipulação de árvores binárias."""
    
    @staticmethod
    def procurar_no(raiz: No, x: int) -> No:
        if raiz is None:
            return None
        if raiz.valor == x:
            return raiz
        esquerda = Arvore.procurar_no(raiz.esquerda, x)
        if esquerda is not None:
            return esquerda
        return Arvore.procurar_no(raiz.direita, x)

    @staticmethod
    def numero_nos(raiz: No) -> int:
        if raiz is None:
            return 0
        n_esquerda=Arvore.numero_nos(raiz.esquerda)
        n_direita=Arvore.numero_nos(raiz.direita)
        return n_esquerda + n_direita + 1
    
    @staticmethod
    def altura(raiz: No) -> int:
        if raiz is None:
            return 0
        h_esquerda = Arvore.altura(raiz.esquerda)
        h_direita = Arvore.altura(raiz.direita)
        return 1 + max(h_esquerda, h_direita)

    @staticmethod
    def pre_ordem(raiz: No):
        if raiz is not None:
            print(raiz.valor, end=' ')
            Arvore.pre_ordem(raiz.esquerda)
            Arvore.pre_ordem(raiz.direita)
    
    @staticmethod
    def pos_ordem(raiz: No):
        if raiz is not None:
            Arvore.pos_ordem(raiz.esquerda)
            Arvore.pos_ordem(raiz.direita)
            print(raiz.valor, end=' ')
    
    @staticmethod
    def in_ordem(raiz: No):
        if raiz is not None:
            Arvore.in_ordem(raiz.esquerda)
            print(raiz.valor, end=' ')
            Arvore.in_ordem(raiz.direita)
    
    @staticmethod
    def percurso_em_largura (raiz: No):
        f = list()
        f.append(raiz) #insere no fim
        while len(f)>0:
            raiz = f.pop(0) # removo no início
            if raiz is not None:
                f.append(raiz.esquerda)
                f.append(raiz.direita)
                print(raiz.valor, end=' ')

    
    @staticmethod
    def buscar(raiz: No, valor):
        if raiz is None or valor == raiz.valor:
            return raiz
        if valor < raiz.valor:
            return Arvore.buscar(raiz.esquerda, valor)
        else:
            return Arvore.buscar(raiz.direita, valor)
    
    @staticmethod
    def inserir(raiz: No, valor):
        if raiz is None:
            novo = No(valor)
            return novo
        
        if valor < raiz.valor:
            if raiz.esquerda is None:
                raiz.esquerda = No(valor)
                raiz.esquerda.pai = raiz
            else:
                Arvore.inserir(raiz.esquerda, valor)
        else:
            if raiz.direita is None:
                raiz.direita = No(valor)
                raiz.direita.pai = raiz
            else:
                Arvore.inserir(raiz.direita, valor)
        return raiz
    
    @staticmethod
    def minimo(raiz: No):
        if raiz is None or raiz.esquerda is None:
            return raiz
        return Arvore.minimo(raiz.esquerda)
    
    @staticmethod
    def maximo(raiz: No):
        if raiz is None or raiz.direita is None:
            return raiz
        else:
            return Arvore.maximo(raiz.direita) 
        
    @staticmethod
    def ancestral_direita(x: No):
        if x is None:
            return None
        if x.pai is None or x.pai.esquerda == x:
            return x.pai
        return Arvore.ancestral_direita(x.pai)

    @staticmethod
    def sucessor(x: No):
        if x.direita is not None:
            return Arvore.minimo(x.direita)
        else:
            return Arvore.ancestral_direita(x)

    @staticmethod
    def ancestral_esquerda(x: No):
        if x is None:
            return None
        if x.pai is None or x.pai.direita == x:
            return x.pai
        else:
            return Arvore.ancestral_esquerda(x.pai) 
    
    @staticmethod
    def antecessor(x: No):
        if x.esquerda is not None:
            return Arvore.maximo(x.esquerda)
        else:
            return Arvore.ancestral_esquerda(x)
    
    
    
    @staticmethod
    def remover_rec(raiz: No, valor):
        if raiz is None:
            return None
        if valor < raiz.valor:
            raiz.esquerda = Arvore.remover_rec(raiz.esquerda, valor)
        elif valor > raiz.valor:
            raiz.direita = Arvore.remover_rec(raiz.direita, valor)
        else:
            if raiz.esquerda is None:
                return raiz.direita
            elif raiz.direita is None:
                return raiz.esquerda
            min_no = Arvore.minimo(raiz.direita)
            raiz.valor = min_no.valor
            raiz.direita = Arvore.remover_rec(raiz.direita, min_no.valor)
        return raiz
    
    @staticmethod
    def pareada(raiz: No):
        esquerda=True
        direita=True
        if raiz == None:
            return True
        if raiz.esquerda == None and raiz.direita == None:
            return True
        if raiz.esquerda.valor % 2 == 1 and raiz.direita.valor == 0:
            esquerda=Arvore.pareada(raiz.esquerda)
            direita=Arvore.pareada(raiz.direita)
        if esquerda == True and direita == True:
            return True
        return False

#inserir 17,11,15,5, 10, 8, 11
raiz=None
raiz=Arvore.inserir(raiz, 5)
raiz=Arvore.inserir(raiz, 3)
raiz=Arvore.inserir(raiz, 8)
raiz=Arvore.inserir(raiz, 1)
raiz=Arvore.inserir(raiz, 4)
raiz=Arvore.inserir(raiz, 7)
raiz=Arvore.inserir(raiz, 10)
#raiz=Arvore.remover_sucessor(raiz)
#Arvore.pos_ordem(raiz)
print(Arvore.pareada(raiz))
Desenho.desenhar(raiz)