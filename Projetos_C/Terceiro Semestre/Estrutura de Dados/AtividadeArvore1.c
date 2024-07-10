#include <stdio.h>
#include <stdlib.h>

struct No {
    int dado;
    struct No* esq, * dir;
};
typedef struct No no, *p_no;

// Função para criar uma árvore (nó) com subárvores esquerda e direita
p_no criar_arvore(int x, p_no esq, p_no dir) {
    p_no r = (p_no)malloc(sizeof(no));
    r->dado = x;
    r->esq = esq;
    r->dir = dir;
    return r;
}

// Função para contar o número de folhas
int contar_folhas(p_no raiz){
    // Se a raiz for NULL, não há folhas
    if (raiz == NULL)
        return 0;
    // Verifica se o nó é uma folha
    if (raiz->esq == NULL && raiz->dir == NULL)
        return 1;
    // Soma recursivamente as folhas das subárvores esquerda e direita
    return contar_folhas(raiz->esq) + contar_folhas(raiz->dir);
}

// Função para apagar folhas com a chave especificada
p_no apagar_folhas(p_no raiz, int chave) {
    // Se a raiz for NULL, não há o que apagar
    if (raiz == NULL)
        return NULL;

    // Verifica se é uma folha e se o valor corresponde à chave
    if (raiz->esq == NULL && raiz->dir == NULL && raiz->dado == chave) {
        // Libera a memória do nó
        free(raiz);
        // Retorna NULL para indicar que o nó foi removido
        return NULL;
    }
    // Recursivamente apaga folhas na subárvore esquerda e direita
    raiz->esq = apagar_folhas(raiz->esq, chave);
    raiz->dir = apagar_folhas(raiz->dir, chave);

    // Retorna a raiz
    return raiz;
}

// Função para comparar se duas árvores binárias são iguais
int sao_iguais(p_no raiz1, p_no raiz2) {
    // Se ambas as árvores são nulas, elas são iguais
    if (raiz1 == NULL && raiz2 == NULL)
        return 1;

    // Se uma das árvores é nula e a outra não, elas não são iguais
    if ((raiz1 == NULL && raiz2 != NULL) || (raiz1 != NULL && raiz2 == NULL))
        return 0;

    // Se os valores dos nós não são iguais, então elas também não são iguais
    if (raiz1->dado != raiz2->dado) {
        return 0;
    }
    // Se a comparação entre as subárvores for diferente de 0, não são iguais
    if (sao_iguais(raiz1->esq, raiz2->esq) == 0 || sao_iguais(raiz1->dir, raiz2->dir) == 0) {
        return 0;
    }
    // Retorna 1 se forem iguais
    return 1;
}

// Imprime em ordem
void imprime_arvore(p_no raiz) {
    // Verifica se a árvore está vazia
    if (raiz == NULL) {
        printf("Árvore vazia\n");
        // Retorna para encerrar a função
        return;
    }
    // Imprime a subárvore esquerda
    if (raiz->esq != NULL) {
        imprime_arvore(raiz->esq);
    }
    // Imprime o dado do nó atual
    printf("%d ", raiz->dado);

    // Imprime a subárvore direita
    if (raiz->dir != NULL) {
        imprime_arvore(raiz->dir);
    }
}

// Função auxiliar para analisar a saída da função "sao_iguais" e
// com base no seu resultado, dizer se é verdadeiro ou falso
void informa(int valor) {
    if (valor == 1)
        printf("\nVerdadeiro");
    else
        printf("\nFalso");
}

int main(void) {

    /*---------------------------------------- Teste para a Função A ----------------------------------------*/
    // Criando árvore binária 1
    p_no raiz_1 = criar_arvore(1, NULL, NULL);
    contar_folhas(raiz_1);
    //imprime_arvore(raiz_1);
    printf("%d\n", contar_folhas(raiz_1));

    // Criando árvore binária 2
    p_no f1 = criar_arvore(6, NULL, NULL);
    p_no f2 = criar_arvore(7, NULL, NULL);
    p_no f3 = criar_arvore(7, f2, NULL);
    p_no f4 = criar_arvore(9, f1, f3);
    p_no f5 = criar_arvore(5, NULL, NULL);
    p_no f6 = criar_arvore(7, NULL, NULL);
    p_no f7 = criar_arvore(8, f5, f6);
    p_no f8 = criar_arvore(5, NULL, f7);
    p_no f9 = criar_arvore(6, f4, f8);
    //imprime_arvore(f9);
    printf("%d\n", contar_folhas(f9));

    // Criando árvore binária 3
    p_no F1 = criar_arvore(6, NULL, NULL);
    p_no F2 = criar_arvore(9, F1, NULL);
    p_no F3 = criar_arvore(5, NULL, NULL);
    p_no F4 = criar_arvore(7, NULL, NULL);
    p_no F5 = criar_arvore(8, F3, F4);
    p_no F6 = criar_arvore(7, NULL, F5);
    p_no F7 = criar_arvore(6, F2, F6);
    //imprime_arvore(F7);
    printf("%d\n", contar_folhas(F7));

    /*---------------------------------------- Teste para a Função B ----------------------------------------*/

    // Criando árvore 1
    printf("\n");
    p_no r1 = criar_arvore(1, NULL, NULL);
    r1 = apagar_folhas(r1, 1);
    imprime_arvore(r1);

    // Teste realizado com a árvore binária 2 do item A-2 (TESTE 2 da Função A)
    // ATENÇÃO: Como as árvores são iguais, reutilizei o código da sua criação e aqui apenas chamo a função apagar_folhas
    apagar_folhas(f9, 7);
    imprime_arvore(f9);
    printf("\n");

    // Teste realizado com a árvore binária 3 do item A-3 (TESTE 3 DO ITEM A)
    // ATENÇÃO: Como as árvores são iguais, reutilizei este código e aqui apenas chamo a função apagar_folhas
    apagar_folhas(F7, 7);
    imprime_arvore(F7);
    printf("\n");

    /*---------------------------------------- Teste para o item C ----------------------------------------*/
    // Criando árvore 1
    p_no folha1 = criar_arvore(6, NULL, NULL);
    p_no folha2 = criar_arvore(9, folha1, NULL);
    p_no folha3 = criar_arvore(5, NULL, NULL);
    p_no folha4 = criar_arvore(8, NULL, folha3);
    p_no folha5 = criar_arvore(7, folha4, NULL);
    p_no folha6 = criar_arvore(6, folha2, folha5);

    // Criando árvore 2
    p_no folha11 = criar_arvore(6, NULL, NULL);
    p_no folha22 = criar_arvore(9, folha11, NULL);
    p_no folha33 = criar_arvore(5, NULL, NULL);
    p_no folha44 = criar_arvore(8, folha33, NULL);
    p_no folha55 = criar_arvore(7, NULL, folha44);
    p_no folha66 = criar_arvore(6, folha2, folha55);

    // Item C-1
    informa(sao_iguais(folha6, folha66));

    // Item C-2
    informa(sao_iguais(folha6, folha6));

    return 0;
}
