package Prova2.InterfaceGrafica.Parte7;

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

        String string = "";
        if (event.getSource() == exemplo1.btnSalvar)
        {
            exemplo1.NovoCliente();
        }
        else if (event.getSource() == exemplo1.btnCancelar){
            JOptionPane.showMessageDialog(null, "Operação cancelada");
            exemplo1.cancelar();
        }
    }
    
}
