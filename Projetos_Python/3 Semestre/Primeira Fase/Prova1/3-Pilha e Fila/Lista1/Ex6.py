"""
6. Se um vetor armazenando uma fila não é considerado circular, pode ocasionar o problema de
overflow quando a variável rear chega ao fim da fila, no entanto, existem espaços anteriores à 
variável front, que poderia armazenar novos elementos.

Uma possível solução é deslocar para baixo todos elementos da uma fila a cada remoção. Porém 
esta solução é custosa. Um método menos custoso é adiar o deslocamento até que rear seja igual ao 
último índice do vetor. Quando essa situação ocorre e faz-se a tentativa de inserir um elemento na 
fila, a fila inteira é deslocada para baixo, de modo que o primeiro elemento da fila fique na posição 
0 do vetor. Escreva as rotinas remove, insert e empty usando esse método
"""

QUEUESIZE=7
class Fila:
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
            if self.front==0:
                print("Erro - Fila Cheia")
                exit(1)
            else:
                self.posicaoZero()
                
        self.rear+=1
        self.valores[self.rear]=valor

    def posicaoZero(self):
        for i in range(self.front, self.rear+1):
            self.valores[self.front-i]=self.valores[i]
            self.valores[i]=0
        self.rear=self.rear-self.front
        self.front=0

teste=Fila()

for i in range(0,7):
    teste.insert(i)
print(teste.valores)
for i in range(0,4):
    teste.remove()
print(teste.valores)
teste.insert('8')

print(teste.valores)

    



    
    