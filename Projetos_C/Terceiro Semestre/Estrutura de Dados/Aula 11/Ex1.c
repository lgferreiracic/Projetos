/*Construa uma rotina que execute uma operação de troca em uma pilha. Esta operação deve trocar
de posição o primeiro e segundo elemento do topo da pilha. Atenção aos casos nos quais a operação
não pode ser aplicada. Utilize apenas de operações primitivas da pilha para executar tal operação.
Não manipule a pilha diretamente.*/

#include<stdio.h>
#include<stdlib.h>

#define STACKSIZE 100

struct stack {
	int top;
	int items[STACKSIZE];
};

int empty (struct stack *ps);
int pop (struct stack *ps);
void push (struct stack *ps, int x);
void trocaTopo(struct stack *ps);

int main(void){
    struct stack pilha;
    pilha.top=-1;

    for(int i=0; i<5; i++)
        push(&pilha, i);
    trocaTopo(&pilha);

    printf("Antes de trocar: \n");
    for(int i=0; i<5; i++)
        printf("%d", pilha.items[i]);

    printf("\nDepois: \n");
    for(int i=0; i<5; i++)
        printf("%d", pilha.items[i]);

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

void trocaTopo(struct stack *ps){
    int aux1, aux2;
    aux1=pop(ps);
    aux2=pop(ps);
    push(ps, aux1);
    push(ps, aux2);
}
