# Projeto prático de banco de dados


## Instalação e configuração

### Clone da aplicação
```bash
git clone https://github.com/jonas-elias/vigilance-hub.git
```

### Entre no caminho especificado
```bash
cd vigilance-hub/backend
```

### Rode o comando docker-compose
```bash
docker-compose up -d
```

### Crie o schema do banco de dados no servidor PostgreSQL instalado pelo docker
```bash
CREATE SCHEMA vigilance_hub
```

### Crie as tabelas do esquema a partir das migrations da aplicação backend
```
curl --location --request POST 'http://127.0.0.1:9501/api/v1/migrateRefresh'
```


### Execute dentro da pasta _client_ o comando a seguir
```
python ./app.py
```

#### Obs: As colections do postman também estão disponíveis no repositório para testes HTTP

## Stack utilizada

**PHP**, **Swoole**, **Python**, **PostgreSql**, **Docker**, **VSCode**.

