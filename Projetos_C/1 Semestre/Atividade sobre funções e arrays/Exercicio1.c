#include <stdio.h>
#include <stdlib.h>
int numerosPares(int* vetorNumeros, int qNumeros);
int main (void){
    int qNum;
    printf("Digite a quantidade de numeros do array\n");
    scanf("%d", &qNum);
    int *vetorNum;
    vetorNum=(int*)malloc(sizeof(int)*qNum);
    if(vetorNum==NULL)
    {
        printf("Erro ao alocar memoria\n");
        return 1;
    }
    for(int i = 0; i<qNum; i++){
        printf("Digite um numero inteiro\n");
        scanf("%d", &vetorNum[i]);
    }
    printf("Quantidade de numeros pares: %d", numerosPares(vetorNum, qNum));
    free(vetorNum);
    return 0;
}
int numerosPares(int* vetorNumeros, int qNumeros){
    int numPar=0;
    for(int i=0; i<qNumeros; i++)
        numPar=vetorNumeros[i]%2==0?numPar+1:numPar;
    return numPar;
}