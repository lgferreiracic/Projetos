class Pessoa:
    def __init__(self, nome):
        self.__nome = nome

    def setNome(self, pNome):
        self.__nome = pNome

    def getNome(self):
        return self.__nome
    
    @property
    def nome(self): 
        return self.__nome

    @nome.setter
    def nome(self, pNome): 
        raise ValueError("Impossivel alterar nome diretamente. Use a função setNome().")

pessoa1 = Pessoa("Alice")

# Tentando modificar o atributo diretamente
pessoa1.__nome = "Julia"  # Isso cria um novo atributo __nome na instância pessoa1
# Recebendo o nome sem usar a propriedade
nome_teste = pessoa1.__nome
# Verificando se o atributo foi modificado
print(nome_teste)  # A saída será "Alice", pois o atributo __nome original não foi modificado
print(vars(pessoa1))