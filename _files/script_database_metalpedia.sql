/*databasename = dbmetalpedia */

/*sequence for table country*/
CREATE SEQUENCE seq_country;
/*create table country*/
CREATE TABLE country (
  id_country INTEGER NOT NULL DEFAULT NEXTVAL ('seq_country'),
  name_country VARCHAR(80) NOT NULL,
  iso_country CHAR(2) NOT NULL,
  iso3_country CHAR(3) NOT NULL,
  flag_country VARCHAR(50) NOT NULL,
  CONSTRAINT pk_country PRIMARY KEY (id_country),
  CONSTRAINT uc_country UNIQUE (iso_country, iso3_country)
);

/*sequence for table genre*/
CREATE SEQUENCE seq_genre;
/*create table genre*/
CREATE TABLE genre (
  id_genre INTEGER NOT NULL DEFAULT NEXTVAL ('seq_genre'),
  name_genre VARCHAR(50) NOT NULL,
  CONSTRAINT pk_genre PRIMARY KEY (id_genre)
);

/*sequence for table band*/
CREATE SEQUENCE seq_band;
/*create table band*/
CREATE TABLE band (
  id_band INTEGER NOT NULL DEFAULT NEXTVAL ('seq_band'),
  name_band VARCHAR(100) NOT NULL,
  bio_band TEXT,
  logo_band VARCHAR(80),
  photo_band VARCHAR(80),
  id_country INTEGER NOT NULL,
  id_genre INTEGER NOT NULL,
  CONSTRAINT pk_band PRIMARY KEY (id_band),
  CONSTRAINT fk_band_country FOREIGN KEY (id_country) REFERENCES country (id_country),
  CONSTRAINT fk_band_genre FOREIGN KEY (id_genre) REFERENCES genre (id_genre)
);

/*create enum album_type*/
CREATE TYPE album_type AS ENUM (
	'Demo',
	'Single',
	'Compilation',
	'EP',
	'Live Album',
	'Studio Album'
);

/*sequence for table album*/
CREATE SEQUENCE seq_album;
/*create table album*/
CREATE TABLE album (
  id_album INTEGER NOT NULL DEFAULT NEXTVAL ('seq_album'),
  name_album VARCHAR(100) NOT NULL,
  release_date DATE NOT NULL,
  cover_album VARCHAR(80),
  album_type ALBUM_TYPE NOT NULL,
  id_band INTEGER NOT NULL,
  CONSTRAINT pk_album PRIMARY KEY (id_album),
  CONSTRAINT fk_album_band FOREIGN KEY (id_band) REFERENCES band (id_band),
);

/*sequence for table song*/
CREATE SEQUENCE seq_song;
/*create table song*/
CREATE TABLE song (
  id_song INTEGER NOT NULL DEFAULT NEXTVAL ('seq_song'),
  name_song VARCHAR(100) NOT NULL,
  number_song INTEGER NOT NULL,
  length_song TIME NOT NULL,
  lyrics_song TEXT,
  id_album INTEGER NOT NULL,
  CONSTRAINT pk_song PRIMARY KEY (id_song),
  CONSTRAINT fk_song_album FOREIGN KEY (id_album) REFERENCES album (id_album)
);

/*sequence for table user*/
CREATE SEQUENCE seq_user;
/*create table users*/
CREATE TABLE users (
  id_user INTEGER NOT NULL DEFAULT NEXTVAL ('seq_user'),
  name_user VARCHAR(100) NOT NULL,
  gender_user CHAR(1) NOT NULL, /*M - Masculino; F - Feminino*/
  avatar_user TEXT,
  type_user CHAR(1) NOT NULL DEFAULT 'U', /*A - Admin; U - User; M - Moderator*/
  status_user CHAR(1) NOT NULL DEFAULT 'I', /*A: active; I:inactive*/
	email_user VARCHAR (50) NOT NULL,
	password_user TEXT NOT NULL,
	CONSTRAINT pk_user PRIMARY KEY (id_user),
	CONSTRAINT un_email_user UNIQUE (email_user)
);
