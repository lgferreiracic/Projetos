package Introdução.Parte3;
import java.util.Scanner;
public class Exercicio2 {
    public static void main(String[] args) {
        System.out.println("Digite um numero inteiro:");
        Scanner s =new Scanner(System.in);
        int numero =s.nextInt();
        numero=numero*numero;
        System.out.println(numero);
        s.close();
    }
}
