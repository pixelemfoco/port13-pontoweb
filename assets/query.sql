Table: registros
Columns:
id_do_ponto int(11) AI PK 
nome varchar(100) 
data date 
entrada time 
saida_almoco time 
volta_almoco time 
saida time 
cod_funcionario varchar(45) 
ativo tinyint(4)





Table: TbUsuariosGeral
Columns:
id int(11) AI PK 
nome varchar(255) 
email varchar(255) 
senha varchar(255) 
genero enum('Masculino','Feminino','Outro') 
telefone varchar(20) 
whatsapp varchar(20) 
cpf varchar(14) 
data_nascimento date 
data_cadastro timestamp 
ultimo_login timestamp 
status tinyint(1) 
nivel_acesso tinyint(1) 
cod_funcionario varchar(45) 
foto_perfil varchar(200) 
reset_token varchar(255) 
reset_token_expira datetime