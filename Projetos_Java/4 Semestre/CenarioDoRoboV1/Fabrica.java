package CenarioDoRoboV1;
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
            System.out.println("ESCOLHA UMA OPCAO");
            System.out.println("1-Posicionar robo");
            System.out.println("2-Imprimir cenario");
            System.out.println("3-Movimentar robo");
            System.out.println("4-Posicionar obstaculo");
            //System.out.printf("5-Remover obstaculo\n");
            System.out.println("5-Encerrar");
            opcao=s.nextInt();
            AuxiliarConsole.limparBuffer(s);
            AuxiliarConsole.limparTela();
            switch (opcao)
                {
                case 1:
                    System.out.println("Qual a posicao do robo? (Linha)");
                    i=s.nextInt();
                    System.out.println("Qual a posicao do robo? (Coluna)");
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
                    AuxiliarConsole.limparBuffer(s);
                    AuxiliarConsole.limparTela();
                break;
                case 3:
                    if(posicao.getPosicionado()){
                        char movimentar=' ';
                        do{
                            AuxiliarConsole.limparTela();
                            fabrica.imprimirCenario();
                            System.out.println("Para qual lado?");
                            System.out.println("Cima = C");
                            System.out.println("Baixo = B");
                            System.out.println("Esquerda= E");
                            System.out.println("Direita = D");
                            System.out.println("Finalizar Movimentacao = F");
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
                            }
                            }     
                        }while(movimentar!='f');
                    }
                    else{
                        System.out.println("O robo ainda nao foi posicionado para que possa se movimentar");
                        AuxiliarConsole.esperar();
                        }
                AuxiliarConsole.limparTela();
                break;
                case 4:
                    System.out.println("Onde posicionar o obstaculo? (Linha)");
                    i=s.nextInt();
                    System.out.println("Onde posicionar o obstaculo? (Coluna)");
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