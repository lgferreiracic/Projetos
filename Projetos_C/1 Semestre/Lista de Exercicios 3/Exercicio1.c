#include <stdio.h>
int main (void){
    int qNum, soma=0;
    printf("Digite um numero inteiro\n");
    scanf("%d", &qNum);
    for(int i=0; i<qNum; i++){
        int num;
        printf("Digite um numero inteiro\n");
        scanf("%d", &num);
        soma=soma+num;
    }
    printf("Soma dos numeros inteiros: %d", soma);
    return 0;
}