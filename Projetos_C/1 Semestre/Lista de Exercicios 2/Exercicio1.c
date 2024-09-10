#include <stdio.h>
int main (void){
    float qKm, qL, tKm, tL;
    qKm=qL=tKm=tL=0;
    while(qL!=-1){
        printf("Entre com os litros consumidos (-1 para finalizar):\n");
        scanf("%f", &qL);
        if(qL!=-1){
            tL=tL+qL;
            printf("Entre com os quilômetros percorridos:\n");
            scanf("%f", &qKm);
            tKm=tKm+qKm;
            printf("A taxa km/litro para esse tanque foi: %f\n", (float)qKm/qL);
        }
        else if(qL==-1){
            if (tL != 0) {
                printf("A taxa total de km/litro foi: %f\n", tKm / tL);
            } else {
                printf("Nenhum dado inserido.\n");
            }
        }
    }

    return 0;
}

