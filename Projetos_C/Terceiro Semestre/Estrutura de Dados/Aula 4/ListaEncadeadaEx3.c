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
    printf("\n");
}

int vazia(Pno inicio){
    if(inicio==NULL)
        return 1;
    else 
        return 0;
}

void inserirOrdenado(Pno* inicio, Pno* novo){
    Pno anterior;
    if(vazia(*inicio))
        *inicio=*novo;
    else{
        anterior=*inicio;
        while(anterior->proximo!=NULL&&anterior->proximo->valor<(*novo)->valor)
            anterior=anterior->proximo;
        (*novo)->proximo=anterior->proximo;
        anterior->proximo=(*novo);
    }
}

Pno concatenar(Pno *inicio1, Pno *inicio2){
    Pno auxiliar= *inicio1;
    while (auxiliar->proximo!=NULL)
        auxiliar=auxiliar->proximo;
    auxiliar->proximo=*inicio2;
    return *inicio1;
}

int contarElementos(Pno inicio){
    int nElementos=0;
    Pno auxiliar=inicio;
    while(auxiliar!=NULL){
        nElementos++;
        auxiliar=auxiliar->proximo;
    }
    return nElementos;
}

int somaInteiros(Pno inicio){
    int soma=0;
    Pno auxiliar=inicio;
    while(auxiliar!=NULL){
        soma=soma+auxiliar->valor;
        auxiliar=auxiliar->proximo;
    }
    return soma;
}

/*void inserirOrdenadoReverso(Pno* inicio, Pno* novo){
    Pno anterior;
    if(vazia(*inicio))
        *inicio=*novo;
    else{
        anterior=*inicio;
        while(anterior->proximo!=NULL&&anterior->proximo->valor>(*novo)->valor)
            anterior=anterior->proximo;
        (*novo)->proximo=anterior->proximo;
        anterior->proximo=(*novo);
    }
}*/

void inserirOrdenadoReverso(Pno* inicio, Pno* novo){
    if(vazia(*inicio) || (*novo)->valor > (*inicio)->valor) {
        (*novo)->proximo = *inicio;
        *inicio = *novo;
    } else {
        Pno anterior = *inicio;
        while(anterior->proximo != NULL && anterior->proximo->valor > (*novo)->valor)
            anterior = anterior->proximo;
        (*novo)->proximo = anterior->proximo;
        anterior->proximo = *novo;
    }
}


void removerTerceiro(Pno* inicio){
    Pno anterior=*inicio;
    Pno alvo=*inicio;
    int qElementos;
    if(!vazia(*inicio)){
        qElementos=contarElementos(*inicio);
        if (qElementos<3){
            while(alvo->proximo!=NULL){
                anterior=alvo;
                alvo=alvo->proximo;
            }
            if(alvo==(*inicio))
                *inicio=NULL;
            anterior->proximo=NULL;
            free(alvo);
        }
        else{
            anterior=anterior->proximo;
            alvo=anterior->proximo;
            anterior->proximo=alvo->proximo;
            free(alvo);
        }
    }
}

/*void parOuImpar(Pno *inicio, Pno *inicioPar, Pno *inicioImpar){
    Pno auxiliar=*inicio;
    Pno ultimoPar=*inicioPar;
    Pno ultimoImpar=*inicioImpar;
    if(!vazia(*inicio)){
        while(auxiliar->proximo!=NULL){
            if (auxiliar->valor%2==0)
            {
                if(ultimoPar==NULL)
                    ultimoPar=auxiliar;
                ultimoPar->proximo=auxiliar;
                ultimoPar=ultimoPar->proximo;
                ultimoPar->proximo==NULL;
            }
            else {
                if(ultimoImpar==NULL)
                    ultimoImpar=auxiliar;
                ultimoImpar->proximo=auxiliar;
                ultimoImpar=ultimoImpar->proximo;
                ultimoImpar->proximo==NULL;
            }
            auxiliar=auxiliar->proximo;
        }
    }
}*/

void parOuImpar(Pno *inicio, Pno *inicioPar, Pno *inicioImpar) {
    Pno auxiliar = *inicio;
    Pno ultimoPar = NULL;
    Pno ultimoImpar = NULL;

    if (!vazia(*inicio)) {
        while (auxiliar != NULL) {
            if (auxiliar->valor % 2 == 0) {
                if (ultimoPar == NULL) {
                    *inicioPar = auxiliar;
                    ultimoPar = *inicioPar;
                } else {
                    ultimoPar->proximo = auxiliar;
                    ultimoPar = ultimoPar->proximo;
                }
            } else {
                if (ultimoImpar == NULL) {
                    *inicioImpar = auxiliar;
                    ultimoImpar = *inicioImpar;
                } else {
                    ultimoImpar->proximo = auxiliar;
                    ultimoImpar = ultimoImpar->proximo;
                }
            }
            auxiliar = auxiliar->proximo;
        }
        if (ultimoPar != NULL) {
            ultimoPar->proximo = NULL;
        }
        if (ultimoImpar != NULL) {
            ultimoImpar->proximo = NULL;
        }
    }
}
void separaImparPar(Pno *inicio1, Pno *InicioImpar, Pno *inicioPar ){
    Pno ultimo= *inicio1;
    Pno novo;

while(ultimo!=NULL){

        if(ultimo->valor%2==0){
            novo= criaElemento(ultimo->valor);
             inserirOrdenado(inicioPar, &novo);
        }
        else{
            novo= criaElemento(ultimo->valor);
             inserirOrdenado(InicioImpar, &novo);
        }

         ultimo = ultimo->proximo;
}
}

Pno terceiraLista(Pno* inicio1, Pno* inicio2){
    Pno inicio3;
    if(vazia(*inicio1)&&(!vazia(*inicio2)))
        return *inicio2;
    else if(!vazia(*inicio1)&&vazia(*inicio2))
        return *inicio1;
    else if(vazia(*inicio1)&&(vazia(*inicio2)))
        return NULL;
    else{
        inicio3=*inicio1;
        Pno auxiliar=inicio3;
        while(auxiliar->proximo!=NULL)
            auxiliar=auxiliar->proximo;
        auxiliar->proximo=*inicio2;
    }
    return inicio3;
}
int main (void){
    Pno inicio1=NULL;
    Pno inicio2=NULL;
    Pno novo;
    for(int i=0; i<6; i++){
        novo=criaElemento(i);
        inserirOrdenado(&inicio1, &novo);
    }
    for(int i=6; i<11; i++){
        novo=criaElemento(i);
        inserirOrdenado(&inicio2, &novo);
    }
    imprimeLista(inicio1);
    imprimeLista(inicio2);
    Pno inicioConc=concatenar(&inicio1,&inicio2);
    
    imprimeLista(inicioConc);

    printf("Quantidade: %d\n", contarElementos(inicioConc));
    printf("Soma: %d\n", somaInteiros(inicioConc));

    Pno inicioReverso=NULL;
    for(int i=0; i<6; i++){
        novo=criaElemento(i);
        inserirOrdenadoReverso(&inicioReverso, &novo);
    }
    imprimeLista(inicioReverso);

    removerTerceiro(&inicioReverso);
    imprimeLista(inicioReverso);

    Pno inicioPar=NULL;
    Pno inicioImpar=NULL;
    /*parOuImpar(&inicioConc, &inicioPar, &inicioImpar);
    imprimeLista(inicioPar);
    imprimeLista(inicioImpar);

    Pno inicio3=terceiraLista(&inicioPar, &inicioImpar);
    imprimeLista(inicio3);*/

    separaImparPar(&inicioConc, &inicioPar, &inicioImpar);
    imprimeLista(inicioPar);
    imprimeLista(inicioImpar);

    return 0;
}