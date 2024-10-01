#include <GL/glut.h>
#include <math.h>

#define PI 3.14159265358979323846

// Função para desenhar um quadrado (usado nos ramos da árvore)
void drawSquare(float x, float y, float size, float angle, int isLeaf) {
    glPushMatrix();
    glTranslatef(x, y, 0);
    glRotatef(angle, 0, 0, 1);  // Rotaciona o quadrado

    // Define a cor: marrom para tronco, verde para folhas
    if (isLeaf) {
        glColor3f(0.0f, 0.8f, 0.0f);  // Verde para as folhas
    } else {
        glColor3f(0.6f, 0.4f, 0.2f);  // Marrom para o tronco
    }

    glBegin(GL_POLYGON);
    glVertex2f(-size / 2, -size / 2);
    glVertex2f(size / 2, -size / 2);
    glVertex2f(size / 2, size / 2);
    glVertex2f(-size / 2, size / 2);
    glEnd();
    glPopMatrix();
}

// Função recursiva para desenhar a Árvore de Pitágoras
void drawPythagorasTree(float x, float y, float size, float angle, int depth) {
    if (depth == 0) return;

    // Desenha o ramo atual (quadrado), verifica se é folha (nível mais profundo)
    int isLeaf = (depth <= 3);  // Folhas a partir do nível 3

    drawSquare(x, y, size, angle, isLeaf);

    // Calcula as coordenadas do topo do ramo atual
    float newX = x + size * cos(angle * PI / 180.0);
    float newY = y + size * sin(angle * PI / 180.0);

    // Define o ângulo e o tamanho para os próximos ramos
    float leftAngle = angle + 45.0f;  // Ângulo para o ramo da esquerda
    float rightAngle = angle - 45.0f; // Ângulo para o ramo da direita
    float newSize = size * 0.7f;      // Fator de redução no tamanho

    // Desenha os próximos dois ramos recursivamente
    drawPythagorasTree(newX, newY, newSize, leftAngle, depth - 1);
    drawPythagorasTree(newX, newY, newSize, rightAngle, depth - 1);
}

// Função para desenhar o terreno (um retângulo verde na base)
void drawGround() {
    glColor3f(0.0f, 0.6f, 0.0f);  // Verde para o terreno
    glBegin(GL_POLYGON);
    glVertex2f(-1.0f, -0.5f);  // Canto inferior esquerdo
    glVertex2f(1.0f, -0.5f);   // Canto inferior direito
    glVertex2f(1.0f, -1.0f);   // Canto superior direito
    glVertex2f(-1.0f, -1.0f);  // Canto superior esquerdo
    glEnd();
}

// Função para desenhar o céu (um retângulo azul)
void drawSky() {
    glColor3f(0.53f, 0.81f, 0.98f);  // Azul claro
    glBegin(GL_POLYGON);
    glVertex2f(-1.0f, 1.0f);  // Canto superior esquerdo
    glVertex2f(1.0f, 1.0f);   // Canto superior direito
    glVertex2f(1.0f, -0.5f);  // Canto inferior direito
    glVertex2f(-1.0f, -0.5f); // Canto inferior esquerdo
    glEnd();
}

// Função para desenhar o Sol (um círculo amarelo)
void drawSun() {
    glColor3f(1.0f, 1.0f, 0.0f);  // Amarelo para o sol
    float radius = 0.15f;
    glBegin(GL_TRIANGLE_FAN);
    for (int i = 0; i <= 100; i++) {
        float angle = 2.0f * PI * i / 100.0f;
        float x = radius * cosf(angle);
        float y = radius * sinf(angle);
        glVertex2f(0.7f + x, 0.7f + y);  // Sol no canto superior direito
    }
    glEnd();
}

// Função de renderização do OpenGL
void display() {
    glClear(GL_COLOR_BUFFER_BIT);

    drawSky();  // Desenha o céu
    drawGround();  // Desenha o terreno
    drawSun();  // Desenha o Sol

    // Desenha a Árvore de Pitágoras
    drawPythagorasTree(-0.5f, -0.5f, 0.25f, 90.0f, 12);  // Primeira árvore com maior detalhe
    drawPythagorasTree(0.3f, -0.5f, 0.2f, 90.0f, 10);    // Segunda árvore

    glFlush();
}

// Função principal do OpenGL
int main(int argc, char** argv) {
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB);
    glutInitWindowSize(800, 600);
    glutCreateWindow("Árvore de Pitágoras Detalhada com Cenário");
    glClearColor(0.0f, 0.0f, 0.0f, 1.0f);  // Fundo preto
    glutDisplayFunc(display);
    glutMainLoop();
    return 0;
}
