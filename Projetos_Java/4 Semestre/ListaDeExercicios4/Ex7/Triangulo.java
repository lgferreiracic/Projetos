package ListaDeExercicios4.Ex7;
import java.lang.Math;
public class Triangulo {
    /*Crie a classe triângulo com suas coordenadas. Faça a opção que preferir para
    armazenar os três pontos (três atributos diferentes, um vetor de pontos ou
    outros). */
    Ponto A, B, C;
    Triangulo(Ponto A, Ponto B, Ponto C){
        this.A=A;
        this.B=B;
        this.C=C;
    }
    /*Crie o método DeslocarX que altera as coordenadas X dos pontos de um
    deslocamento D. Por exemplo, de os pontos do triângulo são (2, 3), (5, 4) e (4, 6),
    com um deslocamento em X de D=4, eles passam para (6,3), (9,4) e (8,6). */

    public void deslocarX(double x){
        this.A.setX(this.A.getX()+x);
        this.B.setX(this.B.getX()+x);
        this.C.setX(this.C.getX()+x);
    }

    /*Crie um método que realize o deslocamento no eixo Y, de forma semelhante ao
    que foi feito no eixo X. */

    public void deslocarY(double y){
        this.A.setY(this.A.getY()+y);
        this.B.setY(this.B.getY()+y);
        this.C.setY(this.C.getY()+y);
    } 
    
    /*Crie um método que faça o deslocamento conjunto, ele recebe os valores dos
    deslocamentos Dx e Dy e realiza dos dois deslocamentos. */

    public void deslocarXY(double x, double y){
        this.deslocarX(x);
        this.deslocarY(y);
    }

    /*(Opcional) Caso tenha gostado do cenário, pesquise como é rotacionar uma figura
    em um plano 2D. Daí implemente um método que recebe um ângulo e rotaciona a
    figura com este ângulo e tendo como base/apoio o primeiro ponto. */

    void rotacao(double angulo) {
        // Converter o ângulo de graus para radianos
        double rad = angulo * Math.PI / 180.0;
    
        // Aplicar a matriz de rotação
        double novoX = this.A.getX() * Math.cos(rad) - this.A.getX() * Math.sin(rad);
        double novoY = this.A.getY() * Math.sin(rad) + this.A.getY() * Math.cos(rad);
        this.A.setX(novoX);
        this.A.setY(novoY);

        novoX = this.B.getX() * Math.cos(rad) - this.B.getX() * Math.sin(rad);
        novoY = this.B.getY() * Math.sin(rad) + this.B.getY() * Math.cos(rad);
        this.B.setX(novoX);
        this.B.setY(novoY);

        novoX = this.C.getX() * Math.cos(rad) - this.C.getX() * Math.sin(rad);
        novoY = this.C.getY() * Math.sin(rad) + this.C.getY() * Math.cos(rad);
        this.C.setX(novoX);
        this.C.setY(novoY);
    }

    public void imprimir(){
        System.out.println("Ponto A");
        this.A.imprimir();
        System.out.println("Ponto B");
        this.B.imprimir();
        System.out.println("Ponto C");
        this.C.imprimir();
    }
}
