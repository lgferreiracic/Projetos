package Prova2.Collections.Slide2Exemplos;

import java.util.ArrayList;
import java.util.List;

public class Exemplo2{
    public static void main(String[] args) {
        List<String> lst_base = new ArrayList<>();
        List<String> lst_adic = new ArrayList<>();

        lst_base.add("Adriana");
        lst_base.add("Carlos");
        lst_base.add("Márcio");

        lst_adic.add("João");
        lst_adic.add("Ana");

        lst_base.addAll(2, lst_adic);

        System.out.println("--Resultado--");
        for (String s : lst_base.subList(1, 4)){
            System.out.println(s);
        }
        


    }
}