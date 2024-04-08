/*Elabore um método para manter duas pilhas dentro de um único vetor linear de tamanho limitado
(STACKSIZE), de modo que nenhuma das pilhas alerte estouro até toda a memória seja usada; e
uma pilha inteira nunca seja deslocada para outro lugar dentro do vetor. Escreva rotinas push1,
pop1, push2 e pop2 para manipular as duas pilhas.*/

#include<stdio.h>
#include<stdlib.h>
#define STACKSIZE 10

struct stack {
	int top1;
    int top2;
	int items[STACKSIZE];
};

int empty1 (struct stack *ps);
int pop1 (struct stack *ps);
void push1 (struct stack *ps, int x);
int pop2 (struct stack *ps);
void push2 (struct stack *ps, int x);

int main(void){
    struct  stack pilha={};
    pilha.top1=-1;
    pilha.top2=STACKSIZE;

    for(int i=0; i<STACKSIZE/2; i++){
        push1(&pilha, i);
        push2(&pilha, i);
    }
    for(int i=0; i<STACKSIZE/2; i++){
        pop1(&pilha);
        pop2(&pilha);
    }

    
    return 0;
}

int empty1 (struct stack *ps){
	if (ps->top1==-1)
		return 1;
	return 0;	
}

int pop1 (struct stack *ps){
	int aux;
	if (empty1(ps)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}
	
	aux=ps->items[ps->top1];
	ps->top1--;
	return aux;
}

void push1 (struct stack *ps, int x){
	if (ps->top1==ps->top2){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}
	ps->top1++;
	ps->items[ps->top1]=x;
}

int empty2 (struct stack *ps){
	if (ps->top2==STACKSIZE)
		return 1;
	return 0;	
}


int pop2 (struct stack *ps){
	int aux;
	if (empty2(ps)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}
	
	aux=ps->items[ps->top2];
	ps->top2++;
	return aux;
}

void push2 (struct stack *ps, int x){
	if (ps->top1==ps->top2){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps->top2--;
	ps->items[ps->top2]=x;
}
