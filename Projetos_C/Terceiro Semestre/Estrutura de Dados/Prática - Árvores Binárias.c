#include <stdio.h>
#include <stdlib.h>

// Definição da estrutura do nó da árvore binária
struct No {
    int dado; // Valor armazenado no nó
    struct No* esquerda, * direita; // Ponteiros para os filhos esquerdo e direito
};
typedef struct No no, *p_no;

// Função para criar um novo nó com subárvores esquerda e direita
p_no criarArvore(int valor, p_no esquerda, p_no direita) {
    p_no novo_no = (p_no)malloc(sizeof(no)); // Aloca memória para um novo nó
    novo_no->dado = valor; // Atribui o valor ao novo nó
    novo_no->esquerda = esquerda; // Define a subárvore esquerda
    novo_no->direita = direita; // Define a subárvore direita
    return novo_no; // Retorna o novo nó criado
}

// Função para contar o número de folhas na árvore
int contarFolhas(p_no raiz) {
    if (raiz == NULL) // Se a raiz for NULL, não há folhas
        return 0;
    if (raiz->esquerda == NULL && raiz->direita == NULL) // Se o nó não tiver filhos, é uma folha
        return 1;
    return contarFolhas(raiz->esquerda) + contarFolhas(raiz->direita); // Soma recursivamente as folhas das subárvores esquerda e direita
}

// Função para apagar folhas com um valor especificado
p_no apagarFolhas(p_no raiz, int chave) {
    if (raiz == NULL) // Se a raiz for NULL, não há o que apagar
        return NULL;

    if (raiz->esquerda == NULL && raiz->direita == NULL && raiz->dado == chave) { // Se o nó é uma folha e o valor corresponde à chave
        free(raiz); // Libera a memória do nó
        return NULL; // Retorna NULL para indicar que o nó foi removido
    }
    raiz->esquerda = apagarFolhas(raiz->esquerda, chave); // Apaga folhas na subárvore esquerda
    raiz->direita = apagarFolhas(raiz->direita, chave); // Apaga folhas na subárvore direita

    return raiz; // Retorna a raiz (potencialmente modificada)
}

// Função para comparar se duas árvores binárias são iguais
int iguais(p_no raiz1, p_no raiz2) {
    if (raiz1 == NULL && raiz2 == NULL) // Se ambas as árvores são nulas, elas são iguais
        return 1;

    if ((raiz1 == NULL && raiz2 != NULL) || (raiz1 != NULL && raiz2 == NULL)) // Se uma das árvores é nula e a outra não, elas não são iguais
        return 0;

    if (raiz1->dado != raiz2->dado) // Se os valores dos nós não são iguais, então as árvores não são iguais
        return 0;

    if (iguais(raiz1->esquerda, raiz2->esquerda) == 0 || iguais(raiz1->direita, raiz2->direita) == 0) // Compara recursivamente as subárvores esquerda e direita
        return 0;

    return 1; // Retorna 1 se as árvores forem iguais
}

// Função para imprimir a árvore em ordem
void imprimir(p_no raiz) {
    if (raiz == NULL) { // Verifica se a árvore está vazia
        printf("Árvore vazia\n");
        return;
    }
    if (raiz->esquerda != NULL) { // Imprime a subárvore esquerda
        imprimir(raiz->esquerda);
    }
    printf("%d ", raiz->dado); // Imprime o dado do nó atual

    if (raiz->direita != NULL) { // Imprime a subárvore direita
        imprimir(raiz->direita);
    }
}

// Função auxiliar para analisar a saída da função "iguais" e imprimir se é verdadeiro ou falso
void verificar(int valor) {
    if (valor == 1)
        printf("\nVerdadeiro");
    else
        printf("\nFalso");
}

int main(void) {
    // Letra A
    // Criando árvore binária 1
    p_no raiz_1 = criarArvore(1, NULL, NULL);
    printf("%d\n", contarFolhas(raiz_1));

    // Criando árvore binária 2
    p_no no1 = criarArvore(6, NULL, NULL);
    p_no no2 = criarArvore(7, NULL, NULL);
    p_no no3 = criarArvore(7, no2, NULL);
    p_no no4 = criarArvore(9, no1, no3);
    p_no no5 = criarArvore(5, NULL, NULL);
    p_no no6 = criarArvore(7, NULL, NULL);
    p_no no7 = criarArvore(8, no5, no6);
    p_no no8 = criarArvore(5, NULL, no7);
    p_no no9 = criarArvore(6, no4, no8);
    printf("%d\n", contarFolhas(no9));

    // Criando árvore binária 3
    p_no noA = criarArvore(6, NULL, NULL);
    p_no noB = criarArvore(9, noA, NULL);
    p_no noC = criarArvore(5, NULL, NULL);
    p_no noD = criarArvore(7, NULL, NULL);
    p_no noE = criarArvore(8, noC, noD);
    p_no noF = criarArvore(7, NULL, noE);
    p_no noG = criarArvore(6, noB, noF);
    printf("%d\n", contarFolhas(noG));

    // Letra B
    printf("\n");
    p_no raiz2 = criarArvore(1, NULL, NULL);
    raiz2 = apagarFolhas(raiz2, 1);
    imprimir(raiz2);

    apagarFolhas(no9, 7);
    imprimir(no9);
    printf("\n");

    apagarFolhas(noG, 7);
    imprimir(noG);
    printf("\n");

    // Letra C
    p_no folhaA = criarArvore(6, NULL, NULL);
    p_no folhaB = criarArvore(9, folhaA, NULL);
    p_no folhaC = criarArvore(5, NULL, NULL);
    p_no folhaD = criarArvore(8, NULL, folhaC);
    p_no folhaE = criarArvore(7, folhaD, NULL);
    p_no folhaF = criarArvore(6, folhaB, folhaE);

    p_no folhaG = criarArvore(6, NULL, NULL);
    p_no folhaH = criarArvore(9, folhaG, NULL);
    p_no folhaI = criarArvore(5, NULL, NULL);
    p_no folhaJ = criarArvore(8, folhaI, NULL);
    p_no folhaK = criarArvore(7, NULL, folhaJ);
    p_no folhaL = criarArvore(6, folhaB, folhaK);

    verificar(iguais(folhaF, folhaL));
    verificar(iguais(folhaF, folhaF));

    return 0;
}
