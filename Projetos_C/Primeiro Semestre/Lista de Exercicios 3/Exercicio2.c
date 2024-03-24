#include <stdio.h>
int main (void){
    float soma;
    int qNum;
    printf("Digite um numero\n");
    scanf("%d", &qNum);
    for (int i=0; i<qNum; i++){
        float num;
        printf("Digite um numero racional\n");
        scanf ("%f", &num);
        soma=soma+num;
    }
    printf("A soma dos numeros racionais: %f", soma);
    return 0;
}