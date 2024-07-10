package ListaDeExercicios2.Ex3_13;

public class EmployeeTest {
    public static void main(String[] args) {
        Employee e1= new Employee("Lucas", "Ferreira", 10000);
    Employee e2= new Employee("Gabriel", "Ferreira", 15000);
    
    e1.readjustment10Percent();
    e2.readjustment10Percent();
    System.out.println(e1.getAnnualSalary());
    System.out.println(e2.getAnnualSalary());
    }
}
