package Aula5;
import java.util.Scanner;

class Robo{
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

class Obstaculos{
    public int i;
    public int j;
}


public class Fabrica{
    public static void main(String[] args){
        Scanner s=new Scanner(System.in);
        int opcao = 0;
        int[][] fabrica=new int[5][5];
        int i, j;
        Robo posicao = new Robo(); 
        Obstaculos obstaculo = new Obstaculos();
        posicao.i=-1;
        for (i = 0; i < 5; i++)
            for (j = 0; j < 5; j++)
                fabrica[i][j] = 0;
        do {
            System.out.printf("ESCOLHA UMA OPCAO\n");
            System.out.printf("1-Posicionar robo\n");
            System.out.printf("2-Imprimir cenario\n");
            System.out.printf("3-Movimentar robo\n");
            System.out.printf("4-Posicionar obstaculo\n");
            System.out.printf("5-Encerrar\n");
            opcao=s.nextInt();
            //limpar_tela();
            switch (opcao)
                {
                case 1:
                    System.out.printf("Qual a posicao do robo? (Linha)\n");
                    posicao.i=s.nextInt();
                    System.out.printf("Qual a posicao do robo? (Coluna)\n");
                    posicao.j=s.nextInt();
                    s.nextLine();
                    posicao.i--;
                    posicao.j--;
                    if(fabrica[posicao.i][posicao.j]!=2){
                        for (i = 0; i < 5; i++)
                            for (j = 0; j < 5; j++)
                                fabrica[i][j]=fabrica[i][j]==1?0:fabrica[i][j];
                        fabrica[posicao.i][posicao.j] = 1;
                    }
                    else{
                            System.out.printf("Existe um obstaulo nessa posicao\n");
                            s.nextLine();
                            //getchar();
                    }
                    //limpar_tela();
                break;
                case 2:
                    Robo.imprimirCenario(fabrica);
                    //if(posicao.i!=-1&&fabrica[i][j]!=2)
                        //System.out.printf("\n\n\t\tA posicao do robo e %d/%d\n", posicao.i + 1, posicao.j + 1);
                    s.nextLine();
                    //getchar();
                    //limpar_tela();
                break;
                case 3:
                    if(posicao.i!=-1){
                        char movimentar=' ';
                        do{
                            //limpar_tela();
                            Robo.imprimirCenario(fabrica);
                            System.out.printf("Para qual lado?\n");
                            System.out.printf("Cima = C\n");
                            System.out.printf("Baixo = B\n");
                            System.out.printf("Esquerda= E\n");
                            System.out.printf("Direita = D\n");
                            System.out.printf("Finalizar Movimentacao = F\n");
                            s.nextLine();
                            movimentar=s.nextLine().charAt(0);
                            //scanf(" %c", &movimentar);
                            movimentar=Character.toLowerCase(movimentar);
                            if (movimentar!='f'){
                                if (Robo.movimentoValido(movimentar, posicao, fabrica)==1) {
                                switch (movimentar) {
                                    case 'c':
                                        Robo.mover_para_cima(fabrica, posicao);
                                    break;
                                    case 'b':
                                        Robo.mover_para_baixo(fabrica, posicao);
                                    break;
                                    case 'e':
                                        Robo.mover_para_esquerda(fabrica, posicao);
                                    break;
                                    case 'd':
                                        Robo.mover_para_direita(fabrica, posicao);
                                    break;
                                    default:
                                    break;
                                }
                                }
                                else{
                                    //limpar_tela();
                                    System.out.printf("Movimento invalido.\n");
                                    s.nextLine();
                                    //limpar_buffer();
                                    //getchar();
                                }
                            }     
                        }while(movimentar!='f');
                    }
                    else{
                        System.out.printf("O robo ainda nao foi posicionado para que possa se movimentar\n");
                        s.nextLine();
                        //limpar_buffer();
                        //getchar();    
                        }
                //limpar_tela();
                break;
                case 4:
                    System.out.printf("Onde posicionar o obstaculo? (Linha)\n");
                    obstaculo.i=s.nextInt();
                    System.out.printf("Onde posicionar o obstaculo? (Coluna)\n");
                    obstaculo.j=s.nextInt();
                    obstaculo.i--;
                    obstaculo.j--;
                    if(fabrica[obstaculo.i][obstaculo.j]!=1&&fabrica[obstaculo.i][obstaculo.j]!=2)
                                fabrica[obstaculo.i][obstaculo.j]=2;
                    else {
                        System.out.printf("Movimento invalido.\n");
                        s.nextLine();
                        //limpar_buffer();
                        //getchar();
                    }
                    //limpar_tela();
                break;
            }
        }while (opcao != 5);
        s.close();
    }
}