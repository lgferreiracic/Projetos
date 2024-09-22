package Prova2.InterfaceGrafica.Parte6;

import java.awt.event.*;
import javax.swing.*;

public class EventoHandler implements ActionListener{
    Exemplo1 exemplo1;
    EventoHandler(){
        
    }
    EventoHandler(Exemplo1 pExemplo1){
        this.exemplo1 = pExemplo1;
    }
    @Override
    public void actionPerformed(ActionEvent event){
        JOptionPane.showMessageDialog(null, exemplo1.txtNome.getText());
    }
    
}
