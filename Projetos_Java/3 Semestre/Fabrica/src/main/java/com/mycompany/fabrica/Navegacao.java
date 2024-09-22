/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package com.mycompany.fabrica;

/**
 *
 * @author lucas
 */
import java.util.*;
public class Navegacao {
    private Sala nSala;
    private int numVertices;
    private LinkedList<Integer>[] listasDeAdj;

    // Construtor do grafo
    public Navegacao(Sala pSala) {
        this.nSala = pSala;
        int linhas = nSala.getSala().length;
        int colunas = nSala.getSala()[0].length;
        this.numVertices = linhas * colunas;
        listasDeAdj = new LinkedList[numVertices];
        for (int i = 0; i < numVertices; i++) {
            listasDeAdj[i] = new LinkedList<>();
        }
    }
    
    // Método para limpar as listas de adjacência
    private void limparListaAdj() {
        for (int i = 0; i < numVertices; i++) {
            listasDeAdj[i].clear();
        }
    }
    
    private void setArestas(){//Metodo que percorre a sala adicionando as arestas entre os vizinhos
        limparListaAdj(); // Limpa as listas de adjacência
        int linhas = nSala.getSala().length;
        int colunas = nSala.getSala()[0].length;
        
        for (int i = 0; i < linhas; i++) {
            for (int j = 0; j < colunas; j++) {
                if (nSala.getSala()[i][j] != 2) {
                    addSeValido(i, j, i - 1, j);     //Cima
                    addSeValido(i, j, i, j - 1);     // Esquerda
                    addSeValido(i, j, i, j + 1);     // Direita
                    addSeValido(i, j, i + 1, j);     // Baixo
                }
            }
        }
    }

    private void addSeValido(int x1, int y1, int x2, int y2) {//Metodo que adiciona uma aresta entre vertices se sao vizinhos validos
        int linhas = nSala.getSala().length;
        int colunas = nSala.getSala()[0].length;
        if (x2 >= 0 && x2 < linhas && y2 >= 0 && y2 < colunas && nSala.getSala()[x2][y2] != 2) {
            this.addAresta(coordenadas_para_posicao(x1, y1), coordenadas_para_posicao(x2, y2));
        }
    }
    
    public int coordenadas_para_posicao(int x, int y){//Metodo que recebe a coordena e transforma em um numero que representa a posicao
        return x * nSala.getSala()[0].length + y;
    }
    
    public int coordenada_x(int posicao){//Metodo que recebe a posicao e retorna o valor de x da coordenada
        return (int)(posicao/21);
    }
    
    public int coordenada_y(int posicao){//Metodo que recebe a posicao e retorna o valor de y da coordenada
        return (posicao%21);
    }
    
    // Adiciona uma aresta ao grafo
    private void addAresta(int orig, int dest) {
        listasDeAdj[orig].add(dest);
        listasDeAdj[dest].add(orig); 
    }

    // Implementação da busca em largura (BFS)
    public List<Integer> encontrarCaminhoBFS(int verticeInicio, int verticeFim) {
        this.setArestas();//Reseta as arestas toda vez, ja que pode ter havido mudança no cenario
        boolean[] visitado = new boolean[numVertices];//Array de visitados
        int[] predecessor = new int[numVertices];//Array que serve para rastrear o caminho percorrido 
        Arrays.fill(predecessor, -1);  // Preencher o array de predecessores com -1

        LinkedList<Integer> fila = new LinkedList<>();
        visitado[verticeInicio] = true;
        fila.add(verticeInicio);

        while (!fila.isEmpty()) {
            int vertice = fila.poll();//Retira o primeiro da fila

            if (vertice == verticeFim) {//Se o vertice atual eh o de destino, finaliza retornando o caminho
                return construirCaminho(predecessor, verticeInicio, verticeFim);
            }

            for (int VerticeAdj : listasDeAdj[vertice]) { //Visita todos os vizinhos
                if (!visitado[VerticeAdj]) {
                    visitado[VerticeAdj] = true;
                    predecessor[VerticeAdj] = vertice;
                    fila.add(VerticeAdj);
                }
            }
        }
        return Collections.emptyList();  // Retorna uma lista vazia se o destino não for encontrado
    }
    
    private List<Integer> construirCaminho(int[] predecessor, int verticeInicio, int verticeFim) {//Metodo para construir o caminho
        LinkedList<Integer> caminho = new LinkedList<>();
        for (int at = verticeFim; at != -1; at = predecessor[at]) {
            caminho.addFirst(at);
        }
        if (caminho.getFirst() == verticeInicio) {
            return caminho;
        }
        return Collections.emptyList(); 
    }
}
