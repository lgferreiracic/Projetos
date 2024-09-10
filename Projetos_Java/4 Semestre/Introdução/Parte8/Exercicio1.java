package Introdução.Parte8;

import java.util.Scanner;

public class Exercicio1 {
    public static void main(String[] args) {
        int[] num = new int[6];
        Scanner s=new Scanner(System.in);
        for(int i=6; i>0; i--){
            System.out.println("Digite um numero");
            num[i-1]=s.nextInt();
        }
        for(int i=0; i<6; i++){
            System.out.printf("%d ",num[i]);
        }
        s.close();
    }
}
