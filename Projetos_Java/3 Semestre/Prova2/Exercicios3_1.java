package Prova2;

import javax.swing.JOptionPane;

public class Exercicios3_1 {
    Exercicio3[] produtos;
    public void CadastrarProdutos(){
        produtos=new Exercicio3[10];
        for (int i=0; i<=9; i++){
            produtos[i]=new Exercicio3("","");
            produtos[i].Codigo=JOptionPane.showInputDialog(null, "Codigo: ");
            produtos[i].Descricao=JOptionPane.showInputDialog(null, "Descricao: ");

        }

    }

    public static void main(String[] args) {
        Exercicios3_1 e = new Exercicios3_1();
        e.CadastrarProdutos();
        for(int i=0; i<=9; i++){
            System.out.println(e.produtos[i].Codigo + " , " + e.produtos[i].Descricao);
        }
    }
}
