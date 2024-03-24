#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>
#include "funcoes.h"

typedef struct 
    {
        int i;
        int j;
    }Obstaculos;

int main() {
    int opcao = 0;
    int fabrica[5][5];
    int i, j;
    Robo posicao;
    Obstaculos obstaculo;
    posicao.i=-1;
    for (i = 0; i < 5; i++)
        for (j = 0; j < 5; j++)
            fabrica[i][j] = 0;
    do {
        printf("ESCOLHA UMA OPCAO\n");
        printf("1-Posicionar robo\n");
        printf("2-Imprimir cenario\n");
        printf("3-Movimentar robo\n");
        printf("4-Posicionar obstaculo\n");
        printf("5-Encerrar\n");
        scanf("%d", &opcao);
        limpar_tela();
		switch (opcao)
		{
		case 1:
			printf("Qual a posicao do robo? (Linha)\n");
            scanf("%d", &posicao.i);
            printf("Qual a posicao do robo? (Coluna)\n");
            scanf("%d", &posicao.j);
            posicao.i--;
            posicao.j--;
            if(fabrica[posicao.i][posicao.j]!=2){
                for (i = 0; i < 5; i++)
                    for (j = 0; j < 5; j++)
                        fabrica[i][j]=fabrica[i][j]==1?0:fabrica[i][j];
                fabrica[posicao.i][posicao.j] = 1;
            }
            else{
                    printf("Existe um obstaulo nessa posicao\n");
                    limpar_buffer();
                    getchar();
            }
                
            limpar_tela();
			break;
		case 2:
            imprimirCenario(fabrica);
            if(posicao.i!=-1)
                printf("\n\n\t\tA posicao do robo e %d/%d\n", posicao.i + 1, posicao.j + 1);
			limpar_buffer();
            getchar();
            limpar_tela();
			break;
		case 3:
            if(posicao.i!=-1){
                char movimentar=' ';
                do{
                    limpar_tela();
                    imprimirCenario(fabrica);
                    printf("Para qual lado?\n");
                    printf("Cima = C\n");
                    printf("Baixo = B\n");
                    printf("Esquerda= E\n");
                    printf("Direita = D\n");
                    printf("Finalizar Movimentacao = F\n");
                    scanf(" %c", &movimentar);
			        movimentar=tolower(movimentar);
                    if (movimentar!='f'){
                        if (movimento_valido(movimentar, &posicao, fabrica)) {
                        switch (movimentar) {
                            case 'c':
                                mover_para_cima(fabrica, &posicao);
                            break;
                            case 'b':
                                mover_para_baixo(fabrica, &posicao);
                            break;
                            case 'e':
                                mover_para_esquerda(fabrica, &posicao);
                            break;
                            case 'd':
                                mover_para_direita(fabrica, &posicao);
                            break;
                            default:
                            break;
                        }
                        }
                        else{
                            limpar_tela();
                            printf("Movimento invalido.\n");
                            limpar_buffer();
                            getchar();
                        }
                    }     
                }while(movimentar!='f');
            }
            else{
                printf("O robo ainda nao foi posicionado para que possa se movimentar\n");
                limpar_buffer();
                getchar();    
                }
		limpar_tela();
		break;
        case 4:
            printf("Onde posicionar o obstaculo? (Linha)\n");
            scanf("%d", &obstaculo.i);
            printf("Onde posicionar o obstaculo? (Coluna)\n");
            scanf("%d", &obstaculo.j);
            obstaculo.i--;
            obstaculo.j--;
            if(fabrica[obstaculo.i][obstaculo.j]!=1&&fabrica[obstaculo.i][obstaculo.j]!=2)
                        fabrica[obstaculo.i][obstaculo.j]=2;
            else {
                printf("Movimento invalido.\n");
                limpar_buffer();
                getchar();
            }
			limpar_tela();
        break;
		}
    } while (opcao != 5);

    return 0;
}
