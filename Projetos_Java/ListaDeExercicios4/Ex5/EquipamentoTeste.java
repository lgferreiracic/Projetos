package ListaDeExercicios4.Ex5;

import java.time.LocalTime;

public class EquipamentoTeste {
    public static void main(String[] args) {
        /* Na classe principal crie um equipamento, ligue e desligue por algumas vezes e
         * depois imprima os valores verificando a contabilização de número de vezes ligado e
         * o tempo total em que ficou ligado. */
        Equipamento e = new Equipamento(111, "Bomba");
        LocalTime horaAtual = LocalTime.of(10, 0, 0);

        // Ligar o equipamento
        e.ligarEquipamento(horaAtual);

        // Desligar o equipamento depois de 2 horas
        horaAtual = horaAtual.plusHours(2);
        e.desligarEquipamento(horaAtual);

        // Ligar o equipamento novamente
        horaAtual = horaAtual.plusHours(1);
        e.ligarEquipamento(horaAtual);

        // Desligar o equipamento depois de 30 minutos
        horaAtual = horaAtual.plusMinutes(30);
        e.desligarEquipamento(horaAtual);

        // Imprimir o relatório
        e.relatorio();
    }
}
