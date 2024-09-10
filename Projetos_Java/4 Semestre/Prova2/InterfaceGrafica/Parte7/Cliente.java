package Prova2.InterfaceGrafica.Parte7;


public class Cliente {

    private int codigo;
    private String nome;

    Cliente(int pCodigo, String pNome){
        this.codigo = pCodigo;
        this.nome = pNome;
    }

    public int getCodigo(){
        return this.codigo;
    }

    public void setCodigo(int codigo){
        this.codigo = codigo;
    }

    public String getNome(){
        return this.nome;
    }

    public void setNome(String nome){
        this.nome = nome;
    }
    
}
