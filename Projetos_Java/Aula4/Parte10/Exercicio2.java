package Aula4.Parte10;

import java.util.Scanner;
class Cilindro{
    public static double volume(double raio, double altura){
        return raio*raio*3.14*altura;
    }
}

public class Exercicio2 {
    public static void main(String[] args) {
        Scanner s=new Scanner(System.in);
        double raio;
        double altura;
        double volume;
        System.out.println("Digite o raio do cilindro e sua altura");
        raio=s.nextDouble();
        altura=s.nextDouble();
        volume=Cilindro.volume(raio, altura);
        System.out.printf("Volume: %.2f", volume);
        s.close();        
    }
}
