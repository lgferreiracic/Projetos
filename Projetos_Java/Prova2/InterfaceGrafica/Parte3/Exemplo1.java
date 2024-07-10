package Prova2.InterfaceGrafica.Parte3;
import javax.swing.JFrame;
import javax.swing.JLabel;

public class Exemplo1 extends JFrame {
    JLabel lblHello;
    JLabel lblBye;

    Exemplo1(){
        lblHello = new JLabel();
        lblHello.setText("Olá, beleza?");
        add(lblHello);

        lblBye = new JLabel();
        lblBye.setText("Tchau");
        add(lblBye);
   }

    public static void main(String[] args) {
        JFrame f = new Exemplo1(); //Criando e instanciando um objeto do tipo JFrame
        f.setTitle("Primeira Janela"); //Definindo o titulo da janela
        f.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); //Definindo o encerramento da aplicação
        f.setBounds(300, 300, 400, 200); //Definindo os limites da janela
        f.setVisible(true); //Definindo como visivel
        //Se a linha 17 for comentada, a aplicação não ficará visivel, mas estará em segundo plano
    }
    //Continuar na lâmina 18
}
