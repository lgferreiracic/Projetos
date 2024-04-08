#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#define TAMANHO 26

struct stack {
	int top;
	char items[26];
};

int empty (struct stack *ps);//Verifica se a pilha esta vazia
char pop (struct stack *ps);//Retira o ultimo elemento da pilha
void push (struct stack *ps, char x);//Insere um elemento no final da pilha

int main(void){

    struct stack esquerda, direita, entradaPilha;
    esquerda.top=direita.top=entradaPilha.top=-1;//Inicializacao das pilhas com -1
    int quantVagoes;
    char entrada[TAMANHO]={};
    char operacoes[TAMANHO*2]={};

    scanf("%d ", &quantVagoes);//Entrada da quantidade de vagoes

    for(int i=0; i<quantVagoes; i++)//Loop para entrada dos caracteres que nomeiam os vagoes
		scanf("%c%*c", &entrada[i]);//%*c para que o caractere ' ' nao faca parte do vetor
        
	for(int i=quantVagoes-1; i>=0; i--)//Os caracteres sao empilhados na ordem contraria ao vetor
            push(&entradaPilha, entrada[i]);

    scanf("%[^\n]s", operacoes);//Entrada da string que contem as operacoes
	int tamString=strlen(operacoes);
    for(int i=0; i<tamString; i+=2){//Loop para percorer as posicoes pares, as quais sao as posicoes relevantes, evitando os ' '
      if(operacoes[i]=='E')
        push(&esquerda, pop(&entradaPilha));    
      else if(operacoes[i]=='D')
        push(&direita, pop(&esquerda));
    }

    for (int i=0; i<=direita.top; i++)//Loop para impressao da pilha direita
      printf(" %c", direita.items[i]);
	printf("\n");

    return 0;
}

int empty (struct stack *ps){
	if (ps->top==-1)
		return 1;
	return 0;	
}

char pop (struct stack *ps){
	char aux;
	if (empty(ps)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}
	
	aux=ps->items[ps->top];
	ps->top--;
	return aux;
}

void push (struct stack *ps, char x){
	if (ps->top==TAMANHO-1){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps->top++;
	ps->items[ps->top]=x;
}
	



	