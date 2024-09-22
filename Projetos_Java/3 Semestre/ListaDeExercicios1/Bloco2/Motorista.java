package ListaDeExercicios1.Bloco2;

import java.util.Scanner;

/*2.a) Imagine um aplicativo de mobilidade em que Motoristas podem ser chamados para atender
os clientes. Exemplos ou exemplares de motoristas são João, Everaldo e Cristiano. Um motorista
tem um nome, o modelo do carro, a placa do carro, o número de viagens e a sua avaliação (nota
entre 0 e 5).
Apresente o código da classe Motorista com seus atributos. 
2.b) Crie agora uma classe TestaMotorista e dentro do método main crie e instancie dois objetos
da classe Motorista.
3.b) Escolha um dos atributos e crie os métodos get e set para ele? Qual o papel destes métodos
ao se aplicar a ideia de encapsulamento.
3.c) No bloco 2 foram tratados métodos get e set que basicamente manipulam atributos em um
ecapsulamento.
Crie agora o método RegistraNovaViagem que recebe uma avaliação da viagem e daí
aumenta o número de viagens e atualiza a avaliação do motorista considerando a nota da nova
viagem.
3.d) Para operar com o sistema é necessário prever operações para entrada e saída de dados.
Implemente o método ImprimirMotorista que apresenta todos os dados do motorista.
3.e) Implemente o método LerMotorista que a partir de uma classe Scanner solicita para um
usuário os dados de um Motorista.*/

public class Motorista {
private String nome;
private String modelo;
private String placa;
private int numViagens;
private int avaliação;

    Motorista(String pNome, String pModelo, String pPlaca){
    this.nome=pNome;
    this.modelo=pModelo;
    this.placa=pPlaca;
    }

    public void mostraMotorista(){
        System.out.println(this.nome);
        System.out.println(this.modelo);
        System.out.println(this.placa);
        System.out.println(this.numViagens);
        System.out.println(this.avaliação);
    }

    public void setPlaca(String pPlaca){
        this.placa=pPlaca;
    }

    public String getPlaca(){
        return this.placa;
    }

    public void RegistraNovaViagem(int pAvaliacao){
        this.numViagens++;
        this.avaliação=pAvaliacao;
    }

    public void LerMotorista(Scanner s){
        String pNome, pModelo, pPlaca;
        pNome=s.nextLine();
        pModelo=s.nextLine();
        pPlaca=s.nextLine();
        this.nome=pNome;
        this.modelo=pModelo;
        this.placa=pPlaca;
    }
}
