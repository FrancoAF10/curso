CREATE DATABASE Cursos;
USE Cursos;

CREATE TABLE CATEGORIA
(
	idCategoria	        INT AUTO_INCREMENT PRIMARY KEY,
    categoria 			VARCHAR(40) 	NOT NULL
)ENGINE = INNODB;

CREATE TABLE CURSOS
(
	idCursos 		    INT AUTO_INCREMENT PRIMARY KEY,
    titulo 			    VARCHAR(40)         NOT NULL,
    duracionHoras 		INT                 NOT NULL,
    nivel 		        VARCHAR(30)	        NOT NULL,
    precio              DECIMAL(6,2)        NOT NULL,
    fechaInicio         DATE,
    idCategoria         INT,
CONSTRAINT fk_idcategoria FOREIGN KEY (idCategoria) REFERENCES CATEGORIA (idCategoria)
)ENGINE = INNODB;


-- Creamos la vista de los cursos

CREATE VIEW vista_cursos
AS
	SELECT
		CS.idCursos,
        CT.categoria,
        CS.titulo,
        CS.duracionHoras,
        CS.nivel,
        CS.precio,
        CS.fechaInicio
    FROM CURSOS CS
    INNER JOIN CATEGORIA CT ON CS.idCategoria = CT.idCategoria
    ORDER BY CS.idCursos;

-- Creamos la funcion para la inserción del nuevo registro

DELIMITER //
CREATE PROCEDURE spu_registrar_cursos(

    IN _titulo 	            VARCHAR(40),
    IN _duracionHoras 	    INT,
    IN _nivel 		        VARCHAR(30),
    IN _precio 		        DECIMAL(6,2),
    IN _fechaInicio 		DATE,
    IN _idCategoria			INT
)
BEGIN
	INSERT INTO CURSOS (titulo, duracionHoras, nivel , precio , fechaInicio,idCategoria) 
		VALUES
        (_titulo, _duracionHoras, _nivel, _precio,_fechaInicio,_idCategoria);
END //
