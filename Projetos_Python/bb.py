def bubble_sort(arr):
    n = len(arr)
    trocas = []  # Lista para armazenar as posições das trocas

    # Realiza o Bubble Sort e armazena as posições das trocas
    for i in range(n):
        for j in range(0, n-i-1):
            if arr[j] > arr[j+1]:
                arr[j], arr[j+1] = arr[j+1], arr[j]
                trocas.append(j)  # Armazena a posição da troca

    # Desenha o triângulo com base nas trocas
    for i in range(n-1):
        linha = ""
        for j in range(n-1):
            if j < i and (j in trocas or (j+1) in trocas):
                linha += "x"
            else:
                linha += " "
        print(linha)
    
    return arr

# Exemplo de uso
arr = [5, 4, 3, 2, 1, 6, 7, 8, 9, 10]
sorted_arr = bubble_sort(arr)
print("Array ordenado:", sorted_arr)
