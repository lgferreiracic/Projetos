package ListaDeExercicios5.Ex1b;
/*a) Na solução, converta a superclasse para uma classe abstrata e faça as devidas
revisões no projeto (por exemplo, nos pontos em que você instancia objetos desta
classe). */
public abstract class Motor {
    protected double potencia;
    Motor(double potencia){
        this.potencia=potencia;
    }
    public abstract double calcularAutonomia(double distancia);
    public abstract double getPotencia();
}
