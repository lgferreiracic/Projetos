package Aula4.Parte6;

import java.util.Scanner;

public class Exercicio2 {
    public static void main(String[] args){
        int dia;
        int mes;
        int[] meses={31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31};
        Scanner s=new Scanner(System.in);
        System.out.println("Digite  o dia e o mes de uma data de 2024 (dd mm)");
        dia=s.nextInt();
        mes=s.nextInt();
        int diasCorridos=0;
        int diaSemana=0;
        for(int i=0; i<mes-1; i++)
            diasCorridos+=meses[i];
        diasCorridos+=dia;
        diaSemana=diasCorridos%7;

        switch (diaSemana) {
            case 1:
                System.out.println("Segunda-Feira");
                break;
            case 2:
                System.out.println("Terca-Feira");
                break;
            case 3:
                System.out.println("Quarta-Feira");
                break;
            case 4:
                System.out.println("Quinta-Feira");
                break;
            case 5:
                System.out.println("Sexta-Feira");
                break;
            case 6:
                System.out.println("Sabado");
                break;
            case 7:
                System.out.println("Domingo");
                break;
        }
        System.out.printf("Dias corridos: %d \n%d", diasCorridos, diaSemana);
        s.close();
            
    }
}
