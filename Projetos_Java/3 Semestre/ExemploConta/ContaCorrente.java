package ExemploConta;

public class ContaCorrente  extends Conta{
    public double limite;
    
    ContaCorrente(String nome){
        super(nome);
    }

    @Override
    public void Sacar(double pValor)
    {
        if (pValor < (this.saldo+this.limite))
            this.saldo -= pValor;         
    }
    
    public void enviar(){
        System.out.println("Mensagem enviada pelo aplicativo para " + this.titular.Nome);
    }
}
