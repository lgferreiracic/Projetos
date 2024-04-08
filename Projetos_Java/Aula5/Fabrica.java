package Aula5;
import java.util.Scanner;

public class Fabrica{
    public static void main(String[] args){
        Scanner s=new Scanner(System.in);
        int opcao = 0;
        //int[][] fabrica=new int[5][5];
        int i, j;
        //Robo posicao = new Robo(); 
        Sala fabrica = new Sala(5, 5);
        Robo posicao = new Robo(fabrica); 
        Obstaculos[] obstaculo = new Obstaculos[fabrica.getMaxObstaculos()];
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
                    i=s.nextInt();
                    System.out.printf("Qual a posicao do robo? (Coluna)\n");
                    j=s.nextInt();
                    if(fabrica.dentroDosLimites(i, j))
                        posicao.setIJ(i-1, j-1);
                    else{
                        System.out.printf("%d,%d - Fora dos limites", i, j);
                        AuxiliarConsole.esperar();
                    }
                        
                    AuxiliarConsole.limparBuffer(s);
                    AuxiliarConsole.limparTela();
                break;
                case 2:
                    fabrica.imprimirCenario();
                    //if(posicao.i!=-1&&fabrica[i][j]!=2)
                        //System.out.printf("\n\n\t\tA posicao do robo e %d/%d\n", posicao.i + 1, posicao.j + 1);
                    AuxiliarConsole.limparBuffer(s);
                    AuxiliarConsole.limparTela();
                break;
                case 3:
                    if(posicao.getPosicionado()){
                        char movimentar=' ';
                        do{
                            AuxiliarConsole.limparTela();
                            fabrica.imprimirCenario();
                            System.out.printf("Para qual lado?\n");
                            System.out.printf("Cima = C\n");
                            System.out.printf("Baixo = B\n");
                            System.out.printf("Esquerda= E\n");
                            System.out.printf("Direita = D\n");
                            System.out.printf("Finalizar Movimentacao = F\n");
                            movimentar=s.nextLine().charAt(0);
                            movimentar=Character.toLowerCase(movimentar);
                            if (movimentar!='f'){
                                switch (movimentar) {
                                    case 'c':
                                        posicao.mover_para_cima();
                                    break;
                                    case 'b':
                                        posicao.mover_para_baixo();
                                    break;
                                    case 'e':
                                        posicao.mover_para_esquerda();
                                    break;
                                    case 'd':
                                        posicao.mover_para_direita();
                                    break;
                                    default:
                                    break;
                                /* }
                                }
                                else{
                                    AuxiliarConsole.limparTela();
                                    System.out.printf("Movimento invalido.\n");
                                    AuxiliarConsole.esperar();
                                }*/
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
                    i=s.nextInt();
                    System.out.printf("Onde posicionar o obstaculo? (Coluna)\n");
                    j=s.nextInt();
                    if(fabrica.dentroDosLimites(i, j)){
                        obstaculo[fabrica.getQuantAtualObstaculos()]=new Obstaculos(fabrica);
                        obstaculo[fabrica.getQuantAtualObstaculos()].setIJ(i-1, j-1);
                    }
                    else{
                        System.out.printf("%d,%d - Fora dos limites\n", i, j);
                        AuxiliarConsole.esperar();
                    }
                    AuxiliarConsole.limparTela();
                break;
            }
        }while (opcao != 5);
        s.close();
    }
    
    

}