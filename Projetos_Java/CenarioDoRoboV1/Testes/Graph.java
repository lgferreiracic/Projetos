package CenarioDoRoboV1.Testes;

import java.util.*;

public class Graph {
    private int numVertices;
    private LinkedList<Integer>[] adjLists;

    // Construtor do grafo
    public Graph(int vertices) {
        numVertices = vertices;
        adjLists = new LinkedList[vertices];
        for (int i = 0; i < vertices; i++) {
            adjLists[i] = new LinkedList<>();
        }
    }

    // Adiciona uma aresta ao grafo
    public void addEdge(int src, int dest) {
        adjLists[src].add(dest);
        adjLists[dest].add(src); // Para grafos não direcionados, comente essa linha para grafos direcionados
    }

    // Implementação da busca em largura (BFS)
    public void BFS(int startVertex) {
        boolean[] visited = new boolean[numVertices];
        LinkedList<Integer> queue = new LinkedList<>();

        visited[startVertex] = true;
        queue.add(startVertex);

        while (queue.size() != 0) {
            int vertex = queue.poll();
            System.out.print(vertex + " ");

            Iterator<Integer> iterator = adjLists[vertex].listIterator();
            while (iterator.hasNext()) {
                int adjVertex = iterator.next();
                if (!visited[adjVertex]) {
                    visited[adjVertex] = true;
                    queue.add(adjVertex);
                }
            }
        }
    }

    public static void main(String[] args) {
        Graph graph = new Graph(6);

        graph.addEdge(0, 1);
        graph.addEdge(0, 2);
        graph.addEdge(1, 3);
        graph.addEdge(1, 4);
        graph.addEdge(2, 4);
        graph.addEdge(3, 4);
        graph.addEdge(3, 5);
        graph.addEdge(4, 5);

        System.out.println("Busca em Largura iniciando do vértice 0:");

        graph.BFS(0);
    }
}
