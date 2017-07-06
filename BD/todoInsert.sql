/* ***** Usuario ***** */
INSERT INTO usuario(nombre, apellidos, password, nombreUsuario, email) VALUES
("pepe", "ApePepe", "pepe", "pepe", "pepe@pepe.com"),
("usuario", "Ausuario", "usuario", "usuario", "usuario@usuario.com"),
("admin", "Aadmin", "admin", "admin", "admin@admin.com");


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

/* ***** Noticia ***** */
INSERT INTO noticia(titulo,	subtitulo, entradilla, fechaCreacion, fechaModificacion, foto, foto1, seccion, autor, cuerpo) VALUES
('El "Daily Telegraph" elige Granada como el 4º mejor destino del mundo en 2017', 
'Invitan a visitar la capital haciendo alusión a los jardines de la Alhambra y al encanto del Albaicín',
'Los expertos en turismo del diario británico eligen a Granada por encima de otros destinos como Nueva Zelanda, Bermudas, ect.',
'2017-03-12', '2017-04-05',
'Granada.jpg', 'Granda.jpg', 1, NULL,
'Los expertos del "Daily Telegraph" han elaborado una lista en la que incluyen los 20 mejores destinos del mundo para visitar en el año 2017 y ha escogido a la ciudad de Granada como el cuarto mejor lugar para viajar. Para argumentar su elección, hacen alusión a los jardines de la Alhambra y a los secretos que esconden los muros de la fortificación, así como las fuentes de azulejos, las pequeñas plazas, las flores que se enredan entre las fachadas del Albaicín o las tapas de sus numerosos bares. Para los autores de la lista de mejores destinos, Sierra Nevada y las Alpujarras son otros de los grandes atractivos de Granada, por la cercanía con la capital y por los paisajes que ofrecen los pueblos alpujarreños en el mes de mayo, cuando las laderas están cubiertas de flores. Además, el Daily Telegraph invita a sus lectores a viajar a Granada, ahora que EasyJet ha lanzado una nueva ruta que enlaza la ciudad de la Alhambra con Londres Gatwick tres veces en semana. Y para aprovechar el viaje, también recomiendan visitar Úbeda y Baeza, así como Fuente Vaqueros, la ciudad natal de Federico García Lorca');

/* ***** Comentario ***** */
INSERT INTO comentario(fecha, ip, texto, usuario, noticia) VALUES
('2017-03-19', "89.45.26.158", "Comentario de la nocitica local", 1, 1);
