#include <stdio.h>
#include <stdlib.h>
#include <string.h>

//Arthur Moreira
//Breno Arouca

typedef struct arvore{
    char info;
    struct arvore *filhoEsquerdo;
    struct arvore *filhoDireito;
}arvore;

arvore *inicia(arvore *a, char c){
    a = (arvore*)malloc(sizeof(arvore));
    a->info=c;
    a->filhoEsquerdo=NULL;
    a->filhoDireito=NULL;
    return a;
}

void codifica(arvore *a, int i, char c, char *cod){
    if(cod[i] != '\0'){
        if(cod[i] == '0'){
            if(a->filhoEsquerdo == NULL)a->filhoEsquerdo=inicia(a->filhoEsquerdo, '\0');
            codifica(a->filhoEsquerdo, i+1,c,cod);
        }else{
            if(a->filhoDireito == NULL)a->filhoDireito=inicia(a->filhoDireito, '\0');
            codifica(a->filhoDireito, i+1,c,cod);
        }
    }else a->info=c;
}

void decodifica(arvore *a, char *txt, int tam){
    int i=0;
    char *decifrado=calloc((tam+1),sizeof(char));
    arvore *f=a;
    char temp[2];

    while(txt[i] != '\0'){
        if(f == NULL)break;

        if(txt[i] == '0')f=f->filhoEsquerdo;
        else f=f->filhoDireito;

        if(f != NULL && f->filhoEsquerdo == NULL && f->filhoDireito == NULL){
            temp[0]=f->info;
            temp[1]='\0';
            strcat(decifrado,temp);
            f=a;
        }
        i++;
    }
    printf("%s\n", decifrado);
}

int main(){
    int n,t,i, tam;
    char txt[10000], cod[100], c;
    arvore *a=NULL;

    while(scanf("%d%*c", &n) && n != 0){
        a=inicia(a,'\0');
        for(i=0;i<n;i++){
            scanf("'%c' ", &c);
            scanf("%s", cod);
            scanf("%*c");
            codifica(a,0,c,cod);
        }
        scanf("%d", &t);
        for(i=0;i<t;i++){
            scanf("%s", txt);
            tam=strlen(txt);
            decodifica(a,txt,tam);
        }
        free(a);
        printf("\n");
    }
}
