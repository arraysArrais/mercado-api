# README #

## Rodando e configurando o projeto (Necessário Docker instalado na máquina)

```bash
# Clone o projeto
$ git clone git@github.com:arraysArrais/mercado-api.git

# Navegue até a pasta do projeto
$ cd mercado-api

# Inicie o container
$ docker compose up --build

# Instale as dependências do composer (dentro do container que roda o PHP).
$ composer install

# Restaure o backup da base de dados

# A aplicação estará disponível no endereço http://localhost:8080
# o pgAdmin poderá ser acessado no endereço http://localhost:5050

# Credenciais de acesso ao pgAdmin:
# email: admin@email.com
# password: adminpassword

# Dados para conexão ao servidor do banco:

# Host name/address: 
$ postgres (partindo da rede interna) 
$ localhost:4005 (caso queira acessar diretamente da sua máquina)

# Username: 
$ db_user

# password: 
$ db_password

# database: 
$ postgres

```

### Observação
- Caso esteja usando alguma distro linux, talvez seja necessário conceder permissões de acesso/leitura/escrita ao diretório raíz do repositório utilizando o comando chmod.
- O backup da base de dados se encontra no arquivo "pg_dump.sql", localizado na raíz do projeto