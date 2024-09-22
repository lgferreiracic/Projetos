package CenarioDoRoboV1;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class FabricaSwing extends JFrame {
    private Sala fabrica;
    private Robo posicao;
    private Obstaculos[] obstaculo;
    private JPanel gridPanel;
    private JTextField posRoboI, posRoboJ, posObstaculoI, posObstaculoJ;

    public FabricaSwing() {
        fabrica = new Sala(5, 5);
        posicao = new Robo(fabrica);
        obstaculo = new Obstaculos[fabrica.getMaxObstaculos()];

        setTitle("Fábrica");
        setSize(800, 600);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(new BorderLayout());

        // Adicionar componentes
        add(createControlPanel(), BorderLayout.NORTH);
        add(createMovementPanel(), BorderLayout.SOUTH);
        gridPanel = createGridPanel();
        add(gridPanel, BorderLayout.CENTER);
        refreshGrid();
    }

    private JPanel createControlPanel() {
        JPanel panel = new JPanel(new GridLayout(4, 3));

        // Campos e botões para posicionar o robô
        posRoboI = new JTextField();
        posRoboJ = new JTextField();
        JButton btnPosRobo = new JButton("Posicionar Robo");
        btnPosRobo.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                try {
                    int i = Integer.parseInt(posRoboI.getText());
                    int j = Integer.parseInt(posRoboJ.getText());
                    if (fabrica.dentroDosLimites(i, j)) {
                        posicao.setIJ(i - 1, j - 1);
                        refreshGrid();
                    } else {
                        JOptionPane.showMessageDialog(null, "Fora dos limites");
                    }
                } catch (NumberFormatException ex) {
                    JOptionPane.showMessageDialog(null, "Entrada inválida");
                }
            }
        });

        // Campos e botões para posicionar obstáculos
        posObstaculoI = new JTextField();
        posObstaculoJ = new JTextField();
        JButton btnPosObstaculo = new JButton("Posicionar Obstáculo");
        btnPosObstaculo.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                try {
                    int i = Integer.parseInt(posObstaculoI.getText());
                    int j = Integer.parseInt(posObstaculoJ.getText());
                    if (fabrica.dentroDosLimites(i, j)) {
                        obstaculo[fabrica.getQuantAtualObstaculos()] = new Obstaculos(fabrica);
                        obstaculo[fabrica.getQuantAtualObstaculos()].setIJ(i - 1, j - 1);
                        refreshGrid();
                    } else {
                        JOptionPane.showMessageDialog(null, "Fora dos limites");
                    }
                } catch (NumberFormatException ex) {
                    JOptionPane.showMessageDialog(null, "Entrada inválida");
                }
            }
        });

        panel.add(new JLabel("Robo Linha:"));
        panel.add(posRoboI);
        panel.add(btnPosRobo);
        panel.add(new JLabel("Robo Coluna:"));
        panel.add(posRoboJ);
        panel.add(new JLabel());
        
        panel.add(new JLabel("Obstáculo Linha:"));
        panel.add(posObstaculoI);
        panel.add(btnPosObstaculo);
        panel.add(new JLabel("Obstáculo Coluna:"));
        panel.add(posObstaculoJ);
        panel.add(new JLabel());

        return panel;
    }

    private JPanel createMovementPanel() {
        JPanel panel = new JPanel(new GridLayout(2, 3));

        JButton btnMoveUp = new JButton("Cima");
        btnMoveUp.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                posicao.mover_para_cima();
                refreshGrid();
            }
        });

        JButton btnMoveDown = new JButton("Baixo");
        btnMoveDown.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                posicao.mover_para_baixo();
                refreshGrid();
            }
        });

        JButton btnMoveLeft = new JButton("Esquerda");
        btnMoveLeft.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                posicao.mover_para_esquerda();
                refreshGrid();
            }
        });

        JButton btnMoveRight = new JButton("Direita");
        btnMoveRight.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                posicao.mover_para_direita();
                refreshGrid();
            }
        });

        panel.add(new JLabel());
        panel.add(btnMoveUp);
        panel.add(new JLabel());
        panel.add(btnMoveLeft);
        panel.add(new JLabel());
        panel.add(btnMoveRight);
        panel.add(new JLabel());
        panel.add(btnMoveDown);
        panel.add(new JLabel());

        return panel;
    }

    private JPanel createGridPanel() {
        JPanel panel = new JPanel(new GridLayout(5, 5));
        panel.setBorder(BorderFactory.createLineBorder(Color.BLACK));
        return panel;
    }

    private void refreshGrid() {
        gridPanel.removeAll();
        int[][] sala = fabrica.getSala();
        for (int i = 0; i < 5; i++) {
            for (int j = 0; j < 5; j++) {
                JLabel label = new JLabel("", SwingConstants.CENTER);
                label.setBorder(BorderFactory.createLineBorder(Color.GRAY));
                if (sala[i][j] == 1) {
                    label.setText("R");
                    label.setBackground(Color.GREEN);
                } else if (sala[i][j] == 2) {
                    label.setText("X");
                    label.setBackground(Color.RED);
                }
                label.setOpaque(true);
                gridPanel.add(label);
            }
        }
        gridPanel.revalidate();
        gridPanel.repaint();
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                new FabricaSwing().setVisible(true);
            }
        });
    }
}