package ListaDeExercicios4.Ex3;
import java.util.Scanner;

public class TestaJogoDaVelha {
    public static void main(String[] args) {
        JogoDaVelha jogo = new JogoDaVelha();
        int i, j;
        Scanner s=new Scanner(System.in);
        System.out.println("Onde deseja jogar? (i-j)(0...2)");
        i=s.nextInt();
        j=s.nextInt();
        while(!jogo.jogada(i, j)){
            jogo.print();
            System.out.println("Onde deseja jogar? (i-j)(0...2)");
            i=s.nextInt();
            j=s.nextInt();
        }
        s.close();
    }
    
}
