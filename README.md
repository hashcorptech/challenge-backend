## Desafio: Software Engineer (Backend )

Você será responsável por revisar decisões de design de um software que processa pedidos online.
Estes pedidos são tratados de forma diferente, dependendo das situações especificas de cada um, como apresentado a seguir:

  - Assinatura de serviço: 
    - O sistema precisa disponibilizar o tipo de assinatura (mensal/semestral/anual)
    - No plano mensal o usuario tem 5 dias de teste gratuito
    - No plano semestral o cliente tem 10 dias de teste gratuito
    - no plano anual o cliente tem 15 dias de teste gratuito
    - Ao receber o pagamento pela assinatura o sistema precisa ativar a assinatura e notificar o usuario através de email.
    - Se a assinatura for mensal o sistema deve enviar por email um codigo promocional de desconto de 5% para renovação no plano semestral
    - Se a assinatura for semestral o sistema deve enviar por email um codigo de desconto de 10% para renovação no plano anual
    - Se a assinatura for anual o sistema deve enviar por email um codigo de desconto de 20% para renovação.
    - Faltando 15 dias para expirar qualquer assinatura o sistema deve notificar o usuario por email, para que ele possa renovar a assinatura antes da data de expiração.
    
  - Cancelamento de assinatura:
    - A qualquer momento o usuario pode cancelar sua assinatura.
    - Caso o cliente cancele a assinatura dentro do periodo gratuito, o sistema deve gerar uma fatura com o valor de R$ 0,00
    - Caso o cliente cancele a assinatura fora do periodo gratuito, o sistema deve calcular o valor proporcional e gerar a fatura
    
### O que é necessário fazer?

Você foi designado para prototipar como poderá ser feita a nova versão deste fluxo. A versão atual é frágil, **encadeada em if/else, switch/case**, exigindo modificações grandes a cada nova regra de envio/processamento inserida ou removida.

Crie as classes, métodos e suas respectivas chamadas para tratar os cenários acima (`Assinatura` ou `Cancelamento` - fica a seu critério).

**Não é necessário** criar as implementações para envio de e-mails. Para este caso (email) crie apenas as chamadas de métodos, para indicar que ali seria o local aonde o envio ocorreria.

**Não é necessário** criar banco de dados. Pode utilizar apenas dados __in memory__.

Como a proposta **não requer um código final funcionando**, não há a necessidade de implementar os testes de unidade. Entretanto, levaremos isso como _bonus points_. É permitido o uso de bibliotecas para facilitar a implementação dos testes (somente para testes).

### O que está sob avaliação?

Sua capacidade de analisar, projetar e codificar uma solução guiando-se com **Design Orientado a Objetos** e **Princípios de Orientação a Objetos**.

Por favor, inclua suas considerações da atividade em um arquivo de texto ou markdown.

__O que não vale?__
  - Frameworks :] (aliás, nem precisa)
  - Metaprogramação

__Qual linguagem?__
  - PHP ou Python

__Tempo__
Estima-se 2h30 para este desafio, entretanto não há um limite.

__Apresentação__
  - Código
  - Explicação da solução (em arquivo separado em Markdown/Plain Text)

__Avaliação__

Para nos enviar seu código, você pode:

 - Fazer um fork desse repositório, e nos mandar uma pull-request.
 - Dar acesso ao seu repositório privado no [GitLab](https://gitlab.com) para `hedcler` ou [Bitbucket](https://bitbucket.org) para `hedclerm`.
 - Nos enviar o arquivo compactado por email para: __dev@hashcorp.tech__
