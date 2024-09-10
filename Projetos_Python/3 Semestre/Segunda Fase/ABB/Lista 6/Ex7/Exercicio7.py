"""7. Qual a árvore resultante e qual o resultado do percorrimento pós-ordem após a inserção
dos elementos 17,11,15,5, 10, 8, 11 e remoção do 15. Não precisa implementar. Basta
simular."""

from Arvore import No, Arvore
from Impressao import Desenho

raiz=No(17)
Arvore.inserir(raiz, 11)
Arvore.inserir(raiz, 15)
Arvore.inserir(raiz, 5)
Arvore.inserir(raiz, 10)
Arvore.inserir(raiz, 8)
Arvore.inserir(raiz, 11)
