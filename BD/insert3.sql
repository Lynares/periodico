/* ***** Comentario ***** */
INSERT INTO comentario(fecha, ip, texto, usuario, noticia) VALUES
('2017-03-19 10:10:10', "89.45.26.158", "Comentario de la nocitica local", 1, 1),
('2017-02-19 10:11:10', "89.50.26.158", "Comentario de la nocitica 2", 1, 1),
('2017-02-19 10:11:10', "89.50.26.158", "Comentario de la nocitica", 2, 2);

/* ***** Palabras Prohibidas ****** */
INSERT INTO palabra(palabra) VALUES
("tres"),
("algo"),
("hola"),
("adios"),
("ocho"),
("falacia"),
("diez"),
("pole");

/* ***** Publicidad ****** */
INSERT INTO publicidad(texto, img, enlace, click, prioridad) VALUES
(NULL, "once.jpg", "https://www.juegosonce.es/", 0, 0),
(NULL, "amarillas.jpg", "http://www.amarillasinternet.com/", 0, 0);
