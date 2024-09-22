package ListaDeExercicios4.Ex6;
/*a) Crie a classe Questao com os atributos necessários (número da questão, resposta
dada, resposta certa, avaliação e a lista de alternativas). A lista de alternativas pode
ser um vetor de Strings. */
public class Questao {
    private int numQuestao;
    private String textoQuestao;
    private char respDada;
    private char respCerta;
    private boolean avaliacao;
    private String[] alternativas = new String[5];

    Questao(int numQuestao, String textoQuestao, char respCerta, String[] alternativas){
        this.numQuestao=numQuestao;
        this.textoQuestao=textoQuestao;
        this.respCerta=respCerta;
        this.alternativas=alternativas;
        this.avaliacao=true;
    }

    /*Crie o método AlterarGabarito que altera a resposta correta. */
    
    public void alterarGabarito(char pRespCerta){
        this.respCerta=pRespCerta;
    }

    /*Crie o método responder que recebe a alternativa e indica se a avaliação é Correta
    ou Errada. */

    public void avaliar(char resposta){
        this.respDada=resposta;
        if(this.respCerta==resposta)
            this.avaliacao=true;
        else
            this.avaliacao=false;
    }
    
    /*Crie o método Embaralhar as alternativas que recebe um número e rotaciona as
    alternativas com base neste número. Por exemplo, para as alternativas a) Item 1, b)
    Item 2, c) Item 3, ... ao solicitar Embaralhar(1), o sistema mostra a) Item 2, b) Item
    3, .... e) Item 1. */

    public void embaralhar(int num){
        String[] aux = new String[5];
        for(int i=0; i<5; i++){
            aux[i]=alternativas[i];
        }
        num%=5;
        for(int i=0; i<5; i++){
            if(i+1<num)
                alternativas[i]=aux[i+num];
            else
                alternativas[i]=aux[i-(num-1)];
        }
    }

    public void boletim(){
        System.out.println("Questao " + this.numQuestao);
        System.out.println(this.textoQuestao);
        System.out.println(this.alternativas[0]);
        System.out.println(this.alternativas[1]);
        System.out.println(this.alternativas[2]);
        System.out.println(this.alternativas[3]);
        System.out.println("Resposta dada: "+this.respDada);
        System.out.println("Resposta certa: "+this.respCerta);
        if (this.avaliacao)
            System.out.println("Avaliacao:  Correta");
        else
            System.out.println("Avaliacao:  Errada");
    }
}
