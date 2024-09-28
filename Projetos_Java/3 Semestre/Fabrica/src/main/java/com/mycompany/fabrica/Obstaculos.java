/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */
public class Obstaculos{// Classe representando os obstaculos
    private int i;
    private int j;
    private Sala oSala;
    public Obstaculos(int pI, int pJ, Sala pSala){ //Construtor de Obstaculos
        this.i=pI;
        this.j=pJ;
        this.oSala=pSala;

    }

    public Obstaculos(Sala pSala){ //Construtor de Obstaculos
        this.oSala=pSala;
    }

    public void setIJ(int pI, int pJ){ //Setter paras as coordenas do obstaculo
        if(oSala.getSala()[pI][pJ]!=1&&oSala.getSala()[pI][pJ]!=2){
            oSala.getSala()[pI][pJ]=2;

        }                        
        else {
                System.out.printf("Nao e possivel posicionar um obstaculo nessa posicao.\n");
                //AuxiliarConsole.esperar();
        }
    }

    public void setSala(Sala pSala){ //Setter para a sala
        this.oSala=pSala;
    }

    public int getI(){ //Getter para coordenada i
        return this.i;
    }

    public int getJ(){ //Getter para coordenada j
        return this.j;
    }

}
