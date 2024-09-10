package ExemploConta;

public class Pessoa implements IComunicable{
    
    public String CPF;
    public String Nome;

    Pessoa(String Nome){
        this.Nome=Nome;
    }

    public void enviar(){
        System.out.println("Mensagem enviada por SMS para " + this.Nome);
    }
}
