package CenarioDoRoboV1;

public class Robo{
    private int i;
    private int j;
    private Sala rSala;
    private boolean posicionado=false;

    public Robo(Sala pSala){
        this.i=0;
        this.j=0;
        this.rSala=pSala;
    }
    public Robo(int i, int j, Sala sala) {
        this.i = i;
        this.j = j;
        this.rSala = sala;
        sala.setRobo(this); 
    }

    public void setIJ(int pI, int pJ){
        if(rSala.getSala()[pI][pJ]!=2){
            if(posicionado)
                rSala.getSala()[i][j] = 0;
            rSala.getSala()[pI][pJ] = 1;
            this.i=pI;
            this.j=pJ;
            this.setPosicionado();
        }
        else{
                System.out.printf("Existe um obstaulo nessa posicao\n");
                AuxiliarConsole.esperar();
        }

    }

    public void setSala(Sala pSala){
        this.rSala=pSala;
    }

    public void setPosicionado(){
        this.posicionado=true;
    }
    public int getI(){
        return this.i;
    }

    public int getJ(){
        return this.j;
    }

    public Sala getSala(){
        return this.rSala;
    }

    public boolean getPosicionado(){
        return this.posicionado;
    }

    public void mover_para_cima() {
        if(i>0)
            setIJ(i - 1, j);
    }

    public void mover_para_baixo() {
        if(i<4)
            setIJ(i + 1, j);
    }

    public void mover_para_esquerda() {
        if(j>0)
            setIJ(i, j - 1);
    }

    public void mover_para_direita() {
        if(j<4)
            setIJ(i, j + 1);
    }

}