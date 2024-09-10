entrada1=input()
N, H = entrada1.split()
A=input()
A=A.split()
cont=0
for i in range(len(A)):
    if (int(H)>=int(A[i])):
        cont+=1
print(cont)
