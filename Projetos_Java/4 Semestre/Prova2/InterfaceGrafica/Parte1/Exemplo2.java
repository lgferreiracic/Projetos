package Prova2.InterfaceGrafica.Parte1;
import javax.swing.JOptionPane;

public class Exemplo2 {

    public static void main(String[] args) {
        String strn1 = JOptionPane.showInputDialog("Primeiro float");
        String strn2 = JOptionPane.showInputDialog("Segundo float");
        String strn3 = JOptionPane.showInputDialog("Terceiro float");
        float n1 = Float.parseFloat(strn1);
        float n2 = Float.parseFloat(strn2);
        float n3 = Float.parseFloat(strn3);

        float s = n1 + n2 + n3;

        JOptionPane.showMessageDialog(null, "A soma é " + s, "Sum of Two Integers", JOptionPane.PLAIN_MESSAGE);

    }
}