# Pagão Seguro
Pagão Seguro

## Instalação

* Clone este repositório, acesse a pasta e instale as dependências via [Composer](https://getcomposer.org/) (ou [clique aqui](http://matheusmarques.com/pagaoseguro.zip) para baixar o .zip com as depêndencias):
```bash
$ composer install
```

* Suba o banco de dados localizado em `/scripts/db.sql`

* Modifique as configurações da aplicação em `/app/settings.php`

* Acesse a aplicação `http://localhost/pagaoseguro/public/`

## Simulação Loja

O Script localizado em `/scripts/api_request` simula a requisição de uma loja(Utilização de token). Para utiliza-lo edite as configurações do PublicHash e PrivateHash no script para uma API criada no sistema, e altera a URL da API.

Utilização:
```bash
$ ./scripts/api_request [token] [valor da compra]
```

## Sistema Online

O sistema se encontra online em: https://pagaoseguro.matheusmarques.com/