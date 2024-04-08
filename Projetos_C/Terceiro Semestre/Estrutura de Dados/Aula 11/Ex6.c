#include<stdio.h>
#include<stdlib.h>

#define QUEUESIZE 10

struct queue {
	int front, rear;
	char items[QUEUESIZE];
};

int empty (struct queue *pq);
char removeq (struct queue *pq);
void insert (struct queue *pq, char x);
void print (struct queue *ps);
void posicaoZero(struct queue *pq);

 

int main (){
    struct queue caracteres[QUEUESIZE];
    caracteres->front=0;
    caracteres->rear=-1;
    for(int i=0; i<QUEUESIZE; i++)
        insert(caracteres, 'a'+i);

    for(int i=0; i<5; i++)
        removeq(caracteres);
    
    insert(caracteres, 'z');
    print(caracteres);
	
	return 0;
}

void print (struct queue *ps){
	for (int i = ps->front; i<=ps->rear; i++)
		printf("%c\n", ps->items[i]);
}


int empty (struct queue *pq){
	if (pq->rear < pq->front)
		return 1;
	return 0;	
}

char removeq (struct queue *pq){
	char x;

	if (empty(pq)){
		printf("ERRO- FILA VAZIA");
		exit(1);
	}

	x=pq->items[pq->front];
	pq->front++;

	return x;
}

void insert(struct queue *pq, char x) {
    if (pq->rear == QUEUESIZE - 1) {
        if (pq->front == 0) {
            printf("ERRO- FILA CHEIA");
            exit(1);
        } else {
            posicaoZero(pq);
        }
    }
    pq->rear++;
    pq->items[pq->rear] = x;
}

void posicaoZero(struct queue *pq) {
    for (int i = pq->front; i <= pq->rear; i++) {
        pq->items[i - pq->front] = pq->items[i];
    }
    pq->rear = pq->rear - pq->front;
    pq->front = 0;
}