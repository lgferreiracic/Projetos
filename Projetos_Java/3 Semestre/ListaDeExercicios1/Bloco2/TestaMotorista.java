package ListaDeExercicios1.Bloco2;

import java.util.Scanner;

public class TestaMotorista{
    public static void main(String[] args){
        Scanner s= new Scanner(System.in);
        Motorista m1 = new Motorista("Joao", "HB20", "LSN4I49");
        Motorista m2 = new Motorista("Everaldo", "Onix", "BRA2E19");
        m1.mostraMotorista();
        m2.mostraMotorista();
        Motorista m3=new Motorista(null, null, null);
        m3.LerMotorista(s);
        m3.RegistraNovaViagem(5);
        m3.mostraMotorista();
        
    }
}