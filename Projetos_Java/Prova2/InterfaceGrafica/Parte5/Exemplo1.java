package Prova2.InterfaceGrafica.Parte5;

import java.awt.*;
import javax.swing.*;


public class Exemplo1 extends JFrame {
    JLabel lblCodigo, lblNome;
    JTextField txtCodigo, txtNome;
    JButton btnSalvar, btnCancelar;

    Exemplo1(){
        lblCodigo = new JLabel("Código");
        txtCodigo = new JTextField();
        //txtCodigo.setText("Digite o codigo");
        lblNome = new JLabel("Nome");
        txtNome = new JTextField();
        //txtNome.setText("Digite seu nome");
        btnSalvar = new JButton("Salvar");
        btnCancelar = new JButton("Cancelar");

        setLayout(new GridLayout(3, 2));
        add(lblCodigo); add(txtCodigo);
        add(lblNome); add(txtNome);
        add(btnSalvar); add(btnCancelar);

    }

    public static void main(String[] args) {
        JFrame f = new Exemplo1(); 
        f.setTitle("Primeira Janela"); 
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setBounds(300, 300, 400, 200); 
        f.setVisible(true); 

    
    }
}
