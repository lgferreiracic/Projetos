#include <stdio.h>
#include <stdlib.h>

int main(void) {
    long long int nEstrelas;
    long long int nVizitados = 0;
    long long int nCarneiros = 0;
    long long int i;
    
    scanf("%lld", &nEstrelas);
    long long int *estrelas = malloc(nEstrelas * sizeof(long long int));
    long long int *vizitado = malloc(nEstrelas * sizeof(long long int));
    
    for (i = 0; i < nEstrelas; i++) {
        scanf("%lld", &estrelas[i]);
        nCarneiros += estrelas[i];
        vizitado[i] = 0;
    }
    
    i = 0;
    while (i >= 0 && i < nEstrelas) {
        if (vizitado[i] == 0) {
            vizitado[i] = 1;
            nVizitados++;
        }
        if (estrelas[i] % 2 == 0 && estrelas[i] > 0) {
            estrelas[i]--;
            nCarneiros--;
            i--;
        } else if (estrelas[i] % 2 == 1 && estrelas[i] > 0) {
            estrelas[i]--;
            nCarneiros--;
            i++;
        } else if (estrelas[i] == 0) {
            break;
        }
    }
    
    printf("%lld %lld\n", nVizitados, nCarneiros);
    
    free(estrelas); 
    free(vizitado);
    
    return 0;
}
