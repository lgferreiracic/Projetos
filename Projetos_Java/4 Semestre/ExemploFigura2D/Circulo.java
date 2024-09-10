package ExemploFigura2D;
import java.lang.Math;
public class Circulo extends Figura2D {

    protected double raio;

    Circulo(){
        super();
        this.raio=1;
    }

    Circulo(int pX, int pY, double pRaio){
        super(pX, pY);
        this.raio=pRaio;
    }

    public double getRaio(){
        return this.raio;
    }

    public void setRaio(double pRaio){
        this.raio=pRaio;
    }

    public double getPerimetro(){
        return 2*Math.PI*raio;
    }

    @Override
    public double calcularArea(){
        return Math.PI*Math.pow(this.raio, 2);
    }

    @Override
    public void imprimir(){
        super.imprimir();
        System.out.printf("Area: %.2f\n", this.calcularArea());
        System.out.printf("Perimetro: %.2f\n", this.getPerimetro());
    }

}
