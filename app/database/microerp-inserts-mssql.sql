SET IDENTITY_INSERT categoria ON; 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (1,2,'Vendas de mercadorias'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (2,2,'Vendas de produtos'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (3,2,'Vendas de insumos'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (4,2,'Serviços de manutenção'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (5,2,'Receitas financeiras'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (6,1,'Compras de matérias primas'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (7,1,'Aluguel'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (8,1,'Compras de mercadoria'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (9,1,'Energia Elétrica'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (10,1,'Despesas comerciais'); 

INSERT INTO categoria (id,tipo_conta_id,nome) VALUES (11,1,'Despesas adminstrativas'); 

SET IDENTITY_INSERT categoria OFF; 

SET IDENTITY_INSERT causa ON; 

INSERT INTO causa (id,nome) VALUES (1,'Prego no radiador'); 

INSERT INTO causa (id,nome) VALUES (2,'Falta de manutenção preventiva'); 

INSERT INTO causa (id,nome) VALUES (3,'Falta de troca de bateria'); 

INSERT INTO causa (id,nome) VALUES (4,'Falta de troca de óleo'); 

INSERT INTO causa (id,nome) VALUES (5,'Desgaste natural de componentes'); 

INSERT INTO causa (id,nome) VALUES (6,'Acidente'); 

INSERT INTO causa (id,nome) VALUES (7,'Pane elétrica'); 

INSERT INTO causa (id,nome) VALUES (8,'Pane mecânica'); 

INSERT INTO causa (id,nome) VALUES (9,'Pane hidráulica'); 

SET IDENTITY_INSERT causa OFF; 

SET IDENTITY_INSERT cidade ON; 

INSERT INTO cidade (id,estado_id,nome,codigo_ibge) VALUES (1,1,'Lajeado','4311403'); 

SET IDENTITY_INSERT cidade OFF; 

SET IDENTITY_INSERT conta ON; 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (1,1,1,1,4,null,'2022-07-22','2022-07-10',null,150,1,'',null,null,null); 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (2,1,7,1,4,null,'2022-07-18','2022-07-01',null,1500,null,'',null,null,null); 

INSERT INTO conta (id,tipo_conta_id,categoria_id,forma_pagamento_id,pessoa_id,ordem_servico_id,data_vencimento,data_emissao,data_pagamento,valor,parcela,obs,created_at,updated_at,deleted_at) VALUES (3,1,9,1,4,null,'2022-07-01','2022-07-01','2022-07-01',300,null,'',null,null,null); 

SET IDENTITY_INSERT conta OFF; 

SET IDENTITY_INSERT estado ON; 

INSERT INTO estado (id,nome,sigla,codigo_ibge) VALUES (1,'Rio Grande do Sul','RS','43'); 

SET IDENTITY_INSERT estado OFF; 

SET IDENTITY_INSERT forma_pagamento ON; 

INSERT INTO forma_pagamento (id,nome) VALUES (1,'Dinheiro'); 

INSERT INTO forma_pagamento (id,nome) VALUES (2,'Boleto'); 

INSERT INTO forma_pagamento (id,nome) VALUES (3,'Cartão de crédito'); 

SET IDENTITY_INSERT forma_pagamento OFF; 

SET IDENTITY_INSERT grupo_pessoa ON; 

INSERT INTO grupo_pessoa (id,nome) VALUES (1,'Clientes'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (2,'Vendedores'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (3,'Fornecedores'); 

INSERT INTO grupo_pessoa (id,nome) VALUES (4,'Técnicos'); 

SET IDENTITY_INSERT grupo_pessoa OFF; 

SET IDENTITY_INSERT pessoa ON; 

INSERT INTO pessoa (id,tipo_cliente_id,system_users_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (1,1,null,'Cliente 01','111111111','','(51) 9 9999-9999','cliente@gmail.com','2022-01-01 10:00','2022-06-01 12:00',null); 

INSERT INTO pessoa (id,tipo_cliente_id,system_users_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (2,1,1,'Vendedor 01','111111111','','','',null,null,null); 

INSERT INTO pessoa (id,tipo_cliente_id,system_users_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (3,1,1,'Técnico 01','9999999','','','',null,null,null); 

INSERT INTO pessoa (id,tipo_cliente_id,system_users_id,nome,documento,observacao,telefone,email,created_at,updated_at,deleted_at) VALUES (4,2,null,'Fornecedor 01','123123123','','','',null,null,null); 

SET IDENTITY_INSERT pessoa OFF; 

SET IDENTITY_INSERT pessoa_contato ON; 

INSERT INTO pessoa_contato (id,pessoa_id,nome,email,telefone,observacao,ramal) VALUES (1,1,'João das Neves','joaodasneves@gmail.com','(51) 9 9999-9999','Teste','Ramal 225'); 

SET IDENTITY_INSERT pessoa_contato OFF; 

SET IDENTITY_INSERT pessoa_endereco ON; 

INSERT INTO pessoa_endereco (id,cidade_id,pessoa_id,nome,principal,cep,rua,numero,bairro,complemento) VALUES (1,1,1,'Principal','T','95900-626','General Flores da Cunha','530','Florestal','Ap 01'); 

SET IDENTITY_INSERT pessoa_endereco OFF; 

SET IDENTITY_INSERT pessoa_grupo ON; 

INSERT INTO pessoa_grupo (id,pessoa_id,grupo_pessoa_id) VALUES (1,1,1); 

INSERT INTO pessoa_grupo (id,pessoa_id,grupo_pessoa_id) VALUES (2,3,4); 

SET IDENTITY_INSERT pessoa_grupo OFF; 

SET IDENTITY_INSERT problema ON; 

INSERT INTO problema (id,nome) VALUES (1,'Radiador furado'); 

INSERT INTO problema (id,nome) VALUES (2,'Vazamento de oléo no carter'); 

INSERT INTO problema (id,nome) VALUES (3,'Não dá partida no motor'); 

INSERT INTO problema (id,nome) VALUES (4,'Roda solta'); 

INSERT INTO problema (id,nome) VALUES (5,'Óleo baixo'); 

INSERT INTO problema (id,nome) VALUES (6,'Surdina furada'); 

INSERT INTO problema (id,nome) VALUES (7,'Motor batendo'); 

INSERT INTO problema (id,nome) VALUES (8,'Motor perdendo óleo'); 

INSERT INTO problema (id,nome) VALUES (9,'Amortecedor quebrado'); 

INSERT INTO problema (id,nome) VALUES (10,'Bateria esgotada'); 

SET IDENTITY_INSERT problema OFF; 

SET IDENTITY_INSERT produto ON; 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (1,2,'Hora técnica',100,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (2,1,'Oléo',25,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (3,1,'Filtro de ar',50,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (4,1,'Filtro de oléo',30,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (5,1,'Amortecedor',400,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (6,1,'Rolamento',200,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (7,1,'Mangueira de arrefecimento',150,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (8,1,'Bateria',250,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (9,2,'Retifica de motor',500,'','',null,null,null); 

INSERT INTO produto (id,tipo_produto_id,nome,preco,obs,foto,inserted_at,deleted_at,updated_at) VALUES (10,2,'Balanceamento e geometria',120,'','',null,null,null); 

SET IDENTITY_INSERT produto OFF; 

SET IDENTITY_INSERT solucao ON; 

INSERT INTO solucao (id,nome) VALUES (1,'Reparo'); 

INSERT INTO solucao (id,nome) VALUES (2,'Troca de peça'); 

INSERT INTO solucao (id,nome) VALUES (3,'Troca de componente mecânico'); 

INSERT INTO solucao (id,nome) VALUES (4,'Troca de componente elétrico'); 

INSERT INTO solucao (id,nome) VALUES (5,'Troca de bateria'); 

INSERT INTO solucao (id,nome) VALUES (6,'Troca de filtros'); 

INSERT INTO solucao (id,nome) VALUES (7,'Troca do motor'); 

INSERT INTO solucao (id,nome) VALUES (8,'Troca da distribuição'); 

INSERT INTO solucao (id,nome) VALUES (9,'Troca de outras peças'); 

INSERT INTO solucao (id,nome) VALUES (10,'Troca de bateria'); 

INSERT INTO solucao (id,nome) VALUES (11,'Troca de óleo'); 

INSERT INTO solucao (id,nome) VALUES (12,'Troca de outros fluidos'); 

SET IDENTITY_INSERT solucao OFF; 

INSERT INTO system_group (id,name,uuid) VALUES (1,'Admin',null); 

INSERT INTO system_group (id,name,uuid) VALUES (2,'Standard',null); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (1,1,1); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (2,1,2); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (3,1,3); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (4,1,4); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (5,1,5); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (6,1,6); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (7,1,8); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (8,1,9); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (9,1,11); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (10,1,14); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (11,1,15); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (12,2,10); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (13,2,12); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (14,2,13); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (15,2,16); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (16,2,17); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (17,2,18); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (18,2,19); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (19,2,20); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (20,1,21); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (21,2,22); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (22,2,23); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (23,2,24); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (24,2,25); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (25,1,26); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (26,1,27); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (27,1,28); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (28,1,29); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (29,2,30); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (30,1,31); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (31,1,32); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (32,1,33); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (33,1,34); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (34,1,35); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (35,1,36); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (36,1,37); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (37,1,38); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (38,1,39); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (39,1,40); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (40,1,41); 

INSERT INTO system_group_program (id,system_group_id,system_program_id) VALUES (41,1,42); 

INSERT INTO system_program (id,name,controller) VALUES (1,'System Group Form','SystemGroupForm'); 

INSERT INTO system_program (id,name,controller) VALUES (2,'System Group List','SystemGroupList'); 

INSERT INTO system_program (id,name,controller) VALUES (3,'System Program Form','SystemProgramForm'); 

INSERT INTO system_program (id,name,controller) VALUES (4,'System Program List','SystemProgramList'); 

INSERT INTO system_program (id,name,controller) VALUES (5,'System User Form','SystemUserForm'); 

INSERT INTO system_program (id,name,controller) VALUES (6,'System User List','SystemUserList'); 

INSERT INTO system_program (id,name,controller) VALUES (7,'Common Page','CommonPage'); 

INSERT INTO system_program (id,name,controller) VALUES (8,'System PHP Info','SystemPHPInfoView'); 

INSERT INTO system_program (id,name,controller) VALUES (9,'System ChangeLog View','SystemChangeLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (10,'Welcome View','WelcomeView'); 

INSERT INTO system_program (id,name,controller) VALUES (11,'System Sql Log','SystemSqlLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (12,'System Profile View','SystemProfileView'); 

INSERT INTO system_program (id,name,controller) VALUES (13,'System Profile Form','SystemProfileForm'); 

INSERT INTO system_program (id,name,controller) VALUES (14,'System SQL Panel','SystemSQLPanel'); 

INSERT INTO system_program (id,name,controller) VALUES (15,'System Access Log','SystemAccessLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (16,'System Message Form','SystemMessageForm'); 

INSERT INTO system_program (id,name,controller) VALUES (17,'System Message List','SystemMessageList'); 

INSERT INTO system_program (id,name,controller) VALUES (18,'System Message Form View','SystemMessageFormView'); 

INSERT INTO system_program (id,name,controller) VALUES (19,'System Notification List','SystemNotificationList'); 

INSERT INTO system_program (id,name,controller) VALUES (20,'System Notification Form View','SystemNotificationFormView'); 

INSERT INTO system_program (id,name,controller) VALUES (21,'System Document Category List','SystemDocumentCategoryFormList'); 

INSERT INTO system_program (id,name,controller) VALUES (22,'System Document Form','SystemDocumentForm'); 

INSERT INTO system_program (id,name,controller) VALUES (23,'System Document Upload Form','SystemDocumentUploadForm'); 

INSERT INTO system_program (id,name,controller) VALUES (24,'System Document List','SystemDocumentList'); 

INSERT INTO system_program (id,name,controller) VALUES (25,'System Shared Document List','SystemSharedDocumentList'); 

INSERT INTO system_program (id,name,controller) VALUES (26,'System Unit Form','SystemUnitForm'); 

INSERT INTO system_program (id,name,controller) VALUES (27,'System Unit List','SystemUnitList'); 

INSERT INTO system_program (id,name,controller) VALUES (28,'System Access stats','SystemAccessLogStats'); 

INSERT INTO system_program (id,name,controller) VALUES (29,'System Preference form','SystemPreferenceForm'); 

INSERT INTO system_program (id,name,controller) VALUES (30,'System Support form','SystemSupportForm'); 

INSERT INTO system_program (id,name,controller) VALUES (31,'System PHP Error','SystemPHPErrorLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (32,'System Database Browser','SystemDatabaseExplorer'); 

INSERT INTO system_program (id,name,controller) VALUES (33,'System Table List','SystemTableList'); 

INSERT INTO system_program (id,name,controller) VALUES (34,'System Data Browser','SystemDataBrowser'); 

INSERT INTO system_program (id,name,controller) VALUES (35,'System Menu Editor','SystemMenuEditor'); 

INSERT INTO system_program (id,name,controller) VALUES (36,'System Request Log','SystemRequestLogList'); 

INSERT INTO system_program (id,name,controller) VALUES (37,'System Request Log View','SystemRequestLogView'); 

INSERT INTO system_program (id,name,controller) VALUES (38,'System Administration Dashboard','SystemAdministrationDashboard'); 

INSERT INTO system_program (id,name,controller) VALUES (39,'System Log Dashboard','SystemLogDashboard'); 

INSERT INTO system_program (id,name,controller) VALUES (40,'System Session dump','SystemSessionDumpView'); 

INSERT INTO system_program (id,name,controller) VALUES (41,'Files diff','SystemFilesDiff'); 

INSERT INTO system_program (id,name,controller) VALUES (42,'System Information','SystemInformationView'); 

INSERT INTO system_unit (id,name,connection_name) VALUES (1,'Matriz','matriz'); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (1,1,1); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (2,2,2); 

INSERT INTO system_user_group (id,system_user_id,system_group_id) VALUES (3,1,2); 

INSERT INTO system_user_program (id,system_user_id,system_program_id) VALUES (1,2,7); 

INSERT INTO system_users (id,name,login,password,email,frontpage_id,system_unit_id,active,accepted_term_policy_at,accepted_term_policy) VALUES (1,'Administrator','admin','21232f297a57a5a743894a0e4a801fc3','admin@admin.net',10,null,'Y','',''); 

INSERT INTO system_users (id,name,login,password,email,frontpage_id,system_unit_id,active,accepted_term_policy_at,accepted_term_policy) VALUES (2,'User','user','ee11cbb19052e40b07aac0ca060c23ee','user@user.net',7,null,'Y','',''); 

INSERT INTO system_user_unit (id,system_user_id,system_unit_id) VALUES (1,1,1); 

SET IDENTITY_INSERT tipo_conta ON; 

INSERT INTO tipo_conta (id,nome) VALUES (1,'Pagar'); 

INSERT INTO tipo_conta (id,nome) VALUES (2,'Receber'); 

SET IDENTITY_INSERT tipo_conta OFF; 

SET IDENTITY_INSERT tipo_pessoa ON; 

INSERT INTO tipo_pessoa (id,nome) VALUES (1,'Física'); 

INSERT INTO tipo_pessoa (id,nome) VALUES (2,'Jurídica'); 

SET IDENTITY_INSERT tipo_pessoa OFF; 

SET IDENTITY_INSERT tipo_produto ON; 

INSERT INTO tipo_produto (id,nome) VALUES (1,'Mercadoria'); 

INSERT INTO tipo_produto (id,nome) VALUES (2,'Serviço'); 

SET IDENTITY_INSERT tipo_produto OFF; 
