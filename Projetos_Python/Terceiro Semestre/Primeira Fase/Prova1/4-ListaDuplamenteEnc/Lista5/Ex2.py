class No:
    def __init__(self, valor):
        self.valor=valor
        self.prox=self
        self.ant=self

class Lista:
    inicio=None

    def insereInicio(self, novo: No):
        if self.inicio==None:
            self.inicio=novo

        else:
            ultimo=self.inicio
            while ultimo.prox!=self.inicio:
                ultimo=ultimo.prox
            ultimo.prox=novo
            novo.ant=ultimo
            novo.prox=self.inicio
            self.inicio=novo

    def mostrar (self):
        atual=self.inicio
        if (atual!=None):
            print(atual.valor, end=' ')
            atual=atual.prox
        while atual!=self.inicio:
            print(atual.valor, end=' ')
            atual=atual.prox

teste=Lista()

for i in range(9,0,-1):
    teste.insereInicio(No(i))

teste.mostrar()