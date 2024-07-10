package ListaDeExercicios4.Ex7;

public class TrianguloTeste {
    public static void main(String[] args) {
        Ponto A = new Ponto(0,0);
        Ponto B = new Ponto(1,0);
        Ponto C = new Ponto(0.5,1);
        Triangulo t = new Triangulo(A, B, C);
        t.imprimir();
        t.rotacao(90);
        t.imprimir();
    }
    
}
