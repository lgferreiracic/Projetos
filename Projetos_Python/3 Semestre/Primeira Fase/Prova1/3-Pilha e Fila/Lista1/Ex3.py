"""
3. Elabore um método para manter duas pilhas dentro de um único vetor linear de tamanho limitado
(STACKSIZE), de modo que nenhuma das pilhas alerte estouro até toda a memória seja usada; e 
uma pilha inteira nunca seja deslocada para outro lugar dentro do vetor. Escreva rotinas push1, 
pop1, push2 e pop2 para manipular as duas pilhas.
"""
STACKSIZE=100
class Pilha:

  def __init__(self):
    self.topo1 = -1
    self.topo2=STACKSIZE
    self.valores = [None]*STACKSIZE

  def pilha_cheia(self):
    if self.topo1 + 1 == self.topo2:
      return True
    return False

  def pilha_vazia1(self):
    if self.topo1 == -1:
      return True
    return False
  
  def pilha_vazia2(self):
    if self.topo2 == STACKSIZE:
      return True
    return False

  def empilhar1(self, valor):
    if self.pilha_cheia():
      print('A pilha está cheia')
      exit(1)
    self.topo1 += 1
    self.valores[self.topo] = valor

  def desempilhar1(self):
    if self.pilha_vazia1():
      print('A pilha está vazia')
      exit(1)
    aux=self.valores[self.topo1]
    self.topo1 -= 1
    return aux
  
  def empilhar2(self, valor):
        if self.pilha_cheia():
            print('A pilha está cheia')
            exit(1)
        self.topo2 -= 1
        self.valores[self.topo2] = valor
  
  def desempilhar2(self):
    if self.pilha_vazia2():
      print('A pilha está vazia')
      exit(1)
    aux=self.valores[self.topo2]
    self.topo2 += 1
    return aux
  


