#include<stdio.h>
#include<stdlib.h>

#define STACKSIZE 100

struct stack {
	int top;
	int items[STACKSIZE];
};

//verifica se pilha está vazia
int empty (struct stack *ps);
//remove e retorna item do topo da pilha
int pop (struct stack *ps);
//insere intem x no topo da pilha
void push (struct stack *ps, int x);

 

int main (){
	struct stack ps;
	int ret;
	
	//inicializando a pilha
	ps.top=-1;

	//empilhar
	push(&ps,10);
	ret=pop(&ps);
	printf("Desempilhei o item %d", ret);
	ret=pop(&ps);

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

void push (struct stack *ps, int x){
	if (ps->top==STACKSIZE-1){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps->top++;
	ps->items[ps->top]=x;
}
