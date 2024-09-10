N = int(input())

for i in range(0, N):
    entrada=input()
    entrada=entrada.split()
    minutos=int(entrada[0])
    tempo=entrada[1]

    if tempo == '1T':
        if minutos<=45:
            print(minutos)
        else:
            acrescimo=minutos-45
            print(f'45+{acrescimo}')
    
    else:
        if minutos <= 45:
            print(45+minutos)
        else:
            print(f'{45+minutos}+{minutos-45}')

