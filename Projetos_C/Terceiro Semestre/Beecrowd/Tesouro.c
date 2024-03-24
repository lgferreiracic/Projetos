#include <stdio.h>

// Estrutura para representar um retângulo
typedef struct {
    int x0, y0, x1, y1; // Coordenadas dos vértices opostos
} Retangulo;

// Função para calcular a área de interseção entre dois retângulos
int areaIntersecao(Retangulo r0, Retangulo r1) {
    // Coordenadas do retângulo de interseção
    int x0 = (r0.x0 > r1.x0) ? r0.x0 : r1.x0;
    int y0 = (r0.y0 > r1.y0) ? r0.y0 : r1.y0;
    int x1 = (r0.x1 < r1.x1) ? r0.x1 : r1.x1;
    int y1 = (r0.y1 < r1.y1) ? r0.y1 : r1.y1;
    
    // Se as coordenadas resultantes definirem um retângulo válido
    if (x0 < x1 && y0 < y1) {
        return (x1 - x0) * (y1 - y0); // Calcula a área do retângulo
    } else {
        return -1; // Retorna -1 se não houver interseção
    }
}

int main() {
    Retangulo r0, r1;
    
    while (scanf("%d %d %d %d", &r0.x0, &r0.y0, &r0.x1, &r0.y1) != EOF) {
        scanf("%d %d %d %d", &r1.x0, &r1.y0, &r1.x1, &r1.y1);
        
        int area = areaIntersecao(r0, r1);
        
        if (area == -1) {
            printf("inexistente\n");
        } else if (area == 0) {
            if ((r0.x0 == r0.x1 && r0.x0 >= r1.x0 && r0.x0 <= r1.x1 && r0.y0 <= r1.y1 && r0.y1 >= r1.y0) ||
                (r0.y0 == r0.y1 && r0.y0 >= r1.y0 && r0.y0 <= r1.y1 && r0.x0 <= r1.x1 && r0.x1 >= r1.x0) ||
                (r1.x0 == r1.x1 && r1.x0 >= r0.x0 && r1.x0 <= r0.x1 && r1.y0 <= r0.y1 && r1.y1 >= r0.y0) ||
                (r1.y0 == r1.y1 && r1.y0 >= r0.y0 && r1.y0 <= r0.y1 && r1.x0 <= r0.x1 && r1.x1 >= r0.x0)) {
                printf("linha\n");
            } else if ((r0.x0 == r0.x1 && r0.x0 >= r1.x0 && r0.x0 <= r1.x1 && r0.y0 >= r1.y0 && r0.y0 <= r1.y1) ||
                       (r1.x0 == r1.x1 && r1.x0 >= r0.x0 && r1.x0 <= r0.x1 && r1.y0 >= r0.y0 && r1.y0 <= r0.y1)){
                printf("ponto\n");
            }
        } else if (area > 10) {
            printf("grande\n");
        } else {
            printf("adequada\n");
        }
    }
    
    return 0;
}
