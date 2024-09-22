#include <stdio.h>
#include <stdlib.h>

//Estrutura para os Pixels
typedef struct {
    int r, g, b;
} Pixel;

//Estrutura para os campos da imagem
typedef struct{
    int altura, largura, quantizacao;
    Pixel **pixel;
} Imagem;

//Função de Verificação de Arquivo
void verificarArquivo(FILE *ponteiroArq, const char *nomeArquivo){

    if(ponteiroArq==NULL){
        printf("\n Erro ao abrir o arquivo %s\n", nomeArquivo); 
        exit(1);
    }

    //Ler cabeçalho do arquivo
    char cabecalho[3]; //ALTERADO
    fscanf(ponteiroArq, "%s", cabecalho);

    if(cabecalho[0]!='P' || cabecalho[1]!= '3'){
        printf("\n Formato invalido: %s", cabecalho);
        fclose(ponteiroArq);
       exit(1);
    }
} //Fim: verificaArquivo

//Função para alocar matriz
void alocarMatriz(Imagem *auxImagem){
        auxImagem->pixel= (Pixel**) malloc (auxImagem->altura*sizeof(Pixel*));
        if (auxImagem->pixel == NULL) {
            printf("Erro ao alocar memória para os pixels.");
            exit(1);
        }

        for (int cont=0; cont<auxImagem->altura; cont++) {
            auxImagem->pixel[cont] = (Pixel*) malloc(auxImagem->largura * sizeof(Pixel));
            if (auxImagem->pixel[cont] == NULL) {
                printf("Erro ao alocar memória para os pixels");
                exit(1);
            }
        }
} // Fim: alocarMatriz

//Função para ler pixels rgb
void lerPixels(Imagem *auxImagem, FILE *ponteiroArq){
       for(int linha=0; linha<auxImagem->altura; linha++){
        for(int coluna=0; coluna< auxImagem->largura; coluna++ ){
            fscanf(ponteiroArq, "%d\n", &auxImagem->pixel[linha][coluna].r);
            fscanf(ponteiroArq, "%d\n", &auxImagem->pixel[linha][coluna].g);
            fscanf(ponteiroArq, "%d\n", &auxImagem->pixel[linha][coluna].b);
        }
    }
}//Fim: função lerPixels

//Função para fazer a leitura do arquivo
Imagem *lerArquivo(const char *nomeArquivo){

    FILE *ponteiroArq = fopen(nomeArquivo, "r");
    verificarArquivo(ponteiroArq, nomeArquivo);

    /*Cria e aloca matriz para a imagem*/
    Imagem* ImagemEntrada= (Imagem *)malloc(sizeof(Imagem));
    if (ImagemEntrada == NULL) {
            printf("Erro ao alocar memória para a imagem %s", nomeArquivo);
            exit(1);
        }
    fscanf(ponteiroArq, "%d %d\n%d\n", &ImagemEntrada->largura, &ImagemEntrada->altura, &ImagemEntrada->quantizacao); //ALTERADO
    alocarMatriz(ImagemEntrada);

    lerPixels(ImagemEntrada, ponteiroArq);
    fclose(ponteiroArq);
    return ImagemEntrada;
}//Fim:  função lerArquivo

//Função para gravar informações no arquivo
void gravarArquivo(const char *nomeArquivo, Imagem *auxImagem){
    FILE *ponteiroArq= fopen(nomeArquivo, "w");

    if(ponteiroArq==NULL){
        printf("\n Erro ao abrir o arquivo");
        exit(1);
    }

    fprintf(ponteiroArq, "P3\n%d %d\n%d\n", auxImagem->largura, auxImagem->altura, auxImagem->quantizacao);

    for(int linha=0; linha<auxImagem->altura; linha++){
            for(int coluna=0; coluna<auxImagem->largura; coluna++){
                fprintf(ponteiroArq,"%d\n", auxImagem->pixel[linha][coluna].r);
                fprintf(ponteiroArq,"%d\n", auxImagem->pixel[linha][coluna].g);
                fprintf(ponteiroArq,"%d\n", auxImagem->pixel[linha][coluna].b);
            }
    }
    fclose(ponteiroArq);
}//Fim: Função gravarArquivo

//Função para liberar memória
void liberarMemoria(Imagem *auxImagem){
    for(int linha=0; linha<auxImagem->altura; linha++)
        free(auxImagem->pixel[linha]);

    free(auxImagem->pixel);
    free(auxImagem);
}// Fim: liberarMemoria


//Função de Interpolação//Morphing
void morphing(Imagem *Imagem1, Imagem *Imagem2){
    Imagem *auxImagem= (Imagem*)malloc(sizeof(Imagem));
    if (auxImagem == NULL) {
            printf("Erro ao alocar memória para a imagem intermediaria");
            exit(1);
        }
    auxImagem->altura = Imagem1->altura;
    auxImagem->largura = Imagem1->largura;
    auxImagem->quantizacao = Imagem1->quantizacao; //ALTERADO
    alocarMatriz(auxImagem);

    for (int cont = 0; cont <=100; cont += 5){
          char nomeArquivo[50];
          sprintf( nomeArquivo, "frame_%d.ppm", cont);
          float t = (cont/100.0); //Valor de interpolação
           for ( int linha = 0; linha <auxImagem->altura; linha++){
                for (int  coluna = 0; coluna <auxImagem->largura ; coluna++){
                    auxImagem->pixel[linha][coluna].r = Imagem1->pixel[linha][coluna].r * (float)(1 - t) + Imagem2->pixel[linha][coluna].r* t;
                    auxImagem->pixel[linha][coluna].g = Imagem1->pixel[linha][coluna].g * (float)(1 - t) + Imagem2->pixel[linha][coluna].g* t;
                    auxImagem->pixel[linha][coluna].b= Imagem1->pixel[linha][coluna].b * (float)(1 - t) + Imagem2->pixel[linha][coluna].b* t;
                   }
            }
        gravarArquivo(nomeArquivo, auxImagem);
    }
    liberarMemoria(auxImagem);
}//Fim: Função morphing

//Função para verificar a compatibilidade das imagens
void verificarCompatibilidade(Imagem *Imagem1,  Imagem*Imagem2  ){
    if(Imagem1->quantizacao != Imagem2->quantizacao){
        printf("\n As quantizacoes das imagens sao diferentes");
        exit(1);
    }
    if( (Imagem1->altura!= Imagem2->altura) || (Imagem1->largura != Imagem2->largura) ){
        printf("\n As dimensoes das imagens sao diferentes ");
        exit(1);
    }
}//Fim: Função verificarCompatibilidade


int main(int argc, char *argv[]){

     //Verifica a quantidade de argumentos recebidos
    if(argc<=2){
        printf("\n Modo correto de uso: <prog> <imagemIn>  <imagemIn>");
        exit(1);
    }

    //Leitura das imagens
    Imagem *Imagem1=lerArquivo(argv[1]);
    Imagem *Imagem2=lerArquivo(argv[2]);

    verificarCompatibilidade(Imagem1, Imagem2);
    morphing(Imagem1,Imagem2);
    liberarMemoria(Imagem1);
    liberarMemoria(Imagem2);

    return 0;
}
