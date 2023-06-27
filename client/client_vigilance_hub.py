import requests
import json

baseurl = 'http://127.0.0.1:9501/api/v1'


def create_user(inputs):
    url = baseurl + '/usuario/register'

    data = {
        "nome": inputs['nome'],
        "email": inputs['email'],
        "senha": inputs['senha'],
        "isAdmin": inputs['isAdmin']
    }

    headers = {'content-type': 'application/json'}
    response = requests.post(url, headers=headers, data=json.dumps(data))

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_user(inputs):
    url = baseurl + '/usuario/update/' + inputs['id_usuario']

    data = {
        "nome": inputs['nome'],
        "email": inputs['email'],
    }

    headers = {'content-type': 'application/json'}
    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def delete_user_admin(inputs):
    url = baseurl + '/usuario/admin/' + inputs['id_admin']

    headers = {'content-type': 'application/json'}
    response = requests.delete(url, headers=headers)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def delete_user_cliente(inputs):
    url = baseurl + '/usuario/cliente/' + inputs['id_cliente']

    headers = {'content-type': 'application/json'}
    response = requests.delete(url, headers=headers)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_application(inputs):
    url = baseurl + '/aplicacao'
    headers = {'Content-Type': 'application/json'}

    data = {
        "idCliente": inputs['idCliente'],
        "nome": inputs['nome']
    }

    response = requests.post(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_application(inputs):
    url = baseurl + '/aplicacao/' + inputs['id_aplicacao']
    headers = {'Content-Type': 'application/json'}

    data = {
        "nome": inputs['nome']
    }

    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def delete_application(inputs):
    url = baseurl + '/aplicacao/' + inputs['id_aplicacao']

    headers = {
        'clienteToken': inputs['clienteToken'],
        'content-type': 'application/json'
    }
    response = requests.delete(url, headers=headers)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_cache_monitoring(inputs):
    url = baseurl + '/monitoramento/cache'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "acao": inputs['acao'],
        "chave": inputs['chave']
    }

    response = requests.post(url, headers=headers, json=data)
    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_cache(inputs):
    url = baseurl + '/monitoramento/cache/' + inputs['id_cache']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "acao": inputs['acao'],
        "chave": inputs['chave']
    }

    response = requests.put(url, headers=headers, json=data)
    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_monitoring_depuracao(inputs):
    url = baseurl + '/monitoramento/depuracao'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "depuracao": inputs['depuracao']
    }

    response = requests.post(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_depuracao(inputs):
    url = baseurl + '/monitoramento/depuracao/' + inputs['id_depuracao']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "depuracao": inputs['depuracao']
    }

    response = requests.put(url, headers=headers, json=data)
    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_monitoring_error(inputs):
    url = baseurl + '/monitoramento/erro'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "nivel": inputs['nivel'],
        "localizacao": inputs['localizacao'],
        "stacktrace": inputs['stacktrace']
    }

    response = requests.post(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_erro(inputs):
    url = baseurl + '/monitoramento/erro/' + inputs['id_erro']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "nivel": inputs['nivel'],
        "localizacao": inputs['localizacao'],
        "stacktrace": inputs['stacktrace']
    }

    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_monitoring_log(inputs):
    url = baseurl + '/monitoramento/log'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "nivel": inputs['nivel'],
        "mensagem": inputs['mensagem']
    }

    response = requests.post(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_log(inputs):
    url = baseurl + '/monitoramento/log/' + inputs['id_log']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "nivel": inputs['nivel'],
        "mensagem": inputs['mensagem']
    }

    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_monitoring_query(inputs):
    url = baseurl + '/monitoramento/query'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }
    data = {
        "duracao": inputs['duracao'],
        "conector": inputs['conector'],
        "localizacao": inputs['localizacao'],
        "query": inputs['query']
    }

    response = requests.post(url, headers=headers, json=data)
    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_query(inputs):
    url = baseurl + '/monitoramento/query/' + inputs['id_query']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }
    data = {
        "duracao": inputs['duracao'],
        "conector": inputs['conector'],
        "localizacao": inputs['localizacao'],
        "query": inputs['query']
    }

    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def create_monitoring_request(inputs):
    url = baseurl + '/monitoramento/request'
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "duracao": inputs['duracao'],
        "status": inputs['status'],
        "metodo": inputs['metodo'],
        "uri": inputs['uri'],
        "headers": inputs['headers'],
        "response": inputs['response']
    }

    response = requests.post(url, headers=headers, json=data)

    if (response.status_code == 201):
        return response.json()
    else:
        return response.json()['erros']


def update_monitoring_request(inputs):
    url = baseurl + '/monitoramento/request/' + inputs['id_request']
    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'Content-Type': 'application/json'
    }

    data = {
        "duracao": inputs['duracao'],
        "status": inputs['status'],
        "metodo": inputs['metodo'],
        "uri": inputs['uri'],
        "headers": inputs['headers'],
        "response": inputs['response']
    }

    response = requests.put(url, headers=headers, json=data)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def delete_monitoramento(inputs):
    url = baseurl + '/monitoramento/' + inputs['id_monitoramento']

    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'content-type': 'application/json'
    }
    response = requests.delete(url, headers=headers)

    if (response.status_code == 200):
        return response.json()
    else:
        return response.json()['erros']


def total_aplicacoes(inputs):
    url = baseurl + '/monitoramento/getTotalAplicacoes'

    headers = {
        'content-type': 'application/json'
    }
    response = requests.get(url, headers=headers)

    if (response.status_code == 200):
        return response.json()['response']
    else:
        return response.json()


def total_monitoramentos(inputs):
    url = baseurl + '/monitoramento/getTotalMonitoramentos'

    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'content-type': 'application/json'
    }
    response = requests.get(url, headers=headers)

    if (response.status_code == 200):
        return response.json()['response']
    else:
        return response.json()


def total_monitoring_data(inputs):
    url = baseurl + '/monitoramento/getTotalMonitoramentoData'

    headers = {
        'aplicacaoToken': inputs['aplicacaoToken'],
        'clienteToken': inputs['clienteToken'],
        'content-type': 'application/json'
    }
    response = requests.get(url, headers=headers)

    if (response.status_code == 200):
        return response.json()['response']
    else:
        return response.json()


def migration_database():
    url = baseurl + '/migrateRefresh'
    headers = {
        'content-type': 'application/json'
    }
    requests.post(url, headers=headers)


clientToken = []
aplicacaoToken = []


def generate_insert():
    global clientToken
    global aplicacaoToken

    clientToken = []
    aplicacaoToken = []
    # migration:refresh database
    migration_database()

    # clientToken
    clientToken.append(create_user({
        "nome": 'Jonas Elias',
        "email": 'jonaselias@gmail.com',
        "senha": 'senha123',
        "isAdmin": False
    })['clientToken'])
    clientToken.append(create_user({
        "nome": 'Felipe Machado',
        "email": 'felipemachado@gmail.com',
        "senha": 'senha123',
        "isAdmin": False
    })['clientToken'])
    clientToken.append(create_user({
        "nome": 'Ruan',
        "email": 'ruan@gmail.com',
        "senha": 'senha123',
        "isAdmin": False
    })['clientToken'])
    create_user({
        "nome": 'Admin',
        "email": 'adminadmin@gmail.com',
        "senha": 'senha123',
        "isAdmin": True
    })

    # aplicacao
    aplicacaoToken.append(create_application({
        'idCliente': 1,
        'nome': 'AWS'
    })['applicationToken'])
    aplicacaoToken.append(create_application({
        'idCliente': 2,
        'nome': 'PostgreSQL'
    })['applicationToken'])
    aplicacaoToken.append(create_application({
        'idCliente': 3,
        'nome': 'Firebase'
    })['applicationToken'])

    # cache monitoring
    create_cache_monitoring({
        "acao": 'missed',
        "chave": '{"cache1"}',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0],
    })
    create_cache_monitoring({
        "acao": 'hit',
        "chave": "{'cache2'}",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1],
    })
    create_cache_monitoring({
        "acao": 'get',
        "chave": "{'cache3'}",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2],
    })

    # request monitoring
    create_monitoring_request({
        "duracao": 3.15,
        "status": 200,
        "metodo": 'POST',
        "uri": 'https:/application.aws.com',
        "headers": "{'headers': 'cookie-user-agent'}",
        "response": "{'success': true}",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0],
    })
    create_monitoring_request({
        "duracao": 1.80,
        "status": 200,
        "metodo": 'PUT',
        "uri": 'https:/application.firebase.com',
        "headers": "{'headers': 'cookie-user-agent'}",
        "response": "{'success': true}",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1],
    })
    create_monitoring_request({
        "duracao": 9.15,
        "status": 400,
        "metodo": 'GET',
        "uri": 'https:/application.postgresql.com',
        "headers": "{'headers': 'cookie-user-agent'}",
        "response": "{'success': false}",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2],
    })

    # query monitoring
    create_monitoring_query({
        'duracao': 3.15,
        'conector': 'MYSQL',
        'localizacao': 'CLASS/APICONTROLLER',
        'query': 'select c.id from vigilance_hub.cliente c group by c.id',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    create_monitoring_query({
        'duracao': 5.10,
        'conector': 'ORACLE',
        'localizacao': 'CLASS/APICONTROLLER/ORACLE/ORACLECONTROLLER',
        'query': 'select * from vigilance_hub.cliente c where c.id IS NOT NULL',
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    create_monitoring_query({
        'duracao': 1.20,
        'conector': 'POSTGRESQL',
        'localizacao': 'CLASS/APICONTROLLER/POSTGRESQL/CLASSCONTROLLER',
        'query': 'select * from vigilance_hub.cliente c',
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # depuracao monitoring
    create_monitoring_depuracao({
        'depuracao': 'depuracao-1',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    create_monitoring_depuracao({
        'depuracao': 'depuracao-2',
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    create_monitoring_depuracao({
        'depuracao': 'depuracao-1',
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # error monitoring
    create_monitoring_error({
        "nivel": "critical",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    create_monitoring_error({
        "nivel": "high",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace - file not found",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    create_monitoring_error({
        "nivel": "high",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace - file not recognized",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # log monitoring
    create_monitoring_log({
        "nivel": "info",
        "mensagem": "Mensagem log - 1",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    create_monitoring_log({
        "nivel": "info",
        "mensagem": "Mensagem log - 2",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    create_monitoring_log({
        "nivel": "info",
        "mensagem": "Mensagem log - 3",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })


def generate_update():

    # garantir que os itens estejam inseridos
    generate_insert()

    # update user
    update_user({
        'id_usuario': '1',
        'nome': 'Jonas Update',
        'email': 'jonaseliasupdate@gmail.com'
    })
    update_user({
        'id_usuario': '2',
        'nome': 'Felipe Update',
        'email': 'felipemachadoupdate@gmail.com'
    })
    update_user({
        'id_usuario': '3',
        'nome': 'Ruan Update',
        'email': 'ruanupdate@gmail.com'
    })

    # update application
    update_application({
        'id_aplicacao': '1',
        'nome': 'AWS Update',
    })
    update_application({
        'id_aplicacao': '2',
        'nome': 'Firebase Update',
    })
    update_application({
        'id_aplicacao': '3',
        'nome': 'PostgreSQL Update',
    })

    # update monitoring cache
    update_monitoring_cache({
        "id_cache": '1',
        "acao": 'missed update',
        "chave": '{"cache1 update"}',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0],
    })
    update_monitoring_cache({
        "id_cache": '2',
        "acao": 'hit update',
        "chave": '{"cache2 update"}',
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1],
    })
    update_monitoring_cache({
        "id_cache": '3',
        "acao": 'get update',
        "chave": '{"cache3 update"}',
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2],
    })

    # request monitoring
    update_monitoring_request({
        "id_request": "1",
        "duracao": 3.15,
        "status": 200,
        "metodo": 'POST',
        "uri": 'https:/application.aws.com',
        "headers": "{'headers': 'cookie-user-agent'}",
        "response": "{'success': true}",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0],
    })
    update_monitoring_request({
        "id_request": "2",
        "duracao": 1.80,
        "status": 400,
        "metodo": 'PUT',
        "uri": 'https:/application.firebase.com',
        "headers": "{'headers': 'cookie-user-agent'}",
        "response": "{'success': true}",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1],
    })
    update_monitoring_request({
        "id_request": "3",
        "duracao": 3.15,
        "status": 400,
        "metodo": 'GET',
        "uri": 'https:/application.postgresql.com',
        "headers": "{'headers': 'cookie-user-agent' - update}",
        "response": "{'update': true}",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2],
    })

    # update query monitoring
    update_monitoring_query({
        'id_query': '1',
        'duracao': 3.50,
        'conector': 'MYSQL',
        'localizacao': 'CLASS/APICONTROLLER',
        'query': 'select c.id from vigilance_hub.cliente c',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    update_monitoring_query({
        'id_query': '2',
        'duracao': 1.10,
        'conector': 'ORACLE',
        'localizacao': 'CLASS/APICONTROLLER/ORACLE/ORACLECONTROLLER',
        'query': 'select * from cliente c where c.id IS NOT NULL',
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    update_monitoring_query({
        'id_query': '3',
        'duracao': 0.10,
        'conector': 'POSTGRESQL',
        'localizacao': 'CLASS/APICONTROLLER/POSTGRESQL/CLASSCONTROLLER',
        'query': 'select * from vigilance_hub.cliente c',
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # depuracao monitoring
    update_monitoring_depuracao({
        'id_depuracao': '1',
        'depuracao': 'depuracao-1 update',
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    update_monitoring_depuracao({
        'id_depuracao': '2',
        'depuracao': 'depuracao-2 update',
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    update_monitoring_depuracao({
        'id_depuracao': '3',
        'depuracao': 'depuracao-1',
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # update monitoring error
    update_monitoring_erro({
        "id_erro": '1',
        "nivel": "critical",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace update",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    update_monitoring_erro({
        "id_erro": '2',
        "nivel": "high",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace - file not found update",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    update_monitoring_erro({
        "id_erro": '3',
        "nivel": "high",
        "localizacao": "CLASS/STACKTRACE/index.php",
        "stacktrace": "Erro stacktrace - file not recognized update",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })

    # update log monitoring
    update_monitoring_log({
        "id_log": '1',
        "nivel": "info update",
        "mensagem": "Mensagem log - 1 update",
        'aplicacaoToken': aplicacaoToken[0],
        'clienteToken': clientToken[0]
    })
    update_monitoring_log({
        "id_log": '2',
        "nivel": "info update",
        "mensagem": "Mensagem log - 2 update",
        'aplicacaoToken': aplicacaoToken[1],
        'clienteToken': clientToken[1]
    })
    update_monitoring_log({
        "id_log": '3',
        "nivel": "info update",
        "mensagem": "Mensagem log - 3 update",
        'aplicacaoToken': aplicacaoToken[2],
        'clienteToken': clientToken[2]
    })


def generation_delete():
    # garantir a existência dos dados
    generate_insert()

    x = 0
    for i in range(1, 16):
        if x == 3:
            x = 0
        delete_monitoramento({
            'id_monitoramento': f'{i}',
            'aplicacaoToken': aplicacaoToken[x],
            'clienteToken': clientToken[x]
        })
        x += 1

    for i in range(1, 4):
        delete_application({
            'id_aplicacao': f'{i}',
            'clienteToken': clientToken[i-1],
        })
        delete_user_cliente({
            'id_cliente': f'{i}'
        })

    delete_user_admin({
        'id_admin': '1'
    })
