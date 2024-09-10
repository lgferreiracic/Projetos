package ListaDeExercicios4.Ex6;

public class TestaQuestao {
    public static void main(String[] args) {
        int numQuestao=10;
        String textoQuestao="Na orientacao a objetos os metodos responsaveis pela instanciacao e inicialização de objetos sao os:";
        String[] alternativas = new String[5];
        alternativas[0]="a) Criadores";
        alternativas[1]="b) Getters";
        alternativas[2]="c) Setters";
        alternativas[3]="d) Construtores";
        alternativas[4]="e) Impressores";
        char respCerta='d';
        Questao q = new Questao(numQuestao, textoQuestao, respCerta, alternativas);
        q.avaliar('a');
        q.boletim();
        q.alterarGabarito('a');
        q.avaliar('a');
        q.boletim();
    }
    
}
