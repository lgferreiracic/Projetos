def counting_sort(V: list):
    C = [0]*(max(V)+1)
    S = [0]*len(V)
    for i in range(0,len(V)):
        C[V[i]]=C[V[i]]+1
    for i in range(1, len(V)):
        C[i]=C[i]+C[i-1]
    for i in range(len(C)-1, -1, -1):
        S[C[V[i]]-1]=V[i]
        C[V[i]] -= 1
    return S, C

V=[5, 3, 7, 5, 9, 4, 8, 2, 7, 6]
S, C =counting_sort(V)
print('Vetor de soma')
print(C)
print('Saida')
print(S)