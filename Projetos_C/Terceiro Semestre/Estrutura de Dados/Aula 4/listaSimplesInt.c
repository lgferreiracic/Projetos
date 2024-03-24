/* Implementação base de uma lista simplesmente encadeada
com números inteiros. Usem essa implementação para possíveis adaptações*/

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

/*Percebam que aqui, nós iremos/podemos mudar os conteúdos dos ponteiros inicio e novo.
 Por isso precisamos passa-los como ponteiros. 
 Portanto temos ponteiros de ponteiro: struct elemento ** inicio ou Pno *inicio */
void insereInicio (Pno *inicio, Pno *novo){
	if (vazia(*inicio))
		*inicio = *novo;
	else {
		(*novo)->prox=*inicio;
		*inicio=*novo;
	}
}

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

void insereOrdenado(Pno *inicio, Pno *novo){
	Pno anterior;

	if (vazia(*inicio))
		*inicio = *novo;
	else {
		//anterior será último elemento menor que novo.
		anterior = *inicio;
		//se prox do anterior ainda é menor que novo, então anterior será o prox;
		while ((anterior-> prox != NULL) && 
								(anterior->prox->valor < (*novo)->valor)) //para strings usar função strcmp
			anterior = anterior->prox;

		(*novo)->prox = anterior->prox;
		anterior->prox = *novo;
	}
}


void removeInicio(Pno *inicio){
	if (!vazia(*inicio)){
		Pno alvo = *inicio;
		*inicio = alvo->prox;
		free(alvo);
	}
}

void removeFim(struct elemento **inicio){
	Pno alvo = *inicio;
	Pno anterior = *inicio;
	
	if (!vazia(*inicio)){
		while (alvo->prox != NULL){
			anterior = alvo;		
			alvo = alvo->prox;
		}
		if (alvo==*inicio)
		    *inicio=NULL;
		anterior->prox=NULL;
		free(alvo);
	}
}

//Precisamos encotrar o anterior ao alvo
void removeAlvo (Pno *inicio, Pno *alvo){
	Pno anterior = *inicio;
	
	if (!vazia(*inicio)){
		if (*inicio==*alvo){ // se alvo é elemento do início
			*inicio=(*inicio)->prox;
			free(*alvo);
		}
		else {	
			while (anterior->prox != *alvo)
				anterior = anterior->prox;		
			
			anterior->prox=(*alvo)->prox;	
			free(*alvo);
		}
	}
	
}

// busca (retorna o endereço) o elemento que tem valor x
Pno busca(Pno *inicio, int x){
	Pno alvo = *inicio;
	
	while (alvo != NULL){
		if (alvo->valor==x)
			return alvo;
		alvo = alvo->prox;
	}
	return alvo;
	
}


Pno concatenar (Pno *inicio1, Pno *inicio2){
	Pno ultimo = *inicio1;
	
	while (ultimo->prox!=NULL){
		ultimo=ultimo->prox;
	}
	ultimo->prox=*inicio2;
	
	return *inicio1;

}


int main (){
	Pno inicio=NULL;
	Pno inicio1=NULL;
	Pno inicio2=NULL;
	Pno novo, alvo;


	//TRECHO PARA TESTAR CONCATENAÇÃO DE 2 LISTAS	
	novo=criaElemento(0);
	insereInicio(&inicio1, &novo);
	novo=criaElemento(1);
	insereInicio(&inicio1, &novo);
	novo=criaElemento(2);
	insereInicio(&inicio1, &novo);
	mostrarLista(inicio1);
	printf("\n");

	novo=criaElemento(2);
	insereInicio(&inicio2, &novo);
	novo=criaElemento(3);
	insereInicio(&inicio2, &novo);
	novo=criaElemento(4);
	insereInicio(&inicio2, &novo);
	mostrarLista(inicio2);
	
	printf("CONCATENAR\n");
	concatenar(&inicio1, &inicio2);
	mostrarLista(inicio1);

	// TRECHO TESTES ALEATÓRIOS	
	novo=criaElemento(0);
	insereInicio(&inicio, &novo);

	novo=criaElemento(2);
	insereFim(&inicio, &novo);

	novo=criaElemento(1);
	insereOrdenado(&inicio, &novo);

	novo=criaElemento(1);
	insereOrdenado(&inicio, &novo);

	novo=criaElemento(1);
	insereOrdenado(&inicio, &novo);
	
	mostrarLista(inicio);	

	removeInicio(&inicio);

	printf("\n");
	mostrarLista(inicio);

	alvo=busca(&inicio,1);
	removeAlvo(&inicio,&alvo);
	
	printf("\n");
	mostrarLista(inicio);

	return 0;
}