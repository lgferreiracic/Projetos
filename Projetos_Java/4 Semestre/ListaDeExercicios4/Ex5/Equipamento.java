package ListaDeExercicios4.Ex5;

import java.time.Duration;
import java.time.LocalTime;

/* Crie a classe Equipamento que contém um número de identificação (ID), a descrição
 * e o seu status (Ligado ou desligado). Crie todos os outros componentes da classe:
 * construtores (com e sem parâmetros), getters e setters, impressão e outros que
 * achar necessário. */
public class Equipamento {
    private int ID;
    private String descricao;
    private boolean status;
    private LocalTime horaLigado;
    private int quantVzsLig;
    private Duration tempoTotLig;

    public Equipamento(int ID, String descricao) {
        this.ID = ID;
        this.descricao = descricao;
        this.status = false;
        this.quantVzsLig = 0;
        this.tempoTotLig = Duration.ZERO;
    }

    public Equipamento() {
        this.ID = 0;
        this.descricao = "";
        this.status = false;
        this.quantVzsLig = 0;
        this.tempoTotLig = Duration.ZERO;
    }

    public void ligarEquipamento(LocalTime hora) {
        if (this.status) {
            System.out.println("O equipamento já está ligado");
        } else {
            this.status = true;
            this.horaLigado = hora;
            this.quantVzsLig++;
        }
    }

    public void desligarEquipamento(LocalTime hora) {
        if (!this.status) {
            System.out.println("O equipamento já está desligado");
        } else {
            this.status = false;
            Duration duracao = Duration.between(this.horaLigado, hora);
            this.tempoTotLig = this.tempoTotLig.plus(duracao);
        }
    }

    public void relatorio() {
        System.out.println("ID do equipamento: " + this.ID);
        System.out.println("Descrição: " + this.descricao);
        System.out.println("Quantidade de vezes ligado: " + this.quantVzsLig);
        System.out.println("Tempo total ligado: " + formatarTempo(this.tempoTotLig));
    }
    

    public String formatarTempo(Duration duracao) {
        long horas = duracao.toHours();
        long minutos = duracao.toMinutesPart();
        return String.format("%d horas e %d minutos", horas, minutos);
    }
    
}
