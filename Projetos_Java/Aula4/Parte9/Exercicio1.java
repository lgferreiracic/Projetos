package Aula4.Parte9;

import java.util.Scanner;

class Sensor {
    public int id;
    public String descricao;
    public double temperatura;

}
public class Exercicio1 {
    public static void main(String[] args) {
        Sensor senTemp = new Sensor();
        Scanner s=new Scanner(System.in);
        System.out.println("Digite o id do sensor:");
        senTemp.id=s.nextInt();
        s.nextLine();
        System.out.println("Digite a descricao do sensor:");
        senTemp.descricao=s.nextLine();
        System.out.println("Digite a temperatura captada pelo sensor:");
        senTemp.temperatura=s.nextDouble();
        if(senTemp.temperatura>24){
            System.out.println("Temperatura acima de 24 graus captada por sensor");
            System.out.printf("ID: %d\nDescricao: %s\n", senTemp.id, senTemp.descricao);
        }
        s.close();
    }
}
