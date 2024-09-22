package Prova2.Collections.Slide2Exemplos;

import java.util.Stack;

public class Exemplo3 {
    public static void main(String[] args) {
        Stack<String> pilha = new Stack<>();

    pilha.push("Este é um ");
    pilha.push("teste com" );
    pilha.push("edição de ");
    pilha.push("texto como ");
    pilha.push("exemplo de ");
    pilha.push("erro 1");
    pilha.push("erro 2.");

    System.out.println("--Resultado 1--");
    System.out.println(pilha.pop());
    System.out.println(pilha.pop());

    pilha.push("fazer e ");
    pilha.push("desfazer.");

    System.out.println("--Resultado 2--");
    for (String s: pilha){
        System.out.println(s);
    }
    }

}
