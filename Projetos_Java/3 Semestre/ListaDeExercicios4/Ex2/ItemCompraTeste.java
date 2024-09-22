package ListaDeExercicios4.Ex2;
/*d) Na classe principal crie um item de compra, por exemplo, “TV 40””, 2300, 2 e 20%
e experimente os métodos.
e) Ainda na classe principal, crie um vetor com 5 items de compra e depois calcule o
total da compra e o total do desconto */
public class ItemCompraTeste {
    public static void main(String[] args) {
        ItemCompra tv=new ItemCompra("TV 40”", 2300, 2, 0.2f);
        tv.print();

        ItemCompra[] compra =new ItemCompra[5];
        double totalCompra=0, totalDesconto=0;
        for(int i=0; i<5; i++){
            compra[i]=new ItemCompra("TV 40”", 2300, 2, 0.2f);
            totalCompra+=compra[i].getValorTotalItem();
            totalDesconto+=compra[i].getValorDesconto();
        }

        System.out.println("Total Compra: "+totalCompra);
        System.out.println("Total Desconto: "+totalDesconto);
        System.out.println("Valor final: "+(totalCompra-totalDesconto));

        
    }
    
}
