#include <stdio.h>
#include <stdlib.h>

struct elemento{
    int valor;
    struct elemento* proximo;
};
typedef struct elemento No;
typedef struct elemento* Pno;

Pno criaElemento(int valor){
    Pno novo;
    novo=(Pno)malloc(sizeof(No));
    novo->valor=valor;
    novo->proximo=NULL;
    return novo;
}

void imprimeLista(Pno inicio){
    Pno atual;
    atual=inicio;
    while(atual!=NULL){
        printf("%d ", atual->valor);
        atual=atual->proximo;
    }
}

int vazia(Pno inicio){
    if(inicio==NULL)
        return 1;
    else
        return 0;
}

void inserirFim(Pno *inicio, Pno *novo){
    Pno ultimo;
    if(*inicio==NULL)
        *inicio=*novo;
    else{
        ultimo=*inicio;
        while(ultimo->proximo!=NULL)
            ultimo=ultimo->proximo;
        ultimo->proximo=*novo;
    }
}

void removerInicio(Pno *inicio){
    if(!vazia(*inicio)){
        Pno alvo=*inicio;
        *inicio=alvo->proximo;
        free(alvo);
    }
}

int main(void){
    Pno inicio=NULL;
    Pno novo;
    for (int i=0; i<5; i++){
        novo=criaElemento(i);
        inserirFim(&inicio, &novo);
    }
    imprimeLista(inicio);
    printf("\n");
    removerInicio(&inicio);
    imprimeLista(inicio);
    return 0;
}




