package ListaDeExercicios4.Ex8;

public class Mapa {
    /*Crie a classe mapa que apresenta os 5 pontos e inicialmente ninguém está
    conectado com ninguém (células preenchidas com -1). */

    private int[][] mapa = new int[5][5];
    public void inicializarMapa(){
        for(int i=0; i<5; i++){
            for(int j=0; j<5; j++){
                if(i!=j)
                    this.mapa[i][j]=-1;
                else
                    this.mapa[i][j]=0;
            }
        }
    }

    /*Crie o método conectar, que recebe um número de origem, um número de destino
    e uma distância e atualiza as informações no mapa/grafo. As vias são de mão dupla,
    por isso deve-se marcar tanto o caminho da origem para o destino como do destino
    para a origem. */

    public void conectar(int origem, int destino, int distancia){
        if(origem<5 && destino<5){
            this.mapa[origem][destino]=distancia;
            this.mapa[destino][origem]=distancia;
        }
        else{
            System.out.println("Insira um valor valido");
        }
    }

    /*Crie o método HáCaminhoDireto que recebe origem e destino e retorna se há
    conexão e com qual distância. */

    public void haCaminhoDireto(int origem, int destino){
        if(origem<5 && destino<5){
            if (this.mapa[origem][destino]!=-1){
                System.out.println("Existe caminho");
                System.out.println("Distancia: "+this.mapa[origem][destino]);
            }
            else{
                System.out.println("Nao existe caminho");
            }
        }
        else{
            System.out.println("Insira um valor valido");
        }
    }

    /*d) Crie o método que verifica se HáCaminho2Passos que verifica se há caminho de uma
    origem até um destino passando por apenas um local intermediário. */

    public void haCaminho2Passos(int origem, int destino){
        if(origem<5 && destino<5){
            if (this.mapa[origem][destino]!=-1){
                System.out.println("Existe caminho direto");
                System.out.println("Distancia: "+this.mapa[origem][destino]);
            }
            else{
                boolean c2Passos=false;
                for(int j=0; j<5; j++){
                    if (this.mapa[origem][j]!=-1&&this.mapa[j][destino]!=-1)
                        c2Passos=true;
                }
                if (c2Passos)
                    System.out.println("Existe caminho com apenas um local intermediario");
                else
                    System.out.println("Nao existe caminho com apenas um local intermediario");
            }
        }
        else{
            System.out.println("Insira um valor valido");
        }
    }

    public void imprimir(){
        System.out.println("__________");
        for(int i=0; i<5; i++){
            for(int j=0; j<5; j++){
                if(this.mapa[i][j]!=-1)
                    System.out.print(this.mapa[i][j]+"|");
                else
                    System.out.print(" |");
            }
            System.out.println();
        }
        System.out.println("----------");
    }

    
}
