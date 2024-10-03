#include <GL/glut.h>
#include <math.h>

#define PI 3.14159265358979323846

// Função genérica para desenhar círculos
void drawCircle(float x, float y, float radius, float red, float green, float blue) {
    glColor3f(red, green, blue);  // Define a cor do círculo
    glBegin(GL_TRIANGLE_FAN);
    for (int i = 0; i <= 100; i++) {
        float angle = 2.0f * PI * i / 100.0f;
        float cx = radius * cosf(angle);
        float cy = radius * sinf(angle);
        glVertex2f(x + cx, y + cy);  // Calcula a posição do vértice
    }
    glEnd();
}

// Função para desenhar o céu com gradiente
void drawSky() {
    glBegin(GL_POLYGON);
    glColor3f(0.7f, 0.7f, 0.2f); // Azul claro (parte superior)
    glVertex2f(1.0f, 1.0f);   // Canto superior direito
    glColor3f(0.0f, 0.4f, 0.8f); // Azul mais escuro (parte inferior)
    glVertex2f(-1.0f, 1.0f);  // Canto superior esquerdo
    glVertex2f(-1.0f, -1.0f); // Canto inferior esquerdo
    glVertex2f(1.0f, -1.0f);  // Canto inferior direito
    glEnd();
}

// Função para desenhar o Sol (um círculo amarelo)
void drawSun() {
    drawCircle(0.7f, 0.7f, 0.15f, 1.0f, 1.0f, 0.0f); // Sol no canto superior direito
}

// Função para desenhar um relevo plano com curvatura suave e altura intermediária
void drawCurvedRelief() {
    glBegin(GL_POLYGON);

    // Parte superior com curvatura (verde claro)
    glColor3f(0.4f, 0.8f, 0.4f);  // Verde claro
   
    for (int cont = -100; cont <= 100; cont += 5) {
        float x = cont / 100.0;
        float y = -0.6f + 0.15f * cosf(PI * x);  // Curvatura com altura intermediária
        glVertex2f(x, y);
    }

    // Parte inferior do relevo (verde escuro)
    glColor3f(0.2f, 0.6f, 0.2f);  // Verde médio
    glVertex2f(1.0f, -1.0f);   // Canto inferior direito
    glVertex2f(-1.0f, -1.0f);  // Canto inferior esquerdo
   
    glEnd();
}

// Função para desenhar uma nuvem, com parâmetros para a posição
void drawCloud1(float posX, float posY) {
    // Círculo maior central
    drawCircle(posX - 0.3f, posY + 0.5f, 0.15f, 1.0f, 1.0f, 1.0f);  // Branco

    // Círculos laterais
    drawCircle(posX - 0.45f, posY + 0.5f, 0.1f, 1.0f, 1.0f, 1.0f);  // Branco
    drawCircle(posX - 0.15f, posY + 0.5f, 0.1f, 1.0f, 1.0f, 1.0f);  // Branco
}

// Função para desenhar um círculo (usado para as hélices do drone)
void drawCircle2(float x, float y, float radius, int segments) {
    glBegin(GL_TRIANGLE_FAN);
    for (int i = 0; i <= segments; i++) {
        float angle = 2.0f * 3.1415926f * i / segments;
        float dx = radius * cosf(angle);
        float dy = radius * sinf(angle);
        glVertex2f(x + dx, y + dy);
    }
    glEnd();
}

// Função para desenhar uma árvore simples
void drawTree(float x, float y) {
    // Tronco da árvore (um retângulo marrom)
    glColor3f(0.4f, 0.2f, 0.0f);  // Marrom
    glBegin(GL_POLYGON);
    glVertex2f(x - 0.05f, y);     // Canto inferior esquerdo
    glVertex2f(x + 0.05f, y);     // Canto inferior direito
    glVertex2f(x + 0.05f, y + 0.3f);  // Canto superior direito
    glVertex2f(x - 0.05f, y + 0.3f);  // Canto superior esquerdo
    glEnd();

    // Folhas da árvore (três círculos verdes)
    glColor3f(0.0f, 0.6f, 0.0f);  // Verde
    drawCircle2(x, y + 0.35f, 0.15f, 20);  // Círculo central
    drawCircle2(x - 0.1f, y + 0.3f, 0.15f, 20);  // Círculo à esquerda
    drawCircle2(x + 0.1f, y + 0.3f, 0.15f, 20);  // Círculo à direita
}

// Função para desenhar uma flor
void drawFlower(float x, float y, float petalRadius, float centerRadius) {
    // Desenha as pétalas (seis círculos ao redor do centro)
    glColor3f(1.0f, 0.0f, 0.5f);  // Cor das pétalas (rosa)
    for (int i = 0; i < 6; i++) {
        float angle = 2.0f * PI * i / 6.0f;
        float petalX = x + petalRadius * cos(angle);
        float petalY = y + petalRadius * sin(angle);
        drawCircle(petalX, petalY, petalRadius, 1.0f, 0.5f, 0.5f);  // Rosa claro
    }

    // Desenha o centro da flor
    glColor3f(1.0f, 1.0f, 0.0f);  // Amarelo
    drawCircle(x, y, centerRadius, 1.0f, 1.0f, 0.0f);  // Círculo central amarelo
}

// Função para desenhar várias flores no relevo
void drawFlowersInField() {
    drawFlower(-0.5f, -0.7f, 0.02f, 0.007f);  // Flor 1
    drawFlower(0.5f, -0.9f, 0.02f, 0.007f);
    drawFlower(-0.2f, -0.6f, 0.02f, 0.007f);  // Flor 2
    drawFlower(0.2f, -0.7f, 0.02f, 0.007f);
    drawFlower(0.3f, -0.65f, 0.02f, 0.007f);  // Flor 3
    drawFlower(-0.3f, -0.95f, 0.02f, 0.007f);
    drawFlower(0.6f, -0.7f, 0.02f, 0.007f);   // Flor 4
    drawFlower(-0.6f, -0.8f, 0.02f, 0.007f);
    drawFlower(0.0f, -0.8f, 0.02f, 0.007f);   // Flor 5
    drawFlower(0.0f, -0.6f, 0.02f, 0.007f);
}


// Função de renderização do OpenGL
void display() {
    glClear(GL_COLOR_BUFFER_BIT);

    drawSky();  // Desenha o céu
    drawSun();  // Desenha o Sol
    drawCurvedRelief();
   
    // Desenha várias nuvens em posições diferentes
    drawCloud1(-0.2f, 0.0f);  // Nuvem na posição (-0.2, 0.0)
    drawCloud1(0.3f, 0.2f);   // Nuvem na posição (0.3, 0.2)
    drawCloud1(0.5f, -0.1f);  // Nuvem na posição (0.5, -0.1)
    drawTree(0.0f, -0.5f);
     // Desenha as flores no relevo
    drawFlowersInField();
    glFlush();
}

// Função principal do OpenGL
int main(int argc, char** argv) {
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGBA);  // Habilitar RGBA
    glutInitWindowSize(1200, 1000);
    glutCreateWindow("Cenario com Boneco Newton");
    glClearColor(0.0f, 0.0f, 0.0f, 1.0f);  // Fundo preto
    glutDisplayFunc(display);
    glutMainLoop();
    return 0;
}