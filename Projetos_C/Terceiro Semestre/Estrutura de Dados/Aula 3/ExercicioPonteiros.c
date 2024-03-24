/*
Faça uma função chamada média que recebe um vetor de double, um
inteiro n que indica o tamanho do vetor, e um inteiro i passado por
referência. A função deve retornar a média dos n elementos no vetor e
no inteiro i, passado por referência, deve retornar a posição do
elemento que tem o valor mais próximo da média.*/

#include <stdio.h>
#include <stdlib.h>
#include <time.h>

double media(double vet[], int n, int *i);

int main (void){
    double* valores;
    int n, i;
    printf("\nQual o tamanho do vetor?");
    scanf("%d", &n);
    valores=(double*)malloc(sizeof(double)*n);
    srand(time(NULL));

    for (int i=0;i<n;i++){
        valores[i]=(double)rand()/RAND_MAX*10;
        printf("%f |", valores[i]);
    }
        
    printf("\nMedia: %f", media(valores, n, &i));
    printf("\nPosicao do valor mais proximo da media: %d", i);

    return 0;
}

double media(double vet[], int n, int *i){
    double media=0;
    int j;
    for(j=0; j<n; j++)
        media=media+vet[j];
    media=media/n;
    double diferenca=fabs(media-vet[0]);
    *i=0;
    for(j=1; j<n; j++)
        if(diferenca>fabs(media-vet[j]))
            *i=j;
return media;
}