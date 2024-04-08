package Aula5;

public class Obstaculos{
    private int i;
    private int j;
    private Sala oSala;
    private int numObstaculos=0;
    public Obstaculos(int pI, int pJ, Sala pSala){
        this.i=pI;
        this.j=pJ;
        this.oSala=pSala;

    }

    public Obstaculos(Sala pSala){
        this.oSala=pSala;
    }

    public void setIJ(int pI, int pJ){
        if(oSala.getSala()[pI][pJ]!=1&&oSala.getSala()[pI][pJ]!=2){
            oSala.getSala()[pI][pJ]=2;
            this.numObstaculos++;

        }                        
        else {
                System.out.printf("Nao e possivel posicionar um obstaculo nessa posicao.\n");
                AuxiliarConsole.esperar();
        }
    }

    public void setSala(Sala pSala){
        this.oSala=pSala;
    }

    public int getI(){
        return this.i;
    }

    public int getJ(){
        return this.j;
    }

}
