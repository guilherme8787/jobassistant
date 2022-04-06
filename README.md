## Bem Vindo

_PHP Raizão nesse projeto que envia curriculos em massa pra te ajudar na busca por Jobs_

## Requisitos

> PHP >= 5
>
> Composer
>
> Banco Mysql
>
> Extensão mysqli no php

## Instalação

```bash
git clone https://github.com/guilherme8787/jobassistant.git
```

```bash
cd jobassistant
```

```bash
composer install
```

### Alterar as configurações do banco em Config/Conn.php

_Lembrar de rodar o script banco.sql no seu sgbd_

## Alterar as configurações de email

_Entre no arquivo src\MailManager e configure o email e altere as palavras "Fulano de tal" e "X" de acordo com a sua preferencia_

### Pra rodar o projeto você pode apenas executar:

```bash
php -S 127.0.0.1:8000
```

### E agora é só abrir o navegador e digitar *http://127.0.0.1:8000/* e navegar

### Contribua para o projeto, traga novas funcionalidades
