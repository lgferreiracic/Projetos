package Aula5;

import java.util.Scanner;
import java.io.IOException;

public class AuxiliarConsole {
    public static void limparBuffer(Scanner scanner) {
        if (scanner.hasNextLine()) {
            scanner.nextLine();
        }
    }
    public static void esperar() {
        Scanner scanner = new Scanner(System.in);
        scanner.nextLine(); // Aguarda até que o usuário pressione Enter
        scanner.close(); // Feche o Scanner quando terminar
    }
    public static void limparTela(){
        try {
            if (System.getProperty("os.name").contains("Windows")) {
                new ProcessBuilder("cmd", "/c", "cls").inheritIO().start().waitFor();
            } else {
                new ProcessBuilder("clear").inheritIO().start().waitFor();
            }
        } catch (IOException | InterruptedException e) {
            e.printStackTrace();
        }
    }
}
