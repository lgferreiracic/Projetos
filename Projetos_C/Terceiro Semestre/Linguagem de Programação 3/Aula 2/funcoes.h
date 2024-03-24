#include <stdio.h>
#include <stdlib.h>

typedef struct {
    int i;
    int j;
} Robo;

void limpar_tela() {
    #ifdef _WIN32
        system("cls");
    #else
        system("clear");
    #endif
}

int movimento_valido(char movimentar, Robo* posicao, int fabrica[5][5]) {
    if ((movimentar == 'c') && posicao->i > 0 && fabrica[posicao->i-1][posicao->j]!=2){
        fabrica[posicao->i][posicao->j]=0;
        return 1;
    }
    else if ((movimentar == 'b') && posicao->i < 4 && fabrica[posicao->i+1][posicao->j]!=2){
        fabrica[posicao->i][posicao->j]=0;
        return 1;
    }
    else if ((movimentar == 'e') && posicao->j > 0 && fabrica[posicao->i][posicao->j-1]!=2){
        fabrica[posicao->i][posicao->j]=0;
        return 1;
    }
    else if ((movimentar == 'd') && posicao->j < 4 && fabrica[posicao->i][posicao->j+1]!=2){
        fabrica[posicao->i][posicao->j]=0;
        return 1;
    }
    else
        return 0;
}

void mover_para_cima(int fabrica[5][5], Robo *posicao) {
    posicao->i --;
    fabrica[posicao->i][posicao->j] = 1;
    limpar_tela();
}

void mover_para_baixo(int fabrica[5][5], Robo *posicao) {
    posicao->i ++;
    fabrica[posicao->i][posicao->j] = 1;
    limpar_tela();
}

void mover_para_esquerda(int fabrica[5][5], Robo *posicao) {
    posicao->j--;
    fabrica[posicao->i][posicao->j] = 1;
    limpar_tela();
}

void mover_para_direita(int fabrica[5][5], Robo *posicao) {
    posicao->j++;
    fabrica[posicao->i][posicao->j] = 1;
    limpar_tela();
}

void limpar_buffer() {
    int c;
    while ((c = getchar()) != '\n');
}

void imprimirCenario(int fabrica[5][5]){
    int i, j;
    printf("\t\t1\t\t2\t\t3\t\t4\t\t5\n");
    printf("\t---------------------------------------------------------------------------------\n");
	for (i = 0; i < 5; i++) {
        printf("%d\t|\t", i+1);
        for (j = 0; j < 5; j++) {
            if (fabrica[i][j] == 0)
                printf(" \t|\t");
            else if(fabrica[i][j] == 1)
                printf("O\t|\t");
            else if(fabrica[i][j] == 2)
                printf("X\t|\t");
        }
        printf("\n");
        printf("\t---------------------------------------------------------------------------------\n");
    }      
}


;