STACKSIZE=100
class Pilha:

  def __init__(self):
    self.topo = -1
    self.valores = [None]*STACKSIZE

  def pilha_cheia(self):
    if self.topo == STACKSIZE - 1:
      return True
    return False

  def pilha_vazia(self):
    if self.topo == -1:
      return True
    return False

  def empilhar(self, valor):
    if self.pilha_cheia():
      print('A pilha está cheia')
      exit(1)
    self.topo += 1
    self.valores[self.topo] = valor

  def desempilhar(self):
    if self.pilha_vazia():
      print('A pilha está vazia')
      exit(1)
    aux=self.valores[self.topo]
    self.topo -= 1
    return aux
