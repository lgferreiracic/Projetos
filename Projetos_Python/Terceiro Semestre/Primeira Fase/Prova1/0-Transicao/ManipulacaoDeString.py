#manipulacao de strings

#Deixar string maiuscula
a='casaco'
print(a)
maiuscula=a.upper()
print(maiuscula)

#Deixar string minuscula
minuscula=maiuscula.lower()
print(minuscula)

#Apenas o primeiro caractere minusculo
capital=a.capitalize()
print(capital)

#Manipulando posicoes
metade_palavra=a[0:3]
print(metade_palavra)
ultimas_letras=a[3:]
print(ultimas_letras)

b=a.replace('aco', 'inha')
print(b)

c=b.find('s')
print(c)
c=b.find('x')
print(c)

e=' casaco '
print(len(e))
f=e.strip()
print(f)

n1=14
n2=16
print(f'Dividindo {n1} por {n2} o resultado é {n1/n2}')
