package Prova2.InterfaceGrafica.Parte4;

import javax.swing.*;
import java.awt.*;

public class Exemplo2 extends JFrame{

    JLabel lblHello;

    Exemplo2(){

        lblHello = new JLabel();
        lblHello.setText("Olá, beleza?");

        setLayout(new BorderLayout(5, 5));
        add(lblHello, BorderLayout.CENTER);
        add(new JLabel("Label 2"), BorderLayout.NORTH);
        add(new JLabel("Label 3"), BorderLayout.SOUTH);
        add(new JLabel("Label 4"), BorderLayout.WEST);
        add(new JLabel("Label 5"), BorderLayout.EAST);

    }/* 
    public static void main(String[] args) {
        JFrame f = new Exemplo1(); 
        f.setTitle("Primeira Janela"); 
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setBounds(300, 300, 400, 200); 
        f.setVisible(true); 
    }*/
    
}
