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
  
  def troca(self):
    if self.pilha_vazia():
      print('A pilha está vazia')
      exit(1)
    aux1=pilha.desempilhar()
    aux2=pilha.desempilhar()
    pilha.empilhar(aux1)
    pilha.empilhar(aux2)

"""
Construa uma rotina que execute uma operação de troca em uma pilha. Esta operação deve trocar
de posição o primeiro e segundo elemento do topo da pilha. Atenção aos casos nos quais a operação
não pode ser aplicada. Utilize apenas de operações primitivas da pilha para executar tal operação. 
Não manipule a pilha diretamente
"""

pilha=Pilha()
for i in range(1,5):
    pilha.empilhar(i)

pilha.troca()

print(pilha.valores[:pilha.topo+1])


