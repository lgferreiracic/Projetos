#include <stdio.h>
int main (void){
    float venda;
    do {
        printf("Entre com a venda (-1 para finalizar): \n");
        scanf("%f", &venda);
        if (venda!=-1)  
            printf("Salario: %f\n", 200+venda*0.09);

    }while(venda!=-1);
    return 0;
}