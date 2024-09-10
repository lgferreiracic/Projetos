QUEUESIZE=100
class FIla:
    def __init__(self):
        self.front=0
        self.rear=-1
        self.valores = [None]*QUEUESIZE

    def fila_vazia(self):
        if (self.rear<self.front):
            return True
        return False
    
    def fila_cheia(self):
        if(self.rear==QUEUESIZE-1):
            return True
        return False

    
    def remove(self):
        if(self.fila_vazia()):
            print("Fila Vazia")
            exit(1)
        primeiro=self.valores[self.front]
        self.front+=1
        return primeiro
    
    def insert (self, valor):
        if(self.fila_cheia()):
            print("Erro - Fila Cheia")
            exit(1)
        self.rear+=1
        self.valores[self.rear]=valor


    



    
    