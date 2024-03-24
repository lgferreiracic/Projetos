#include <stdio.h>
int main (void){
    int numConta;
    float saldoDev, totalItensCob, totalCredMes, limCredPerm;
    do {
        printf("Entre com o numero da conta (0 para finalizar):\n");
        scanf("%d", &numConta);
        if (numConta!=0){
            printf("Entre com o saldo inicial: \n");
            scanf("%f", &saldoDev);
            printf("Entre com o total de cobrancas: \n");
            scanf("%f",&totalItensCob);
            printf("Entre com o total de creditos: \n");
            scanf("%f", &totalCredMes);
            printf("Entre com o limite de credito: \n");
            scanf("%f", &limCredPerm);
            saldoDev=saldoDev+totalItensCob-totalCredMes;
            printf("Conta: %d\n", numConta);
            printf("Limite de Credito: %f\n", limCredPerm);
            printf("Saldo: %f\n", saldoDev);
            if(limCredPerm<saldoDev)
                printf("Limite de Credito Excedido\n");
        }
    }while(numConta!=0);

    return 0;
}