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

Deixo como dica rodar o container chamado [docker-hosts-updater](https://github.com/grachevko/docker-hosts-updater) que faz a atualização do arquivo de hosts do seu computador, para apontar o IP do container para o seu nome do host. Caso você não tenha esse container, você terá que mapear ele de forma manual em seu arquivo de hosts. Para isso execute os comando: 

```shell 
docker inspect --format={{.NetworkSettings.Networks.creditos.IPAddress}} gerenciador-financas
```
E anote o ip que foi informado. Depois insira a linha a abaixo em seus hosts:

```shell
seu_ip      gerenciador-financas
```

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

#### Funcionalidades

* Administração de categorias de custo - URL [http://gerenciador-financas/category-costs](http://gerenciador-financas/category-costs).

* Administração de contas a pagar - URL [http://gerenciador-financas/bill-pays](http://gerenciador-financas/bill-pays).

* Administração de contas a receber - URL [http://gerenciador-financas/bill-receives](http://gerenciador-financas/bill-receives).

* Extrato - URL [http://gerenciador-financas/statements](http://gerenciador-financas/statements).

* Gráfico de gastos - URL [http://gerenciador-financas/charts](http://gerenciador-financas/charts).

* Administração de Usuários - URL [http://gerenciador-financas/charts](http://gerenciador-financas/charts).

#### Modelagem e DB

Abaixo segue o mapeamento das tabelas usadas no projeto.

##### users

Tabela responsável por armezar os usuários do sistema.

* id - INT PK
* first_name - VARCHAR(255)
* last_name - VARCHAR(255)
* email - VARCHAR(255)
* password - VARCHAR(255)
* created_at - DATETIME
* updated_at - DATETIME

##### category_costs

Tabela que serve como uma tipagem para as contas a pagar. Serve também para gerar o gráfico de custos. Tem uma ligação com usuário, para acesso exclusivo.

* id - INT PK
* name - VARCHAR(255)
* user_id - INT FK
* created_at - DATETIME
* updated_at - DATETIME

##### bill_pays

Essa é a tabela usada para armazenar as contas a pagar. Ela tem uma relação com categorias de custo, para gerar a tipagem da conta. E também tem uma relação com o usuário, para acesso exclusivo.

* id - INT PK
* date_launch - DATE
* name - VARCHAR(255)
* value - FLOAT
* user_id - INT FK
* category_cost_id - INT FK
* created_at - DATETIME
* updated_at - DATETIME

##### bill_receives

Essa tabela armazena as contas a receber, que entraram como positivas para o usuário. Tem um ligação com usuário, para acesso exclusivo.

* id - INT PK
* date_launch - DATE
* name - VARCHAR(255)
* value - FLOAT
* user_id - INT FK
* created_at - DATETIME
* updated_at - DATETIME

#### Estrutura do projeto

1. **config** - Diretório que guarda as configs do projeto.

2. **db** - Diretório responsável por guardar as migrações e seeds, para a montagem do banco de dados.

* **migrations** - Diretório responsável por guardar as migrações, que criam as tabelas de banco de dados do sistema.

* **seeds** - Diretório que armazena as seeds, responsáveis por popular as tabelas com dados de teste.

3. **docs** - Diretório que armazena os documentos usados no projeto.

4. **public** - Diretório de document root do sistema, usado para carregar a aplicação.

5. **src** - Diretório que armazena o core do projeto.

* **Auth** - Diretório que contém a lógica de autenticação do sistema. Para essa configuração é usado a biblioteca [Jasny\Auth](https://github.com/jasny/auth).

* **Models** - Diretório responsável por guardar os modelos do sistema, que são os mappers das tabelas. Nele é usado o ORM [Eloquent](https://github.com/illuminate/database).

* **Plugins** - Diretório que armazena os serviços que serão adicionados no container.

* **Repository** - Diretório que armazena os repositórios do sistema. Nele são usados os modelos e servem para armazenar as regras de negócio.

* **View** - Diretório de configuração para o renderizador de templates [Twig](https://twig.symfony.com/).

* **controllers** - Diretório que armazena as rotas de acesso da aplicação. Nele é usado a biblioteca [Aura/Router](https://github.com/auraphp/Aura.Router).

* **ServiceContainer** - Arquivo de configuração para o container de serviço. Nele é usado a biblioteca [Pimple](https://pimple.symfony.com/).

* **helpers** - Arquivo com algumas funções de apoio para a aplicação.

* **Application** - Arquivo que serve para inicializar a aplicação.

6. **templates** - Diretório que armazena as views do sistema.

7. **env.example** - Arquivo que contém as variáveis de ambiente do sistema.

8. **migrate-seed** - Arquivo que contém os comandos para gerar as migrações e seeds.

9. **phinx** - Arquivo de configuração da biblioteca [Phinx](https://phinx.org/).