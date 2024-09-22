package ListaDeExercicios5.Ex1c;

public class Main {
    public static void main(String[] args) {
        Motor[] motores = new Motor[3]; 
        motores[0] = new Motor(50);
        motores[1] = new MotorCombustao(50, 50, 15);
        motores[2] = new MotorEletrico(50, 50, 25, 50);

        for(int i = 0; i < motores.length; i++) {
            System.out.println("Motor " + (i + 1) );
            motores[i].ligar();
            motores[i].desligar();
        }
    }
}