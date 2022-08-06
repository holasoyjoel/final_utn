CREATE TABLE Clientes
(
    id INT(11) AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni INT(8) UNIQUE NOT NULL,
    sexo ENUM("m" , "f") NOT NULL,
    telefono VARCHAR(20) NULL,
    direccion VARCHAR(100) NOT NULL,
    CONSTRAINT pk_cliente PRIMARY KEY (id)
);

CREATE TABLE Personales
(	
    id INT(11) AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni INT(8) UNIQUE NOT NULL,
    sexo ENUM("m" , "f") NOT NULL,
    telefono VARCHAR(20) NULL,
    direccion VARCHAR(100) NOT NULL,
    CONSTRAINT pk_personal PRIMARY KEY (id)
);


CREATE TABLE Trabajos
(
    id INT(11) AUTO_INCREMENT,
    idCliente INT(11),
    idPersonal INT(11),
    titulo VARCHAR(50) NOT NULL,
    descripcion LONTEXT(1000) NOT NULL,
    fecha DATE NOT NULL,
    CONSTRAINT pk_trabajo PRIMARY KEY(id),
    CONSTRAINT fk_cliente FOREIGN KEY(idCliente) REFERENCES Clientes(id),
    CONSTRAINT fk_personal FOREIGN KEY(idPersonal) REFERENCES Personales(id)
);