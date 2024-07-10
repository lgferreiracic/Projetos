package ExemploFigura2D;

public class Quadrado extends Figura2D{
    protected double lado;

    Quadrado(){
        super();
        this.lado=1;
    }

    Quadrado(int pX, int pY, double pLado){
        super(pX, pY);
        this.lado=pLado;
    }

    public double getLado(){
        return this.lado;
    }

    public void setLado(double pLado){
        this.lado=pLado;
    }

    @Override
    public void imprimir(){
        super.imprimir();
        System.out.println("Lado: "+this.lado);
        System.out.println("Diagonal: "+this.getDiagonal());
    }

    @Override
    public double calcularArea(){
        return Math.pow(lado, 2);
    }

    public double getDiagonal(){
        return Math.pow(this.lado, 2);
    }
    
    public void printQuadrado(){
        for(int i=0; i<10; i++){
            for(int j=0; j<10;j++){
                if(i==0||i==9)
                    System.out.print("----");
                else{
                    if(j==0||j==9)
                        System.out.print("|");
                    else{
                        System.out.print("     ");
                    }
                }
            }
            System.out.println();
        }
    }
}
