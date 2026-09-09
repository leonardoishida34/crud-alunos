# CRUD de Alunos com PHP, MySQL e Docker Compose

## 1. Descrição do projeto

Aplicação web simples que implementa um CRUD (Create, Read, Update, Delete) para a entidade **Aluno**, desenvolvida em PHP com banco de dados MySQL, totalmente containerizada com Docker Compose.

A entidade `Aluno` possui os seguintes campos:
- `id` — chave primária, auto incremento
- `nome` — varchar
- `email` — varchar
- `curso` — varchar
- `data_matricula` — date

A aplicação permite:
- Listar todos os alunos cadastrados.
- Cadastrar um novo aluno.
- Editar um aluno existente.
- Excluir um aluno (com confirmação).

## 2. Pré-requisitos

- [Docker](https://www.docker.com/) instalado
- [Docker Compose](https://docs.docker.com/compose/) instalado (já vem junto no Docker Desktop)

Não é necessário ter PHP ou MySQL instalados na máquina — tudo roda dentro dos containers.

## 3. Como executar o projeto

### Clonar o repositório
```bash
git clone https://github.com/leonardoishida34/crud-alunos
cd crud-alunos
```

### Subir os containers
```bash
docker-compose up -d
```

### Criação da tabela no banco
A tabela `alunos` é criada **automaticamente pelo código PHP**. O arquivo `app/src/config.php` executa, a cada conexão, o comando `CREATE TABLE IF NOT EXISTS alunos (...)`. Ou seja, não é preciso rodar nenhum script SQL manualmente — basta acessar a aplicação pela primeira vez que a tabela já é criada.

### Acessar a aplicação
http://localhost:8080

## 4. Explicação do docker-compose.yml

O arquivo `docker-compose.yml` já contém comentários explicando cada linha. Em resumo:

**Serviço `app`**
Roda a aplicação PHP. Como a imagem oficial `php:apache` não vem com suporte a MySQL, criamos um `Dockerfile` próprio que instala a extensão `pdo_mysql`. A porta 8080 do host é mapeada para a porta 80 do container, e o código PHP local é montado via volume, refletindo alterações sem precisar reconstruir a imagem.

**Serviço `db`**
Usa a imagem oficial `mysql:8.0` direto do Docker Hub. Cria automaticamente o banco `crud_alunos` na primeira inicialização.

**Variáveis de ambiente** (definidas direto no `docker-compose.yml`, sem uso de `.env`):

| Variável | Valor | Função |
|---|---|---|
| `DB_HOST` | `db` | Nome do serviço do banco, resolvido pela rede interna |
| `DB_PORT` | `3306` | Porta padrão do MySQL |
| `DB_USER` | `root` | Usuário do banco |
| `DB_PASSWORD` | `root` | Senha do usuário |
| `DB_NAME` | `crud_alunos` | Nome do banco de dados |

**Rede**
A rede `crud-network` (tipo `bridge`) permite que o container `app` se comunique com o `db` usando o nome do serviço como hostname, sem precisar de IP fixo.

**Volume**
O volume nomeado `db_data` garante que os dados cadastrados não sejam perdidos caso o container do banco seja removido ou recriado.

## 5. Pontos interessantes observados pela dupla / Aprendizados

- Utilizamos variáveis de ambiente diretamente no `docker-compose.yml`, o que facilita mudar a configuração de conexão com o banco sem alterar o código PHP.
- Aprendemos a usar volumes no Docker para não perder os dados do banco toda vez que os containers são reiniciados.
- Vimos como containers diferentes conseguem se comunicar entre si só usando o nome do serviço, sem precisar descobrir o IP de cada um.

## 6. Autores

- Leonardo Hitoshi Ishida RA: 250282
- Danilo Augusto Maia RA: 250266