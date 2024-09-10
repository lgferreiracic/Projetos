package ListaDeExercicios4.Ex1;
/*e) Na classe principal crie pelo menos três objetos candidatos com notas que permite
ser aprovado, ser reprovado por conta de uma das notas ser abaixo de 50,0 e outro
em que foi reprovado pela média total inferior a 60,0 */
public class TestaCandidato {
    public static void main(String[] args) {
        Candidato c1=new Candidato("Lucas", 90, 85, 70);
        Candidato c2=new Candidato("Gabriel", 90, 85, 50);
        Candidato c3=new Candidato("Ferreira", 60, 60, 60);
        
        c1.feedback();
        c2.feedback();
        c3.feedback();
    }
    
}
