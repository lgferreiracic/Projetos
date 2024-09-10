package Prova2.InterfaceGrafica.Parte3;
import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
public class Exemplo3 {

    public static void main(String[] args) {
        // Criar o frame
        JFrame frame = new JFrame("Exemplo Swing");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(500, 400);

        // Definir o layout do frame
        frame.setLayout(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();

        // JLabel
        JLabel label1 = new JLabel("Teste");
        gbc.gridx = 0;
        gbc.gridy = 0;
        frame.add(label1, gbc);

        JLabel label2 = new JLabel("Teste");
        gbc.gridx = 1;
        gbc.gridy = 0;
        frame.add(label2, gbc);

        JLabel label3 = new JLabel("Teste");
        gbc.gridx = 2;
        gbc.gridy = 0;
        frame.add(label3, gbc);

        // JRadioButton
        /*JRadioButton radioButton = new JRadioButton("Teste");
        gbc.gridx = 1;
        gbc.gridy = 1;
        frame.add(radioButton, gbc);*/

        // JCheckBox
        JCheckBox checkBox = new JCheckBox("Teste");
        gbc.gridx = 0;
        gbc.gridy = 1;
        frame.add(checkBox, gbc);

        // JButton
        JButton button = new JButton("Teste");
        gbc.gridx = 2;
        gbc.gridy = 1;
        frame.add(button, gbc);

        // JSlider
        JSlider slider = new JSlider();
        gbc.gridx = 1;
        gbc.gridy = 2;
        gbc.gridwidth = 2;
        frame.add(slider, gbc);

        // JTable
        String[] columnNames = {"Teste1", "Teste2", "Teste3", "Teste4"};
        Object[][] data = {
            {"", "", "", ""},
            {"", "", "", ""},
            {"", "", "", ""}
        };
        JTable table = new JTable(new DefaultTableModel(data, columnNames));
        JScrollPane scrollPane = new JScrollPane(table);
        gbc.gridx = 0;
        gbc.gridy = 3;
        gbc.gridwidth = 3;
        gbc.fill = GridBagConstraints.BOTH;
        gbc.weightx = 1.0;
        gbc.weighty = 1.0;
        frame.add(scrollPane, gbc);

        // Tornar o frame visível
        frame.setVisible(true);
    }
}
    
