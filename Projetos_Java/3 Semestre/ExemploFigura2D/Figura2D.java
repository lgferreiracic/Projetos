package ExemploFigura2D;
public abstract class Figura2D{
    protected int x, y;

    Figura2D(){
        this.x=1;
        this.y=1;
    }

    Figura2D(int pX, int pY){
        this.x=pX;
        this.y=pY;
    }

    public int getX(){
        return this.x;
    }

    public int getY(){
        return this.y;
    }

    public void setX(int pX){
        this.x=pX;
    }

    public void setY(int pY){
        this.y=pY;
    }

    public void imprimir(){
        System.out.println("X: "+this.x);
        System.out.println("Y: "+this.y);
    }

    public abstract double calcularArea();
}