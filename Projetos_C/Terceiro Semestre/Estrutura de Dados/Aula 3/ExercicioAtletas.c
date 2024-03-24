#include <stdio.h>
#include <stdlib.h>

typedef struct {
    char nome[100];
    int id, n_ouro, n_prata, n_bronze;
}Atleta;

void comparar(Atleta *atletas, int atleta1, int atleta2){ //Funcao que realiza a comparacao dos atletas
	if(atletas[atleta1].n_ouro>atletas[atleta2].n_ouro)
			printf("%d\n", atletas[atleta1].id);
		else if (atletas[atleta1].n_ouro<atletas[atleta2].n_ouro)
			printf("%d\n", atletas[atleta2].id);
		else{
			if(atletas[atleta1].n_prata>atletas[atleta2].n_prata)
				printf("%d\n", atletas[atleta1].id);
			else if (atletas[atleta1].n_prata<atletas[atleta2].n_prata)
				printf("%d\n", atletas[atleta2].id);
			else{
				if(atletas[atleta1].n_bronze>atletas[atleta2].n_bronze)
					printf("%d\n", atletas[atleta1].id);
				else if (atletas[atleta1].n_bronze<atletas[atleta2].n_bronze)
					printf("%d\n", atletas[atleta2].id);
				else
					printf("empate\n");
			}
		}
}

int main(void) {
	int numAtletas, j; 
	scanf("%d", &numAtletas); //Entrada do numero de atletas
	Atleta *atletas=(Atleta*)malloc(sizeof(Atleta)*numAtletas);

	for (j=0; j<numAtletas; j++){
		scanf("%d %s", &atletas[j].id, atletas[j].nome); //Entrada do id e do nome do atleta
		scanf("%d %d %d", &atletas[j].n_ouro, &atletas[j].n_prata, &atletas[j].n_bronze); //Entrada do numero de medalhas (ouro, prata e bronze)
	}

	int numComp; 
	scanf("%d", &numComp); //Entrada do numero de comparacoes

	int atleta1, atleta2;
	for(j=0; j<numComp; j++)
	{
		scanf("%d %d", &atleta1, &atleta2); //Entrada dos ids dos atletas a serem comparados
		comparar(atletas, atleta1-1, atleta2-1); //Resultado da comparacao
	}

	free(atletas);
	
	return 0;
}
