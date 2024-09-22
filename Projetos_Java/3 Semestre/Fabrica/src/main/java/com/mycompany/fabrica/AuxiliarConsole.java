/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */
import java.io.IOException;
import java.util.Scanner;

public class AuxiliarConsole {
    public static void limparBuffer(Scanner scanner) {
        if (scanner.hasNextLine()) {
            scanner.nextLine();
        }
    }
    public static void esperar() {
        Scanner pauser = new Scanner (System.in);
        pauser.nextLine();
    }
    
    public static void limparTela() {
        try {
            
            new ProcessBuilder("clear").inheritIO().start().waitFor();
            
        } catch (Exception e) {
            System.out.println(e);
        }
    
}
}
