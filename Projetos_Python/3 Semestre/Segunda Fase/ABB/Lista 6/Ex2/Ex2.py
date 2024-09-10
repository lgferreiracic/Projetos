"""
2. Considere o seguinte texto: “nas mensagens muito extensas contendo simbolos que
aparecem raramente, a economia eh substancial; em geral, os codigos nao sao
formados pela frequencia de caracteres dentro de uma unica mensagem isolada,
mas por sua frequencia dentro de um conjunto inteiro de mensagens; o mesmo
conjunto de códigos eh, entao, usado para cada mensagem.” Simule a aplicação de
um algoritmo de huffmann no texto e gere árvore e a tabela de códigos para os
caracteres usados no texto. Qual seria o tamanho, em bits, do texto usando uma
codificação formal de 7 bits (ASCII) e usando a compressão de Huffmann?
"""

from Arvore import No, Arvore
from Impressao import Desenho

indices=[0]*126
texto = "nas mensagens muito extensas contendo simbolos que aparecem raramente, a economia eh substancial; em geral, os codigos nao sao formados pela frequencia de caracteres dentro de uma unica mensagem isolada, mas por sua frequencia dentro de um conjunto inteiro de mensagens; o mesmo conjunto de códigos eh, entao, usado para cada mensagem."

tam=len(texto)

for i in range(0, tam):
    char=ord(texto[i])
    indices[ord(texto[i])]+=1

indices_ordenados=sorted(indices)







