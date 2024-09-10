class ponto:

    def __init__(self, x, y):
        self.x=x
        self.y=y

ponto_a=ponto(10,0)
ponto_b=ponto(1,5)

print(ponto_a.x)
soma_xs=ponto_a.x+ponto_b.x
print(soma_xs)