from utils import *

texto_menu_cliente = """Menu Clientes           
(L)ista          
(P)rocura     
(A)paga      
(N)ovo
(U)pdate      

(V)olta ao menu principal
        """


def menu_cliente(cnx):
    """menu de clientes - apresenta o menu e le a opcao"""
    while True:
        op = menu(texto_menu_cliente)
        if op == "L":  # lista todos os clientes
            lista_clientes(cnx)
        elif op == "P":  # lista clientes que satisfazem o filtro
            filtra_clientes(cnx)
        elif op == "A":  # apaga cliente da lista
            apaga_clientes(cnx)
        elif op == "N":  # insere um novo cliente
            insere_clientes(cnx)
        elif op == "U":  # atualiza cliente
            atualiza_clientes(cnx)
        elif op == 'V':
            break
        else:
            print("Opção Inválida")
            break


def filtra_clientes(cnx):
    """
    metodo que filtra os clientes por nome, password, data nascimento, asc
    :param cnx:
    :return:
    """
    print("Escolha os atributos pelos quais deseja filtrar:")
    print("1. Nome")
    print("2. Data de Nascimento")
    print("3. Password")

    opcao = input("Opção: ")

    if opcao == "1":
        filtro = "%" + input("Filtro para Nome (e.g., %Po%) ?") + "%"
        data = (filtro,)
        coluna = "nome"
    elif opcao == "2":
        filtro = "%" + input("Filtro para Data de Nascimento (e.g., %Po%) ?") + "%"
        data = (filtro,)
        coluna = "dataNascimento"
    elif opcao == "3":
        filtro = "%" + input("Filtro para Password (e.g., %Po%) ?") + "%"
        data = (filtro,)
        coluna = "password"
    else:
        print("Opção Inválida")
        return

    sql = f"""SELECT * 
              FROM cliente 
              WHERE {coluna} LIKE %s
              ORDER BY {coluna} ASC;
           """
    filtra_e_lista(cnx, data, sql)

    cnx.commit()


def lista_clientes(cnx):
    """
    metodo que apresenta uma listagem de clientes.
    :param cnx: coneção à base de dados
    """
    sql = """ SELECT * FROM cliente """
    filtra_e_lista(cnx, sql)

    cnx.commit()


def apaga_clientes(cnx):
    """Apaga um cliente"""
    filtro = "%" + input("Filtro (id) ?") + "%"
    data = 1 * (filtro,)
    sql = """DELETE  
            FROM cliente
            WHERE id_cliente LIKE %s; 
    """
    filtra_e_lista(cnx, data, sql)
    cnx.commit()

def atualiza_clientes(cnx):
    """Atualiza um cliente"""
    sql = """UPDATE cliente
             SET nome = %s,
                 password = %s,
                 dataNascimento = %s
             WHERE id_cliente LIKE %s;
    """

    data = dict()
    data["id_cliente"] = "%" + input("Filtro (id) ?") + "%"
    data["nome"] = input("Novo nome? ")
    data["password"] = input("Nova password? ")
    data["dataNascimento"] = input("Nova data de nascimento? ")

    with cnx.cursor() as cursor:
        cursor.execute(sql, (data["nome"], data["password"], data["dataNascimento"], data["id_cliente"]))
        cnx.commit()

def insere_clientes(cnx):
    """insere um novo cliente na na base de dados - pede os dados ao utilizador"""
    sql = """ INSERT  INTO  cliente (
                    id_cliente, 
                    nome, 
                    password, 
                    dataNascimento
                ) VALUES (
                    DEFAULT, 
                    %(nome)s, 
                    %(password)s, 
                    %(dataNascimento)s
                    )
        """
    data = dict()
    for atributo in ("nome", "password", "dataNascimento"):
        data[atributo] = input(f"{atributo}? ")

    with cnx.cursor() as cursor:
        cursor.execute(sql, data)
        cnx.commit()
