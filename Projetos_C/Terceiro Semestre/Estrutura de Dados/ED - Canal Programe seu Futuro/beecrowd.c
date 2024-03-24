#include <stdio.h>
#include <stdlib.h>

int main(void) {
    int n_saques = 0;
    int n_bloqueios = 0;
    int n_ataque = 0;
    char nome[100];

    int tot_saques = 0;
    int tot_bloq = 0;
    int tot_ataques = 0;

    float tot_sucSaq = 0;
    float tot_sucAta = 0;
    float tot_sucBloq = 0;

    float total_sucessos = 0; // Total de sucessos para evitar divisão por zero

    int qtd = 0;
    scanf("%d", &qtd);

    for (int i = 0; i < qtd; i++) {
        scanf("%s", nome);
        scanf("%d %d %d", &n_saques, &n_bloqueios, &n_ataque);
        scanf("%f %f %f", &tot_sucSaq, &tot_sucBloq, &tot_sucAta);

        tot_saques += n_saques;
        tot_bloq += n_bloqueios;
        tot_ataques += n_ataque;

        total_sucessos += tot_sucSaq + tot_sucBloq + tot_sucAta;
    }

    // Verifica se há divisão por zero
    if (total_sucessos != 0) {
        // Calcula o percentual total de saques, bloqueios e ataques
        float percent_saque = ((float)tot_saques / total_sucessos) * 100;
        float percent_bloqueio = ((float)tot_bloq / total_sucessos) * 100;
        float percent_ataque = ((float)tot_ataques / total_sucessos) * 100;

        printf("Pontos de Saque: %.2f\n", percent_saque);
        printf("Pontos de Bloqueio: %.2f\n", percent_bloqueio);
        printf("Pontos de Ataque: %.2f\n", percent_ataque);
    } else {
        printf("Não foi possível calcular os percentuais, pois o total de sucessos é zero.\n");
    }

    return 0;
}