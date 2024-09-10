N=int(input())
string=input()
total=0
parcial=""
for letra in string:
  if letra == 'a':
    parcial=parcial+letra
  else:
    if len(parcial)>=2:
      total+=len(parcial)
    parcial=""
if len(parcial) >= 2:
    total += len(parcial)
print(total)