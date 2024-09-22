package ListaDeExercicios5.Ex1cV2;

public class MotorCombustao extends Motor implements Iot{
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

    public void ligar(){
        System.out.println("Ligado");
    }

    public void desligar(){
        System.out.println("Desligado");
    }
}
