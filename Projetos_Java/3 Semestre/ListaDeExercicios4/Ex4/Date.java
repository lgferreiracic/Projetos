package ListaDeExercicios4.Ex4;

public class Date {
    private int day;
    private int month;
    private int year;
    
    public Date(int pDay, int pMonth, int pYear){
        this.day=pDay;
        this.month=pMonth;
        this.year=pYear;
    }

    public void setDay(int pDay){
        this.day=pDay;
    }

    public void setMonth(int pMonth){
        this.month=pMonth;
    }

    public void setYear(int pYear){
        this.year=pYear;
    }

    public int getDay(){
        return this.day;
    }

    public int getMonth(){
        return this.month;
    }

    public int getYear(){
        return this.year;
    }

    public void printDate(){
        System.out.print(" " + getDay() + "/" + getMonth() + "/" + getYear());
    }

    public String getPrintDate() {
        return " " + getDay() + "/" + getMonth() + "/" + getYear();
    }

}
