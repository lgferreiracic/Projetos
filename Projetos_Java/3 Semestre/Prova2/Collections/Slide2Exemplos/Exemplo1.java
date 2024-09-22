package Prova2.Collections.Slide2Exemplos;

import java.util.ArrayList;
import java.util.List;

public class Exemplo1{
    public static void main(String[] args) {
        List<String> lista = new ArrayList<>();

        lista.add("Adriana");
        lista.add("Fábio");
        lista.add("Cristiane");
        lista.add(1, "Marcelo");
        lista.add(1, "Zenildo");
        lista.remove(2);
        System.out.println("--Resultado--");
        for (String s : lista){
            System.out.println(s);
        }
        


    }
}