TAMANHO=10
class Deque:
    def __init__(self):
        self.fim_esquerda=-1
        self.fim_direita=TAMANHO
        self.inicio_esquerda=0
        self.inicio_direita=TAMANHO-1
        self.valores=[None]*TAMANHO

    def dequeCheio(self):
        if self.fim_esquerda==self.fim_direita-1:
            return True
        return False
    
    def esquerdaVazia(self):
        if self.fim_esquerda==-1:
            return True
        return False
    
    def direitaVazia(self):
        if self.fim_direita==TAMANHO:
            return True
        return False
    
    def remleft(self):
        if self.esquerdaVazia():
            print('Lado Esquerdo vazio')
            exit(1)
        removido=self.valores[self.inicio_esquerda]
        self.inicio_esquerda+=1
        return removido
    
    def remright(self):
        if self.direitaVazia():
            print('Lado Direito vazio')
            exit(1)
        removido=self.valores[self.inicio_direita]
        self.inicio_direita-=1
        return removido
    
    def insleft(self, valor):
        if self.dequeCheio():
            print('Deque cheio')
            exit(1)
        self.fim_esquerda+=1
        self.valores[self.fim_esquerda]=valor

    def insright(self, valor):
        if self.dequeCheio():
            print('Deque cheio')
            exit(1)
        self.fim_direita-=1
        self.valores[self.fim_direita]=valor



deque=Deque()

deque.insleft(1)
deque.insleft(2)
deque.insleft(3)
print(deque.valores)

deque.insright(4)
deque.insright(5)
deque.insright(6)
print(deque.valores)

print(deque.remleft())
print(deque.remright())