package Prova2.InterfaceGrafica.Parte4;

import javax.swing.*;
import java.awt.*;

public class Exemplo1 extends JFrame{

    JLabel lblHello;

    Exemplo1(){

        lblHello = new JLabel();
        lblHello.setText("Olá, beleza?");

        setLayout(new GridLayout(3, 2));
        add(lblHello);
        add(new JLabel("Label 2"));
        add(new JLabel("Label 3"));
        add(new JLabel("Label 4"));
        add(new JLabel("Label 5"));

    }/* 
    public static void main(String[] args) {
        JFrame f = new Exemplo1(); 
        f.setTitle("Primeira Janela"); 
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setBounds(300, 300, 400, 200); 
        f.setVisible(true); 
    }*/
}
