/* ***** Publicidad ***** */
CREATE TABLE publicidad(
	id		INT PRIMARY KEY AUTO_INCREMENT,
	texto	VARCHAR(500),
	img		VARCHAR(50),
	enlace	VARCHAR(100),
	click	INT,
	prioridad INT
);

/* ***** Rol ***** */
CREATE TABLE rol(
	id		INT PRIMARY KEY,
	rol	VARCHAR(50)
);

/* ***** Usuario ***** */
CREATE TABLE usuario(
	id			INT PRIMARY KEY AUTO_INCREMENT,
	nombre		VARCHAR(50),
	apellidos 	VARCHAR(50),
	password	VARCHAR(30),
	nombreUsuario	VARCHAR(20),
	email		VARCHAR(30),
	rol			INT,
	FOREIGN KEY (rol) REFERENCES rol(id)
);


/* ***** Seccion ***** */
CREATE TABLE seccion(
	id			INT PRIMARY KEY AUTO_INCREMENT,
	nombre		VARCHAR(30),
	ruta 		VARCHAR(30),
	subseccion	INT
);
ALTER TABLE seccion ADD FOREIGN KEY (subseccion) REFERENCES seccion(id);


/* ***** Noticia ***** */
CREATE TABLE noticia(
	id			INT PRIMARY KEY AUTO_INCREMENT,
	titulo		VARCHAR(300),
	subtitulo	VARCHAR(300),
	entradilla	VARCHAR(300),
	fechaCreacion	DATETIME,
	fechaModificacion	DATETIME,
	foto		VARCHAR(50),
	foto1		VARCHAR(50),
	estado	VARCHAR(50),
	cuerpo		VARCHAR(5000),
	seccion		INT,
	autor		INT,
	prioridad INT,
	FOREIGN KEY (seccion) REFERENCES seccion(id),
	FOREIGN KEY (autor) REFERENCES usuario(id)
);


/* ***** Comentario ***** */
CREATE TABLE comentario(
	id		INT PRIMARY KEY AUTO_INCREMENT,
	fecha	DATETIME,
	ip		VARCHAR(24),
	texto	VARCHAR(500),
	usuario	INT,
	noticia	INT,
	FOREIGN KEY (usuario) REFERENCES usuario(id),
	FOREIGN KEY (noticia) REFERENCES noticia(id)
);

/* ***** Palabra ***** */
CREATE TABLE palabra(
	id		INT PRIMARY KEY AUTO_INCREMENT,
	palabra	VARCHAR(50)
);
