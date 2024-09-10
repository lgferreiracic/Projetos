package CenarioDoRoboV1.Testes;
public class MazeGenerator {
    public static int[][] generateMaze(int rows, int cols) {
        int[][] maze = new int[rows][cols];

        // Preencher todas as células com 1 (parede)
        for (int i = 0; i < rows; i++) {
            for (int j = 0; j < cols; j++) {
                maze[i][j] = 1;
            }
        }

        // Criar caminhos (0s) conforme o padrão da imagem
        for (int i = 2; i < rows - 2; i += 4) {
            for (int j = 2; j < cols - 2; j++) {
                maze[i][j] = 0;
                maze[i + 1][j] = 0;
            }
        }

        for (int i = 2; i < cols - 2; i += 4) {
            for (int j = 2; j < rows - 2; j++) {
                maze[j][i] = 0;
                maze[j][i + 1] = 0;
            }
        }

        // Central paths
        for (int i = 2; i < rows - 2; i++) {
            maze[i][cols / 2] = 0;
        }
        for (int i = 2; i < cols - 2; i++) {
            maze[rows / 2][i] = 0;
        }

        return maze;
    }

    public static void printMaze(int[][] maze) {
        for (int[] row : maze) {
            for (int cell : row) {
                if (cell == 1) {
                    System.out.print("■ ");
                } else {
                    System.out.print("  ");
                }
            }
            System.out.println();
        }
    }

    public static void main(String[] args) {
        int rows = 21; // número de linhas
        int cols = 21; // número de colunas
        int[][] maze = generateMaze(rows, cols);
        printMaze(maze);
    }
}
