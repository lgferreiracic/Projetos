package Aula4.Parte6;

import java.util.Scanner;

public class Exercicio1 {
    public static void main(String[] args){
        String nome;
        double raio;
        int quant;
        double preco;
        double area;

        Scanner s=new Scanner(System.in);
        System.out.println("Digite o nome do cliente");
        nome=s.nextLine();
        System.out.println("Digite o raio");
        raio=s.nextDouble();
        System.out.println("Digite a quantidade");
        quant=s.nextInt();
        area=3.14*(raio*raio)*quant;
        preco=area*25;
        if(area>=100)
            preco*=0.8;
        else if(area>=40)
            preco*=0.9;
        System.out.println("\tOrcamento");
        System.out.printf("Nome do Cliente: %s\nRaio: %.2f\nQuantidade: %d\nPreco: %.2f", nome, raio, quant, preco);
        s.close();

    }
    
}
