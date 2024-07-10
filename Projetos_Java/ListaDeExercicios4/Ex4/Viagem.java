/*Crie a classe Viagem que possui Origem, Destino, Data, Hora e um mapa com todas
as 44 poltronas do ônibus. */
package ListaDeExercicios4.Ex4;
import ListaDeExercicios4.Ex4.Date;
public class Viagem {
    private String origem;
    private String destino;
    private Date data;
    private int hora;
    private int[][] mapa = new int[4][11];
    
    Viagem(String origem, String destino, int dia, int mes, int ano, int hora){
        this.origem=origem;
        this.destino=destino;
        data = new Date(mes, ano, hora);
        this.hora=hora;
    }
    /*Crie o método VenderPassagem para esta viagem que solicita o número da poltrona
e a marca como vendida. Vale perceber que só pode ser vendida poltrona
desocupada. */
    public void venderPassagem(int numPoltrona){
        if(numPoltrona>0&&numPoltrona<49){
            for(int i = 0; i<4; i++){
                for(int j=0; j<11; j++){
                    if(mapa[i][j]==numPoltrona){
                        mapa[i][j]=-1;
                        return;
                    }
                }
            }
            System.out.println("Poltrona Ocupada");
        }
    }
    public void inicializarOnibus(){
        int poltrona=1;
        for(int i =0; i<4; i++)
            for (int j = 0; j<11; j++)
                mapa[i][j]=poltrona++;
    }

    //Crie o método LiberarPassagem que libera uma poltrona vendida.
    public void liberaPassagem(int poltrona){
        if (poltrona<0||poltrona>44){
            System.out.println("Nao existe poltrona com essa numeracao");
            return;
        }

        for(int i =0; i<4; i++)
            for (int j = 0; j<11; j++)
                if((j+(i*11)+1)==poltrona){
                    mapa[i][j]=poltrona;
                    System.out.println("Poltrona Liberada");
                    return;
                }
        System.out.println("Poltrona nao estava ocupada");
    }

    /*Crie o método MostrarJanelasDireita que mostra todas as poltronas de janela à
    direita do ônibus. Faça o mesmo para janelas a esquerda e para corredores. Se
    quiser, podem pensar em um arranjo de métodos que facilite este tipo de
    observação das poltronas.*/

    void mostrarJanelasDireita(){
        for (int i=0; i<11; i++)
            System.out.print(mapa[0][i]+"  ");
        System.out.println();
    }
    void mostrarJanelasEsquerda(){
        for (int i=0; i<11; i++)
            System.out.print(mapa[3][i]+" ");
        System.out.println();
    }
    void mostrarJanelasCorredor(){
        for (int i=1; i<3; i++){
            for(int j=0; j<11; j++)
                System.out.print(mapa[i][j]+" ");
            System.out.println();
        }
        System.out.println();
    }

    /*Faça um método que calcule a taxa de ocupação do ônibus, isto é, qual percentual
    de poltronas vendidas.*/
    public double ocupacao(){
        double ocupado=0;
        for(int i = 0; i<4; i++)
            for(int j=0; j<11; j++)
                if (mapa[i][j]!=-1)
                    ocupado++;
        return (ocupado/44)*100;
    }

}