# Agenda PHP
Repositório de conteúdo gerado durante a disciplina de programação do curso técnico, utilizando a linguagem PHP, com alguns reajustes recentes.

## Estrutura do Projeto

O projeto está dividido em duas versões principais: `v2` e `v3`. Ambas implementam uma aplicação de agenda com funcionalidades de gerenciamento de contatos e usuários. Abaixo estão os detalhes de cada versão:

### Versão 2 (`v2`)

- **Descrição**: Implementação inicial da aplicação de agenda.
- **Tecnologias**:
  - PHP 5.3
  - MySQL 5.5
  - Docker
- **Estrutura**:
  - `app/`: Contém o código da aplicação.
    - `dados/`: Diretório principal com os arquivos PHP, CSS, JS e views.
    - `admin/`: Funcionalidades administrativas, como gerenciamento de usuários.
    - `controller/`: Contém a lógica de autenticação, manipulação de contatos e usuários.
    - `view/`: Contém as páginas HTML para interação com o usuário.
  - `database/`: Scripts para criação do banco de dados e Dockerfile para o container MySQL.
- **Destaques**:
  - Sistema de login com autenticação.
  - Gerenciamento de contatos (adicionar, editar, excluir).
  - Importação de contatos via arquivo CSV.
  - Gerenciamento de usuários para administradores.

### Versão 3 (`v3`)

- **Descrição**: Versão aprimorada da aplicação com melhorias e ajustes.
- **Tecnologias**:
  - PHP 5.6
  - MySQL 5.7
  - Docker
- **Estrutura**:
  - Similar à versão 2, mas com ajustes e melhorias no código.
  - Atualizações no Dockerfile para suportar versões mais recentes de PHP e MySQL.
- **Destaques**:
  - Melhorias no código para maior compatibilidade e desempenho.
  - Ajustes no layout e funcionalidades.

## Como Executar

### Pré-requisitos

- Docker instalado na máquina.

### Passos

1. **Criação da Rede Docker**:
   ```bash
   docker network create rede-agenda
   ```

2. **Iniciar o Banco de Dados**:

   Navegue até o diretório `v2/database` ou `v3/database` e execute:
   ```bash
   ./criarBanco.sh
   ```

3. **Iniciar a Aplicação**:

   Navegue até o diretório `v2/app` ou `v3/app` e execute:
   ```bash
   ./criarApp.sh
   ```

4. **Acessar a Aplicação**:

   Abra o navegador e acesse: [http://localhost](http://localhost).

## Funcionalidades

### Gerenciamento de Contatos:

- Adicionar, editar e excluir contatos.
- Importar contatos via arquivo CSV.

### Gerenciamento de Usuários:

- Administradores podem adicionar, editar e excluir usuários.
- Controle de níveis de acesso (administrador e usuário comum).

### Autenticação:

- Sistema de login com validação de credenciais.

## Estrutura de Banco de Dados

O banco de dados `bd_agenda` contém as seguintes tabelas principais:

- `agenda_contatos`: Armazena os contatos dos usuários.
- `agenda_usuarios`: Armazena as informações dos usuários, incluindo níveis de acesso.

## Observações

- Este projeto foi desenvolvido como parte de um curso técnico e pode conter práticas de codificação que não seguem os padrões modernos.
- Ajustes recentes foram feitos para melhorar a compatibilidade e funcionalidade.