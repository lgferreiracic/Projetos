package Prova2.InterfaceGrafica.Parte4.Extra;

import java.awt.BorderLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;

public class DevMedia extends JFrame implements ActionListener {

	private JButton[] botoes;	//ARRAY DE BOTÕES PARA OCULTAR PARTES
	private static final String[] nomes = {"Esconde Norte", "Esconde Sul",
	"Esconde Leste", "Esconde Oeste", "Esconde Centro"};
	private BorderLayout layout;

	public DevMedia()
	{
		super("Demo LayoutFrame");

		layout = new BorderLayout(5,5);	//ESPAÇOS DE 5 PIXELS
		setLayout(layout);
		botoes = new JButton[nomes.length];	//CONFIGURA O TAMANHO DO ARRAY

		//CRIA JBUTTONS E REGISTRA OUVINTES
		for(int count = 0; count < nomes.length; count++){
			botoes[count] = new JButton(nomes[count]);
			botoes[count].addActionListener(this);
		}

		//ADICIONA A POSIÇÃO DOS BOTÕES
		add(botoes[0], BorderLayout.NORTH);
		add(botoes[1], BorderLayout.SOUTH);
		add(botoes[2], BorderLayout.EAST);
		add(botoes[3], BorderLayout.WEST);
		add(botoes[4], BorderLayout.CENTER);
	}

	@Override
	public void actionPerformed(ActionEvent evento) {
		//VERIFICA A ORIGEM DE EVENTO E O PAINEL DE CONTEÚDO DE LAYOUT CORRESPONDENTE
		for(JButton botao : botoes){
			if(evento.getSource() == botao)
				botao.setVisible(false);	//OCULTA O BOTÃO QUANDO CLICADO
			else
				botao.setVisible(true);
		}

		layout.layoutContainer(getContentPane());

	}

	public static void main(String[] args) {

		DevMedia border = new DevMedia();
		border.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		border.setSize(400,200);
		border.setVisible(true);

	}
}