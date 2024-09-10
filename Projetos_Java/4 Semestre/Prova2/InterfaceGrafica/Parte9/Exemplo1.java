package Prova2.InterfaceGrafica.Parte9;

import java.awt.*;
import java.util.ArrayList;

import javax.swing.*;



public class Exemplo1 extends JFrame {
    JLabel lblCodigo, lblNome, lblListaClientes;
    JTextField txtCodigo, txtNome;
    JButton btnSalvar, btnCancelar;
    JList jlstClientes;
    DefaultListModel mdlListaClientes;
    
    //Cliente c;
    ArrayList<Cliente> lstClientes = new ArrayList<Cliente>();


    Exemplo1(){
        lblCodigo = new JLabel("Código");
        txtCodigo = new JTextField();
        lblNome = new JLabel("Nome");
        txtNome = new JTextField();
        btnSalvar = new JButton("Salvar");
        btnCancelar = new JButton("Cancelar");

        lblListaClientes = new JLabel("Lista de Clientes");
        mdlListaClientes = new DefaultListModel();
        jlstClientes = new JList(mdlListaClientes);

        JPanel formularioPane = new JPanel();

        formularioPane.setLayout(new GridLayout(4, 2));

        formularioPane.setBorder(BorderFactory.createEmptyBorder());

        formularioPane.add(lblCodigo);
        formularioPane.add(txtCodigo);
        formularioPane.add(lblNome);
        formularioPane.add(txtNome);
        formularioPane.add(btnSalvar);
        formularioPane.add(btnCancelar);

        JPanel listPane = new JPanel();
        listPane.setLayout(new BoxLayout(listPane, BoxLayout.PAGE_AXIS));
        Container contentPane = getContentPane();
        contentPane.add(formularioPane, BorderLayout.NORTH);
        contentPane.add(listPane, BorderLayout.CENTER);

        EventoHandler handler = new EventoHandler(this);
        btnSalvar.addActionListener(handler);
        btnCancelar.addActionListener(handler);
    }

    public void AtualizarLista(){
        //int i;
        mdlListaClientes.clear();
        for (Cliente aux: lstClientes){
            mdlListaClientes.addElement(aux.getNome());
        }
    }

    public void NovoCliente(){
        try{
            String strCodigo, strNome;
            int iCodigo;
            strCodigo = txtCodigo.getText();
            strNome = txtNome.getText();
            iCodigo = Integer.parseInt(strCodigo);

            lstClientes.add(new Cliente(iCodigo, strNome));
            AtualizarLista();
            JOptionPane.showMessageDialog(rootPane, "Novo cliente criado: " + lstClientes.get(lstClientes.size()).getNome());
        }catch(Exception e){
            JOptionPane.showMessageDialog(rootPane, "Entrada invalida");
            cancelar();
        }
        

    }

    public void cancelar(){
        txtCodigo.setText("");
        txtNome.setText("");
    }

    public static void main(String[] args) {
        JFrame f = new Exemplo1(); 
        f.setTitle("Primeira Janela"); 
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        f.setBounds(300, 300, 400, 200); 
        f.setVisible(true); 

    
    }

}
