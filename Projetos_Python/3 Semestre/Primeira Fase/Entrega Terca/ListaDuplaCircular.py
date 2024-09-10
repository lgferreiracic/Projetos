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
            aux=self.inicio
            self.inicio=novo
            novo.prox=aux
            novo.ant=aux.ant
            aux.ant=novo

            ultimo=aux
            while ultimo.prox!=aux:
                ultimo=ultimo.prox

            ultimo.prox=novo

    def mostrar(self):
        aux=self.inicio
        if aux!=None:
            print(aux.valor, end=' ')
            print('Ant: ' + str(aux.ant.valor), end = ' ')
            print('Prox: ' + str(aux.prox.valor))
            if aux.prox!=None:
                aux=aux.prox
        while aux!=self.inicio:
            print(aux.valor, end=' ')
            print('Ant: ' + str(aux.ant.valor), end = ' ')
            print('Prox: ' + str(aux.prox.valor))
            aux=aux.prox


teste=Lista()

novo=No(3)
teste.insereInicio(novo)
novo=No(2)
teste.insereInicio(novo)
novo=No(1)
teste.insereInicio(novo)
novo=No(0)
teste.insereInicio(novo)
teste.mostrar()