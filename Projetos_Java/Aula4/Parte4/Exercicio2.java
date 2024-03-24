package Aula4.Parte4;
import java.util.Scanner;
public class Exercicio2 {
    public static void main (String[] args){
        int valor;
        int minimo=0;
        Scanner s= new Scanner(System.in);
        do{
            System.out.println("Digite o valor que sera sacado");
            valor=s.nextInt();
            if(valor%10!=0)
                System.out.println("Digite um numero valido");
        }while(valor%10!=0);
        
        if(valor>50){
            minimo=valor/50;
            valor=valor%50;
        }
        if(valor>=20){
            minimo=minimo+(valor/20);
            valor=valor%20;
        }
        if(valor>=10)
            minimo=minimo+(valor/10);
        System.out.printf("Valor minimo de notas: %d", minimo);
        s.close();
    }
}
