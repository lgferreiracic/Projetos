package Introdução.Parte10;
import java.util.Scanner;
class Imprimir {
    public static int imprimirMensagem() {
        Scanner menu= new Scanner(System.in);
        int opcao;
        System.out.println("(1) Cadastrar Sensor");
        System.out.println("(2) Cadastrar Equipamento");
        System.out.println("(3) Monitorar umidade");
        System.out.println("(4) Sair");
        opcao=menu.nextInt();
        menu.close();
        return opcao;
    }
}
public class Exercicio1 {
    public static void main(String[] args) {
        int opcao=Imprimir.imprimirMensagem();
        System.out.printf("Opcao escolhida: %d", opcao);
    }
}
