PRAGMA foreign_keys=OFF; 

CREATE TABLE api_error( 
      id  INTEGER    NOT NULL  , 
      classe varchar  (255)   , 
      metodo varchar  (255)   , 
      url varchar  (500)   , 
      dados varchar  (5000)   , 
      erro_message varchar  (5000)   , 
      created_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE categoria( 
      id  INTEGER    NOT NULL  , 
      tipo_conta_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_conta_id) REFERENCES tipo_conta(id)) ; 

CREATE TABLE causa( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cep_cache( 
      id  INTEGER    NOT NULL  , 
      cep varchar  (10)   , 
      rua varchar  (255)   , 
      cidade varchar  (255)   , 
      bairro varchar  (255)   , 
      codigo_ibge varchar  (100)   , 
      uf varchar  (2)   , 
      cidade_id int   , 
      estado_id int   , 
      created_at datetime   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE cidade( 
      id  INTEGER    NOT NULL  , 
      estado_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(estado_id) REFERENCES estado(id)) ; 

CREATE TABLE conta( 
      id  INTEGER    NOT NULL  , 
      tipo_conta_id int   NOT NULL  , 
      categoria_id int   NOT NULL  , 
      forma_pagamento_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      ordem_servico_id int   , 
      data_vencimento date   , 
      data_emissao date   , 
      data_pagamento date   , 
      valor double   , 
      parcela int   , 
      obs text   , 
      created_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_conta_id) REFERENCES tipo_conta(id),
FOREIGN KEY(categoria_id) REFERENCES categoria(id),
FOREIGN KEY(forma_pagamento_id) REFERENCES forma_pagamento(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id)) ; 

CREATE TABLE estado( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
      codigo_ibge varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE forma_pagamento( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE grupo_pessoa( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE orcamento( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      data_orcamento date   , 
      valor double   , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE orcamento_produtos( 
      id  INTEGER    NOT NULL  , 
      orcamento_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      quantidade double   , 
      valor double   , 
 PRIMARY KEY (id),
FOREIGN KEY(orcamento_id) REFERENCES orcamento(id),
FOREIGN KEY(produto_id) REFERENCES produto(id)) ; 

CREATE TABLE orcamento_servicos( 
      id  INTEGER    NOT NULL  , 
      orcamento_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      valor double   , 
 PRIMARY KEY (id),
FOREIGN KEY(orcamento_id) REFERENCES orcamento(id),
FOREIGN KEY(produto_id) REFERENCES produto(id)) ; 

CREATE TABLE ordem_servico( 
      id  INTEGER    NOT NULL  , 
      cliente_id int   NOT NULL  , 
      descricao text   NOT NULL  , 
      data_inicio date   , 
      data_fim date   , 
      data_prevista date   , 
      valor_total double   , 
      mes char  (2)   , 
      ano char  (4)   , 
      mes_ano char  (8)   , 
      inserted_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(cliente_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ordem_servico_atendimento( 
      id  INTEGER    NOT NULL  , 
      tecnico_id int   NOT NULL  , 
      ordem_servico_id int   NOT NULL  , 
      solucao_id int   , 
      causa_id int   , 
      problema_id int   , 
      data_atendimento date   , 
      horario_inicial text   , 
      horario_final text   , 
      obs text   , 
 PRIMARY KEY (id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id),
FOREIGN KEY(solucao_id) REFERENCES solucao(id),
FOREIGN KEY(causa_id) REFERENCES causa(id),
FOREIGN KEY(problema_id) REFERENCES problema(id),
FOREIGN KEY(tecnico_id) REFERENCES pessoa(id)) ; 

CREATE TABLE ordem_servico_item( 
      id  INTEGER    NOT NULL  , 
      ordem_servico_id int   NOT NULL  , 
      produto_id int   NOT NULL  , 
      quantidade double   , 
      desconto double   , 
      valor double   , 
      valor_total double   , 
 PRIMARY KEY (id),
FOREIGN KEY(ordem_servico_id) REFERENCES ordem_servico(id),
FOREIGN KEY(produto_id) REFERENCES produto(id)) ; 

CREATE TABLE pessoa( 
      id  INTEGER    NOT NULL  , 
      tipo_cliente_id int   NOT NULL  , 
      system_users_id int   , 
      nome varchar  (255)   NOT NULL  , 
      documento varchar  (20)   NOT NULL  , 
      observacao varchar  (500)   , 
      telefone varchar  (20)   , 
      email varchar  (255)   , 
      created_at datetime   , 
      updated_at datetime   , 
      deleted_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_cliente_id) REFERENCES tipo_pessoa(id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE pessoa_contato( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      nome varchar  (255)   , 
      email varchar  (255)   , 
      telefone varchar  (20)   , 
      observacao varchar  (500)   , 
      ramal varchar  (100)   , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE pessoa_endereco( 
      id  INTEGER    NOT NULL  , 
      cidade_id int   NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      principal varchar  (1)     DEFAULT 'F', 
      cep varchar  (10)   NOT NULL  , 
      rua varchar  (255)   NOT NULL  , 
      numero varchar  (100)   NOT NULL  , 
      bairro varchar  (255)   NOT NULL  , 
      complemento varchar  (255)   , 
 PRIMARY KEY (id),
FOREIGN KEY(cidade_id) REFERENCES cidade(id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id)) ; 

CREATE TABLE pessoa_grupo( 
      id  INTEGER    NOT NULL  , 
      pessoa_id int   NOT NULL  , 
      grupo_pessoa_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(pessoa_id) REFERENCES pessoa(id),
FOREIGN KEY(grupo_pessoa_id) REFERENCES grupo_pessoa(id)) ; 

CREATE TABLE problema( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE produto( 
      id  INTEGER    NOT NULL  , 
      tipo_produto_id int   NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
      preco double   NOT NULL  , 
      obs text   , 
      foto text   , 
      inserted_at datetime   , 
      deleted_at datetime   , 
      updated_at datetime   , 
 PRIMARY KEY (id),
FOREIGN KEY(tipo_produto_id) REFERENCES tipo_produto(id)) ; 

CREATE TABLE solucao( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      uuid varchar  (36)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_preference( 
      id varchar  (255)   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      connection_name text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_user_program( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_users( 
      id int   NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      accepted_term_policy_at text   , 
      accepted_term_policy char  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_user_unit( 
      id int   NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id)) ; 

CREATE TABLE tipo_conta( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_pessoa( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE tipo_produto( 
      id  INTEGER    NOT NULL  , 
      nome varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 