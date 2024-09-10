package ListaDeExercicios4.Ex7;
/*Crie a classe ponto com suas coordenadas (X, Y). Crie todos os elementos da
classe, os atributos, construtores, getters e setters e impressão. */
public class Ponto {
    private double x,y;
    Ponto(double x, double y){
        this.x=x;
        this.y=y;
    }
    Ponto(){
        this.x=1;
        this.y=1;
    }
    public void setX(double x){
        this.x=x;
    }
    public void setY(double y){
        this.y=y;
    }
    public double getX(){
        return this.x;
    }
    public double getY(){
        return this.y;
    }
    public void imprimir(){
        System.out.println("X: "+this.x);
        System.out.println("Y: "+this.y);
    }
}
