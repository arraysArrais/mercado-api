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

```

### Observação
- Caso esteja usando alguma distro linux, talvez seja necessário conceder permissões de acesso/leitura/escrita ao diretório raíz do repositório utilizando o comando chmod.
- O backup da base de dados se encontra no arquivo "pg_dump.sql", localizado na raíz do projeto