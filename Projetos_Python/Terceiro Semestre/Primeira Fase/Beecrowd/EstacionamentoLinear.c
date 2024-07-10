#include <stdio.h>
#include <stdlib.h>

#define STACKSIZE 1000

struct stack {
	int top;
	int items[STACKSIZE];
};

//verifica se pilha está vazia
int empty (struct stack *ps);
//remove e retorna item do topo da pilha
int pop (struct stack *ps);
//insere intem x no topo da pilha
void push (struct stack *ps, int x, int K);

 

int main (){
	int N, K;
    struct stack estacionamento;
    estacionamento.top=-1;
    int ok;
    while (1){
        ok=1;
        scanf("%d %d",&N, &K);
        if(N==0&&K==0)
            break;
        int i=0;
        while(i<N){
            
            int entrada;
            int saida;
            scanf("%d %d", &entrada, &saida);
            if(empty(&estacionamento)){
                push(&estacionamento, saida, K);
            }
            else{
                if(estacionamento.top<K){
                    if(entrada>estacionamento.items[estacionamento.top])
                    {
                        while(entrada>estacionamento.items[estacionamento.top])
                            pop(&estacionamento);
                        if(estacionamento.items[estacionamento.top]>saida)    
                            push(&estacionamento, saida, K);
                        else{
                            printf("Nao\n");
                            ok=0;
                            break;
                        }
                    }        
                    else if(estacionamento.items[estacionamento.top]>saida){
                        push(&estacionamento, saida, K);
                    }
                    else{
                        printf("%d %d", estacionamento.items[estacionamento.top], saida);
                        printf("Nao\n");
                        ok=0;
                        break;
                    }                        
                }
                else{
                    printf("Nao\n");
                    ok=0;
                    break;
                }
            }
        
            i++;

        }
        if(ok)
            printf("Sim\n");
        estacionamento.top=-1;
    }


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

void push (struct stack *ps, int x, int K){
	if (ps->top== K-1){
		printf("ERRO- PILHA CHEIA");
		exit(1);		
	}

	ps->top++;
	ps->items[ps->top]=x;
}