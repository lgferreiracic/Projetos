#include <stdio.h>
#define STACKSIZE 50

struct stack {
	int top;
	int items[STACKSIZE];
};

int empty (struct stack *ps);
int pop (struct stack *ps);
void push (struct stack *ps, int x);
void insereInicio(struct stack *ps, int x);
void zeraPilha(struct stack *ps);

int main (void){
    int quantCards;
    struct stack pilha;
    pilha.top=-1;
    do{
    scanf("%d", &quantCards);
    if(quantCards==0)
        break;
    for(int i=quantCards; i>0; i--)
        push(&pilha, i);
    printf("Discarded cards:");
    while (pilha.top > 0) { 
        printf(" %d", pop(&pilha)); 
        if (pilha.top > 0) {
            insereInicio(&pilha, pop(&pilha));
            if (pilha.top >= 0) printf(","); 
        }
    }
    printf("\nRemaining card: %d\n", pilha.items[0]);
    zeraPilha(&pilha);
    }while (1);
    
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

void insereInicio(struct stack *ps, int x){
    for(int i=ps->top; i>=0; i--)
        ps->items[i+1]=ps->items[i];
    ps->items[0]=x;
    ps->top++;
}

void zeraPilha(struct stack *ps){
    for(int i=0; i<STACKSIZE; i++)
        ps->items[i]=0;
    ps->top=-1;
}
