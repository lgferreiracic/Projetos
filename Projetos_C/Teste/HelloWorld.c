#include <stdio.h>
#include <stdlib.h>
typedef struct{
    int dia;
    int mes;
    int ano;
}Nascimento;
typedef struct 
{
    char nome[20];
    char sobrenome[20];
    Nascimento data;
    float altura;
    int telefone;
}Pessoa;

int main (void){
    Pessoa* cidadao;
    int numPessoa;
    printf("Quantos cidadaos cadastrar?\n");
    scanf("%d", &numPessoa);
    cidadao=(Pessoa*)malloc(sizeof(Pessoa)*numPessoa);
    for(int i=0; i<numPessoa; i++){
        printf("Digite o nome do cidadao\n");
        scanf("%s", cidadao[i].nome);
        printf("Digite o sobrenome do cidadao\n");
        scanf("%s", cidadao[i].sobrenome);
        printf("Dia de nascimento\n");
        scanf("%d", &cidadao[i].data.dia);
        printf("Mes de nascimento\n");
        scanf("%d", &cidadao[i].data.mes);
        printf("Ano de nascimento\n");
        scanf("%d", &cidadao[i].data.ano);
        printf("Altura\n");
        scanf("%f", &cidadao[i].altura);
        printf("Telefone\n");
        scanf("%d", &cidadao[i].telefone);
    }
    for(int i=0; i<numPessoa; i++){
        printf("Nome: %s\n", cidadao[i].nome);
        printf("Sobrenome: %s\n", cidadao[i].sobrenome);
        printf("Nascimento: %d/%d/%d\n", cidadao[i].data.dia, cidadao[i].data.mes, cidadao[i].data.ano);
        printf("Altura: %f\n", cidadao[i].altura);
        printf("Telefone: %d\n", cidadao[i].telefone);
    }


    return 0;
}