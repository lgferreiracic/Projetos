package ListaDeExercicios2.Ex3_16;
import ListaDeExercicios2.Ex3_14.Date;
import java.time.LocalDate;

public class HeartRates {
    private String firstName;
    private String lastName;
    private String birthday;
    private Date d;

    public HeartRates(String pFirstName, String pLastName, int pDay, int pMonth, int pYear){
        d = new Date(pDay, pMonth, pYear);
        this.firstName=pFirstName;
        this.lastName=pLastName;
        this.birthday=d.getPrintDate();
    }

    public int getOld(){
        LocalDate today = LocalDate.now();
        int currentYear = today.getYear();
        int birthYear = d.getYear();
        int age = currentYear - birthYear;
        if (today.getDayOfYear() > d.getDay() && today.getDayOfMonth()>d.getMonth()) {
            age--; 
        }
        return age;
    }

    public int freqCardMax(){
        return 220-getOld();
    }

    public int freqCardMaxAlvo(){
        return (int)(freqCardMax()*0.85);
    }

    public int freqCardMinAlvo(){
        return (int)(freqCardMax()*0.5);
    }

    public void setFirstName(String pFirstName){
        this.firstName=pFirstName;
    }

    public void setLastName(String pLastName){
        this.lastName=pLastName;
    }

    public void setBirthday(String pBirthday){
        this.birthday=pBirthday;
    }

    public String getFirstName(){
        return this.firstName;
    }

    public String getLastName(){
        return this.lastName;
    }

    public String getBirthday(){
        return this.birthday;
    }

    public void print(){
        System.out.println("Name: "+getFirstName());
        System.out.println("Last name: "+getLastName());
        System.out.println("Birthday: "+getBirthday());
        System.out.println("Years Old: "+getOld());
        System.out.println("Heart Rate Max: "+freqCardMax());
        System.out.println("Target Heart Rate: "+freqCardMinAlvo()+"-"+freqCardMaxAlvo());
    }
}
