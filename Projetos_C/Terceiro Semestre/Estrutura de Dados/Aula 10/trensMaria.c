#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#define TAMANHO 26

struct trem{
    int posicao;
    char vagoes[TAMANHO];
};

//--------------------------------------------------
//Verifica se A pilha está vazia
int empty (struct trem *Trem);
//Remove e retorna item do topo da pilha
char pop (struct trem *Trem);
//Insere intem x no topo da pilha
void push(struct trem *Trem, char vagao);
//--------------------------------------------------


int main(void){
    struct trem Trem, direita, esquerda;
    int qtd_vagoes;
    char aux_vagao;

  //inicializando posicao;
    Trem.posicao=-1;
    direita.posicao=-1;
    esquerda.posicao=-1;

    //Recebe a quantidade de vagoes
   scanf("%d ", &qtd_vagoes);
   char vetor_aux[qtd_vagoes];

    //Recebe os vagoes
    for(int i=0; i<qtd_vagoes; i++){
        scanf("%c%*c", &aux_vagao);
        vetor_aux[i]=aux_vagao;
    }

    //Faz a pilha com os vagoes (invertendo os vagoes)
    int tam= qtd_vagoes-1;
    for(int i=0; i<qtd_vagoes; i++){
        Trem.vagoes[i]=vetor_aux[tam];
        Trem.posicao++;
        tam--;

    }

    //Recebe as operações
   char operacoes[52];
    scanf("%[^\n]s",operacoes);

    //Detecta quantas operações foram informadas
    int tam_string= strlen(operacoes);

    //Laço de repetição para jogar nas pilhas adequadas
   for(int i=0; i<=tam_string; i=i+2){
        if(operacoes[i]=='E'){
                push(&esquerda, pop(&Trem));
        }
        else{
                push(&direita, pop(&esquerda));
        }
   }

   //Printa os vagoes da direita
   printf("\n");
   for(int i=0; i<=direita.posicao; i++){
        printf("%c ",direita.vagoes[i]);
    }

}

int empty (struct trem *Trem){
	if (Trem->posicao==-1)
		return 1;
	return 0;
}

char pop (struct trem *Trem){
	char aux;
	if (empty(Trem)){
		printf("ERRO- PILHA VAZIA");
		exit(1);
	}

	aux=Trem->vagoes[Trem->posicao];
	Trem->posicao--;
	return aux;
}

void push (struct trem *Trem, char x){
	if (Trem->posicao==TAMANHO-1){
        printf("ERRO- PILHA CHEIA");
		exit(1);
	}
	Trem->posicao++;
	Trem->vagoes[Trem->posicao]=x;

}