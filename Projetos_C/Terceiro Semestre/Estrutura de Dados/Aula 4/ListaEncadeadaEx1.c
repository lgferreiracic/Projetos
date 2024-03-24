#include <stdio.h>
#include <stdlib.h>

struct elemento{
    int valor;
    struct elemento * proximo;
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

void insereOrdenado(Pno *inicio, Pno *novo){
    Pno anterior;
    if(vazia(*inicio))
        *inicio=*novo;
    else{
        anterior=*inicio;
        while((anterior->proximo!=NULL)&&(anterior->proximo->valor<(*novo)->valor))
            anterior=anterior->proximo;
        (*novo)->proximo=anterior->proximo;
        anterior->proximo=*novo;
    }
}

void removeAlvo(Pno *inicio, Pno *alvo){
    Pno anterior;
    if(!vazia(*inicio)){
        if(*inicio==*alvo){
            *inicio=(*inicio)->proximo;
            free(*alvo);
        }
        else{
            anterior=(*inicio);
            while(anterior->proximo!=(*alvo))
                anterior=anterior->proximo;
            anterior->proximo=(*alvo)->proximo;
            free(*alvo);
        }
    }
}

Pno busca(Pno *inicio, int valor){
    Pno alvo=(*inicio);
    while(alvo!=NULL){
        if(alvo->valor==valor)
            return alvo;
        alvo=alvo->proximo;
    }
    return alvo;
}


int main (void){
    Pno inicio=NULL;
    Pno novo, alvo;
    int x;
    x=1;
    novo=criaElemento(x);
    insereOrdenado(&inicio, &novo);
    x=2;
    novo=criaElemento(x);
    insereOrdenado(&inicio, &novo);
    novo=criaElemento(x);
    insereOrdenado(&inicio, &novo);
    x=3;
    novo=criaElemento(x);
    insereOrdenado(&inicio, &novo);
    imprimeLista(inicio);
    printf("\n");
    do{
        alvo=busca(&inicio, 2);
        if(alvo){
            removeAlvo(&inicio, &alvo);
        }
    }while (alvo);
    imprimeLista(inicio);

    return 0;
}



