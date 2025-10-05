TESTE - DESENVOLVEDOR JR
O teste consiste no desenvolvimento de um CRUD de uma WEB API para o
gerenciamento de uma loja entregando os endpoints para realizar listagem, cadastro,
atualização e remoção de produtos. O candidato deverá também criar dois endpoint
para integrar API de terceiros.
A API deve ser desenvolvida utilizando PHP com Laravel. Para a modelagem do
banco de dados, que pode ser o de sua preferência, utilize a seguinte regra:
id
name
category
status (ACTIVE, INACTIVE)
quantity
created_at
updated_at
deleted_at
Para o endpoint de integração, realize a implementação de dois endpoints, um
que irá listar os itens cadastrados no banco de dados e outro que consulte os
municípios do Rio de Janeiro, utilizando a API do IBGE e realize a inserção em uma
tabela do seu banco de dados.
Salve os dados no banco de dados e caso o endpoint seja chamado mais de uma
vez os itens já cadastrados não devem ser duplicados, para a modelagem do banco de
dados, utilize a seguinte regra:
id
ibge_id
ibge_name
CLIQUE AQUI PARA ACESSAR A API DO IBGE;
Será analisada a qualidade de código, documentação, utilização de patterns,
validações e tratativas de erros, boas práticas, organização, nomenclaturas e
simplicidade.
Ao final do teste envie seu código e banco de dados para um repositório público
para leitura (Github, Bitbucket, Gitlab, etc.) e crie um arquivo README na raiz do projeto
com instruções detalhadas de como executar seu código.
Envie um email para oi@pedidu.com.br com o assunto Teste Backend - [SEU
NOME] contendo o link para o repositório que você criou.
HORA DE CODAR 👨🏻‍💻!