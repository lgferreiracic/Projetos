package Introdução.Parte4;
import java.util.Scanner;
public class Exercicio1 {
    public static void main(String[] args){
        String nome;
        double raio;
        int quant;
        double preco;

        Scanner s=new Scanner(System.in);
        System.out.println("Digite o nome do cliente");
        nome=s.nextLine();
        System.out.println("Digite o raio");
        raio=s.nextDouble();
        System.out.println("Digite a quantidade");
        quant=s.nextInt();

        preco=3.14*(raio*raio)*quant*25;
        System.out.println("\tOrcamento");
        System.out.printf("Nome do Cliente: %s\nRaio: %.2f\nQuantidade: %d\nPreco: %.2f", nome, raio, quant, preco);
        s.close();
    }
    
}
