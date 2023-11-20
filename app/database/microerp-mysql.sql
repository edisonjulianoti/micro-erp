CREATE TABLE api_error( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `classe` varchar  (255)   , 
      `metodo` varchar  (255)   , 
      `url` varchar  (500)   , 
      `dados` varchar  (5000)   , 
      `erro_message` varchar  (5000)   , 
      `created_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE categoria( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_conta_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE causa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cep_cache( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cep` varchar  (10)   , 
      `rua` varchar  (255)   , 
      `cidade` varchar  (255)   , 
      `bairro` varchar  (255)   , 
      `codigo_ibge` varchar  (100)   , 
      `uf` varchar  (2)   , 
      `cidade_id` int   , 
      `estado_id` int   , 
      `created_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE cidade( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `estado_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `codigo_ibge` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE conta( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_conta_id` int   NOT NULL  , 
      `categoria_id` int   NOT NULL  , 
      `forma_pagamento_id` int   NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `ordem_servico_id` int   , 
      `data_vencimento` date   , 
      `data_emissao` date   , 
      `data_pagamento` date   , 
      `valor` double   , 
      `parcela` int   , 
      `obs` text   , 
      `created_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE estado( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `sigla` varchar  (2)   NOT NULL  , 
      `codigo_ibge` varchar  (10)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE forma_pagamento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE grupo_pessoa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE orcamento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `data_orcamento` date   , 
      `valor` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE orcamento_produtos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `orcamento_id` int   NOT NULL  , 
      `produto_id` int   NOT NULL  , 
      `quantidade` double   , 
      `valor` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE orcamento_servicos( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `orcamento_id` int   NOT NULL  , 
      `produto_id` int   NOT NULL  , 
      `valor` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cliente_id` int   NOT NULL  , 
      `descricao` text   NOT NULL  , 
      `data_inicio` date   , 
      `data_fim` date   , 
      `data_prevista` date   , 
      `valor_total` double   , 
      `mes` char  (2)   , 
      `ano` char  (4)   , 
      `mes_ano` char  (8)   , 
      `inserted_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico_atendimento( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tecnico_id` int   NOT NULL  , 
      `ordem_servico_id` int   NOT NULL  , 
      `solucao_id` int   , 
      `causa_id` int   , 
      `problema_id` int   , 
      `data_atendimento` date   , 
      `horario_inicial` time   , 
      `horario_final` time   , 
      `obs` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE ordem_servico_item( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `ordem_servico_id` int   NOT NULL  , 
      `produto_id` int   NOT NULL  , 
      `quantidade` double   , 
      `desconto` double   , 
      `valor` double   , 
      `valor_total` double   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_cliente_id` int   NOT NULL  , 
      `system_users_id` int   , 
      `nome` varchar  (255)   NOT NULL  , 
      `documento` varchar  (20)   , 
      `observacao` varchar  (500)   , 
      `telefone` varchar  (20)   , 
      `email` varchar  (255)   , 
      `created_at` datetime   , 
      `updated_at` datetime   , 
      `deleted_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_contato( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `nome` varchar  (255)   , 
      `email` varchar  (255)   , 
      `telefone` varchar  (20)   , 
      `observacao` varchar  (500)   , 
      `ramal` varchar  (100)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_endereco( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `cidade_id` int   NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `principal` varchar  (1)     DEFAULT 'F', 
      `cep` varchar  (10)   NOT NULL  , 
      `rua` varchar  (255)   NOT NULL  , 
      `numero` varchar  (100)   NOT NULL  , 
      `bairro` varchar  (255)   NOT NULL  , 
      `complemento` varchar  (255)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE pessoa_grupo( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `pessoa_id` int   NOT NULL  , 
      `grupo_pessoa_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE problema( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE produto( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `tipo_produto_id` int   NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
      `preco` double   NOT NULL  , 
      `obs` text   , 
      `foto` text   , 
      `inserted_at` datetime   , 
      `deleted_at` datetime   , 
      `updated_at` datetime   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE solucao( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_group( 
      `id` int   NOT NULL  , 
      `name` text   NOT NULL  , 
      `uuid` varchar  (36)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_group_program( 
      `id` int   NOT NULL  , 
      `system_group_id` int   NOT NULL  , 
      `system_program_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_preference( 
      `id` varchar  (255)   NOT NULL  , 
      `preference` text   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_program( 
      `id` int   NOT NULL  , 
      `name` text   NOT NULL  , 
      `controller` text   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_unit( 
      `id` int   NOT NULL  , 
      `name` text   NOT NULL  , 
      `connection_name` text   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_user_group( 
      `id` int   NOT NULL  , 
      `system_user_id` int   NOT NULL  , 
      `system_group_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_user_program( 
      `id` int   NOT NULL  , 
      `system_user_id` int   NOT NULL  , 
      `system_program_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_users( 
      `id` int   NOT NULL  , 
      `name` text   NOT NULL  , 
      `login` text   NOT NULL  , 
      `password` text   NOT NULL  , 
      `email` text   , 
      `frontpage_id` int   , 
      `system_unit_id` int   , 
      `active` char  (1)   , 
      `accepted_term_policy_at` text   , 
      `accepted_term_policy` char  (1)   , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE system_user_unit( 
      `id` int   NOT NULL  , 
      `system_user_id` int   NOT NULL  , 
      `system_unit_id` int   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_conta( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_pessoa( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

CREATE TABLE tipo_produto( 
      `id`  INT  AUTO_INCREMENT    NOT NULL  , 
      `nome` varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

 
  
 ALTER TABLE categoria ADD CONSTRAINT fk_categoria_1 FOREIGN KEY (tipo_conta_id) references tipo_conta(id); 
ALTER TABLE cidade ADD CONSTRAINT fk_cidade_1 FOREIGN KEY (estado_id) references estado(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_1 FOREIGN KEY (tipo_conta_id) references tipo_conta(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_2 FOREIGN KEY (categoria_id) references categoria(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_3 FOREIGN KEY (forma_pagamento_id) references forma_pagamento(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_4 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE conta ADD CONSTRAINT fk_conta_5 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE orcamento ADD CONSTRAINT fk_orcamento_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE orcamento_produtos ADD CONSTRAINT fk_orcamento_produtos_1 FOREIGN KEY (orcamento_id) references orcamento(id); 
ALTER TABLE orcamento_produtos ADD CONSTRAINT fk_orcamento_produtos_2 FOREIGN KEY (produto_id) references produto(id); 
ALTER TABLE orcamento_servicos ADD CONSTRAINT fk_orcamento_servicos_1 FOREIGN KEY (orcamento_id) references orcamento(id); 
ALTER TABLE orcamento_servicos ADD CONSTRAINT fk_orcamento_servicos_2 FOREIGN KEY (produto_id) references produto(id); 
ALTER TABLE ordem_servico ADD CONSTRAINT fk_ordem_servico_1 FOREIGN KEY (cliente_id) references pessoa(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_2 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_3 FOREIGN KEY (solucao_id) references solucao(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_4 FOREIGN KEY (causa_id) references causa(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_5 FOREIGN KEY (problema_id) references problema(id); 
ALTER TABLE ordem_servico_atendimento ADD CONSTRAINT fk_ordem_servico_atendimento_5 FOREIGN KEY (tecnico_id) references pessoa(id); 
ALTER TABLE ordem_servico_item ADD CONSTRAINT fk_ordem_servico_item_1 FOREIGN KEY (ordem_servico_id) references ordem_servico(id); 
ALTER TABLE ordem_servico_item ADD CONSTRAINT fk_ordem_servico_item_2 FOREIGN KEY (produto_id) references produto(id); 
ALTER TABLE pessoa ADD CONSTRAINT fk_pessoa_1 FOREIGN KEY (tipo_cliente_id) references tipo_pessoa(id); 
ALTER TABLE pessoa ADD CONSTRAINT fk_pessoa_2 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE pessoa_contato ADD CONSTRAINT fk_pessoa_contato_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_endereco ADD CONSTRAINT fk_pessoa_endereco_1 FOREIGN KEY (cidade_id) references cidade(id); 
ALTER TABLE pessoa_endereco ADD CONSTRAINT fk_pessoa_endereco_2 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_grupo ADD CONSTRAINT fk_pessoa_grupo_1 FOREIGN KEY (pessoa_id) references pessoa(id); 
ALTER TABLE pessoa_grupo ADD CONSTRAINT fk_pessoa_grupo_2 FOREIGN KEY (grupo_pessoa_id) references grupo_pessoa(id); 
ALTER TABLE produto ADD CONSTRAINT fk_produto_1 FOREIGN KEY (tipo_produto_id) references tipo_produto(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
