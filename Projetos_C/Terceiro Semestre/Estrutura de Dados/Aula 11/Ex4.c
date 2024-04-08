/*Usando pilha ou fila, determine se uma string de caracteres tem a seguinte forma:
xCx onde x é uma string composta por As e Bs.
Um exemplo de xCx é ABBBCABBB.
Em cada ponto você só poderá ler o próximo carater da string, para decidir se está ou não no padrão
esperado.*/

#include<stdio.h>
#include<stdlib.h>
#include<string.h>

#define STACKSIZE 100

struct stack {
	int top;
	char items[STACKSIZE];
};

int empty (struct stack *ps);
int pop (struct stack *ps);
void push (struct stack *ps, char x);

int main (void){
    char string[STACKSIZE];
    struct stack primeiraMetade;
    primeiraMetade.top=-1;
    int padrao=1;
    scanf("%s", string);
    int tamString=strlen(string);
    for(int i = tamString; i>=0; i--)
        push(&primeiraMetade, string[i]);
    for(int i=tamString/2+1; i<tamString; i++){
        if(string[i]!=pop(&primeiraMetade)){
            padrao=0;
            break;
        }
        else
            padrao=1;
    }

    if(padrao)
        printf("Esta no padrao");
    else
        printf("Esta fora do padrao");
    return 0;
}

int empty (struct stack *ps){
	if (ps->top==-1)
		return 1;
	return 0;	
}

int pop (struct stack *ps){
	int aux;
	if (empty(ps)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}
	
	aux=ps->items[ps->top];
	ps->top--;
	return aux;
}

void push (struct stack *ps, char x){
	if (ps->top==STACKSIZE-1){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps->top++;
	ps->items[ps->top]=x;
}