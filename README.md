Aconselhável criar um diretório raiz pois serão clonadas 3 imagens que precisam estar no mesmo nível para uma instalação
mais rápida, caso contrário será necessário configurar todos apontamentos dentro de cada imagem (.env)

-my-directory

- ┣ 📂basis
- ┣ 📂basisFrontVue2
- ┗ 📂laradock``

### 1-Clonar imagem “laradock”

$``git clone https://github.com/laradock/laradock``

### 2-Clonar imagem “basisFrontVue2”

$``git clone git@github.com:mayckol/basisFrontVue2.git``

### 3-Clonar imagem “basis”

$``git clone git@github.com:mayckol/basis.git``

_____________________________________________________________________________ 

#### Construção da imagem e subida do container para o Vue

$``` cd basisFrontVue2```

$``` yarn install```

	ou 

$```npm install```(alternativa)

$```docker-compose up -d```

#### Construção da imagem e subida do container para o Laradock

##### (PHP, laravel, mysql, phpmyadmin)

____________________________________________________________ 

#### Configurar vhost

127.0.0.1 test.basis.com

_____________________________________________________________________________ 

$```cd ../basis/```

#### Duplicar o arquivo .env.example e renomear para .env

#### Gerar as chaves pelo artisan

$```php artisan key:generate```

#### Instalar as dependências

$```composer install```

_____________________________________________________________________________ 

$```cd ../laradock/```

#### Localizar o arquivo .env na raiz do diretório “laradock” e substituí-lo pelo que está no diretório "enviroments” na raiz do projeto do laravel “basis”.

#### Localizar o arquivo “basis.conf” que está no diretório "enviroments” na raíz do diretório do laravel e adiciona-lo em laradock/nginx/sites/basis.conf

#### Atenção ao escolher as imagens corretas, pois existem muitas outras que poderão ser construídas caso não seja especificado.

### Na primeira vez o processo poderá demorar um pouco
$```docker-compose up -d nginx mysql phpmyadmin```

http://test.basis.com:80 Api

http://test.basis.com:1010 phpmyadmin

http://test.basis.com:8306 Mysql

phpmyadmin acaba sendo opcional

_____________________________________________________________________________ 

#### Gerar chaves do ouath

$```docker-compose exec --user=laradock workspace bash```

$```cd basis```

$```php artisan migrate --seed```

$```php artisan passport:install --force```

Saída

Client ID: 1

Client secret: Gxt2rVEdMwSqkm4K0L9dDBGpuIxuAMYq95dhGWBI

Password grant client created successfully.

Client ID: 2

Client secret: FZIRogwX2stSPPTnMWI5iWCdBv14ZAG0teqwQgzF

#### Adicionar o id e chave ao arquivo .env

PASSPORT_CLIENT_ID PASSPORT_CLIENT_SECRET

PASSPORT_CLIENT_ID=2 PASSPORT_CLIENT_SECRET=FZIRogwX2stSPPTnMWI5iWCdBv14ZAG0teqwQgzF

_____________________________________________________________________________ 

 
