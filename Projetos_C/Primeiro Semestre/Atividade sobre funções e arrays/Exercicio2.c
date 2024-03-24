#include <stdio.h>
#include <stdlib.h>
#include <time.h>

int quantasVezesTem(int qNumeros, int qualNumero, int* vetorInteiros);
int main (void){
    int n, x;
    int* vetorInt;
    srand(time(NULL));
    printf("Qual o tamanho do vetor?\n");
    scanf("%d", &n);
    vetorInt=(int*)malloc(sizeof(int)*n);
    for (int i=0; i<n; i++)
        vetorInt[i]=rand()%11;
    printf("Qual numero procurar?\n");
    scanf("%d", &x);
    printf("O numero aparece %d vezes\n", quantasVezesTem(n, x, vetorInt));
    for (int i=0; i<n; i++)
     printf("%d\t", vetorInt[i]);
    return 0;
}
int quantasVezesTem(int qNumeros, int qualNumero, int* vetorInteiros){
    int quantasVezes=0;
    for(int i = 0; i<qNumeros; i++){
        if (vetorInteiros[i]==qualNumero)
            quantasVezes++;
    }
    return quantasVezes;
}
