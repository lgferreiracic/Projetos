package ListaDeExercicios4.Ex3;
/*Exercício 3 – Jogo da Velha
Crie um programa que codifique a classe Jogo da Velha.
a) Crie a classe JogoDaVelha que representa o tabuleiro e as opções marcadas pelo
jogador.
b) Crie o método limpar tabuleiro que coloca o caractere “.” em todas as casas do
tabuleiro.
c) Crie o método Jogar que recebe a posição e o jogador e marca a jogada do jogador.
Perceba que você precisa checar se a jogada é válida, se a casa está de fato
desocupada.
d) Crie o método ProximoJogador que indica quem é o próximo jogador a jogar.
Perceba que você pode avaliar o próximo jogador olhando apenas para o tabuleiro
ou pode criar um atributo para auxiliar neste controle e alternância.
e) Crie o método AvaliarVencedor que é computador logo após realizar uma Jogada. O
método verifica se a jogada culminou em um vencedor conforme as regras do Jogo
da Velha.
f) Na classe principal, crie o jogo da velha e realize algumas jogadas visualizando o
tabuleiro em seguida. */
public class JogoDaVelha {
    private char[][] tabuleiro=new char[3][3];
    private static char turno ='x';

    JogoDaVelha(){
        limpaTabuleiro();
    }

    public void limpaTabuleiro(){
        for(int i=0; i<3; i++)
            for(int j=0; j<3; j++)
                tabuleiro[i][j]='.';
    }

    public boolean verifica(int pI, int pJ) {
        if (pI < 0 || pI >= 3 || pJ < 0 || pJ >= 3) {
            System.out.println("Jogada Inválida. Fora do tabuleiro.");
            return false;
        }
    
        if (tabuleiro[pI][pJ] != '.') {
            System.out.println("Jogada Inválida. Posição já ocupada.");
            return false;
        }
    
        return true;
    }

    public boolean jogada(int pI, int pJ){
        if(verifica(pI, pJ)){
            tabuleiro[pI][pJ]=turno;
            if(vitoria()){
                System.err.println("Vitoria do "+turno);
                print();
                return true;
            }
            else if(empate()){
                System.out.println("Deu velha");
                print();
                return true;
            }
            else {
                turno=turno=='x'?'o':'x';
                System.out.println("Próximo jogador: " + turno);
                return false;
            }
        }
        return false;
    }

    public boolean vitoria(){
        for(int i=0; i<3; i++){
            if(tabuleiro[i][0]==tabuleiro[i][1]&&tabuleiro[i][1]==tabuleiro[i][2]&&tabuleiro[i][0]!='.')
                return true;
            else if(tabuleiro[0][i]==tabuleiro[1][i]&&tabuleiro[1][i]==tabuleiro[2][i]&&tabuleiro[0][i]!='.')
                return true;
        }
        if(tabuleiro[0][0]==tabuleiro[1][1]&&tabuleiro[1][1]==tabuleiro[2][2]&&tabuleiro[0][0]!='.')
            return true;
        else if(tabuleiro[0][2]==tabuleiro[1][1]&&tabuleiro[1][1]==tabuleiro[2][0]&&tabuleiro[0][2]!='.')
            return true;
        return false;
    }

    public boolean empate(){
        for(int i=0; i<3; i++)
            for(int j=0; j<3; j++)
                if(tabuleiro[i][j]=='.')
                    return false; 
        return true;
    }

    public void print() {
        for (int i = 0; i < 3; i++) {
            for (int j = 0; j < 3; j++) {
                System.out.print(tabuleiro[i][j] + " ");
                if (j < 2)
                    System.out.print("|");
            }
            if (i < 2)
                System.out.printf("\n______");
            System.out.println();
        }
        
    }
    

}
