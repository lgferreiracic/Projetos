class fila:
    def __init__(self):
        self.front = 0
        self.rear = -1
        self.items = [None] * 8

    def filaCheia(self):
        if self.rear == 7:
            return True
        return False

    def filaVazia(self):
        if self.rear < self.front:
            return True
        return False

    def removeInicio(self):
        if self.filaVazia():
            print("Fila Vazia")
            exit(1)

        primeiro = self.items[self.front]
        self.front += 1
        return primeiro

    def inserirFim(self, valor):
        if self.filaCheia():
            if self.front == 0:
                print('Fila Cheia')
                exit(1)
            else:
                for i in range(self.front, self.rear + 1):
                    self.items[i - self.front] = self.items[i]
                self.rear = self.rear - self.front
                self.front = 0
        self.rear += 1
        self.items[self.rear] = valor


teste = fila()

for i in range(0, 8):
    teste.inserirFim(i)

for i in range(0, 5):
    teste.removeInicio()

teste.inserirFim('8')
print(teste.items)
