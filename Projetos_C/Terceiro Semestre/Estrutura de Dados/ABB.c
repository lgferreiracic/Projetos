#include <stdio.h>
#include <stdlib.h>
#include <string.h>

//Estrutura para o No
struct No{
    char nome[100];
    int cpf;
    struct No *esq, *dir;
};

typedef struct No *p_no;
typedef struct No aux_no;

//Função para criar no
p_no cria_pessoa(char nome[], int aux_cpf){
    p_no pessoa= (p_no)malloc(sizeof(aux_no));
    strcpy(pessoa->nome, nome);
    pessoa->cpf= aux_cpf;
    pessoa->esq= NULL;
    pessoa->dir= NULL;
    return pessoa;
}

//Função para inserir Nó na árvore
p_no insere_pessoa(p_no raiz, p_no novo){
    if(raiz==NULL)
        return novo;
    if(novo->cpf < raiz->cpf)
        raiz->esq= insere_pessoa(raiz->esq, novo);
    else
        raiz->dir= insere_pessoa(raiz->dir, novo);

    return raiz;
}

//Função para descobrir o nível de um nó em uma árvore
int nivel_no(p_no raiz, int aux_cpf, int nivel){
    int esq;
    if(raiz==NULL)
        return -1;
    if(raiz->cpf== aux_cpf)
        return nivel;
    esq= nivel_no(raiz->esq, aux_cpf, nivel+1);
    if(esq!=-1)
        return esq;
    return nivel_no(raiz->dir, aux_cpf, nivel+1);
}

//Função para buscar o aluno na árvore
p_no procura_pessoa(p_no raiz, int aux_cpf){
    p_no esq;
    if(raiz==NULL || raiz->cpf== aux_cpf)
        return raiz;
    esq= procura_pessoa(raiz->esq, aux_cpf);
    if(esq!= NULL)
        return esq;
    return procura_pessoa(raiz->dir, aux_cpf);
}
int main(void){
    int nivel=0;
    int qtd_operacoes=0;
    char operacao;
    char nome[100];
    int aux_cpf;
    p_no raiz= NULL;

    scanf("%d", &qtd_operacoes);
    for(int i=0; i<qtd_operacoes; i++){
            scanf(" %c %d", &operacao, &aux_cpf);
            if(operacao=='I'){
                scanf(" %[^\n]s", nome);
                p_no novo= cria_pessoa(nome, aux_cpf);
                raiz= insere_pessoa(raiz, novo);
            }
            else{
                nivel= nivel_no(raiz, aux_cpf,1);
                    p_no aux_pessoa=  procura_pessoa(raiz, aux_cpf);
                    if (aux_pessoa != NULL) {
                        printf("%s %d\n", aux_pessoa->nome, nivel);
                    }
            }
    }

    return 0;
}
