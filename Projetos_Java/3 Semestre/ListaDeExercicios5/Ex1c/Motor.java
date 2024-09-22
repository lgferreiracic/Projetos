package ListaDeExercicios5.Ex1c;

public class Motor implements Iot{
    protected double potencia;

    Motor(double potencia) {
        this.potencia = potencia;
    }

    public double calcularAutonomia(double distancia) {
        System.out.println("Metodo de Motor");
        return 0;
    }
    
    public void ligar(){
        System.out.println("Ligado");
    }

    public void desligar(){
        System.out.println("Desligado");
    }
}
