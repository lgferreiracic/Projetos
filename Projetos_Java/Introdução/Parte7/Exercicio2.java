package Introdução.Parte7;

import java.util.Scanner;

public class Exercicio2 {
    public static void main(String[] args) {
        double produto;
        double soma=0;
        double maisCaro=0;
        int quantProd=0;
        Scanner s=new Scanner(System.in);
        do{
            System.out.println("Digite o valor do item (-1 para cancelar)");
            produto=s.nextDouble();
            if(produto!=-1){
                soma+=produto;
                maisCaro=produto>=maisCaro?produto:maisCaro;
                quantProd++;
            }
        }while(produto!=-1);
        
        if(quantProd>0){
            System.out.printf("Total da compra: %.2f\n", soma);
            System.out.printf("Item mais caro: %.2f\n", maisCaro);
            System.out.printf("Media: %.2f\n", soma/quantProd);
        }
        
        s.close();
    }
    
}
