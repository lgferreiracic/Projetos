/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */
public class Sala {
    private int linha;
    private int coluna;
    private Robo robo;
    private int[][] sala;
    private int maxObstaculos=441;
    private int quantAtualObstaculos=0;

    public Sala(int linha, int coluna) {// Classe representando a sala
        this.linha = linha;
        this.coluna = coluna;
        this.sala = new int[linha][coluna];
        this.simular();
    }
    
    public void simular(){ // Metodo para simular um cenario ja com obstaculos e caminhos
        for (int j = 0; j < 21; j++){
            this.sala[0][j]=2;
            if (j != 5 && j != 15){
                this.sala[7][j]=2;
                this.sala[13][j]=2;
            }
            this.sala[20][j]=2;
        }
        
                    
        for (int i = 0; i < 21; i++){
            this.sala[i][0]=2;
            this.sala[i][20]=2;
        }
        
        for (int i = 2; i < 21; i+=2){
            if (i == 4 || i == 17)
                i+=1;
            else if (i == 7 || i == 13)
                i+=2;
            for (int j = 2; j < 19; j++){
                if (j == 9)
                    j+=3;
                this.sala[i][j]=2;
            }
        }
        
        for (int i = 0; i < 21; i++){
            if (i != 3 && i != 9 && i != 15 && i != 4 && i != 10 && i != 16)
                this.sala[i][10]=2;
        }
    }

    public void setLinha(int pLinha){ // Setter para linhas
        this.linha=pLinha;
    }

    public void setColuna(int pColuna){ // Setter para colunas
        this.coluna=pColuna;
    }

    public void setRobo(Robo pRobo){ // Setter para robo
        this.robo=pRobo;
        sala[robo.getI()][robo.getJ()]=1;
    }

    public int getLinha(){ // Getter para linhas
        return this.linha;
    }

    public int getColuna(){ // Getter para colunas
        return this.coluna;
    }

    public Robo getRobo(){ // Getter para robo
        return this.robo;
    }

    public int[][] getSala(){ // Getter para sala
        return this.sala;
    }

    public int getMaxObstaculos(){ // Getter para quantidade maxima de obstaculos
        return this.maxObstaculos;
    }

    public int getQuantAtualObstaculos(){ // Getter para quantidade atual de obstaculos
        return this.quantAtualObstaculos;
    }
/*
    public void diminuirQuantObstaculos(){
        quantAtualObstaculos--;
    }*/

    public boolean dentroDosLimites(int pI, int pJ){ // Verificacao dos limites da sala
        if((pI>0) && (pI<22) && (pJ>0) && (pJ<22))
            return true;
        else
            return false;
    }

    public void imprimirCenario(){ // Impressao do cenario no terminal
        int i, j;
        System.out.printf("\t\t1\t\t2\t\t3\t\t4\t\t5\t\t6\t\t7\t\t8\t\t9\t\t10\t\t11\t\t12\t\t13\t\t14\t\t15\t\t16\t\t17\t\t18\t\t19\t\t20\t\t21\n");
        System.out.print("\t--------------------------------------------------------------------------------------------------------------------------------------------------------------------");
        System.out.println("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
        for (i = 0; i < 21; i++) {
            System.out.printf("%d\t|\t", i+1);
            for (j = 0; j < 21; j++) {
                if (this.sala[i][j] == 0)
                    System.out.printf(" \t|\t");
                else if(this.sala[i][j] == 1)
                    System.out.printf("O\t|\t");
                else if(this.sala[i][j] == 2)
                    System.out.printf("X\t|\t");
            }
            System.out.printf("\n");
            System.out.print("\t--------------------------------------------------------------------------------------------------------------------------------------------------------------------");
            System.out.println("------------------------------------------------------------------------------------------------------------------------------------------------------------------------------");
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
