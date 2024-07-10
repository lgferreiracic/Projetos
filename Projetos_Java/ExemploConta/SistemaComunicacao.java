package ExemploConta;

import java.util.ArrayList;

public class SistemaComunicacao {
    public static void main(String args[])
    {
        ArrayList<IComunicable> lstDestinatario = new ArrayList<IComunicable>();
        
        Conta c;
        ContaCorrente cc;
        Pessoa p;
        c = new Conta("Lucas");
        lstDestinatario.add(c);
        cc = new ContaCorrente("Gabriel");
        lstDestinatario.add(cc);
        p = new Pessoa("Ferreira");
        lstDestinatario.add(p);

        for (IComunicable com: lstDestinatario){
            com.enviar();
        }

   
    }
    
}
