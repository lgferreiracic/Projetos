import math
class ponto:

    def __init__(self, x, y):
        self.x=x
        self.y=y

def distacia (param_1: ponto, param_2: ponto):
    return math.sqrt(math.pow(param_2.x-param_1.x, 2)+(math.pow(param_2.y-param_1.y,2)))

ponto_a=ponto(10,0)
ponto_b=ponto(1,5)

print(distacia(ponto_a, ponto_b))