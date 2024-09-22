package ListaDeExercicios5.Ex1b;

public class Main {
    public static void main(String[] args) {
        Motor[] motores = new Motor[2]; 
        motores[0] = new MotorCombustao(50, 50, 15);
        motores[1] = new MotorEletrico(50, 50, 25, 50);

        for(int i = 0; i < motores.length; i++) {
            double autonomia = motores[i].calcularAutonomia(100); 
            System.out.println("Autonomia do motor " + (i + 1) + ": " + autonomia);
        }
    }
}