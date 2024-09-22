package ExemploFigura2D;

public class Retangulo extends Figura2D{

    protected double base;
    protected double altura;

    Retangulo(){
        super();
        this.base=1;
        this.altura=1;
    }

    Retangulo(int pX, int pY, double pBase, double pAltura){
        super(pX, pY);
        this.base=pBase;
        this.altura=pAltura;
    }

    public void setBase(double pBase){
        this.base=pBase;
    }

    public void setAltura(double pAltura){
        this.altura=pAltura;
    }

    public double getBase(){
        return this.base;
    }

    public double getAltura(){
        return this.altura;
    }

    @Override
    public void imprimir(){
        super.imprimir();
        System.out.println("Base: "+this.base);
        System.out.println("Altura: "+this.altura);
    }

    @Override
    public double calcularArea(){
        return this.base*this.altura;
    }
    
}
