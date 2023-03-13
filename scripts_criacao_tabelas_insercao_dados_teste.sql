-- criando a tabela de usuários
create table tbl_usuarios(
	id int not null primary key auto_increment,
	nome varchar(255) not null,
	email varchar(255) not null unique,
	senha varchar(255) not null,
	ativo boolean not null default true
);
-- criando a tabela de tarefas
create table tbl_tarefas(
	id int not null primary key auto_increment,
	titulo varchar(255) not null,
	descricao text not null,
	dataCadastro datetime not null,
	status varchar(255) not null default 'Em andamento',
	usuario_id int not null,
	constraint usuario_id foreign key(usuario_id) references tbl_usuarios(id)
);
-- cadastrando usuários de teste
insert into tbl_usuarios(nome, email, senha) values('Teste 1', 'teste1@gmail.com', '202cb962ac59075b964b07152d234b70'); 
insert into tbl_usuarios(nome, email, senha) values('Teste 2', 'teste2@gmail.com', '202cb962ac59075b964b07152d234b70'); 
insert into tbl_usuarios(nome, email, senha) values('Teste 3', 'teste3@gmail.com', '202cb962ac59075b964b07152d234b70');

select * from tbl_usuarios;

-- cadastrando tarefas de teste
insert into tbl_tarefas(titulo, descricao, usuario_id) values('Título 1', 'Descrição 1', 1);
insert into tbl_tarefas(titulo, descricao, usuario_id) values('Título 2', 'Descrição 2', 1);
insert into tbl_tarefas(titulo, descricao, usuario_id) values('Título 3', 'Descrição 3', 2);

select * from tbl_tarefas;


