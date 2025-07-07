CREATE TABLE veiculos(
	id SERIAL PRIMARY KEY,
	marca VARCHAR(50),
	modelo VARCHAR(50),
	placa VARCHAR(7),
	ano SMALLINT,
	cor VARCHAR(25),
	tipo VARCHAR(50),
	status VARCHAR(50) 
);

CREATE TABLE marcas(
	id SERIAL PRIMARY KEY,
	nome VARCHAR(50),
	anofundacao SMALLINT,
	pais VARCHAR(50),
	ativo BOOLEAN
);

CREATE TABLE tipos(
	id SERIAL PRIMARY KEY,
	nome VARCHAR(50),
	categoria VARCHAR(100)
);
