package Aula5;
import java.util.Scanner;

public class Fabrica{
    public static void main(String[] args){
        Scanner s=new Scanner(System.in);
        int opcao = 0;
        int[][] fabrica=new int[5][5];
        int i, j;
        Robo posicao = new Robo(); 
        Obstaculos obstaculo = new Obstaculos();
        posicao.i=-1;
        do {
            System.out.printf("ESCOLHA UMA OPCAO\n");
            System.out.printf("1-Posicionar robo\n");
            System.out.printf("2-Imprimir cenario\n");
            System.out.printf("3-Movimentar robo\n");
            System.out.printf("4-Posicionar obstaculo\n");
            System.out.printf("5-Encerrar\n");
            opcao=s.nextInt();
            AuxiliarConsole.limparBuffer(s);
            AuxiliarConsole.limparTela();
            switch (opcao)
                {
                case 1:
                    System.out.printf("Qual a posicao do robo? (Linha)\n");
                    posicao.i=s.nextInt();
                    System.out.printf("Qual a posicao do robo? (Coluna)\n");
                    posicao.j=s.nextInt();
                    AuxiliarConsole.limparBuffer(s);
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
                            AuxiliarConsole.esperar();
                    }
                    AuxiliarConsole.limparTela();
                break;
                case 2:
                    Robo.imprimirCenario(fabrica);
                    //if(posicao.i!=-1&&fabrica[i][j]!=2)
                        //System.out.printf("\n\n\t\tA posicao do robo e %d/%d\n", posicao.i + 1, posicao.j + 1);
                    AuxiliarConsole.limparBuffer(s);
                    AuxiliarConsole.limparTela();
                break;
                case 3:
                    if(posicao.i!=-1){
                        char movimentar=' ';
                        do{
                            AuxiliarConsole.limparTela();
                            Robo.imprimirCenario(fabrica);
                            System.out.printf("Para qual lado?\n");
                            System.out.printf("Cima = C\n");
                            System.out.printf("Baixo = B\n");
                            System.out.printf("Esquerda= E\n");
                            System.out.printf("Direita = D\n");
                            System.out.printf("Finalizar Movimentacao = F\n");
                            movimentar=s.nextLine().charAt(0);
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
                                    AuxiliarConsole.limparTela();
                                    System.out.printf("Movimento invalido.\n");
                                    AuxiliarConsole.esperar();
                                }
                            }     
                        }while(movimentar!='f');
                    }
                    else{
                        System.out.printf("O robo ainda nao foi posicionado para que possa se movimentar\n");
                        AuxiliarConsole.esperar();
                        }
                AuxiliarConsole.limparTela();
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
                        AuxiliarConsole.esperar();
                    }
                    AuxiliarConsole.limparTela();
                break;
            }
        }while (opcao != 5);
        s.close();
    }
    
    

}