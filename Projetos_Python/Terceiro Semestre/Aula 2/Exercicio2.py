import math
class ponto:

    def __init__(self, x, y):
        self.x=x
        self.y=y

ponto_a=ponto(10,0)
ponto_b=ponto(1,5)

distancia=math.sqrt(math.pow(ponto_b.x-ponto_a.x, 2)+(math.pow(ponto_b.y-ponto_a.y,2)))
print(distancia)