# Achados e Perdidos

Um sistema simples para gerenciar objetos perdidos e encontrados.

---

## 🚀 Instruções para executar o projeto

### **1. Pré-requisitos**

- **XAMPP**: Certifique-se de que o XAMPP está instalado no seu sistema. Caso não esteja, você pode baixá-lo [aqui](https://www.apachefriends.org/index.html).

### **2. Configuração do ambiente**

1. **Baixe o projeto**
   - Faça o download do repositório do projeto.

2. **Cole o projeto na pasta correta**
   - Renomeie a pasta do projeto para: `achados_perdidos-main`.
   - Copie e cole a pasta do projeto em:
     ```
     /opt/lampp/htdocs/
     ```
     No Windows, cole o projeto em:
     ```
     C:\xampp\htdocs\
     ```

3. **Configurar o banco de dados**
   - Abra o navegador e acesse o phpMyAdmin:
     ```
     http://localhost/phpmyadmin/
     ```
   - Crie um banco de dados com o nome:
     ```
     achados_perdidos
     ```
   - Importe o arquivo `sql.sql` (disponível na pasta do projeto) para criar as tabelas e preencher o banco de dados:
     - No phpMyAdmin, selecione o banco de dados `achados_perdidos`.
     - Clique na aba **Importar**.
     - Escolha o arquivo `sql.sql` e clique em **Executar**.

4. **Inicie o servidor Apache e MySQL**
   - Abra o painel de controle do XAMPP e inicie os serviços **Apache** e **MySQL**.
   - No Linux, você também pode iniciar pelo terminal:
     ```bash
     sudo /opt/lampp/lampp start
     ```

5. **Acesse o projeto**
   - Abra o navegador e vá para:
     ```
     http://localhost/achados_perdidos-main
     ```

---

## 🛠 Tecnologias utilizadas

- **PHP**: Linguagem principal do projeto.
- **MySQL**: Banco de dados para armazenar informações.
- **HTML/CSS/JS**: Frontend do projeto.
- **XAMPP**: Ambiente de desenvolvimento local.

---

## 💡 Funcionalidades

- Cadastro de objetos perdidos.
- Busca de objetos encontrados.
- Interface simples e amigável.

---
