STACKSIZE=100
class Pilha:

  def __init__(self):
    self.valores = [None]*STACKSIZE
    self.valores[0]=0

  def pilha_cheia(self):
    if self.valores[0] == STACKSIZE - 1:
      return True
    return False

  def pilha_vazia(self):
    if self.valores[0] == 0:
      return True
    return False

  def empilhar(self, valor):
    if self.pilha_cheia():
      print('A pilha está cheia')
      exit(1)
    self.valores[0] += 1
    self.valores[self.valores[0]] = valor

  def desempilhar(self):
    if self.pilha_vazia():
      print('A pilha está vazia')
      exit(1)
    aux=self.valores[self.valores[0]]
    self.valores[0]-=1
    return aux

"""
2. Implemente uma pilha de inteiros em C, usando um vetor int s[STACKSIZE], onde s[0] é 
usado para conter o índice do elemento topo da pilha, e a partir de s[1] a s[STACKSIZE-1] 
contenham os elementos da pilha. 
Escreva as rotinas push, pop, empty e stacktop para essa implementação
"""

pilha=Pilha()
for i in range(1,5):
    pilha.empilhar(i)

print(pilha.valores[:pilha.valores[0]+1])

pilha.desempilhar()
print(pilha.valores[:pilha.valores[0]+1])