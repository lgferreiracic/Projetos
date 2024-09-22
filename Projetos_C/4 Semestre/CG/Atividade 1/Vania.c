#include <stdio.h>
#include <stdlib.h>

FILE *fpin, *fpoutR, *fpoutG, *fpoutB;
int **imagemR, **imagemG, **imagemB, ncol, nlin, quantizacao;

void abrir_arquivos(int argc, char *argv[]);
void ler_cabecalho(void);
void ler_imagem(void);
void gravar_cabecalho(void);
void gravar_imagemR(void);
void gravar_imagemG(void);
void gravar_imagemB(void);
void fechar_arquivos(void);

void abrir_arquivos(int argc, char *argv[]) {
     if (argc  <=1) {
	    printf("Modo correto de uso: <prog> <imagemIn> <imagemOut>\n");
	    exit(0);
     }
     if ((fpin=fopen(argv[1],"r"))==NULL) {
	    printf("Nao foi possivel abrir arquivo de imagem %s\n", argv[1]);
	    exit(1);
     }
    if ((fpoutR=fopen("ImagemR.ppm","w"))==NULL) {
        printf("Nao foi possivel abrir arquivo de saida R\n" );
        exit(1);
     }
     if ((fpoutG=fopen("ImagemG.ppm","w"))==NULL) {
        printf("Nao foi possivel abrir arquivo de saida G\n");
        exit(1);
     }
     if ((fpoutB=fopen("ImagemB.ppm","w"))==NULL) {
        printf("Nao foi possivel abrir arquivo de saida B\n");
        exit(1);
     }

} // Fim: abrir_arquivos

void ler_imagem(void) {
  int cont, col, lin;
  imagemR= (int **)malloc((nlin+1)*sizeof(int *));
  imagemG= (int **)malloc((nlin+1)*sizeof(int *));
  imagemB= (int **)malloc((nlin+1)*sizeof(int *));
  for (cont=0;cont<nlin;cont++) {
    imagemR[cont]=(int *)malloc(ncol*sizeof(int));
    if (imagemR[cont]==NULL) { /* Alocar memoria para a matriz de pixels */
      printf("Falha na alocacao de memoria - 1\n");
      exit(1);
    }
    imagemG[cont]=(int *)malloc(ncol*sizeof(int));
    if (imagemG[cont]==NULL) { /* Alocar memoria para a matriz de pixels */
      printf("Falha na alocacao de memoria - 1\n");
      exit(1);
    }
    imagemB[cont]=(int *)malloc(ncol*sizeof(int));
    if (imagemR[cont]==NULL) { /* Alocar memoria para a matriz de pixels */
      printf("Falha na alocacao de memoria - 1\n");
      exit(1);
    }
  }
  for (lin=0;lin<nlin;lin++) {
    for (col=0;col<ncol;col++) {
      fscanf(fpin,"%d ",&imagemR[lin][col]);
      fscanf(fpin,"%d ",&imagemG[lin][col]);
      fscanf(fpin,"%d ",&imagemB[lin][col]);
    }
  }
} // Fim: ler_imagem

void ler_cabecalho(void) {
     char controle[4];
     fscanf(fpin,"%s\n",controle);
     fscanf(fpin,"%d %d\n",&ncol,&nlin);
     fscanf(fpin,"%d\n",&quantizacao);
} // Fim: ler_cabecalho

void fechar_arquivos(void) {
  fclose(fpin);
  fclose(fpoutR);
  fclose(fpoutG);
  fclose(fpoutB);
} // Fim: fechar_arquivos

void gravar_imagemR(void) {
  int lin, col;
  fprintf(fpoutR,"P3\n");
  fprintf(fpoutR,"%d %d\n",ncol,nlin);
  fprintf(fpoutR,"%d\n",quantizacao);
  for (lin=0;lin<nlin;lin++) {
    for (col=0;col<ncol;col++) {
      fprintf(fpoutR,"%d ",imagemR[lin][col]);
      fprintf(fpoutR,"0 ");
      fprintf(fpoutR,"0 ");
    }
    fprintf(fpoutR,"\n");
  }
} //gravar_imagemR

void gravar_imagemG(void) {
  int lin, col;
  fprintf(fpoutG,"P3\n");
  fprintf(fpoutG,"%d %d\n",ncol,nlin);
  fprintf(fpoutG,"%d\n",quantizacao);
  for (lin=0;lin<nlin;lin++) {
    for (col=0;col<ncol;col++) {
      fprintf(fpoutG,"0 ");
      fprintf(fpoutG,"%d ",imagemG[lin][col]);
      fprintf(fpoutG,"0 ");
    }
    fprintf(fpoutG,"\n");
  }
} //gravar_imagemG

void gravar_imagemB(void) {
  int lin, col;
  fprintf(fpoutB,"P3\n");
  fprintf(fpoutB,"%d %d\n",ncol,nlin);
  fprintf(fpoutB,"%d\n",quantizacao);
  for (lin=0;lin<nlin;lin++) {
    for (col=0;col<ncol;col++) {
      fprintf(fpoutB,"0 ");
      fprintf(fpoutB,"0 ");
      fprintf(fpoutB,"%d ",imagemB[lin][col]);
    }
    fprintf(fpoutB,"\n");
  }
}

int main(int argc, char *argv[]) {
  abrir_arquivos(argc,argv);
  ler_cabecalho();
  ler_imagem();
  gravar_imagemR();
  gravar_imagemG();
  gravar_imagemB();
  fechar_arquivos();
  return 0;
}