#include <stdio.h>
#include <stdlib.h>


struct elemento{
	int valor;
	struct elemento *prox;
};

typedef struct elemento No;
typedef struct elemento * Pno;


/* Percorre e imprimir lista. Recebe o início da lista*/
void mostrarLista(Pno inicio){
	Pno atual;
	atual = inicio;
	while (atual != NULL) {
		printf("%d ", atual->valor);
		atual = atual->prox;
	}
    printf("\n");
}

//recebe dados(valor) e retorna um elemento com este dado
Pno criaElemento (int valor){
	Pno novo;
	novo = (Pno) malloc (sizeof(No));

	novo->valor=valor;
	novo->prox=NULL;

	return novo;
}

/* verifica se é vazia. Se sim, retorna 1; se não, retorna 0. */
int vazia (Pno inicio){
	if (inicio==NULL)
		return 1;
	else
		return 0;
}

//Insere um elemento no inicio da lista
void insereInicio (Pno *inicio, Pno *novo){
	if (vazia(*inicio))
		*inicio = *novo;
	else {
		(*novo)->prox=*inicio;
		*inicio=*novo;
	}
}

//Insere um elemento no final da lista
void insereFim (Pno *inicio, Pno *novo){
	Pno ultimo;

	if (vazia(*inicio))
		*inicio = *novo;
	else {
		//percorre ate encontrar ultimo
		ultimo = *inicio;
		while (ultimo->prox != NULL) 
			ultimo = ultimo->prox;

		ultimo->prox=*novo;
	}
}

int main (void){
    int quantNum, num;
    char posicao;
 
    do{
        scanf("%d", &quantNum);
        if(quantNum==0)
            break;
        Pno inicio=NULL;
        for(int i=0; i<quantNum; i++){
            scanf(" %c %d", &posicao, &num);
            Pno novo=criaElemento(num);
            switch (posicao)
            {
            case 'P':
                insereInicio(&inicio, &novo);
                break;
            case 'U':
                insereFim(&inicio, &novo);
                break;
            }
        }
        mostrarLista(inicio);
        Pno atual = inicio;
        while (atual != NULL) {
            Pno proximo = atual->prox;
            free(atual);
            atual = proximo;
        }
    }while(1);
    return 0;
}