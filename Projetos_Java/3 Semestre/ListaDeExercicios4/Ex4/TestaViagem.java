package ListaDeExercicios4.Ex4;
public class TestaViagem {
    public static void main(String[] args) {
        //Na classe principal crie a classe Viagem e realize alguns testes para checar se os
        //métodos estão funcionando adequadamente.
        Viagem v= new Viagem("Ilheus", "Teofilo Otoni", 15, 07, 2024, 17 );
        v.inicializarOnibus();
        v.venderPassagem(15);
        v.venderPassagem(16);
        v.liberaPassagem(16);
        v.mostrarJanelasDireita();
        v.mostrarJanelasCorredor();
        v.mostrarJanelasEsquerda();
        double ocupacao=v.ocupacao();
        System.out.printf("Ocupacao: %.2f", ocupacao);
    }
}
