package Aula5;

public class Sala {
    private int linha;
    private int coluna;
    private Robo robo;
    private int[][] sala;
    private int maxObstaculos=25;
    private int quantAtualObstaculos=0;

    public Sala(int linha, int coluna) {
        this.linha = linha;
        this.coluna = coluna;
        this.sala = new int[linha][coluna]; 
    }

    public void setLinha(int pLinha){
        this.linha=pLinha;
    }

    public void setColuna(int pColuna){
        this.coluna=pColuna;
    }

    public void setRobo(Robo pRobo){
        this.robo=pRobo;
        sala[robo.getI()][robo.getJ()]=1;
    }

    public int getLinha(){
        return this.linha;
    }

    public int getColuna(){
        return this.coluna;
    }

    public Robo getRobo(){
        return this.robo;
    }

    public int[][] getSala(){
        return this.sala;
    }

    public int getMaxObstaculos(){
        return this.maxObstaculos;
    }

    public int getQuantAtualObstaculos(){
        return this.quantAtualObstaculos;
    }

    public void diminuirQuantObstaculos(){
        quantAtualObstaculos--;
    }

    public boolean dentroDosLimites(int pI, int pJ){
        if((pI>0) && (pI<6) && (pJ>0) && (pJ<6))
            return true;
        else
            return false;
    }

    public void imprimirCenario(){
        int i, j;
        System.out.printf("\t\t1\t\t2\t\t3\t\t4\t\t5\n");
        System.out.printf("\t---------------------------------------------------------------------------------\n");
        for (i = 0; i < 5; i++) {
            System.out.printf("%d\t|\t", i+1);
            for (j = 0; j < 5; j++) {
                if (this.sala[i][j] == 0)
                    System.out.printf(" \t|\t");
                else if(this.sala[i][j] == 1)
                    System.out.printf("O\t|\t");
                else if(this.sala[i][j] == 2)
                    System.out.printf("X\t|\t");
            }
            System.out.printf("\n");
            System.out.printf("\t---------------------------------------------------------------------------------\n");
        }     
    } 

    /*public void removerObstaculo(int pI, int pJ, Obstaculos[] obstaculo){
        if(sala[pI][pJ]==2){
            sala[pI][pJ]=0;
            System.out.println("Obstaculo removido com sucesso");
            obstaculo[quantAtualObstaculos-1]=null;
            diminuirQuantObstaculos();
            AuxiliarConsole.esperar();
            AuxiliarConsole.limparTela();
        }
        else{
            System.out.println("Nao existe um obstaculo nessa posicao");
            AuxiliarConsole.esperar();
            AuxiliarConsole.limparTela();
        }
    }*/

}
