package ListaDeExercicios4.Ex1;

/*Imagine que um concurso foi realizado com base em 3 provas cada uma com uma nota de 0 a
100. O candidato está classificado, isto é, ele só poderá ser convocado se obter nota superior a
50,0 em qualquer prova e que a média total seja superior a 60,0.
a) Crie a classe Candidato com os atributos Nome e os valores das notas.
b) Crie os construtores da classe, apenas com o Nome e daí as notas ficam zeradas ou
com Nome e todas as três notas das provas.
c) Crie um método VerificarClassificado que verifica se determinado candidato foi
classificado no concurso.
d) Crie um método getMedia que apresenta qual a média final do candidato.
.*/

public class Candidato {
    private String nome;
    private double calculo, lp, ed;
    Candidato(String pNome){
        this.nome=pNome;
    }
    Candidato(String pNome, double pCalculo, double pLp, double pEd){
        this.nome=pNome;
        this.calculo=pCalculo;
        this.lp=pLp;
        this.ed=pEd;
    }

    public double media(){
        return (this.calculo+this.lp+this.ed)/3;
    }

    public boolean superior50(){
        if(this.calculo>50&&this.lp>50&&this.ed>50)
            return true;
        else
            return false;
    }

    public boolean classificado(){
        if(this.superior50()&&(this.media()>60))
            return true;
        else
            return false;
    }

    public boolean motivoReprovado(){
        if(!this.superior50())
            return true;
        else
            return false;
    }

    public void feedback(){
        if(this.classificado())
            System.out.println("Aprovado");
        else{
            if(this.motivoReprovado())
                System.out.println("Nota abaixo de 50");
            else{
                System.out.println("Media igual ou inferior a 60");
            }
        }
    }

    
}
