package ListaDeExercicios5.Ex1cV2;

public class MotorEletrico extends Motor implements Iot{
    protected double capacidadeBateria;
    protected double consumo;
    protected double velocidadeMedia;

    MotorEletrico(double potencia, double capacidadeBateria, double consumo, double velocidadeMedia) {
        super(potencia);
        this.capacidadeBateria = capacidadeBateria;
        this.consumo = consumo;
        this.velocidadeMedia = velocidadeMedia;
    }

    @Override
    public double calcularAutonomia(double distancia) {
        System.out.println("Metodo de MotorEletrico");
        double tempo = distancia / velocidadeMedia;
        return tempo * consumo;
    }

    public void ligar(){
        System.out.println("Ligado");
    }

    public void desligar(){
        System.out.println("Desligado");
    }
}