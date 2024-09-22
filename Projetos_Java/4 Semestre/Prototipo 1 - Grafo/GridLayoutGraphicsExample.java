import javax.swing.*;
import java.awt.*;

public class GridLayoutGraphicsExample extends JPanel {

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);
        
        // Vamos supor que esta célula representa um espaço para desenhar
        int cellWidth = getWidth();   // Largura da célula no GridLayout
        int cellHeight = getHeight(); // Altura da célula no GridLayout

        // Desenhar um círculo no centro da célula
        int ovalWidth = 50;
        int ovalHeight = 50;
        int x = (cellWidth - ovalWidth) / 2;  // Coordenada X centralizada
        int y = (cellHeight - ovalHeight) / 2; // Coordenada Y centralizada

        g.setColor(Color.BLUE);
        g.fillOval(x, y, ovalWidth, ovalHeight);
    }

    public static void main(String[] args) {
        JFrame frame = new JFrame("GridLayout with Graphics");

        // Criando um painel principal com GridLayout 2x2
        JPanel panel = new JPanel(new GridLayout(4, 4));

        // Criar 4 células, onde cada célula será um JPanel personalizado
        for (int i = 0; i < 16; i++) {
            GridLayoutGraphicsExample cell = new GridLayoutGraphicsExample();
            panel.add(cell);  // Adicionar as células ao painel principal
        }

        frame.add(panel);
        frame.setSize(400, 400);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setVisible(true);
    }
}
