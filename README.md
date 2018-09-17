#### Sistema de gerenciamento de finanças

Esse é um sistema de controle de finanças simplificado, que serve como estudo dos conceitos de SOLID.
Ele é feito com a linguagem PHP para o backend. Para o frontend foi usado HTML e o framework CSS Bootstrap.

#### Como rodar o projeto

Esse projeto usa um container docker para os testes em desenvolvimento. Então para subir o container, é necessário dar permissão de execução no arquivo de instalação. Para isso rode o seguinte comando:

```shell
chmod +x startapp.sh
```

Depois das devidas permissões, basta executar o arquivo de instalação, com o comando:

```shell
./startapp.sh
```

** Obs.: Caso você não tenha a network ```jose```, o docker irá gerar um erro e lhe mostrar o comando necessário para criar a rede. Depois do comando, basta executar novamente a instalação. Caso queira vocêr pode alterar o nome da rede ou colocar em uma rede existente editando ```networks``` no arquivo ```Dockerfile```.

Fique atento ao container de nome ```gerenciador-financas-composer```, pois ele é responsável por instalar as dependencias do projeto. Para isso você pode analisa-lo com o seguinte comando:

```shell
docker logs -f gerenciador-financas-composer
```

Depois da instalação das dependências, é necessário a criação da base de dados. O sistema usa a biblioteca [phinx](https://phinx.org/) para a criação de migrações. Para isso execute:

```shell
docker exec gerenciador-financas php migrate-seed.php
```

Com a base de dados criada, basta acessar a em seu navegador o seguinte endereço: [http://gerenciador-financas/login](http://gerenciador-financas/login).

#### Dados de acesso

* Usuário = admin@user.com
* Senha   = 12345 