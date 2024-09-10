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

"""
4. Usando pilha ou fila, determine se uma string de caracteres tem a seguinte forma:
xCx onde x é uma string composta por As e Bs.
Um exemplo de xCx é ABBBCABBB.
Em cada ponto você só poderá ler o próximo carater da string, para decidir se está ou não no padrão
esperado.
"""

string = input()
posicao = string.find('C')
pilha = Pilha()
igual = False

for i in range(posicao - 1, -1, -1):
    pilha.empilhar(string[i])

for i in range(posicao + 1, len(string)):
    if not pilha.pilha_vazia() and string[i] == pilha.desempilhar():
        igual = True
    else:
        igual = False
        break

if igual:
    print("Igual")
else:
    print("Diferente")

  
  
