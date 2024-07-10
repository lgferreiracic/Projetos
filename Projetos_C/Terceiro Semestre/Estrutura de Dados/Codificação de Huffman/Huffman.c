#include <stdio.h>
#include <stdlib.h>
#define TAMANHO 27

struct No {
    unsigned char carac;
    int freq;
    struct No *esq, *dir, *pai;
};
typedef struct No *p_no;
typedef struct No no;

struct Pilha {
    int topo;
    p_no vetor_no[TAMANHO];
};
typedef struct Pilha *pilha_no;
typedef struct Pilha aux_no;

p_no criar_no(int freq, char carac, p_no esq, p_no dir) {
    p_no r = (p_no)malloc(sizeof(no));
    r->freq = freq;
    r->carac = carac;
    r->esq = esq;
    r->dir = dir;
    r->pai = NULL;

    if (r->esq != NULL)
        r->esq->pai = r;
    if (r->dir != NULL)
        r->dir->pai = r;
    return r;
}

void inicializa_vetor(int *vetor_freq) {
    for (int i = 0; i < TAMANHO; i++) {
        vetor_freq[i] = 0;
    }
}

int informa_indice(char caracter) {
    if (caracter == ' ') {
        return 0;
    } else {
        int valor = (caracter - 'a') + 1;
        return valor;
    }
}

void informa_freq(unsigned char *texto, int *vetor_freq) {
    int indice = 0;
    while (texto[indice] != '\0') {
        unsigned char caracter = texto[indice];
        int posicao = informa_indice(caracter);
        vetor_freq[posicao] += 1;
        indice++;
    }
}

void imprime_freq(int *vetor_freq) {
    for (int i = 0; i < TAMANHO; i++) {
        if (i == 0) {
            printf("  : %d\n", vetor_freq[i]);
        } else {
            printf("%c : %d\n", 'a' + (i - 1), vetor_freq[i]);
        }
    }
}

void push(pilha_no pilha, p_no novo_no) {
    if (pilha->topo == TAMANHO - 1)
        return;
    else {
        pilha->topo++;
        pilha->vetor_no[pilha->topo] = novo_no;
    }
}

void cria_pilha(pilha_no pilha, int *vetor_freq) {
    for (int i = 0; i < TAMANHO; i++) {
        if (vetor_freq[i] != 0) {
            unsigned char aux_caracter = 'a' + (i - 1);
            if (i == 0) {
                aux_caracter = ' ';
                p_no novo_no = criar_no(vetor_freq[i], aux_caracter, NULL, NULL);
                push(pilha, novo_no);
            } else {
                p_no novo_no = criar_no(vetor_freq[i], aux_caracter, NULL, NULL);
                push(pilha, novo_no);
            }
        }
    }
}

void Pop(pilha_no pilha) {
    if (pilha->topo == -1)
        return;
    else {
        pilha->topo--;
    }
}

void ordena_vetor(pilha_no pilha) {
    if (pilha->topo <= 0)
        return;

    for (int i = 0; i <= pilha->topo; i++) {
        for (int j = 0; j <= pilha->topo - 1 - i; j++) {
            if (pilha->vetor_no[j]->freq == pilha->vetor_no[j + 1]->freq) {
                if (pilha->vetor_no[j]->carac > pilha->vetor_no[j + 1]->carac) {
                    p_no temp = pilha->vetor_no[j];
                    pilha->vetor_no[j] = pilha->vetor_no[j + 1];
                    pilha->vetor_no[j + 1] = temp;
                }
            } else if (pilha->vetor_no[j]->freq < pilha->vetor_no[j + 1]->freq) {
                p_no temp = pilha->vetor_no[j];
                pilha->vetor_no[j] = pilha->vetor_no[j + 1];
                pilha->vetor_no[j + 1] = temp;
            }
        }
    }
}

p_no cria_arvore(pilha_no pilha) {
    while (pilha->topo > 0) {
        p_no aux1_no = pilha->vetor_no[pilha->topo];
        Pop(pilha);

        p_no aux2_no = pilha->vetor_no[pilha->topo];
        Pop(pilha);

        int soma_freq = (aux1_no->freq + aux2_no->freq);
        p_no novo_no = criar_no(soma_freq, '+', aux1_no, aux2_no);

        push(pilha, novo_no);
        //ordena_vetor(pilha);
    }
    return pilha->vetor_no[pilha->topo];
}

void imprimeArvore(p_no raiz) {
    if (raiz == NULL) {
        printf("Arvore vazia\n");
        return;
    }
    if (raiz->esq != NULL) {
        imprimeArvore(raiz->esq);
    }
    printf("%c ", raiz->carac);
    if (raiz->dir != NULL) {
        imprimeArvore(raiz->dir);
    }
}

int main(void) {
    pilha_no pilha = (pilha_no)malloc(sizeof(aux_no));
    pilha->topo = -1;
    unsigned char palavra[100];
    int vetor_freq[TAMANHO];
    inicializa_vetor(vetor_freq);
    informa_freq("", vetor_freq);
    imprime_freq(vetor_freq);

    cria_pilha(pilha, vetor_freq);
    ordena_vetor(pilha);

    for (int i = 0; i <= pilha->topo; i++) {
        unsigned char letra = pilha->vetor_no[i]->carac;
        printf("\n%c", letra);
    }

    p_no raiz = cria_arvore(pilha);
    printf("\nIn-order traversal of Huffman Tree:\n");
    imprimeArvore(raiz);
    printf("\n\n%c", raiz->esq->carac);
    printf("\n\n%c", raiz->dir->carac);
    printf("\n\n%c", raiz->esq->esq->carac);
    printf("\n\n%c", raiz->esq->dir->carac);
    free(pilha);
    return 0;
}
    