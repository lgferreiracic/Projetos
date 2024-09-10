package ListaDeExercicios2.Ex3_17;
import ListaDeExercicios2.Ex3_16.HeartRates;
public class HealthProfile {
    HeartRates h;
    private String sex;
    private double height;
    private double weight;

    HealthProfile(String pFirstName, String pLastName, int pDay, int pMonth, int pYear, String pSex, double pHeigth, double pWeight){
        h = new HeartRates(pFirstName, pLastName, pDay, pMonth, pYear);
        this.sex=pSex;
        this.height=pHeigth;
        this.weight=pWeight;
    }

    public void setSex(String pSex){
        this.sex=pSex;
    }

    public void setHeight(double pHeight){
        this.height=pHeight;
    }

    public void setWeight(double pWeight){
        this.weight=pWeight;
    }

    public String getSex(){
        return this.sex;
    }

    public double getHeight(){
        return this.height;
    }

    public double getWeight(){
        return this.weight;
    }
    
    public double getIMC(){
        return weight/(height*height);
    }

    public void classifImc(){
        if(getIMC()>=40)
            System.out.println("Obesidade Grau III");
        else if(getIMC()>=35)
            System.out.println("Obesidade Grau II");
        else if(getIMC()>=30)
            System.out.println("Obesidade Grau I");
        else if(getIMC()>=25)
            System.out.println("Pre-Obeso");
        else if(getIMC()>=18.5)
            System.out.println("Adequado");
        else if(getIMC()>=17)
            System.out.println("Magreza Grau I");
        else if(getIMC()>=16)
            System.out.println("Magreza Grau II");
        else
            System.out.println("Magreza Grau III");
    }

    public void print(){
        h.print();
        System.out.println("Sex: "+getSex());
        System.out.println("Height: "+getHeight());
        System.out.println("Weight: "+getWeight());
        System.out.printf("IMC: %.2f - ",getIMC());
        classifImc();
    }

}
