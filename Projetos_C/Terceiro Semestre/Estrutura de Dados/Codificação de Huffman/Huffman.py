from Impressao import Desenho
TAMANHO = 27

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

class Frequencia:
    def __init__(self):
        self.vetor_freq = [0] * TAMANHO

    @staticmethod
    def informa_indice(caracter):
        if caracter == ' ':
            return 0
        else:
            valor = ord(caracter) - ord('a') + 1
            return valor
        
    def informa_freq(self, texto):
        for caracter in texto:
            posicao = Frequencia.informa_indice(caracter)
            self.vetor_freq[posicao] += 1

    def imprime_freq(self): 
        for i in range(TAMANHO): 
            if i == 0: 
                print("  : ", self.vetor_freq[i])
            else:
                print(f"{chr(ord('a') + i - 1)} : {self.vetor_freq[i]}")

class Arvore:
    def __init__(self):
        self.raiz = None
        self.lista = []
    
    def criar_lista(self, vetor_freq):
        for i in range(TAMANHO):
            if vetor_freq[i] != 0:
                carac = ' ' if i == 0 else chr(ord('a') + i - 1)
                novo_no = No(vetor_freq[i], carac)
                self.lista.append(novo_no)
        self.ordenar_lista()

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
            novo_no = No(soma_freq, '|', aux1_no, aux2_no)
            #novo_no = No(soma_freq, '|', aux2_no, aux1_no)
            """
            if aux1_no.freq<=aux2_no.freq:
                novo_no = No(soma_freq, '|', aux1_no, aux2_no)
            else:
                novo_no = No(soma_freq, '|', aux2_no, aux1_no)
            """
            # Adiciona o novo nó de volta na lista
            self.lista.append(novo_no)
            self.ordenar_lista()
        
        # Define o nó raiz da árvore
        self.raiz = self.lista.pop()

    def imprimir_arvore(self, no, prefixo=''):
        if no is not None:
            print(f"{prefixo}Caractere: {no.carac}, Frequência: {no.freq}")
            self.imprimir_arvore(no.esquerda, prefixo + 'L-')
            self.imprimir_arvore(no.direita, prefixo + 'R-')
    
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

    def codifica_caractere(self, c):
        aux=self.procurar_no(self.raiz, c)
        cod=[]

        while aux.pai!=None:
            if aux.pai.esquerda == aux:
                cod.insert(0,'0')
            else:
                cod.insert(0,'1')
            aux=aux.pai
        return cod
    
    def decodifica(self, codificacao):
        decodificacao=[]
        if self.raiz != None:
            aux=self.raiz
            tam=len(codificacao)
            i=0
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
            
    def codifica(self, texto):
        codificacao=[]
        for i in texto:
           codificacao.extend(self.codifica_caractere(i))
        return codificacao             
    
# Exemplo de uso
texto = "upa pepipa popipa papou pa papa e pipe ap"
freq = Frequencia()
freq.informa_freq(texto)
arvore = Arvore()
arvore.criar_lista(freq.vetor_freq)
arvore.cria_arvore()
codificacao=arvore.codifica(texto)
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

Desenho.desenhar(arvore.raiz)