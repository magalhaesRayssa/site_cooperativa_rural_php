# Sistema de Cadastro de Produtos Agricolas

Este é um sistema web desenvolvido em **PHP** com **MySQL**, que realiza operações CRUD (Create, Read, Update, Delete) para gerenciar **produtores rurais**, **produtos** e **estabelecimentos**.

## Tecnologias Utilizadas

- **PHP** (puro)
- **MySQL** (via phpMyAdmin ou terminal)
- **HTML5 / CSS3**
- **XAMPP** (para ambiente local de desenvolvimento)

## Funcionalidades

- Cadastro e exclusão de **produtores**
- Cadastro e exclusão de **produtos**
- Cadastro e exclusão de **estabelecimentos**
- Relacionamento entre os dados (ex: produtos vinculados a produtores e estabelecimentos)
- Interface simples e intuitiva
- Exibição de mensagens de sucesso ou erro

## Estrutura do Banco de Dados

O sistema utiliza um banco de dados MySQL com ao menos três tabelas principais:

- `produtores` — armazena dados como nome e contato
- `produtos` — armazena informações sobre os produtos (nome, descricao, link da foto e produtor)
- `estabelecimentos` — armazena nome, localização e link da foto

Relacionamentos entre tabelas são feitos por **chaves estrangeiras** (`FOREIGN KEY`).

## Como Executar

1. Instale o [XAMPP](https://www.apachefriends.org/index.html) ou outro servidor local compatível.
2. Clone este repositório:
   ```bash
   git clone https://github.com/magalhaesRayssa/site_cooperativa_rural_php.git
3. Faça o download do banco atraves do script **db.sql** encontrado na pasta db 