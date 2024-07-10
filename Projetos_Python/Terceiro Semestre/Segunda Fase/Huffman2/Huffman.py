"""
Alunos:
Lucas Gabriel Ferreira
Maria Clara Simões de Jesus
"""
TAMANHO = 27

#Classe para os Nos da árvore
class No:

    def __init__(self, freq, carac, esquerda=None, direita=None):
        self.freq = freq
        self.carac = carac
        self.esquerda = esquerda
        self.direita = direita
        self.pai = None
        
        # Atualiza ponteiro de pai se os filhos não forem nulos
        if self.esquerda:
            self.esquerda.pai = self
        if self.direita:
            self.direita.pai = self

#Classe calcular a frequência de caracter no texto de entrada
class Frequencia:
    def __init__(self):
        self.vetor_freq = [0] * TAMANHO

    #Informa o índice do caracter no vetor de frequência
    @staticmethod
    def informa_indice(caracter):
        #Se o caracter analisado for o "espaço", retorna 0, pois este índice no vetor de frequência
        if caracter == ' ':
            return 0
        #Se não, determina o índice do caracter no vetor de frequência de acordo com o seu valor na Tabela ASCII
        else:
            valor = ord(caracter) - ord('a') + 1
            return valor

    #Analisa um caracter por vez e incrementa a sua frequência no vetor
    def informa_freq(self, texto):
        for caracter in texto:
            posicao = Frequencia.informa_indice(caracter)
            self.vetor_freq[posicao] += 1

    #Método para imprimir a frequência de cada caracter que possui frequência diferente de zero
    def imprime_freq(self): 
        for i in range(1, TAMANHO): 
                if self.vetor_freq[i]!=0:
                    print(f"{chr(ord('a') + i - 1)}: {self.vetor_freq[i]}")
        if self.vetor_freq[0] != 0:
            print(f"espaço: {self.vetor_freq[0]}\n")

#Classe para inserir os nós na árvore
class Arvore:
    def __init__(self):
        self.raiz = None
        self.lista = []

    #Cria lista de nós para auxiliar na construção da árvore
    def criar_lista(self, vetor_freq):
        for i in range(TAMANHO):
            #Percorre o vetor de frequência e se o caracter possuir frequência diferente de zero,
            #recupera o caracter (com o seu valor na Tabela ASCII) e o insere
            if vetor_freq[i] != 0:
                carac = ' ' if i == 0 else chr(ord('a') + i - 1)
                novo_no = No(vetor_freq[i], carac)
                self.lista.append(novo_no)
        #Ordena a lista em ordem crescente com o valor da frequência
        self.ordenar_lista()

    #Ordena a lista em ordem crescente com o valor da frequência
    def ordenar_lista(self):
        self.lista.sort(key=lambda no: (no.freq, no.carac))


    def cria_arvore(self):
        while len(self.lista) > 1:
            # Remove os dois nós com menor frequência
            aux1_no = self.lista.pop(0)
            aux2_no = self.lista.pop(0)
            # Cria um novo nó combinando os dois removidos
            soma_freq = aux1_no.freq + aux2_no.freq
            novo_no = None
            #Analisa quem possui menor frequência e o insere na esquerda e o de maior valor, o insere na direita
            novo_no = No(soma_freq, '|', aux1_no, aux2_no)
            # Adiciona o novo nó de volta na lista
            self.lista.append(novo_no)
            self.ordenar_lista()
        
        # Define o nó raiz da árvore
        self.raiz = self.lista.pop()

    @staticmethod
    def in_ordem(raiz):
        if raiz is not None:
            Arvore.in_ordem(raiz.esquerda)
            if raiz.carac == ' ':
                print('espaço', end=' ')
            elif raiz.carac != '|':
                print(raiz.carac, end=' ')
            else:
                print(raiz.freq, end=' ')
            Arvore.in_ordem(raiz.direita)

    #Função para procurar o nó na árvore de acordo com o caracter informado e retorna o nó que possui este caracter
    def procurar_no(self, raiz, x):
        if raiz is None:
            return None

        if raiz.carac == x:
            return raiz

        left = self.procurar_no(raiz.esquerda, x)
        if left is not None:
            return left

        right = self.procurar_no(raiz.direita, x)
        if right is not None:
            return right

        return None

    #Função para codificar cada caracter
    def codifica_caractere(self, c):
        #Recebe o caracter retornado pela função de busca
        aux=self.procurar_no(self.raiz, c)

        #Lista para receber o codificação
        cod=[]

        #Todas a vezes que percorre o nó da árvore para esquerda, adiciona zero na lista
        #Todas a vezes que percorre o nó da árvore para direita, adiciona 1 na lista
        while aux.pai!=None:
            if aux.pai.esquerda == aux:
                cod.insert(0,'0')
            else:
                cod.insert(0,'1')
            aux=aux.pai
        return cod
    
    #Método auxiliar para impressão dos caracteres codificados
    def imprime_carac_codificado(self, carac, codigo):
        if carac != ' ':
            print(f'{carac}:', end=' ')
        else:
            print('espaço:', end=' ')
        for j in codigo:
            print(j, end='')
        print()

    #Método para impressão dos caracteres com sua codificação
    def dicionario(self, vetor_freq): 
        for i in range(1, TAMANHO): 
                if vetor_freq[i]!=0:
                    aux_carac = chr(ord('a') + i - 1)
                    aux_codigo = self.codifica_caractere(aux_carac)
                    self.imprime_carac_codificado(aux_carac, aux_codigo)
                
        if vetor_freq[0] != 0:
            aux_carac = ' '
            aux_codigo = self.codifica_caractere(aux_carac)
            self.imprime_carac_codificado(aux_carac, aux_codigo)

    #Método para decodificar a lista
    def decodifica(self, codificacao):
        #Lista para receber os carcateres decodificados
        decodificacao=[]
        if self.raiz != None:
            aux=self.raiz
            tam=len(codificacao) #Recebe o tamanho da lista de codificação
            i=0
            #Percorre toda a lista e analisa e analisa se o elemento da lista é 1 ou 0.
            #No primeiro caso, vai para a direita e no segundo, para a esquerda. Quando encontra
            #uma folha,adiciona o caracter do nó na lista. No final, retorna a lista com os nós decodificados
            while i<tam:
                    if aux.esquerda == None and aux.direita == None:
                        decodificacao.append(aux.carac)
                        aux=self.raiz
                    else:
                        if codificacao[i] == '0':
                            aux=aux.esquerda
                            i+=1
                        else:
                            aux=aux.direita

                            i+=1
            decodificacao.append(aux.carac)
        return decodificacao

    #Gera texto codificado e o retorna
    def codifica(self, texto):
        codificacao=[]
        for i in texto:
           codificacao.extend(self.codifica_caractere(i))
        return codificacao             
    
# Exemplo de uso
texto = "e da vez que eu me perdi no caminho so consigo lembrar de tu me sorrindo sentada no portao da tua casa lembro do cd de coco do cafe caboclo da vontade absurda de sentir teu gosto feito fumaca num quarto fechado uu tomou conta dos quatro cantos acende o cigarro queima a brasa eu sou o quarto tu a fumaca e os cigarros foram tantos feito fumaca num quarto fechado tu tomou conta dos quatro cantos acende o cigarro queima a brasa eu sou o quarto tu a fumaca e os cigarros foram tantos e da vez que eu me perdi no caminho so consigo lembrar de tu me sorrindo sentada no portao da tua casa lembro do cd de coco do cafe caboclo da vontade absurda de sentir teu gosto laia laia laia laia"
#texto ="upa pepipa popipa papou pa papa e pipe ap"
freq = Frequencia()
freq.informa_freq(texto)
arvore = Arvore()
arvore.criar_lista(freq.vetor_freq)
arvore.cria_arvore()
codificacao=arvore.codifica(texto)
print('etapa 1:')
freq.imprime_freq()

print('etapa 2:')
arvore.in_ordem(arvore.raiz)
print('\n')

print('etapa 3:')
arvore.dicionario(freq.vetor_freq)
print()

print('etapa 4 (extra):')
print()

print('original: "' + texto + '"')
print('\ncodificado:\n')

for i in codificacao:
    print(i, end='')

print('\n\n')

print('decodificado: "', end='')
decodificacao=arvore.decodifica(codificacao)
for i in decodificacao:
    print(i, end='')
print('"')

print('\n')

