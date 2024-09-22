package ListaDeExercicios5.Ex1b;

public class MotorCombustao extends Motor {
    protected double capacidadeCombustivel;
    protected double consumoMedio;

    MotorCombustao(double potencia, double capacidadeCombustivel, double consumoMedio) {
        super(potencia);
        this.capacidadeCombustivel = capacidadeCombustivel;
        this.consumoMedio = consumoMedio;
    }

    @Override
    public double calcularAutonomia(double distancia) {
        System.out.println("Metodo de MotorCombustao");
        return distancia / consumoMedio;
    }

    @Override
    public double getPotencia(){
        return this.potencia;
    }
}