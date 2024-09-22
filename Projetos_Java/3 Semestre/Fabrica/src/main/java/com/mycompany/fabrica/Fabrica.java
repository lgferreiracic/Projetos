/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 */

package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */


public class Fabrica{
    public static void main(String[] args){
        
        
        Sala fabrica = new Sala(21, 21);
        Robo posicao = new Robo(fabrica);
        Navegacao navegacao = new Navegacao(fabrica);
        Obstaculos[] obstaculo = new Obstaculos[fabrica.getMaxObstaculos()];
        MainFrame f = new MainFrame(fabrica, posicao, navegacao, obstaculo);
        f.setVisible(true);
    }
    
    

}