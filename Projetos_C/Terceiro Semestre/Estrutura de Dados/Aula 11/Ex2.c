/*Implemente uma pilha de inteiros em C, usando um vetor int s[STACKSIZE], onde s[0] é
usado para conter o índice do elemento topo da pilha, e a partir de s[1] a s[STACKSIZE-1]
contenham os elementos da pilha.
Escreva as rotinas push, pop, empty e stacktop para essa implementação.*/

#include<stdio.h>
#include<stdlib.h>
#define STACKSIZE 5

int empty (int *ps);
int pop (int *ps);
void push (int *ps, int x);
int stacktop(int *ps);

int main (void){
    int pilha[STACKSIZE]={};
    
    for(int i=1; i<5; i++){
        push(pilha, i);
        printf("%d ", pilha[i]);
    }
    printf("\n%d\n", stacktop(pilha));
    for(int i=1; i<5; i++)
        pop(pilha);
    

    return 0;
}

int empty (int *ps){
	if (ps[0]==-1)
		return 1;
	return 0;	
}

int pop (int *ps){
	int aux;
	if (empty(ps)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}
	
	aux=ps[ps[0]];
	ps[0]--;
	return aux;
}

void push (int *ps, int x){
	if (ps[0]==STACKSIZE-1){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps[0]++;
	ps[ps[0]]=x;
}

int stacktop(int *ps){
    return ps[ps[0]];
}
