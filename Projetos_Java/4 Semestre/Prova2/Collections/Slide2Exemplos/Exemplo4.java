package Prova2.Collections.Slide2Exemplos;

import java.util.PriorityQueue;
import java.util.Queue;

public class Exemplo4 {
    public static void main(String args[]) {
    Queue<String> fila = new PriorityQueue<>();

    fila.add("A");
    fila.offer("B");
    fila.add("C");
    fila.offer("D");

    System.out.println("-- Resultado 1 --");
    for (String s : fila) {
        System.out.println(s);
    }

    System.out.println("-- Itens retirados --");
    System.out.println(fila.poll());
    System.out.println(fila.poll());

    System.out.println("-- Resultado 2 --");
    for (String s : fila) {
        System.out.println(s);
    }
}

    
}
