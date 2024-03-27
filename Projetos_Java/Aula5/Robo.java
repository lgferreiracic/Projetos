package Aula5;

public class Robo{
    public int i;
    public int j;

    public static int movimentoValido(char movimentar, Robo posicao, int[][] fabrica){
        if ((movimentar == 'c') && posicao.i > 0 && fabrica[posicao.i-1][posicao.j]!=2){
            fabrica[posicao.i][posicao.j]=0;
            return 1;
        }
        else if ((movimentar == 'b') && posicao.i < 4 && fabrica[posicao.i+1][posicao.j]!=2){
            fabrica[posicao.i][posicao.j]=0;
            return 1;
        }
        else if ((movimentar == 'e') && posicao.j > 0 && fabrica[posicao.i][posicao.j-1]!=2){
            fabrica[posicao.i][posicao.j]=0;
            return 1;
        }
        else if ((movimentar == 'd') && posicao.j < 4 && fabrica[posicao.i][posicao.j+1]!=2){
            fabrica[posicao.i][posicao.j]=0;
            return 1;
        }
        else
            return 0;
    }

    public static void mover_para_cima(int[][] fabrica, Robo posicao) {
        posicao.i --;
        fabrica[posicao.i][posicao.j] = 1;
        //limpar_tela();
    }

    public static void mover_para_baixo(int[][] fabrica, Robo posicao) {
        posicao.i ++;
        fabrica[posicao.i][posicao.j] = 1;
        //limpar_tela();
    }

    public static void mover_para_esquerda(int[][] fabrica, Robo posicao) {
        posicao.j--;
        fabrica[posicao.i][posicao.j] = 1;
        //limpar_tela();
    }

    public static void mover_para_direita(int[][] fabrica, Robo posicao) {
        posicao.j++;
        fabrica[posicao.i][posicao.j] = 1;
        //limpar_tela();
    }

    public static void imprimirCenario(int[][] fabrica){
        int i, j;
        System.out.printf("\t\t1\t\t2\t\t3\t\t4\t\t5\n");
        System.out.printf("\t---------------------------------------------------------------------------------\n");
        for (i = 0; i < 5; i++) {
            System.out.printf("%d\t|\t", i+1);
            for (j = 0; j < 5; j++) {
                if (fabrica[i][j] == 0)
                    System.out.printf(" \t|\t");
                else if(fabrica[i][j] == 1)
                    System.out.printf("O\t|\t");
                else if(fabrica[i][j] == 2)
                    System.out.printf("X\t|\t");
            }
            System.out.printf("\n");
            System.out.printf("\t---------------------------------------------------------------------------------\n");
        }      
    }
}