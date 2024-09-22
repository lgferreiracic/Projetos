package ExemploFigura2D;

public class Teste {
    public static void main(String[] args) {
        Figura2D f= new Quadrado(1,10,10);
        System.out.println(f.calcularArea());
        System.out.println(f.getX());
        /* 
        Quadrado q1= new Quadrado(2, 2, 2);
        Circulo c1= new Circulo(3, 3, 3);
        Retangulo r1= new Retangulo(4, 4, 4, 4);
        q1.imprimir();
        c1.imprimir();
        r1.imprimir();*/
    }
    
}
