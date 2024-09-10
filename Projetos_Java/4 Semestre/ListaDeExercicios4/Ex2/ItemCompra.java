package ListaDeExercicios4.Ex2;
/*Faça um programa que implemente a classe ItemCompra, ela tem a descrição do item, o valor
unitário do item, a quantidade e o percentual de desconto. Com base nestes elementos é
possível obter o valor total do item (qtde x valor unitário) e o desconto no item.
a) Crie a classe ItemCompra com seus atributos, os métodos getters e setters e
construtores (sem e com parâmetros).
b) Crie o método ValorTotalItem que retorna o valor total do item
c) Crie o método ValorDesconto que recupera qual o valor de desconto no item
. */
public class ItemCompra {
    private String descricao;
    private double valorUnitario;
    private int quantidade;
    private float desconto;

    ItemCompra(){

    }
    ItemCompra(String pDescricao, double pValorUnitario, int pQuantidade, float pDesconto){
        this.descricao=pDescricao;
        this.valorUnitario=pValorUnitario;
        this.quantidade=pQuantidade;
        this.desconto=pDesconto;
    }

    public void setDescricao(String pDescricao){
        this.descricao=pDescricao;
    }

    public void setValorUnitario(double pValorUnitario){
        this.valorUnitario=pValorUnitario;
    }

    public void setQuantidade(int pQuantidade){
        this.quantidade=pQuantidade;
    }

    public void setDesconto(float pDesconto){
        this.desconto=pDesconto;
    }

    public String getDescricao(){
        return this.descricao;
    }

    public double getValorUnitario(){
        return this.valorUnitario;
    }

    public int getQuantidade(){
        return this.quantidade;
    }

    public float getDesconto(){
        return this.desconto;
    }

    public double getValorTotalItem(){
        return this.valorUnitario*this.quantidade;
    }

    public double getValorDesconto(){
        return this.getValorTotalItem()*this.desconto;
    }

    public double getValorFinal(){
        return this.getValorTotalItem()-this.getValorDesconto();
    }

    public void print(){
        System.out.println(this.descricao);
        System.out.println("Valor Unitario: "+this.valorUnitario);
        System.out.println("Quantidade: "+this.quantidade);
        System.out.println("Desconto: "+this.desconto);
        System.out.println("Valor da compra: "+this.getValorTotalItem());
        System.out.println("Valor descontado: "+this.getValorDesconto());
        System.out.println("Valor final: "+getValorFinal());
        
    }


    
}
