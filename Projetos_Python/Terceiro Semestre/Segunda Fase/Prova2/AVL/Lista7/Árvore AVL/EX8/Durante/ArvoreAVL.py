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
    def remover_sucessor(raiz: No):
        min = raiz.direita 
        pai = raiz
        while min.esquerda != None:
            pai = min
            min = min.esquerda
        if pai.esquerda == min:
            pai.esquerda = min.direita
        else:
            pai.direita = min.direita
            raiz.valor = min.valor
            
class ArvoreAVL(Arvore):
    
    @staticmethod
    def balancear(raiz: No):
        if raiz is None:
            return raiz

        # Verifica o balanceamento atual do nó
        balance = ArvoreAVL.fator_balanceamento(raiz)

        # Caso 1: Desbalanceamento à esquerda
        if balance > 1:
            if ArvoreAVL.fator_balanceamento(raiz.esquerda) < 0:
                raiz.esquerda = ArvoreAVL.rotacao_esq(raiz.esquerda)
            return ArvoreAVL.rotacao_dir(raiz)

        # Caso 2: Desbalanceamento à direita
        if balance < -1:
            if ArvoreAVL.fator_balanceamento(raiz.direita) > 0:
                raiz.direita = ArvoreAVL.rotacao_dir(raiz.direita)
            return ArvoreAVL.rotacao_esq(raiz)

        return raiz
    
    @staticmethod
    def balancearFinal(raiz: No):
        if raiz is None:
            return raiz

        # Verifica o balanceamento atual do nó
        balance = ArvoreAVL.fator_balanceamento(raiz)

        # Caso 1: Desbalanceamento à esquerda
        if balance > 1:
            if ArvoreAVL.fator_balanceamento(raiz.esquerda) <= -1:
                raiz.esquerda = ArvoreAVL.rotacao_esq(raiz.esquerda)
            return ArvoreAVL.rotacao_dir(raiz)

        # Caso 2: Desbalanceamento à direita
        if balance < -1:
            if ArvoreAVL.fator_balanceamento(raiz.direita) >= 1:
                raiz.direita = ArvoreAVL.rotacao_dir(raiz.direita)
            return ArvoreAVL.rotacao_esq(raiz)
        raiz.esquerda=ArvoreAVL.balancear(raiz.esquerda)
        raiz.direita=ArvoreAVL.balancear(raiz.direita)

        return raiz

    @staticmethod
    def fator_balanceamento(n: No):
        if n is None:
            return 0
        return Arvore.altura(n.esquerda) - Arvore.altura(n.direita)

    @staticmethod
    def rotacao_esq(n: No):
        aux = n.direita
        n.direita = aux.esquerda
        if aux.esquerda is not None:
            aux.esquerda.pai = n
        aux.esquerda = n
        aux.pai = n.pai
        n.pai = aux
        return aux

    @staticmethod
    def rotacao_dir(n: No):
        aux = n.esquerda
        n.esquerda = aux.direita
        if aux.direita is not None:
            aux.direita.pai = n
        aux.direita = n
        aux.pai = n.pai
        n.pai = aux
        return aux
  
    @staticmethod
    def inserir(raiz: No, valor):
        if raiz is None:
            return No(valor)
        elif valor < raiz.valor:
            raiz.esquerda = ArvoreAVL.inserir(raiz.esquerda, valor)
            raiz.esquerda.pai = raiz
        else:
            raiz.direita = ArvoreAVL.inserir(raiz.direita, valor)
            raiz.direita.pai = raiz

        return ArvoreAVL.balancear(raiz)

    @staticmethod
    def remover_rec(raiz: No, valor):
        if raiz is None:
            return None
        if valor < raiz.valor:
            raiz.esquerda = ArvoreAVL.remover_rec(raiz.esquerda, valor)
        elif valor > raiz.valor:
            raiz.direita = ArvoreAVL.remover_rec(raiz.direita, valor)
        else:
            if raiz.esquerda is None:
                return raiz.direita
            elif raiz.direita is None:
                return raiz.esquerda
            min_no = Arvore.minimo(raiz.direita)
            raiz.valor = min_no.valor
            raiz.direita = ArvoreAVL.remover_rec(raiz.direita, min_no.valor)
        return ArvoreAVL.balancear(raiz)

 