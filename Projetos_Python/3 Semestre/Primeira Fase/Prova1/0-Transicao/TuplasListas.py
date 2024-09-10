tupla =('Homo sapiens', 'Canis familiaris', 'Felis catus')
print(tupla)

lista=['Homo sapiens', 'Canis familiaris', 'Felis catus']
print(lista)

lista2=['Homo sapiens', 'Canis familiaris', 'Felis catus']
lista3=lista+lista2
print(lista3)

print(lista[0])

lista4=lista*2
print(lista4)

for item in lista4:
    print(item)

for i in range(0,5):
    print(lista4[i])

# Em Python, as listas (list) e as tuplas (tuple) são estruturas de dados semelhantes, mas têm algumas diferenças fundamentais:
#Mutabilidade:
#Listas: São mutáveis, o que significa que os elementos podem ser alterados, adicionados ou removidos após a criação da lista.
#Tuplas: São imutáveis, o que significa que, após criadas, elas não podem ser modificadas. Os elementos de uma tupla não podem ser alterados, adicionados ou removidos.