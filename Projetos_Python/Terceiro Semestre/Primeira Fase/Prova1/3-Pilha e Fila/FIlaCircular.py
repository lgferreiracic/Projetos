class FilaCircular:
    def __init__(self, tamanho):
        self.tamanho = tamanho
        self.front = 0
        self.rear = -1
        self.valores = [None] * tamanho

    def fila_vazia(self):
        return self.rear == -1

    def fila_cheia(self):
        return (self.rear + 2) % self.tamanho == self.front

    def remove(self):
        if self.fila_vazia():
            print("Fila Vazia")
            exit(1)
        primeiro = self.valores[self.front]
        self.valores[self.front] = None
        if self.front == self.rear:
            self.front = 0
            self.rear = -1
        else:
            self.front = (self.front + 1) % self.tamanho
        return primeiro

    def insert(self, valor):
        if self.fila_cheia():
            print("Erro - Fila Cheia")
            exit(1)
        if self.fila_vazia():
            self.front = 0
        self.rear = (self.rear + 1) % self.tamanho
        self.valores[self.rear] = valor


# Teste
QUEUESIZE = 100
fila = FilaCircular(QUEUESIZE)

# Adicionando elementos à fila
for i in range(1, 101):
    fila.insert(i)

# Removendo elementos da fila
for _ in range(10):
    print(fila.remove())
