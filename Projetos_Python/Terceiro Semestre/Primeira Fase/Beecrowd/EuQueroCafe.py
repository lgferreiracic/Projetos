entrada=input()
entrada=entrada.split()
N=float(entrada[0])
L=float(entrada[1])
D=float(entrada[2])
print(N*(D/1000))

while True:
    if N*(D/1000)>L:
        L+=L
    else:
        print(int(L))
        break
