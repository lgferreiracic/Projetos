package ExemploConta;
public class Conta implements IComunicable{
    
    public int      numero;
    public int      agencia;
    public Pessoa   titular;
    public Pessoa   gerente;
    public double   saldo;

    Conta(String nome){
        this.titular = new Pessoa(nome); 
    }
    
    public void Sacar(double pValor)
    {
        if (pValor < this.saldo)
            this.saldo -= pValor;        
    }
    
    public void enviar(){
        System.out.println("Mensagem enviada por email para " + this.titular.Nome );
    }
    
}

