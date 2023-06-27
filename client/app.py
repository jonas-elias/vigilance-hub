from rich.console import Console
from rich.panel import Panel
import client_vigilance_hub
from time import sleep
import plotly.graph_objects as go
import pandas as pd


def call_api(params, function):
    function_to_call = getattr(client_vigilance_hub, function)
    console.print(f"[{option_style}]Resposta:")
    response = function_to_call(params)
    console.print(response)
    return response


while True:
    console = Console()

    title_style = "bold underline"
    option_style = "bold cyan"
    success_style = "bold green"

    content = Panel(
        f"[{title_style}]Opções:[/{title_style}]\n\n"
        f"[{option_style}]1. Opções de insert\n"
        f"[{option_style}]2. Opções de update\n"
        f"[{option_style}]3. Opções de delete\n"
        f"[{option_style}]4. Opções de geração gráfico\n"
        f"[{option_style}]5. Gerar inserts automaticamente\n"
        f"[{option_style}]6. Gerar update automaticamente\n"
        f"[{option_style}]7. Gerar delete automaticamente\n"
        f"[{option_style}]8. Resetar o banco de dados\n"
    )

    console.print(content)

    option = console.input("\nEscolha uma opção: ")

    if option == "1":
        content = Panel(
            f"\n"
            f"[{title_style}]Opções de insert:[/{title_style}]\n\n"
            f"[{option_style}]1. Criar usuário\n"
            f"[{option_style}]2. Criar aplicação\n"
            f"[{option_style}]3. Criar monitoramento de cache\n"
            f"[{option_style}]4. Criar monitoramento de request\n"
            f"[{option_style}]5. Criar monitoramento de depuração\n"
            f"[{option_style}]6. Criar monitoramento de erro\n"
            f"[{option_style}]7. Criar monitoramento de log\n"
            f"[{option_style}]8. Criar monitoramento de query"
        )

        console.print(content)

        sub_option = console.input("\nEscolha uma opção: ")

        if sub_option == "1":
            user_data = {
                "nome": console.input("Nome: "),
                "email": console.input("Email: "),
                "senha": console.input("Senha: "),
                "isAdmin": console.input("isAdmin (True/False): ").lower() == "true"
            }
            call_api(user_data, 'create_user')
            continue
        elif sub_option == "2":
            application_data = {
                "idCliente": console.input("ID do Cliente: "),
                "nome": console.input("Nome: ")
            }
            call_api(application_data, 'create_application')
            continue
        elif sub_option == "3":
            cache_data = {
                "acao": console.input("Ação: "),
                "chave": console.input("Chave: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(cache_data, 'create_cache_monitoring')
            continue
        elif sub_option == "4":
            request_data = {
                "duracao": float(console.input("Duração: ")),
                "status": int(console.input("Status: ")),
                "metodo": console.input("Método: "),
                "uri": console.input("URI: "),
                "headers": console.input("Headers: "),
                "response": console.input("Response: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(request_data, 'create_monitoring_request')
            continue
        elif sub_option == "5":
            debug_data = {
                "depuracao": console.input("Depuração: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(debug_data, 'create_monitoring_depuracao')
            continue
        elif sub_option == "6":
            error_data = {
                "nivel": console.input("Nível: "),
                "localizacao": console.input("Localização: "),
                "stacktrace": console.input("Stacktrace: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(error_data, 'create_monitoring_error')
            continue
        elif sub_option == "7":
            log_data = {
                "nivel": console.input("Nível: "),
                "mensagem": console.input("Mensagem: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(log_data, 'create_monitoring_log')
            continue
        elif sub_option == "8":
            query_data = {
                "duracao": float(console.input("Duração: ")),
                "conector": console.input("Conector: "),
                "localizacao": console.input("Localização: "),
                "query": console.input("Query: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(query_data, 'create_monitoring_query')
            continue
        else:
            console.print(f"[{'bold red'}]Opção inválida.\n")
            sleep(1)
            continue

    if option == "2":
        content = Panel(
            f"\n"
            f"[{title_style}]Opções de update:[/{title_style}]\n\n"
            f"[{option_style}]1. Alterar usuário\n"
            f"[{option_style}]2. Alterar aplicação\n"
            f"[{option_style}]3. Alterar monitoramento de cache\n"
            f"[{option_style}]4. Alterar monitoramento de request\n"
            f"[{option_style}]5. Alterar monitoramento de depuração\n"
            f"[{option_style}]6. Alterar monitoramento de erro\n"
            f"[{option_style}]7. Alterar monitoramento de log\n"
            f"[{option_style}]8. Alterar monitoramento de query"
        )

        console.print(content)

        sub_option = console.input("\nEscolha uma opção: ")

        if sub_option == "1":
            user_data = {
                "id_usuario": console.input("Id do usuário: "),
                "nome": console.input("Nome: "),
                "email": console.input("Email: ")
            }
            call_api(user_data, 'update_user')
            continue
        elif sub_option == "2":
            application_data = {
                "id_aplicacao": console.input("Id da aplicação: "),
                "nome": console.input("Nome: ")
            }
            call_api(application_data, 'update_application')
            continue
        elif sub_option == "3":
            cache_data = {
                "id_cache": console.input("Id do monitoramento de cache: "),
                "acao": console.input("Ação: "),
                "chave": console.input("Chave: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(cache_data, 'update_monitoring_cache')
            continue
        elif sub_option == "4":
            request_data = {
                'id_request': console.input("Id do monitoramento da request: "),
                "duracao": float(console.input("Duração: ")),
                "status": int(console.input("Status: ")),
                "metodo": console.input("Método: "),
                "uri": console.input("URI: "),
                "headers": console.input("Headers: "),
                "response": console.input("Response: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(request_data, 'update_monitoring_request')
            continue
        elif sub_option == "5":
            debug_data = {
                "id_depuracao": console.input("Id do monitoramento da depuração: "),
                "depuracao": console.input("Depuração: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(debug_data, 'update_monitoring_depuracao')
            continue
        elif sub_option == "6":
            error_data = {
                'id_erro': console.input("Id do monitoramento de erro: "),
                "nivel": console.input("Nível: "),
                "localizacao": console.input("Localização: "),
                "stacktrace": console.input("Stacktrace: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(error_data, 'update_monitoring_erro')
            continue
        elif sub_option == "7":
            log_data = {
                'id_log': console.input("Id do monitoramento de log: "),
                "nivel": console.input("Nível: "),
                "mensagem": console.input("Mensagem: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(log_data, 'update_monitoring_log')
            continue
        elif sub_option == "8":
            query_data = {
                "id_query": console.input("Id do monitoramento de query: "),
                "duracao": float(console.input("Duração: ")),
                "conector": console.input("Conector: "),
                "localizacao": console.input("Localização: "),
                "query": console.input("Query: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(query_data, 'update_monitoring_query')
            continue
        else:
            console.print("Opção inválida.\n")
            sleep(1)
            continue


    if option == "3":
        content = Panel(
            f"\n"
            f"[{title_style}]Opções de delete:[/{title_style}]\n\n"
            f"[{option_style}]1. Deletar admin\n"
            f"[{option_style}]2. Deletar cliente\n"
            f"[{option_style}]3. Deletar aplicação\n"
            f"[{option_style}]4. Deletar monitoramento\n"
        )

        console.print(content)

        sub_option = console.input("\nEscolha uma opção: ")

        if sub_option == "1":
            admin_data = {
                "id_admin": console.input("Id do usuário admin: ")
            }
            call_api(admin_data, 'delete_user_admin')
            continue
        elif sub_option == "2":
            client_data = {
                "id_cliente": console.input("Id do usuário cliente: ")
            }
            call_api(client_data, 'delete_user_cliente')
            continue
        elif sub_option == "3":
            application_data = {
                "id_aplicacao": console.input("Id da aplicação: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(application_data, 'delete_application')
            continue
        elif sub_option == "4":
            monitoramento_data = {
                "id_monitoramento": console.input("Id do monitoramento: "),
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            call_api(monitoramento_data, 'delete_monitoramento')
            continue
        else:
            console.print(f"[{'bold red'}]Opção inválida.\n")
            sleep(1)
            continue
    if option == "4":
        content = Panel(
            f"\n"
            f"[{title_style}]Opções de geração de gráfico:[/{title_style}]\n\n"
            f"[{option_style}]1. Gerar total de aplicações por cliente\n"
            f"[{option_style}]2. Gerar total de monitoramentos\n"
            f"[{option_style}]3. Gerar monitoramento por data\n"
        )

        console.print(content)

        sub_option = console.input("\nEscolha uma opção: ")

        if sub_option == "1":
        
            data = call_api([], 'total_aplicacoes')
            if "erros" in data:
                continue
            df = pd.DataFrame(data)
            id_cliente = df['id_cliente']
            nome = df['nome']
            aplicacoes = df['aplicacoes']

            fig = go.Figure(data=[go.Bar(x=nome, y=aplicacoes, textposition='auto')])

            fig.update_layout(
                title='Número de Aplicações por Cliente',
                xaxis=dict(title='ID Cliente'),
                yaxis=dict(title='Número de Aplicações')
            )
            fig.show()
            continue
        elif sub_option == "2":
            total_monitoramentos_data = {
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            data = call_api(total_monitoramentos_data, 'total_monitoramentos')
            if "erros" in data:
                continue

            labels = list(data[0].keys())[3:]
            values = list(data[0].values())[3:]

            fig = go.Figure(data=[go.Pie(labels=labels, values=values)])

            fig.update_layout(
                title='Total de monitoramentos - Descreve quantos monitoramentos foram adicionados com base no token do cliente e no token da aplicação.')
            fig.show()
            continue
        elif sub_option == "3":
            total_monitoring_data = {
                "aplicacaoToken": console.input("Aplicação Token: "),
                "clienteToken": console.input("Cliente Token: ")
            }
            data = call_api(total_monitoring_data, 'total_monitoring_data')
            if "erros" in data:
                continue
            df = pd.DataFrame(data)
            df['monitoramento_total'] = df['monitoramento_total'].astype(int)
            fig = go.Figure(data=go.Scatter(x=df['data_monitoramento'], y=df['monitoramento_total']))
            fig.update_layout(
                title='Total de monitoramentos criados a partir de datas crescentes',
                xaxis=dict(title='Data de inserção do monitoramento'),
                yaxis=dict(title='Monitoramentos')
            )
            fig.show()
            continue
        else:
            console.print(f"[{'bold red'}]Opção inválida.\n")
            sleep(1)
    elif option == "5":
        client_vigilance_hub.generate_insert()
        continue
    elif option == "6":
        client_vigilance_hub.generate_update()
        continue
    elif option == "7":
        client_vigilance_hub.generation_delete()
        continue
    elif option == "8":
        client_vigilance_hub.migration_database()
        continue
    else:
        console.print(f"[{'bold red'}]Opção inválida.\n")
        sleep(1)
