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
        return response.json()['erros']
    
    
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
        return response.json()['erros']


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
        return response.json()['erros']

# create_monitoring_query({
#     'duracao': 3.15,
#     'conector': 'MYSQL',
#     'localizacao': 'CLASS/APICONTROLLER',
#     'query': 'select * from vigilance_hub.cliente c',
#     'aplicacaoToken': '51107922ed43d5acd7622aad8c2301cd75dab9005f4e6571986c0e96fc08879b60ce6017afa09cc8c82d1b0706f50bb9b9ad982bb78c1949e97dc1de468d84db',
#     'clienteToken': '0ecfaf4fdbc5cd4568a8eabf46e3e47ed7c9f749dce6bc5e4ea4cd445451c4274192ed392f35d68ff6c2c77a803dc3df66b8281fd44ba54f0c6a9914c4d2133d'
# })
