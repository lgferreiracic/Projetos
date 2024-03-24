class Atleta: # Classe para representar um atleta e comparar suas medalhas

    def __init__(self, nome, id, n_ouro, n_prata, n_bronze):
        self.nome=nome
        self.id=id
        self.n_ouro=n_ouro
        self.n_prata=n_prata
        self.n_bronze=n_bronze
    
def comparar(atleta_1: Atleta, atleta_2: Atleta):
    if(atleta_1.n_ouro>atleta_2.n_ouro):
        return print(atleta_1.id)
    elif(atleta_2.n_ouro>atleta_1.n_ouro):
        return print(atleta_2.id)
    else:
        if(atleta_1.n_prata>atleta_2.n_prata):
            return print(atleta_1.id)
        elif(atleta_2.n_prata>atleta_1.n_prata):
            return print(atleta_2.id)
        else:
            if(atleta_1.n_bronze>atleta_2.n_bronze):
                return print(atleta_1.id)
            elif(atleta_2.n_bronze>atleta_1.n_bronze):
                return print(atleta_2.id)
            else:
                return print("empate")
            
    

atletas=[]
num_atletas=int(input()) 
for j in range(0, num_atletas, 1):
    nome_id=input() # Entrada do id e nome
    nome_id=nome_id.split()
    id=int(nome_id[0])
    nome=nome_id[1]

    medalha_ouro, medalha_prata, medalha_bronze=map(int, input().split()) #Entrada do numero de medalhas (ouro, prata, bronze)

    atletas.append(Atleta(nome, id, medalha_ouro, medalha_prata, medalha_bronze))

n_comp=int(input()) # Entrada do numero de comparacoes

for j in range (0, n_comp, 1):
    atleta1, atleta2 = map(int, input().split()) # Entrada dos ids dos atletas para comparacao
    comparar(atletas[atleta1-1], atletas[atleta2-1]) # Resultado da comparacao