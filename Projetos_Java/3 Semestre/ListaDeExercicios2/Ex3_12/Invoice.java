package ListaDeExercicios2.Ex3_12;
public class Invoice {
    private String numero;
    private String descricao;
    private int quantidade;
    private double preco;

    Invoice(String pNumero, String pDescricao, int pQuantidade, double pPreco){
        this.numero=pNumero;
        this.descricao=pDescricao;
        this.quantidade=pQuantidade;
        this.preco=pPreco;
    }

    public void setNumero(String pNumero){
        this.numero=pNumero;
    }

    public void setDescricao(String pDescricao){
        this.descricao=pDescricao;
    }

    public void setQuantidade(int pQuantidade){
        if(pQuantidade<0)
            pQuantidade=0;
        this.quantidade=pQuantidade;
    }

    public void setPreco(double pPreco){
        if(pPreco==0)
            pPreco=0;
        this.preco=pPreco;
    }

    public String getNumero(){
        return this.numero;
    }

    public String getDescricao(){
        return this.descricao;
    }

    public int getQuantidade(){
        return this.quantidade;
    }

    public double getPreco(){
        return this.preco;
    }

    public double getInvoiceAmount(){
        return this.preco*this.quantidade;
    }

    public void printInvoice(){
        System.out.println("Numero da fatura: "+this.numero);
        System.out.println("Descricao: "+this.descricao);
        System.out.println("Quantidade: "+this.quantidade);
        System.out.println("Preco: "+this.preco);
        System.out.println("Total: "+getInvoiceAmount());
    }


    
}
