/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */
public class Robo{// Classe representando o robo
    private int i;
    private int j;
    private Sala rSala;
    private boolean posicionado=false;

    public Robo(Sala pSala){ // Construtor de robo
        this.i=0;
        this.j=0;
        this.rSala=pSala;
    }
    public Robo(int i, int j, Sala sala) { // Construtor de robo
        this.i = i;
        this.j = j;
        this.rSala = sala;
        sala.setRobo(this); 
    }

    public void setIJ(int pI, int pJ){ //Setter paras as coordenas do robo
        if(rSala.getSala()[pI][pJ]!=2){
            if(posicionado)
                rSala.getSala()[i][j] = 0;
            rSala.getSala()[pI][pJ] = 1;
            this.i=pI;
            this.j=pJ;
            this.setPosicionado();
        }
        else{
                System.out.printf("Existe um obstaulo nessa posicao\n");
                //AuxiliarConsole.esperar();
        }

    }

    public void setSala(Sala pSala){ //Setter para a sala
        this.rSala=pSala;
    }

    public void setPosicionado(){ //Setter para posicionado
        this.posicionado=true;
    }
    public int getI(){ //Getter para coordenada i
        return this.i;
    }

    public int getJ(){ //Getter para coordenada j
        return this.j;
    }

    public Sala getSala(){ //Getter para sala
        return this.rSala;
    }

    public boolean getPosicionado(){ //Getter para posicionado
        return this.posicionado;
    }

    public void mover_para_cima() { //Metodo para mover para cima
        if(i>0)
            setIJ(i - 1, j);
    }

    public void mover_para_baixo() { //Metodo para mover para baixo
        if(i<20)
            setIJ(i + 1, j);
    }

    public void mover_para_esquerda() { //Metodo para mover para esquerda
        if(j>0)
            setIJ(i, j - 1);
    }

    public void mover_para_direita() { //Metodo para mover para direita
        if(j<20)
            setIJ(i, j + 1);
    }

}