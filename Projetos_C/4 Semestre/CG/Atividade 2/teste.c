#include <GL/glut.h>
#include <math.h>

#define PI 3.14159265358979323846

// Estrutura para representar as cores (incluindo canal alfa)
typedef struct {
    float red, green, blue, alpha;  // Agora inclui o canal alfa
} Color;

// Estruturas para representar os objetos do cenário
typedef struct {
    float x, y;
} Position;

typedef struct {
    Position pos;
    float radius;
    Color color;
} Sun;

typedef struct {
    Position pos;
    Color color;
} Cloud;

typedef struct {
    Position pos;
    Color trunkColor;
    Color leavesColor;
} Cactus;

typedef struct {
    Position pos;
    Color baseColor;
    Color sideColor;
} Pyramid;

typedef struct {
    Position pos;
    Color mainColor;
    Color secundaryColor;
    Color rotorColor;
} Drone;

// Função genérica para desenhar círculos
void drawCircle(float x, float y, float radius, Color color) {
    glColor4f(color.red, color.green, color.blue, color.alpha);  // Usa glColor4f para incluir o canal alfa
    glBegin(GL_TRIANGLE_FAN);
    for (int i = 0; i <= 100; i++) {
        float angle = 2.0f * PI * i / 100.0f;
        float cx = radius * cosf(angle);
        float cy = radius * sinf(angle);
        glVertex2f(x + cx, y + cy);
    }
    glEnd();
}

// Função para desenhar o céu
void drawSky() {
    glBegin(GL_POLYGON);
    glColor3f(0.9f, 0.75f, 0.5f);
    glVertex2f(1.0f, 1.0f);
    glColor3f(0.9f, 0.3f, 0.0f);  // Cor mais clara (superior)
    glVertex2f(-1.0f, 1.0f);
    glColor3f(0.9f, 0.5f, 0.2f);  // Cor mais quente (inferior)
    glVertex2f(-1.0f, -1.0f);
    glVertex2f(1.0f, -1.0f);
    glEnd();
}

// Função para desenhar o sol
void drawSun(Sun sun) {
    drawCircle(sun.pos.x, sun.pos.y, sun.radius, sun.color);
}

// Função para desenhar o solo do deserto
void drawDesertFloor() {
    glBegin(GL_POLYGON);
    glColor3f(0.9f, 0.8f, 0.6f);  // Bege claro
    for (int cont = -100; cont <= 100; cont += 5) {
        float x = cont / 100.0f;
        float y = -0.7f + 0.05f * cosf(PI * x);  // Curvatura suave do terreno
        glVertex2f(x, y);
    }
    glVertex2f(1.0f, -1.0f);
    glVertex2f(-1.0f, -1.0f);
    glEnd();
}

// Função para desenhar uma nuvem
void drawCloud(Cloud cloud) {
    drawCircle(cloud.pos.x - 0.3f, cloud.pos.y + 0.5f, 0.15f, cloud.color);
    drawCircle(cloud.pos.x - 0.45f, cloud.pos.y + 0.5f, 0.1f, cloud.color);
    drawCircle(cloud.pos.x - 0.15f, cloud.pos.y + 0.5f, 0.1f, cloud.color);
}

// Função para desenhar um cacto com formas quadradas
void drawCactus(Cactus cactus) {
    glColor4f(cactus.trunkColor.red, cactus.trunkColor.green, cactus.trunkColor.blue, 1.0f);

    // Tronco principal (retângulo)
    glBegin(GL_QUADS);
    glVertex2f(cactus.pos.x - 0.05f/2, cactus.pos.y);        // Canto inferior esquerdo
    glVertex2f(cactus.pos.x + 0.05f/2, cactus.pos.y);        // Canto inferior direito
    glVertex2f(cactus.pos.x + 0.05f/2, cactus.pos.y + 0.4f/2); // Canto superior direito
    glVertex2f(cactus.pos.x - 0.05f/2, cactus.pos.y + 0.4f/2); // Canto superior esquerdo
    glEnd();

    // Braço esquerdo (retângulo)
    glBegin(GL_QUADS);
    glVertex2f(cactus.pos.x - 0.14f/2, cactus.pos.y + 0.2f/2);  // Canto inferior esquerdo
    glVertex2f(cactus.pos.x - 0.07f/2, cactus.pos.y + 0.2f/2);  // Canto inferior direito
    glVertex2f(cactus.pos.x - 0.07f/2, cactus.pos.y + 0.35f/2); // Canto superior direito
    glVertex2f(cactus.pos.x - 0.14f/2, cactus.pos.y + 0.35f/2); // Canto superior esquerdo
    glEnd();

    // Braço direito (retângulo)
    glBegin(GL_QUADS);
    glVertex2f(cactus.pos.x + 0.07f/2, cactus.pos.y + 0.2f/2);  // Canto inferior esquerdo
    glVertex2f(cactus.pos.x + 0.14f/2, cactus.pos.y + 0.2f/2);  // Canto inferior direito
    glVertex2f(cactus.pos.x + 0.14f/2, cactus.pos.y + 0.30f/2); // Canto superior direito
    glVertex2f(cactus.pos.x + 0.07f/2, cactus.pos.y + 0.30f/2); // Canto superior esquerdo
    glEnd();

    // Braço direito (retângulo)
    glBegin(GL_QUADS);
    glVertex2f(cactus.pos.x - 0.07f/2, cactus.pos.y + 0.2f/2);  // Canto inferior esquerdo
    glVertex2f(cactus.pos.x + 0.07f/2, cactus.pos.y + 0.2f/2);  // Canto inferior direito
    glVertex2f(cactus.pos.x + 0.14f/2, cactus.pos.y + 0.25f/2); // Canto superior direito
    glVertex2f(cactus.pos.x - 0.14f/2, cactus.pos.y + 0.25f/2); // Canto superior esquerdo
    glEnd();
}

// Função para desenhar uma pirâmide
void drawPyramid(Pyramid pyramid) {
    // Base da pirâmide
    glBegin(GL_POLYGON);
    glColor3f(pyramid.baseColor.red, pyramid.baseColor.green, pyramid.baseColor.blue);
    glVertex2f(pyramid.pos.x - 0.5f, pyramid.pos.y);  // Canto inferior esquerdo
    glVertex2f(pyramid.pos.x + 0.5f, pyramid.pos.y);  // Canto inferior direito
    glVertex2f(pyramid.pos.x, pyramid.pos.y + 0.8f);  // Ponto superior
    glEnd();

    // Lado direito da pirâmide
    glBegin(GL_TRIANGLES);
    glColor3f(pyramid.sideColor.red, pyramid.sideColor.green, pyramid.sideColor.blue);
    glVertex2f(pyramid.pos.x + 0.5f, pyramid.pos.y);
    glVertex2f(pyramid.pos.x, pyramid.pos.y + 0.8f);
    glVertex2f(pyramid.pos.x + 0.2f, pyramid.pos.y);
    glEnd();

    glBegin(GL_QUADS);
    glColor4f(0.0f, 0.0f, 0.0f, 0.5f);
    glVertex2f(pyramid.pos.x - 0.5f, pyramid.pos.y);  // Canto superior esquerdo
    glVertex2f(pyramid.pos.x + 0.2f, pyramid.pos.y);  // Canto superior direito
    glVertex2f(pyramid.pos.x - 0.1f, -1.0f); // Canto superior direito
    glVertex2f(pyramid.pos.x - 0.6f, -1.0f); // Canto superior esquerdo
    glEnd();
}

// Função para desenhar um drone com perspectiva
void drawDrone(Drone drone) {
    //Perna 3 - cima
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.02474f, drone.pos.y + 0.0235f); //B1
    glVertex2f(drone.pos.x + 0.05347f, drone.pos.y + 0.0434f); //C1
    glVertex2f(drone.pos.x + 0.06279f, drone.pos.y + 0.0369f); //A1
    glVertex2f(drone.pos.x + 0.03493f, drone.pos.y + 0.01671f); //Z
    glEnd();
    //Contorno da perna 3 - cima
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.02474f, drone.pos.y + 0.0235f); //B1
    glVertex2f(drone.pos.x + 0.05347f, drone.pos.y + 0.0434f); //C1
    glVertex2f(drone.pos.x + 0.06279f, drone.pos.y + 0.0369f); //A1
    glVertex2f(drone.pos.x + 0.03493f, drone.pos.y + 0.01671f); //Z
    glEnd();
    //Perna 3 - lateral
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.03493f, drone.pos.y + 0.0167f); //Z
    glVertex2f(drone.pos.x + 0.06279f, drone.pos.y + 0.0369f); //A1
    glVertex2f(drone.pos.x + 0.06319f, drone.pos.y + 0.0234f); //E1
    glVertex2f(drone.pos.x + 0.04050f, drone.pos.y + 0.0069f); //D1
    glEnd();
    //Contorno da perna 3 - lateral
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.03493f, drone.pos.y + 0.0167f); //Z
    glVertex2f(drone.pos.x + 0.06279f, drone.pos.y + 0.0369f); //A1
    glVertex2f(drone.pos.x + 0.06319f, drone.pos.y + 0.0234f); //E1
    glVertex2f(drone.pos.x + 0.04050f, drone.pos.y + 0.0069f); //D1
    glEnd();


    //Perna 4 - cima
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.05859f, drone.pos.y + 0.03444f); //I1
    glVertex2f(drone.pos.x - 0.04674f, drone.pos.y + 0.04217f); //G1
    glVertex2f(drone.pos.x - 0.02491f, drone.pos.y + 0.02339f); //F1
    glVertex2f(drone.pos.x - 0.03511f, drone.pos.y + 0.01659f); //H1
    glEnd();
    //Contorno da perna 4 - cima
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.05859f, drone.pos.y + 0.03444f); //I1
    glVertex2f(drone.pos.x - 0.04674f, drone.pos.y + 0.04217f); //G1
    glVertex2f(drone.pos.x - 0.02491f, drone.pos.y + 0.02339f); //F1
    glVertex2f(drone.pos.x - 0.03511f, drone.pos.y + 0.01659f); //H1
    glEnd();
    //Perna 4 - lateral
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.05859f, drone.pos.y + 0.03444f); //I1
    glVertex2f(drone.pos.x - 0.03511f, drone.pos.y + 0.01659f); //H1
    glVertex2f(drone.pos.x - 0.04349f, drone.pos.y + 0.00900f); //J1
    glVertex2f(drone.pos.x - 0.05748f, drone.pos.y + 0.02074f); //K1
    glEnd();
    //Contorno da perna 4 - lateral
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.05859f, drone.pos.y + 0.03444f); //I1
    glVertex2f(drone.pos.x - 0.03511f, drone.pos.y + 0.01659f); //H1
    glVertex2f(drone.pos.x - 0.04349f, drone.pos.y + 0.00900f); //J1
    glVertex2f(drone.pos.x - 0.05748f, drone.pos.y + 0.02074f); //K1
    glEnd();

    //Cima
    glColor4f(drone.mainColor.red, drone.mainColor.green, drone.mainColor.blue, drone.mainColor.alpha);  // Corpo principal
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x, drone.pos.y + 0.04f); 
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y); 
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f); 
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y); 
    glEnd();
    // Contorno da parte de cima
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x, drone.pos.y + 0.04f); 
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y); 
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f); 
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y); 
    glEnd();

    //Direita
    glColor4f(drone.mainColor.red, drone.mainColor.green, drone.mainColor.blue, drone.mainColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y );
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y - 0.02f);
    glVertex2f(drone.pos.x, drone.pos.y - 0.06f);  
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f);  
    glEnd();
    //Contorno da parte direita
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y );
    glVertex2f(drone.pos.x + 0.06f, drone.pos.y - 0.02f);
    glVertex2f(drone.pos.x, drone.pos.y - 0.06f);  
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f);  
    glEnd();

    //Esquerda
    glColor4f(drone.mainColor.red, drone.mainColor.green, drone.mainColor.blue, drone.mainColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y );
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f);
    glVertex2f(drone.pos.x, drone.pos.y - 0.06f);  
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y - 0.02f);  
    glEnd();
    //Contorno da parte esquerda
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y );
    glVertex2f(drone.pos.x, drone.pos.y - 0.04f);
    glVertex2f(drone.pos.x, drone.pos.y - 0.06f);  
    glVertex2f(drone.pos.x - 0.06f, drone.pos.y - 0.02f);   
    glEnd();


    //Perna 1 - cima
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.03756f, drone.pos.y - 0.01497f); //J
    glVertex2f(drone.pos.x - 0.02499f, drone.pos.y - 0.02335f); //I
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.03764f); //H  
    glEnd();
    //Contorno da perna 1 - cima
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.03756f, drone.pos.y - 0.01497f); //J
    glVertex2f(drone.pos.x - 0.02499f, drone.pos.y - 0.02335f); //I
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.03764f); //H    
    glEnd();

    //Perna 1 - lateral
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.02499f, drone.pos.y - 0.02335f); //I
    glVertex2f(drone.pos.x - 0.02489f, drone.pos.y - 0.04341f);//L
    glVertex2f(drone.pos.x - 0.05734f, drone.pos.y - 0.06230f); //N
    glEnd();
    //Contorno da perna 1 - lateral
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.02499f, drone.pos.y - 0.02335f); //I
    glVertex2f(drone.pos.x - 0.02489f, drone.pos.y - 0.04341f);//L
    glVertex2f(drone.pos.x - 0.05734f, drone.pos.y - 0.06230f); //N 
    glEnd();

    //Perna 1 - frente
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.03764f); //H  
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.05734f, drone.pos.y - 0.06230f); //N
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.05397f); //M
    glEnd();
    //Contorno da perna 1 - frente
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.03764f); //H  
    glVertex2f(drone.pos.x - 0.05718f, drone.pos.y - 0.04495f); //O
    glVertex2f(drone.pos.x - 0.05734f, drone.pos.y - 0.06230f); //N
    glVertex2f(drone.pos.x - 0.06993f, drone.pos.y - 0.05397f); //M
    glEnd();


    //Perna 2 - cima
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.02499f, drone.pos.y - 0.02334f); //P  
    glVertex2f(drone.pos.x + 0.03527f, drone.pos.y - 0.01649f); //Q
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.03819f); //W
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glEnd();
    //Contorno da perna 2 - cima
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.02499f, drone.pos.y - 0.02334f); //P  
    glVertex2f(drone.pos.x + 0.03527f, drone.pos.y - 0.01649f); //Q
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.03819f); //W
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glEnd();
    //Perna 2 - lateral
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.02499f, drone.pos.y - 0.02334f); //P
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.06526f); //T
    glVertex2f(drone.pos.x + 0.02524f, drone.pos.y - 0.04317f); //R
    glEnd();
    //Contorno da perna 2 - lateral
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.02499f, drone.pos.y - 0.02334f); //P
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.06526f); //T
    glVertex2f(drone.pos.x + 0.02524f, drone.pos.y - 0.04317f); //R
    glEnd();
    //Perna 2 - frente
    glColor4f(drone.secundaryColor.red, drone.secundaryColor.green, drone.secundaryColor.blue, drone.secundaryColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.03819f); //W
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.05678f); //U
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.06526f); //T
    glEnd();
    //Contorno da perna 2 - frente
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.04642f); //V
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.03819f); //W
    glVertex2f(drone.pos.x + 0.07092f, drone.pos.y - 0.05678f); //U
    glVertex2f(drone.pos.x + 0.06075f, drone.pos.y - 0.06526f); //T
    glEnd();


    //Helice 1
    glColor4f(drone.rotorColor.red, drone.rotorColor.green, drone.rotorColor.blue, drone.rotorColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.08857f, drone.pos.y - 0.02648f); //L1
    glVertex2f(drone.pos.x - 0.08000f, drone.pos.y - 0.02000f); //N1
    glVertex2f(drone.pos.x - 0.02384f, drone.pos.y - 0.05407f); //O1
    glVertex2f(drone.pos.x - 0.03180f, drone.pos.y - 0.05973); //M1
    glEnd();
    //Contorno da Helice 1
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.08857f, drone.pos.y - 0.02648f); //L1
    glVertex2f(drone.pos.x - 0.08000f, drone.pos.y - 0.02000f); //N1
    glVertex2f(drone.pos.x - 0.02384f, drone.pos.y - 0.05407f); //O1
    glVertex2f(drone.pos.x - 0.03180f, drone.pos.y - 0.05973); //M1
    glEnd();

    //Helice 2
    glColor4f(drone.rotorColor.red, drone.rotorColor.green, drone.rotorColor.blue, drone.rotorColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.02800f, drone.pos.y - 0.06041f); //S1
    glVertex2f(drone.pos.x + 0.08351f, drone.pos.y - 0.01420f); //R1
    glVertex2f(drone.pos.x + 0.09158f, drone.pos.y - 0.02007f); //P1
    glVertex2f(drone.pos.x + 0.03778f, drone.pos.y - 0.06726f); //Q1
    glEnd();
    //Contorno da Helice 2
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.02800f, drone.pos.y - 0.06041f); //S1
    glVertex2f(drone.pos.x + 0.08351f, drone.pos.y - 0.01420f); //R1
    glVertex2f(drone.pos.x + 0.09158f, drone.pos.y - 0.02007f); //P1
    glVertex2f(drone.pos.x + 0.03778f, drone.pos.y - 0.06726f); //Q1
    glEnd();

    //Helice 3
    glColor4f(drone.rotorColor.red, drone.rotorColor.green, drone.rotorColor.blue, drone.rotorColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x + 0.02540f, drone.pos.y + 0.05182f); //B2
    glVertex2f(drone.pos.x + 0.03364f, drone.pos.y + 0.05741f); //Z1
    glVertex2f(drone.pos.x + 0.08286f, drone.pos.y + 0.02209f); //A2
    glVertex2f(drone.pos.x + 0.07387f, drone.pos.y + 0.01524f); //C2
    glEnd();
    //Contorno da Helice 3
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x + 0.02540f, drone.pos.y + 0.05182f); //B2
    glVertex2f(drone.pos.x + 0.03364f, drone.pos.y + 0.05741f); //Z1
    glVertex2f(drone.pos.x + 0.08286f, drone.pos.y + 0.02209f); //A2
    glVertex2f(drone.pos.x + 0.07387f, drone.pos.y + 0.01524f); //C2
    glEnd();

    //Helice 4
    glColor4f(drone.rotorColor.red, drone.rotorColor.green, drone.rotorColor.blue, drone.rotorColor.alpha);
    glBegin(GL_QUADS);
    glVertex2f(drone.pos.x - 0.08000f, drone.pos.y + 0.02000f); //T1
    glVertex2f(drone.pos.x - 0.02668f, drone.pos.y + 0.05609f); //U1
    glVertex2f(drone.pos.x - 0.01756f, drone.pos.y + 0.04945f); //W1
    glVertex2f(drone.pos.x - 0.06921f, drone.pos.y + 0.01451f); //V1
    glEnd();
    //Contorno da Helice 4
    glColor3f(0.0f, 0.0f, 0.0f);  // Preto para o contorno
    glLineWidth(2.0f);  // Espessura do contorno
    glBegin(GL_LINE_LOOP);
    glVertex2f(drone.pos.x - 0.08000f, drone.pos.y + 0.02000f); //T1
    glVertex2f(drone.pos.x - 0.02668f, drone.pos.y + 0.05609f); //U1
    glVertex2f(drone.pos.x - 0.01756f, drone.pos.y + 0.04945f); //W1
    glVertex2f(drone.pos.x - 0.06921f, drone.pos.y + 0.01451f); //V1
    glEnd();
}


// Função de renderização
void display() {
    glClear(GL_COLOR_BUFFER_BIT);

    // Definir os elementos do cenário
    Sun sun = {{0.7f, 0.7f}, 0.15f, {1.0f, 1.0f, 0.0f, 1.0f}};  // Sol
    Cloud cloud1 = {{0.6f, 0.0f}, {1.0f, 1.0f, 1.0f, 0.95f}};  // Nuvem 1
    Cloud cloud2 = {{0.2f, 0.2f}, {1.0f, 1.0f, 1.0f, 0.95f}};  // Nuvem 2
    Cloud cloud3 = {{-0.3f, 0.1f}, {1.0f, 1.0f, 1.0f, 0.95f}};  // Nuvem 3
    Cactus cactus1 = {{-0.60f, -0.8f}, {0.0f, 0.5f, 0.0f, 1.0f}, {0.0f, 0.8f, 0.0f, 1.0f}};  // Cacto 1
    Cactus cactus2 = {{0.7f, -0.9f}, {0.0f, 0.5f, 0.0f, 1.0f}, {0.0f, 0.8f, 0.0f, 1.0f}};  // Cacto 2
    Cactus cactus3 = {{-0.9f, -0.8f}, {0.0f, 0.5f, 0.0f, 1.0f}, {0.0f, 0.8f, 0.0f, 1.0f}};  // Cacto 3
    Cactus cactus4 = {{0.9f, -0.8f}, {0.0f, 0.5f, 0.0f, 1.0f}, {0.0f, 0.8f, 0.0f, 1.0f}};  // Cacto 4
    Cactus cactus5 = {{-0.75f, -0.9f}, {0.0f, 0.5f, 0.0f, 1.0f}, {0.0f, 0.8f, 0.0f, 1.0f}};  // Cacto 5
    Pyramid pyramid = {{0.0f, -0.8f}, {0.8f, 0.5f, 0.3f, 1.0f}, {0.9f, 0.7f, 0.4f, 1.0f}};  // Pirâmide4
    Drone drone1 =  {{0.3f, 0.3f}, {0.0706f, 0.3961f, 0.8706f, 1.0f}, {0.0706f, 0.6471f, 0.8706f, 1.0f}, {0.1804f, 0.1804f, 0.1804f, 1.0f}}; //Drone
    //rgb(63, 163, 252)
    // Habilitar blending
    glEnable(GL_BLEND);
    glBlendFunc(GL_SRC_ALPHA, GL_ONE_MINUS_SRC_ALPHA);  // Configuração da função de mistura

    // Desenhar o cenário
    drawSky();          // Céu
    drawSun(sun);       // Sol
    drawCloud(cloud1);  // Nuvem 1
    drawCloud(cloud2);  // Nuvem 2
    drawCloud(cloud3);  // Nuvem 3
    drawDesertFloor();  // Solo
    drawPyramid(pyramid);  // Pirâmide
    drawCactus(cactus1);  // Cacto 1
    drawCactus(cactus2);  // Cacto 2
    drawCactus(cactus3);  // Cacto 3
    drawCactus(cactus4);  // Cacto 4
    drawCactus(cactus5);  // Cacto 5
    drawDrone(drone1);


    glFlush();
}

// Função principal
int main(int argc, char** argv) {
    glutInit(&argc, argv);
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB | GLUT_ALPHA);  // Adicionando GLUT_ALPHA
    glutInitWindowSize(1200, 1000);
    glutCreateWindow("Deserto");
    gluOrtho2D(-1.0, 1.0, -1.0, 1.0);
    glutDisplayFunc(display);
    glutMainLoop();
    return 0;
}