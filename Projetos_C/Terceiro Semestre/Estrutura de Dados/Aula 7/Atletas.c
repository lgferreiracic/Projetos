#include <stdio.h>
#include <stdlib.h>
#include <string.h>

struct atleta {
    char nome[100];
    int id, n_ouro, n_prata, n_bronze;
    struct atleta* prox;
};

typedef struct atleta Atleta;
typedef struct atleta* PontAtleta;

//recebe dados(nome, id, numero de medalhas) e retorna um elemento com este dado
PontAtleta criaAtleta(char nome[], int id, int n_ouro, int n_prata, int n_bronze) {
    PontAtleta novo;
    novo = (PontAtleta)malloc(sizeof(Atleta));
    strcpy(novo->nome, nome);
    novo->id = id;
    novo->n_ouro = n_ouro;
    novo->n_prata = n_prata;
    novo->n_bronze = n_bronze;
    novo->prox = NULL;
    return novo;
}

/* Percorre e imprimir lista. Recebe o início da lista*/
void mostrarLista(PontAtleta inicio) {
    PontAtleta atual;
    atual = inicio;
    while (atual != NULL) {
        printf("%d ", atual->id);
        atual = atual->prox;
    }
}

/* verifica se é vazia. Se sim, retorna 1; se não, retorna 0. */
int vazia(PontAtleta inicio) {
    if (inicio==NULL)
		return 1;
	else
		return 0;
}

//insere um atleta ao final da lista
void insereFim(PontAtleta* inicio, PontAtleta *novo) {
    PontAtleta ultimo;

    if (vazia(*inicio))
        *inicio = *novo;
    else {
        ultimo = *inicio;
        while (ultimo->prox != NULL)
            ultimo = ultimo->prox;

        ultimo->prox = *novo;
    }
}

//Remove atletas com total de medalhas sendo um numero par
void removePar(PontAtleta* inicio) {
    PontAtleta auxiliar = *inicio;
    PontAtleta anterior = NULL;
    int nMedalhas;
    while (auxiliar != NULL) {
        nMedalhas = auxiliar->n_ouro + auxiliar->n_prata + auxiliar->n_bronze;
        if (nMedalhas % 2 == 0) {
            if (anterior == NULL) {
                *inicio = auxiliar->prox;
                free(auxiliar);
                auxiliar = *inicio;
            } else {
                anterior->prox = auxiliar->prox;
                free(auxiliar);
                auxiliar = anterior->prox;
            }
        } else {
            anterior = auxiliar;
            auxiliar = auxiliar->prox;
        }
    }
}

int main(void) {
    int numAtletas, j;
    scanf("%d", &numAtletas); //Entrada do numero de atletas
    PontAtleta inicio = NULL;

    for (j = 0; j < numAtletas; j++) {
        char nome[100];
        int id, n_ouro, n_prata, n_bronze;
        scanf("%d %s", &id, nome); //Entrada do id e do nome do atleta
        scanf("%d %d %d", &n_ouro, &n_prata, &n_bronze); //Entrada do numero de medalhas (ouro, prata e bronze)
        PontAtleta novoAtleta = criaAtleta(nome, id, n_ouro, n_prata, n_bronze);
        insereFim(&inicio, &novoAtleta);
    }

    removePar(&inicio);

    mostrarLista(inicio);

    return 0;
}
