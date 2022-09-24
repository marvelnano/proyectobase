/*INSERT INTO usuario(
    idusuario, nombre_completo, email, usuario, password, clave_inicial, 
	foto, estado, usuariocrea, fechacrea)

SELECT 
 	idusuario+1,
	'editor', 'editor', 'editor', 
    '$2a$07$asxx54ahjppf45sd87a5au6fAHIlFrQ7jQ4XHf7fycZYUNBysO4Bq', 'editor', 
	'vistas/img/perfiles/849.png', 1, '202201', NOW()
FROM usuario
SELECT IF(idnegocio = '',CONCAT(YEAR(NOW()),'0001'),idnegocio+1) FROM */

/*** TRIGGERS PARA IDS AUINCREMTAL ***/
--para usuario
DELIMITER $$
CREATE TRIGGER tg_insert_usuario
BEFORE INSERT ON usuario
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM usuario) = 0   THEN
        SET NEW.idusuario = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idusuario = (SELECT MAX(idusuario)+1 FROM usuario);
  END IF;
END$$
DELIMITER ;

INSERT INTO usuario(nombre_completo, email, usuario, password, clave_inicial, foto, estado, usuariocrea, fechacrea)
VALUES('editor', 'editor', 'editor', '$2a$07$asxx54ahjppf45sd87a5au6fAHIlFrQ7jQ4XHf7fycZYUNBysO4Bq', 'editor', 
	'vistas/img/perfiles/849.png', 1, '202201', NOW());

--para nivel_usuario
DELIMITER $$
CREATE TRIGGER tg_insert_nivelusuario
BEFORE INSERT ON nivel_usuario
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM nivel_usuario) = 0   THEN
        SET NEW.idnivelusuario = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idnivelusuario = (SELECT MAX(idnivelusuario)+1 FROM nivel_usuario);
  END IF;
END$$
DELIMITER ;

INSERT INTO nivel_usuario(descripcion, estado, usuariocrea, fechacrea) 
VALUES('Editor',1,'202201',NOW());

--para rubro_negocio
DELIMITER $$
CREATE TRIGGER tg_insert_rubronegocio
BEFORE INSERT ON rubro_negocio
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM rubro_negocio) = 0   THEN
        SET NEW.idrubronegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idrubronegocio = (SELECT MAX(idrubronegocio)+1 FROM rubro_negocio);
  END IF;
END$$
DELIMITER ;

INSERT INTO rubro_negocio(descripcion, estado, usuariocrea, fechacrea) 
VALUES('Hotel',1,'202201',NOW());

--para negocio
DELIMITER $$
CREATE TRIGGER tg_insert_negocio
BEFORE INSERT ON negocio
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM negocio) = 0   THEN
        SET NEW.idnegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idnegocio = (SELECT MAX(idnegocio)+1 FROM negocio);
  END IF;
END$$
DELIMITER ;

INSERT INTO negocio(idrubronegocio, ruc, razon_social, estado, usuariocrea, fechacrea)
VALUES('20220001','12345678901','Empresa',1,'202201',NOW());

--para proyecto
DELIMITER $$
CREATE TRIGGER tg_insert_proyecto
BEFORE INSERT ON proyecto
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM proyecto) = 0   THEN
        SET NEW.idproyecto = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idproyecto = (SELECT MAX(idproyecto)+1 FROM proyecto);
  END IF;
END$$
DELIMITER ;

INSERT INTO proyecto(idubigeo, estado, usuariocrea, fechacrea)
VALUES('2022000001',1,'202201',NOW());

--para codigo_usuario_negocio
DELIMITER $$
CREATE TRIGGER tg_insert_codigo_usuario_negocio
BEFORE INSERT ON codigo_usuario_negocio
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM codigo_usuario_negocio) = 0   THEN
        SET NEW.idcodigousuarionegocio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idcodigousuarionegocio = (SELECT MAX(idcodigousuarionegocio)+1 FROM codigo_usuario_negocio);
  END IF;
END$$
DELIMITER ;

INSERT INTO codigo_usuario_negocio(idusuario, idnegocio, estado, usuariocrea, fechacrea)
VALUES('20220001','20220001',1,'202201',NOW());

--para plantilla_web_seccion
DELIMITER $$
CREATE TRIGGER tg_insert_plantilla_web_seccion
BEFORE INSERT ON plantilla_web_seccion
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_seccion) = 0   THEN
        SET NEW.idplantillawebseccion = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebseccion = (SELECT MAX(idplantillawebseccion)+1 FROM plantilla_web_seccion);
  END IF;
END$$
DELIMITER ;

INSERT INTO plantilla_web_seccion(descripcion, estado, usuariocrea, fechacrea) 
VALUES('web_Hotel',1,'202201',NOW());

--para plantilla_web_area_portfolio
DELIMITER $$
CREATE TRIGGER tg_insert_plantilla_web_area_portfolio
BEFORE INSERT ON plantilla_web_area_portfolio
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_area_portfolio) = 0   THEN
        SET NEW.idplantillawebareaportfolio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebareaportfolio = (SELECT MAX(idplantillawebareaportfolio)+1 FROM plantilla_web_area_portfolio);
  END IF;
END$$
DELIMITER ;

INSERT INTO plantilla_web_area_portfolio(descripcion, estado, usuariocrea, fechacrea) 
VALUES('web_Hotel_portfolio',1,'202201',NOW());

--para plantilla_web
DELIMITER $$
CREATE TRIGGER tg_insert_plantilla_web
BEFORE INSERT ON plantilla_web
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM plantilla_web) = 0   THEN
        SET NEW.idplantillaweb = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillaweb = (SELECT MAX(idplantillaweb)+1 FROM plantilla_web);
  END IF;
END$$
DELIMITER ;

INSERT INTO plantilla_web(idnegocio, idplantillawebseccion, estado, usuariocrea, fechacrea) 
VALUES('20220001','20220001',1,'202201',NOW());

--para plantilla_web_portfolio
DELIMITER $$
CREATE TRIGGER tg_insert_plantilla_web_portfolio
BEFORE INSERT ON plantilla_web_portfolio
FOR EACH ROW
BEGIN
    if (SELECT COUNT(*) FROM plantilla_web_portfolio) = 0   THEN
        SET NEW.idplantillawebportfolio = CONCAT(YEAR(NOW()),'0001');
    else
        SET NEW.idplantillawebportfolio = (SELECT MAX(idplantillawebportfolio)+1 FROM plantilla_web_portfolio);
  END IF;
END$$
DELIMITER ;

INSERT INTO plantilla_web_portfolio(idplantillaweb, idplantillawebareaportfolio, estado, usuariocrea, fechacrea) 
VALUES('20220001','20220001',1,'202201',NOW());



-----------------------------
toastr.error("Llenar todos los campos obligatorios");

toastr.success("Datos se guardaron correctamente.","Aviso del Sistema:");
					$(".tablaNivelUsuario").DataTable().ajax.reload();
					$("#modalAgregarRubro").modal('hide');
					
toastr.success("Datos se actualizaron correctamente.","Aviso del Sistema:");
					$(".tablaNivelUsuario").DataTable().ajax.reload();
					$("#modalEditarRubro").modal('hide');