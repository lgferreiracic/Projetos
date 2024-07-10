"""6. Desenhe todas as árvores binárias de busca para os quatro elementos A, B, C e D. Observe que ela pode ter alturas diversas, inclusive igual a 4."""

from itertools import permutations

# Sequência de elementos
sequencia = ['A', 'B', 'C', 'D']

# Gerar todas as permutações
todas_permutacoes = permutations(sequencia)

# Imprimir todas as permutações
for permutacao in todas_permutacoes:
    print(permutacao)

