import javax.swing.*;
import java.awt.*;

public class CustomGridGraph extends JPanel {
    
    private final int rows = 8;
    private final int cols = 8;
    private final int panelSize = 930;  // Tamanho total do painel
    private final int cellSize = panelSize / cols;  // Tamanho de cada célula (116)

    @Override
    protected void paintComponent(Graphics g) {
        super.paintComponent(g);

        // Desenhar vértices e arestas
        for (int row = 0; row < rows; row++) {
            for (int col = 0; col < cols; col++) {
                // Coordenadas do centro da célula
                int x = col * cellSize + cellSize / 2;
                int y = row * cellSize + cellSize / 2;
                
                // Desenhar vértice (círculo)
                g.setColor(Color.BLUE);
                g.fillOval(x - 20, y - 20, 40, 40);
                
                // Desenhar arestas
                g.setColor(Color.BLACK);
                
                // Aresta para o vértice à direita (se houver)
                if (col < cols - 1) {
                    int xRight = (col + 1) * cellSize + cellSize / 2;
                    g.drawLine(x, y, xRight, y);
                }
                
                // Aresta para o vértice abaixo (se houver)
                if (row < rows - 1) {
                    int yBelow = (row + 1) * cellSize + cellSize / 2;
                    g.drawLine(x, y, x, yBelow);
                }
            }
        }
    }

    public static void main(String[] args) {
        JFrame frame = new JFrame("Custom Grid Graph");
        CustomGridGraph graphPanel = new CustomGridGraph();
        
        // Definir o tamanho do painel
        graphPanel.setPreferredSize(new Dimension(930, 930));
        
        frame.add(graphPanel);
        frame.pack();  // Ajustar o frame ao tamanho do painel
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setVisible(true);
    }
}
