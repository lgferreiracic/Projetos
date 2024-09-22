package ListaDeExercicios2.Ex3_13;

public class Employee {
    private String firstName;
    private String lastName;
    private double salary;

    Employee(String pFirstName, String pLastName, double pSalary){
        this.firstName=pFirstName;
        this.lastName=pLastName;
        this.salary=pSalary;
    }

    public void setFirstName(String pFirstName){
        this.firstName=pFirstName;
    }

    public void setLastName(String pLastName){
        this.lastName=pLastName;
    }

    public void setSalary(double pSalary){
        this.salary=pSalary;
    }

    public String getFirstName(){
        return this.firstName;
    }

    public String getLastName(){
        return this.lastName;
    }

    public double getSalary(){
        return this.salary;
    }

    public double getAnnualSalary(){
        return getSalary()*12;
    }

    public void readjustment10Percent(){
        this.salary*=1.1;
    }
}
