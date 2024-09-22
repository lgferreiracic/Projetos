package Prova2.InterfaceGrafica.Parte2;
import javax.swing.JFrame;

public class Exemplo1 extends JFrame {

   Exemplo1(){
        this.setTitle("Primeira Janela"); //Definindo o titulo da janela
        this.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE); //Definindo o encerramento da aplicação
        this.setBounds(400, 400, 800, 400); //Definindo os limites da janela
        this.setVisible(true); //Definindo como visivel
   }

    public static void main(String[] args) {
        JFrame f = new Exemplo1(); //Criando e instanciando um objeto do tipo JFrame
        
        //Se a linha 17 for comentada, a aplicação não ficará visivel, mas estará em segundo plano
    }
}
