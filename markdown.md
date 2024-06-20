# Blog sobre Slay The Spire

Este é um blog simples desenvolvido como parte de um trabalho para um curso técnico, utilizando PHP sem nenhum framework específico. O projeto inclui um sistema de roteamento básico que suporta rotas simples e rotas com parâmetros.

## Funcionalidades

Existem três funções principais no blog:

1. **Cadastrar novos Posts**
2. **Editar Posts**
3. **Apagar Posts**

## Bibliotecas Utilizadas

Para cumprir requisitos específicos do projeto, foram utilizadas duas bibliotecas:

- **PHPMailer**: Utilizada para enviar e-mails de notificação quando novos posts são cadastrados.
- **Parsedown**: Utilizada para renderizar o conteúdo dos posts escritos em Markdown. Isso permite uma visualização prévia dos posts enquanto são escritos.

## Páginas

O blog contém três páginas principais:

- **/**: Página inicial que exibe os posts mais recentes e contém o formulário para cadastro de novos posts.
- **/admin**: Área administrativa onde são executadas as funções de cadastrar, editar e apagar posts.
- **/pagina/?id=**: Página onde é possível visualizar um post específico, identificado pelo parâmetro `id`.

## Aviso

Para proteger os dados sensíveis referentes ao serviço de e-mail fornecido pelo professor, existe um arquivo chamado `config.php` que contém as variáveis de ambiente do projeto. Ele deve incluir as seguintes variáveis:

```php
<?php
// Configurações de SMTP para envio de e-mails
$smtp_host = "";         // Endereço do servidor SMTP
$smtp_port = ;                         // Porta do servidor SMTP
$smtp_user = "";    // Usuário de autenticação SMTP
$smtp_password = "";             // Senha de autenticação SMTP

// Configurações do banco de dados MySQL
$servername = "";    // Endereço do servidor MySQL
$username = "";           // Nome de usuário do banco de dados MySQL
$password = "";               // Senha do usuário do banco de dados MySQL
$dbname = "";             // Nome do banco de dados
?>
