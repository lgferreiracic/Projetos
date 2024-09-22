package Prova2.InterfaceGrafica.Parte3;
import java.awt.GridLayout;

import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;

public class Exemplo2 extends JFrame {
    



    public static void main(String[] args) {
        JFrame f = new JFrame("Interface de Formulário"); 
        f.setLayout(new GridLayout(2,2));
        JLabel lblNumero = new JLabel();
        lblNumero.setText("Número");
        JTextField txtNumero = new JTextField();

        JLabel lblAgencia = new JLabel();
        lblAgencia.setText("Agência");
        JTextField txtAgencia = new JTextField();

        f.add(lblNumero);
        f.add(lblAgencia);
        f.add(txtNumero);
        f.add(txtAgencia);


        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); 
        f.setBounds(300, 300, 400, 200); 
        f.setVisible(true); 
        
    }
    //Continuar na lâmina 18
}
