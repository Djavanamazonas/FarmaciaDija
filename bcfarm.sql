create database if not exists bcfarm;
use bcfarm;

create table if not exists adm (
    id int auto_increment primary key,
    usuario varchar(50) not null unique,
    senha varchar(255) not null 
);

insert into adm (usuario, senha) values ('dija', '1234');

create table medicamentos (
    id int auto_increment primary key,
    nome varchar(255) not null,
    preco decimal(10, 2) not null, 
    quantidade int not null,
    categoria varchar(100) not null,
    validade date not null
);

insert into medicamentos (nome, preco, quantidade, categoria, validade) values
('Dorax 25mg', 250.00, 15, 'analgésico', '2027-09-01'),
('Algenon', 45.00, 5, 'analgésico', '2026-12-18'),
('Relaxon', 580.00, 3, 'analgésico', '2031-06-22'),
('Febrix', 18.00, 40, 'antipirético', '2026-09-12'),
('Inflatex', 35.00, 18, 'anti-inflamatório', '2024-12-31'),
('Cefalexina', 95.00, 28, 'antibiótico', '2029-03-18'),
('Pressolax', 180.00, 22, 'antihipertensivo', '2025-05-10'),
('Gastrolax', 30.00, 10, 'antiácido', '2026-08-05'),
('Lipidex', 130.00, 8, 'anticolesterol', '2025-01-20');
