package Introdução.Parte7;

import java.util.Scanner;

public class Exercicio1 {
    public static void main(String[] args) {
        double produto;
        double soma=0;
        double maisCaro=0;
        Scanner s=new Scanner(System.in);
        for(int i=1; i<=10; i++){
            System.out.printf("Digite o valor do %d item:\n", i);
            produto=s.nextDouble();
            soma+=produto;
            maisCaro=produto>=maisCaro?produto:maisCaro;
        }
        System.out.printf("Total da compra: %.2f\n", soma);
        System.out.printf("Item mais caro: %.2f\n", maisCaro);
        System.out.printf("Media: %.2f\n", soma/10);
        s.close();
    }
    
}
