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
    //Se a raiz for nula, o novo nó será a raiz da árvore
    if(raiz==NULL)
        return novo;
    /*Se não for nula, avalio se o cpf informado é menor ou maior que o da raiz
        Se for menor, é inserido na esqueda . Caso contrário, é inserido na direita*/
    if(novo->cpf < raiz->cpf)
        raiz->esq= insere_pessoa(raiz->esq, novo);
    else
        raiz->dir= insere_pessoa(raiz->dir, novo);

    //Retorna a raiz com os ponteiros atualizados
    return raiz;
}

//Função para buscar o aluno na árvore
p_no procura_pessoa(p_no raiz, int aux_cpf, int aux_nivel, int *nivel_final){
    p_no esq;
    /*Retorna a raiz caso o CPF seja encontrado ou se a raiz for NULL e atribui o valor informado
     no parâmetro como o nível final*/
    if(raiz==NULL || raiz->cpf== aux_cpf){
         *nivel_final= aux_nivel;
           return raiz;
    }
    //Primeiro, percorre a árvore pela esquerda. Se não encontrar, retorna NULL e a busca será reallizada no lado direito da árvore, sempre somando um a cada busca
    esq= procura_pessoa(raiz->esq, aux_cpf, aux_nivel+1, nivel_final);
    if(esq!= NULL)
        return esq;
    return procura_pessoa(raiz->dir, aux_cpf, aux_nivel+1, nivel_final);
}

int main(void){
    int qtd_operacoes=0;
    char operacao;
    char nome[100];
    int aux_cpf;
    p_no raiz= NULL;

    //Lendo a quantidade de operações
    scanf("%d", &qtd_operacoes);

    for(int i=0; i<qtd_operacoes; i++){
            //Lendo a operação e o CPF
            scanf(" %c %d", &operacao, &aux_cpf);

            //Cria o nó de acordo com as informações dadas pelo usuário e o insere na árvore
            if(operacao=='I'){
                scanf(" %[^\n]s", nome);
                p_no novo= cria_pessoa(nome, aux_cpf);
                raiz= insere_pessoa(raiz, novo);
            }
                 //Busca o nó de acordo com as informações dadas pelo usuário, retorna o nome do dono do CPF  e o nível do dado na árvore
            else{
                    //
                    int nivel_final= 0;
                    p_no aux_pessoa=  procura_pessoa(raiz, aux_cpf, 1, &nivel_final);
                    if (aux_pessoa != NULL) {
                        printf("%s %d\n", aux_pessoa->nome, nivel_final);
                    }
            }
    }

    return 0;
}
