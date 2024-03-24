class aluno:

    def __init__(self, nome, nota):
        self.nome=nome
        self.nota=nota

alunos = []
melhor_aluno=aluno("", -1)
pior_aluno=aluno("", 11)
for i in range(3):
    nome=input("Digite o nome do %d aluno: \n" % (i+1))
    nota=float(input("Digite a nota do %d aluno: \n" % (i+1)))
    alunos.append(aluno(nome, nota))
    if(nota>melhor_aluno.nota):
        melhor_aluno.nome=nome
        melhor_aluno.nota=nota
    elif(nota<pior_aluno.nota):
        pior_aluno.nome=nome
        pior_aluno.nota=nota

print("Melhor aluno: %s" % melhor_aluno.nome)
print("Nota do melhor aluno: %s" % melhor_aluno.nota)

print("Pior aluno: %s" % pior_aluno.nome)
print("Nota do pior aluno: %d" % pior_aluno.nota)
        
    

