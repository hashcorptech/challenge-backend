## Instalação

1. Clonar repostório e instalar as dependências do composer rodando 
````
composer install
````

2.Rodar o projeto com o servidor do PHP integrado 
````
php -S localhost:8080 index.php
````

## Testes Unitários
Foi desenvolvido alguns testes unitários para validação de algumas features.
Basta rodar na raiz do projeto o comando:

## Windows
````
vendor\bin\phpunit.bat --testdox tests
````

Ou

## Mac OSX/Linux
````
vendor\bin\phpunit --testdox tests
````


## Explicação Técnica
Para a solução do problema, busquei deixar
a implementação limpa e simples. Foram mapeadas os seguintes domínios

1. Invoice
2. Subscription
3. SubscriptionType (Base)
4. SubscriptionTypeMonth (extend SubscriptionType)
5. SubscriptionTypeSemester (extend SubscriptionType)
6. SubscriptionTypeYearly (extend SubscriptionType)
7. User

Analisei que, a maioria das regras girava em torno do tipo de plano
que a assinatura possuía, por isto isolei algumas regras de negócio no domínio de SubscriptionType.
Logo, também verifiquei que existiam os mesmos comportamentos para cada tipo de assinatura, porém,
de formas/conteúdos diferentes, então foi criado uma classe base de SubscriptionType, que detém essas ações
de forma que os demais tipos de assinaturas herdam essas propriedades/métodos, reaproveitando o código 
e expondo por meio de métodos abstratos, contratos públicos garantindo a mesma chamada indiferente do tipo em questão (Se é mensal, semestral ou anual).
Foram aplicados conceitos de Clean Code também :), tal como,
princípio de responsabilidade única e um pouco de DDD, onde os domínios são ricos,
e representam as regras do negócio em si. 

