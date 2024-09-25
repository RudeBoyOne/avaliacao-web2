# Sistema de Gerenciamento de Produtos

## Descrição do Projeto

Este projeto consiste em uma aplicação para gerenciamento de produtos, que permite cadastrar, atualizar, listar e excluir produtos, além de registrar as operações realizadas em uma tabela de logs. A aplicação utiliza um banco de dados SQLite para armazenamento de dados.

## Funcionalidades

- **Gerenciamento de Produtos**:
  - Criar, ler, atualizar e excluir produtos.
  - Validação de campos obrigatórios:
    - O nome do produto deve ter no mínimo 3 caracteres.
    - O preço deve ser um valor positivo.
    - O estoque deve ser um número inteiro maior ou igual a zero.

- **Registro de Logs**:
  - Registro de operações CRUD em uma tabela de logs.
  - A tabela de logs contém informações sobre:
    - Tipo de operação (criação, atualização, exclusão).
    - Data e hora da operação.
    - ID do produto afetado.

## Estrutura do Banco de Dados

### Tabelas

- **Produto**:
  - `id`: Identificador único do produto.
  - `nome`: Nome do produto.
  - `descricao`: Descrição do produto.
  - `preco`: Preço do produto.
  - `estoque`: Quantidade disponível em estoque.
  - `userInsert`: Usuário que inseriu o produto.
  - `data_hora`: Data e hora de inserção.

- **Log**:
  - `id`: Identificador único do log.
  - `acao`: Tipo de operação realizada (criação, atualização, exclusão).
  - `data_hora`: Data e hora da operação.
  - `produto_id`: ID do produto afetado.
  - `userInsert`: Usuário que realizou a operação.

## Endpoints da API

### Produtos

- **GET /produtos**
  - Retorna todos os produtos.
  - **Resposta**: Lista de produtos.

- **GET /produtos/{id}**
  - Retorna o produto com o ID especificado.
  - **Parâmetros**: `id` (ID do produto).
  - **Resposta**: Detalhes do produto.

- **POST /produtos**
  - Cria um novo produto.
  - **Corpo da Requisição**:

- **PUT /produtos/{id}**
  - Atualiza os dados de um produto existente.
  - **Parâmetros**: `id` (ID do produto).
  - **Corpo da Requisição**
  - **Resposta**: Produto atualizado.

- **DELETE /produtos/{id}**
  - Exclui o produto com o ID especificado.
  - **Parâmetros**: `id` (ID do produto).
  - **Resposta**: Produto excluído.

### Logs

- **GET /logs**
  - Retorna todos os logs das operações realizadas nos produtos.
  - **Resposta**: Lista de logs.

## Testes

Todos os endpoints foram testados utilizando o Postman. Capturas de tela dos testes estão incluídas no documento de entrega.

## Documentação

A documentação dos endpoints, incluindo exemplos de requisições e respostas, está disponível no Postman. Para mais informações sobre como usar a API, consulte a documentação fornecida.

## Relatório Técnico

Um relatório técnico detalhado foi elaborado, explicando o processo de desenvolvimento da aplicação, a implementação dos logs e a validação dos campos. O relatório também destaca as principais dificuldades enfrentadas e as soluções adotadas.

