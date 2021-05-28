ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password
BY '14Laurita';

--
-- Table structure for table folders
--

DROP TABLE IF EXISTS folders;

CREATE TABLE folders (
  fld_id BIGINT NOT NULL AUTO_INCREMENT,
  fld_name VARCHAR(255) NOT NULL,
  fld_width INT NOT NULL,
  fld_left INT NOT NULL,
  fld_top INT NOT NULL,
  fld_icon INT NOT NULL,
  fld_father BIGINT NULL,
  fld_path VARCHAR(4000) NOT NULL,
  PRIMARY KEY (fld_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('Home', 96, 50, 100, 1, null, "Desktop");
insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('My Files', 96, 50, 200, 2, 1, "Desktop#Home");
insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('My Music', 96, 150, 100, 3, 1, "Desktop#Home");
insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('My Images', 96, 150, 200, 4, 1, "Desktop#Home");
insert into folders(fld_name, fld_width, fld_left, fld_top, fld_icon, fld_father, fld_path) values ('My Videos', 96, 250, 100, 5, 1, "Desktop#Home");

--
-- Table structure for table files
--

DROP TABLE IF EXISTS files;

CREATE TABLE files (
  fl_id BIGINT NOT NULL AUTO_INCREMENT,
  fl_name VARCHAR(255) NOT NULL,
  fl_width INT NOT NULL,
  fl_left INT NOT NULL,
  fl_top INT NOT NULL,
  fl_icon INT NOT NULL,
  fl_folder_id BIGINT NULL,
  PRIMARY KEY (fl_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into files(fl_name, fl_width, fl_left, fl_top, fl_icon, fl_folder_id) values ('My Videos', 96, 250, 200, 6, 1);

--
-- Table structure for table file_contents
--

DROP TABLE IF EXISTS file_contents;

CREATE TABLE file_contents (
  fl_id BIGINT NOT NULL AUTO_INCREMENT,
  fl_content VARCHAR(4000) NOT NULL,
  PRIMARY KEY (fl_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into file_contents(fl_content) values ('<h2>Hola Mundo</h2><p>Este es un ejemplo de fichero</p>');

--
-- Table structure for table usuario
--

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
  username VARCHAR(255) NOT NULL DEFAULT '',
  token VARCHAR(12) DEFAULT NULL,
  password VARCHAR(255) DEFAULT NULL,
  email VARCHAR(255) DEFAULT NULL,
  nombre VARCHAR(255) DEFAULT NULL,
  apellidos VARCHAR(255) DEFAULT NULL,
  idioma INT DEFAULT NULL,
  maxdirs INT DEFAULT NULL,
  maxfiles INT DEFAULT NULL,
  pendienteconfirmacion TINYINT DEFAULT NULL,
  coderegistro VARCHAR(255) DEFAULT NULL,
  fecha_ultimo_acceso DATETIME DEFAULT NULL,
  PRIMARY KEY (username)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

insert into usuarios values('mdelgado','', 'mdelgado','mdelgado@cc.es','Mario','Delgado Picazo',0,100, 100, 0, '', now());
update usuarios set password=md5(password) where username='mdelgado';
