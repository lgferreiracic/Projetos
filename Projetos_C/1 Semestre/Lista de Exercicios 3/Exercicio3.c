#include <stdio.h>
#include <stdlib.h>
#include <math.h>

int main(void) {
    float soma = 0, numAnt, num;

    printf("Digite um numero racional:\n");
    scanf("%f", &num);

    while (1) {
        soma = soma + num;
        numAnt = num;
        
        printf("Digite um numero racional:\n");
        scanf("%f", &num);
        
        if (fabs(num - numAnt) > 1) // Corrected syntax and condition
            break;
    }

    printf("A soma dos numeros racionais: %f\n", soma);
    return 0;
}
