/* ***** Rol ***** */
INSERT INTO rol VALUES
(1, "Registrado"),
(2, "Redactor"),
(3, "Editor Jefe"),
(4, "Administrador");

/* ***** Usuario ***** */
INSERT INTO usuario(nombre, apellidos, password, nombreUsuario, email, rol) VALUES
("Pepe", "ApePepe", "pepe", "Pepe", "pepe@pepe.com", 2),
("Usuario", "Ausuario", "usuario", "Usuario", "usuario@usuario.com", 1),
("Juan", "ApeJuan", "juan", "Juan", "juan@juan.com", 1),
("Paco", "ApeFran", "paco", "Paco", "paco@paco.com", 1),
("admin", "Aadmin", "admin", "Admin", "admin@admin.com", 4),
("redactor", "redactor", "redactor", "redactor", "redactor@redactor.com", 3);


/* ***** Secciones ***** */
INSERT INTO seccion(nombre, ruta) VALUES
("Local", "local"),
("Deportes", "deportes"),
("Economía", "economia"),
("Política", "politica");

INSERT INTO seccion(nombre, ruta, subseccion) VALUES
("Fútbol", "futbol", 2),
("Baloncesto", "baloncesto", 2),
("Nieve", "nieve", 2);
