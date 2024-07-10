package ListaDeExercicios4.Ex8;

public class MapaTeste {
    public static void main(String[] args) {
        /*Na classe principal crie o mapa e realize algumas experiências com ele, adicoonando
        caminhos e consultando. */
        Mapa m = new Mapa();
        m.inicializarMapa();
        m.conectar(0, 1, 3);
        m.conectar(0, 2, 2);
        m.conectar(1, 4, 1);
        m.conectar(2, 4, 2);
        m.imprimir();
        m.haCaminhoDireto(0, 1);
        m.haCaminho2Passos(1, 2);
        m.haCaminho2Passos(1, 3);
    }
    
}
