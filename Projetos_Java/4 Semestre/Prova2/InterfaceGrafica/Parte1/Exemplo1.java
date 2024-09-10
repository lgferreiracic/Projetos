package Prova2.InterfaceGrafica.Parte1;
import javax.swing.JOptionPane;

public class Exemplo1 {

    public static void main(String[] args) {
        String strn1 = JOptionPane.showInputDialog("Primeiro inteiro");
        String strn2 = JOptionPane.showInputDialog("Segundo inteiro");
        String strn3 = JOptionPane.showInputDialog("Terceiro inteiro");
        int n1 = Integer.parseInt(strn1);
        int n2 = Integer.parseInt(strn2);
        int n3 = Integer.parseInt(strn3);

        int s = n1 + n2 + n3;

        JOptionPane.showMessageDialog(null, "A soma é " + s, "Sum of Two Integers", JOptionPane.PLAIN_MESSAGE);

    }
}