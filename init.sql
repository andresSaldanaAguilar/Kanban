DROP DATABASE IF EXISTS proyectoISW;
CREATE DATABASE proyectoISW;
USE proyectoISW;

CREATE TABLE usuario(
    idUsuario INT NOT NULL PRIMARY KEY auto_increment,
    userName VARCHAR(100),
    Nombre VARCHAR(100),
    ApPaterno VARCHAR(100),
    ApMaterno VARCHAR(100), 
    Correo VARCHAR(100),
    Contrasena VARCHAR(100)
);

CREATE TABLE portafolio(
    idPortafolio INT NOT NULL PRIMARY KEY auto_increment,
    Portafolio VARCHAR(100),
    Estado INT,
    FechaCreacion DATE,
    Swag VARCHAR(100),
    idUsuario INT,
    FOREIGN KEY(idUsuario) REFERENCES usuario(idUsuario)
    ON DELETE cascade ON UPDATE cascade
); 

CREATE TABLE miembrouserport(
    idUsuario INT NOT NULL,
    idPortafolio INT NOT NULL,
    PRIMARY KEY(idUsuario,idPortafolio),
    FOREIGN KEY(idUsuario) REFERENCES usuario(idUsuario)
    ON DELETE cascade ON UPDATE cascade,
    FOREIGN KEY(idPortafolio) REFERENCES portafolio(idPortafolio)
    ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE tablero(
    idTablero INT NOT NULL PRIMARY KEY auto_increment,
    Nombre VARCHAR(100),
    idPortafolio INT,
    FOREIGN KEY(idPortafolio) REFERENCES portafolio(idPortafolio)
    ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE colaborausertab(
    idUsuario INT NOT NULL,
    idTablero INT NOT NULL,
    PRIMARY KEY(idUsuario,idTablero),
    FOREIGN KEY(idUsuario) REFERENCES usuario(idUsuario)
    ON DELETE cascade ON UPDATE cascade,
    foreign key(idTablero) references tablero(idTablero)
    ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE columna(
    idColumna INT NOT NULL PRIMARY KEY auto_increment,
    Nombre VARCHAR(100),
    NumColumna INT,
    LimitesWIP INT,
    TipoColumna VARCHAR(100),
    idTablero INT,
    FOREIGN KEY(idTablero) REFERENCES tablero(idTablero)
    ON DELETE cascade ON UPDATE cascade
);

CREATE TABLE tarea(
    idTarea INT NOT NULL PRIMARY KEY auto_increment,
    Swag VARCHAR(100),
    FechaMod DATE,
    ValorNegocios INT,
    Titulo VARCHAR(100),
    Prioridad VARCHAR(100),
    Estado VARCHAR(100),
    FechaCreacion DATE,
    TipoTarea VARCHAR(100),
    Progreso VARCHAR(100),
    idColumna INT,
    idTablero INT,
    idUsuario INT,
    FOREIGN KEY(idColumna) REFERENCES columna(idColumna)
    ON DELETE cascade ON UPDATE cascade,
    FOREIGN KEY(idTablero) REFERENCES tablero(idTablero)
    ON DELETE cascade ON UPDATE cascade,
    FOREIGN KEY(idUsuario) REFERENCES usuario(idUsuario)
    ON DELETE cascade ON UPDATE cascade
);

INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('juandanielcr','Juan Daniel','Castillo','Reyes','castilloreyesjuan@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('antoniord','Antonio','Ramírez','De la Cruz Aguilar','antonio666@hotmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('melisale','Melisa','Luciano','Espino','meluciano@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('miguelangelat','Miguel Angel','Angeles','Torres','miguelangeles10@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('almagr','Alma','Garcia','Romero','romerogarciaalma@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('monicaao','Monica Alejandra','Argott','Ocampo','argottocampomonica@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('dianamb','Diana Laura','Mendoza','Banda','mendozabandadiana@gmail.com','pass123');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('rociops','Rocío','Palacios','Solano','palaciossolano@gmail.com','pass213');
INSERT INTO usuario(userName, Nombre, ApPaterno, ApMaterno, Correo, Contrasena) 
VALUES('brendarm','Brenda','Roxana','Mercado','roxanamercadobrenda@gmail.com','pass123');

INSERT INTO portafolio(Portafolio, Estado, FechaCreacion, Swag, idUsuario) 
VALUES('Calmecac',1,'2016-02-14','Descripción de Calmecac',1);
INSERT INTO portafolio(Portafolio, Estado, FechaCreacion, Swag, idUsuario) 
VALUES('Vive tu futuro',2,'2017-02-14','Descripción de Vive tu futuro',1);
INSERT INTO portafolio(Portafolio, Estado, FechaCreacion, Swag, idUsuario) 
VALUES('TT',2,'2018-02-14','Descripción de TT',2);
INSERT INTO portafolio(Portafolio, Estado, FechaCreacion, Swag, idUsuario) 
VALUES('ESCOM',1,'2019-02-14','Descripción de ESCOM',3);
INSERT INTO portafolio(Portafolio, Estado, FechaCreacion, Swag, idUsuario) 
VALUES('Nautilus',3,'2016-01-01','Descripción de Nautilus',4);

INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(1,1);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(1,2);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(1,3);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(1,4);

INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(2,1);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(2,5);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(2,6);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(2,7);

INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(3,2);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(3,5);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(3,1);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(3,7);

INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(4,3);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(4,4);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(4,2);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(4,7);

INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(5,4);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(5,5);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(5,6);
INSERT INTO miembrouserport(idPortafolio, idUsuario) VALUES(5,7);

INSERT INTO tablero(Nombre, idPortafolio) VALUES('Análisis',1);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Desarrollo',1);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Pruebas',1);

INSERT INTO tablero(Nombre, idPortafolio) VALUES('Frontend',2);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Backend',2);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Diseño',2);

INSERT INTO tablero(Nombre, idPortafolio) VALUES('Software',3);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Hardware',3);

INSERT INTO tablero(Nombre, idPortafolio) VALUES('Materias',4);

INSERT INTO tablero(Nombre, idPortafolio) VALUES('Desarollo',5);
INSERT INTO tablero(Nombre, idPortafolio) VALUES('Cotización',5);

INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(1,1);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(2,1);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(3,2);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(4,3);

INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(1,4);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(5,4);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(6,5);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(7,6);

INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(2,7);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(5,7);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(1,8);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(7,8);

INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(3,9);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(4,9);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(2,9);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(7,9);

INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(4,10);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(5,10);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(6,11);
INSERT INTO colaborausertab(idUsuario, idTablero) VALUES(7,11);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Minutas', 1, 10, 1, 1);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Contratos', 2, 10, 1, 1);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Documento técnico', 3, 10, 2, 1);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Maqueta', 1, 10, 1, 1);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Programación Casos de Uso', 2, 10, 1, 2);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Base de datos', 3, 10, 1, 2);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Manuales', 1, 10, 1, 3);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Test', 2, 10, 1, 3);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('React', 1, 10, 1, 4);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Docs', 2, 10, 2, 4);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Django', 1, 10, 2, 5);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Spring', 2, 10, 1, 5);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Vectores', 1, 10, 2, 6);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Diseños', 2, 10, 2, 6);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Micrservicios', 1, 10, 1, 7);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('App Android', 2, 10, 1, 7);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Encapsulado', 1, 10, 2, 8);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Sensor', 2, 10, 1, 8);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('BDD', 1, 10, 1, 9);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Redes 3', 2, 10, 2, 9);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Blog', 1, 10, 1, 10);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Página', 2, 10, 2, 10);

INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Precios', 1, 10, 2, 11);
INSERT INTO columna(Nombre, NumColumna, LimitesWIP, TipoColumna, idTablero) VALUES ('Host', 2, 10, 1, 11); 

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Redactar minutas de la junta del Lunes','2018-02-20','2018-02-20',10, 'Pendiente', 'Tipo tarea', '50%', 'Descripción de la redaccion de minutas para la junta','Alta', 1, 1,1);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Solicitar firmas de las minutas pasadas','2018-02-21','2018-02-21',10, 'Pendiente', 'Tipo tarea', '0%', 'Los responsables de cada área deben firmar las minutas','Alta', 1, 1,2);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Imprimir mintuas de las siguientes reuniones','2018-02-20','2018-02-20',10, 'Pendiente', 'Tipo tarea', '80%', 'Imprimir minutas para la siguiente junta','Alta', 1, 1,2);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Respaldar contratos','2018-02-18','2018-02-18',9, 'Terminada', 'Tipo tarea', '100%', 'Descripción de como respaldar los contratos','Alta', 2, 1,3);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Revisar contratos con los proveedores','2018-02-17','2018-02-17',8, 'En curso', 'Tipo tarea', '0%', 'Descripción de como revisar contratos con los proveedores','Media', 2, 1,3);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Renegociar contrato con el cliente','2018-02-16','2018-02-16',6, 'Terminada', 'Tipo tarea', '100%', 'Descripción de como renegociar contrato con el cliente','Baja', 2, 1,4);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Crear plantilla en Latex para el documento técnico','2018-02-22','2018-02-18',9, 'Terminada', 'Tipo tarea', '100%', 'Descripción de como crear plantilla en Latex para el documento técnico','Alta', 3, 1,3);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Resolver problemas con SVN','2018-02-20','2018-02-17',8, 'En curso', 'Tipo tarea', '0%', 'Descripción de como resolver problemas con SVN','Media', 3, 1,3);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Aprobar la maqueta de la última versión','2018-02-21','2018-02-16',6, 'Terminada', 'Tipo tarea', '100%', 'Descripción de como renegociar contrato con el cliente','Baja', 4, 1,4);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Programación de casos de uso por parte de los desarrolladores','2018-02-22','2018-02-18',5, 'Pendiente', 'Tipo tarea', '0%', 'Descripcion de la programación de casos de uso por parte de los desarrolladores','Alta', 5, 2,1);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Repartir casos de uso entre los desarrolladores','2018-02-20','2018-02-20',8, 'En curso', 'Tipo tarea', '20%', 'Descripción de como repartir casos de uso entre los desarrolladores','Alta', 5, 2,5);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Actualizar el estado de los casos de uso anteriores','2018-02-23','2018-02-23',10, 'Pendiente', 'Tipo tarea', '0%', 'Descripción de como actualizar estado de los casos de uso anteriores','Alta', 5, 2,6);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Generar Script para el llenado de la BD','2018-02-24','2018-02-24',7, 'Pendiente', 'Tipo tarea', '0%', 'Descripición de como generar Script para el llenado de la BD','Alta', 6, 2,7);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Realizar dump de la BD','2018-02-25','2018-02-25',8, 'En curso', 'Tipo tarea', '20%', 'Descripción de como realizar dump de la BD','Alta', 6, 2,7);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Crear Manuales de usuario','2018-02-22','2018-02-18',5, 'Pendiente', 'Tipo tarea', '80%', 'Descripción crear Manuales de usuario','Alta', 7, 3,1);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Envíar manuales de usuario','2018-02-20','2018-02-20',8, 'En curso', 'Tipo tarea', '20%', 'Descripción envíar manuales de usuario','Media', 7, 3,5);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Aprender ReactJS','2018-02-23','2018-02-23',10, 'Pendiente', 'Tipo tarea', '50%', 'Descripción Aprender ReactJS','Baja', 9, 4,3);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Organizar los documentos','2018-02-24','2018-02-24',7, 'Pendiente', 'Tipo tarea', '50%', 'Descripción Organizar los documentos','Media', 10, 4,4);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Subir la última versión de Django','2018-02-25','2018-02-25',6, 'En curso', 'Tipo tarea', '20%', 'Descripción Subir la última versión de Django','Alta', 11, 5,2);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Continuar curso de Spring','2018-02-26','2018-02-26',5, 'En Pendiente', 'Tipo tarea', '20%', 'Descripción Continuar curso de Spring','Baja', 12, 5,5);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Revisar vectores del diseñador','2018-02-27','2018-02-27',8, 'En curso', 'Tipo tarea', '20%', 'Descripción Revisar vectores del diseñador','Alta', 13, 6,6);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Integrar diseños a la pagina','2018-02-28','2018-02-28',8, 'Pendiente', 'Tipo tarea', '20%', 'Descripción Integrar diseños a la pagina','Baja', 14, 6,2);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Revisar contendores de microservicios','2018-02-28','2018-02-28',10, 'En curso', 'Tipo tarea', '20%', 'Descripción Revisar contendores de microservicios ','Alta', 15, 7,6);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Continuar app android','2018-02-25','2018-02-28',9, 'Pendiente', 'Tipo tarea', '20%', 'Descripción Continuar app android','Alta', 16, 7,7);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Empezar encapsulado','2018-02-24','2018-02-27',7, 'En curso', 'Tipo tarea', '20%', 'Descripción Empezar encapsulado','Media', 17, 8,4);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Comprar sensor','2018-02-25','2018-02-25',8, 'Terminada', 'Tipo tarea', '100%', 'Descripción Comprar sensor','Media', 18, 8,5);

INSERT INTO tarea(Titulo, FechaCreacion, FechaMod, ValorNegocios, Estado, TipoTarea, Progreso, Swag, Prioridad, idColumna, idTablero, idUsuario)
VALUES ('Tarea de DDB','2018-02-24','2018-02-25',10, 'En curso', 'Tipo tarea', '20%', 'Descripción Tarea de DDB','Alta', 19, 9,6);
