package CenarioDoRoboV1;

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
