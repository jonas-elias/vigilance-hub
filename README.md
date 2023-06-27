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

### Instale o componente de migrations do hyperf através do comando a seguir dentro do terminal disponibilizado pelo docker (imagem hyperf do docker-compose) e crie as tabelas a partir dos comandos restantes
```
php bin/hyperf.php migrate:install

php bin/hyperf.php migrate

php bin/hyperf.php migrate:refresh
```

### Execute dentro da pasta _client_ o comando a seguir
```
python ./app.py
```

#### Obs: As colections do postman também estão disponíveis no repositório para testes HTTP

## Stack utilizada

**PHP**, **Swoole**, **Python**, **PostgreSql**, **Docker**, **VSCode**.

