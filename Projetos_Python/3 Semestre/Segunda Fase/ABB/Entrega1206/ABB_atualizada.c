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

//Fun��o para criar no
p_no cria_pessoa(char nome[], int aux_cpf){
    p_no pessoa= (p_no)malloc(sizeof(aux_no));
    strcpy(pessoa->nome, nome);
    pessoa->cpf= aux_cpf;
    pessoa->esq= NULL;
    pessoa->dir= NULL;
    return pessoa;
}

//Fun��o para inserir N� na �rvore
p_no insere_pessoa(p_no raiz, p_no novo){
    //Se a raiz for nula, o novo n� ser� a raiz da �rvore
    if(raiz==NULL)
        return novo;
    /*Se n�o for nula, avalio se o cpf informado � menor ou maior que o da raiz
        Se for menor, � inserido na esqueda . Caso contr�rio, � inserido na direita*/
    if(novo->cpf < raiz->cpf)
        raiz->esq= insere_pessoa(raiz->esq, novo);
    else
        raiz->dir= insere_pessoa(raiz->dir, novo);

    //Retorna a raiz com os ponteiros atualizados
    return raiz;
}

//Fun��o para buscar o aluno na �rvore
p_no procura_pessoa(p_no raiz, int aux_cpf, int aux_nivel, int *nivel_final){
    p_no esq;
    /*Retorna a raiz caso o CPF seja encontrado ou se a raiz for NULL e atribui o valor informado
     no par�metro como o n�vel final*/
    if(raiz==NULL || raiz->cpf== aux_cpf){
         *nivel_final= aux_nivel;
           return raiz;
    }
    //Primeiro, percorre a �rvore pela esquerda. Se n�o encontrar, retorna NULL e a busca ser� reallizada no lado direito da �rvore, sempre somando um a cada busca
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

    //Lendo a quantidade de opera��es
    scanf("%d", &qtd_operacoes);

    for(int i=0; i<qtd_operacoes; i++){
            //Lendo a opera��o e o CPF
            scanf(" %c %d", &operacao, &aux_cpf);

            //Cria o n� de acordo com as informa��es dadas pelo usu�rio e o insere na �rvore
            if(operacao=='I'){
                scanf(" %[^\n]s", nome);
                p_no novo= cria_pessoa(nome, aux_cpf);
                raiz= insere_pessoa(raiz, novo);
            }
                 //Busca o n� de acordo com as informa��es dadas pelo usu�rio, retorna o nome do dono do CPF  e o n�vel do dado na �rvore
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
