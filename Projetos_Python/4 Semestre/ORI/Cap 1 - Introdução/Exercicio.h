#include <stdio.h>
#include <stdlib.h>
#define N = 100;

typedef struct{
    int codigo;
    char nome[50];
}Empresa;

typedef struct{
    Empresa empresas[N];
    int n; 
}Cadastro;

void inserirEmpresa(Cadastro *cadastro, int codigo){
    if(cadastro->n < N){
        cadastro->empresas[cadastro->n].codigo = codigo;
        cadastro->n++;
    }else{
        printf("Vetor cheio\n");
    }
}

Cadastro buscarEmpresa(Cadastro cadastro, int codigo){
    Cadastro resultado;
    resultado.n = 0;
    int i;
    for(i = 0; i < cadastro.n; i++){
        if(cadastro.empresas[i].codigo == codigo){
            resultado.empresas[resultado.n] = cadastro.empresas[i];
            resultado.n++;
        }
    }
    return resultado;
}

Cadastro buscaBinaria(Cadastro cadastro, int codigo){
    Cadastro resultado;
    resultado.n = 0;
    int inicio = 0, fim = cadastro.n-1, meio;
    while(inicio <= fim){
        meio = (inicio + fim) / 2;
        if(cadastro.empresas[meio].codigo == codigo){
            resultado.empresas[resultado.n] = cadastro.empresas[meio];
            resultado.n++;
            break;
        }else if(cadastro.empresas[meio].codigo < codigo){
            inicio = meio + 1;
        }else{
            fim = meio - 1;
        }
    }
    return resultado;
}
