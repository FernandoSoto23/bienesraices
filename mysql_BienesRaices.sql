
use bienesraices;

create table propiedades(
	id int not null primary key auto_increment,
    titulo varchar(150),
    precio decimal(12,2),
    imagen varchar(200),
    descripcion varchar(200),
    habitaciones int,
    wc int,
    estacionamiento int,
    creado date,
    vendedor int not null references vendedores(id) on delete no action on update no action
);



create table vendedores(
	id int not null primary key auto_increment,
    nombre varchar(120),
    apellido varchar(120),
    telefono varchar(10)
);

select * from vendedores 	

select * from propiedades 

select *  from propiedades limit 3

insert into vendedores(nombre,apellido,telefono) 
values('Fernando','Soto','6681515406')


create table usuario(
	id int not null primary key auto_increment,
	email varchar(50) not null unique,
	pwd  char(60) not null
);

select * from usuario



