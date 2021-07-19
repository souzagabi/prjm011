CREATE DATABASE  IF NOT EXISTS `prjm011` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prjm011`;
-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: prjm011
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping events for database 'prjm011'
--

--
-- Dumping routines for database 'prjm011'
--
/*!50003 DROP PROCEDURE IF EXISTS `prc_classificacao_sel` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_classificacao_sel`()
BEGIN
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
    SELECT * FROM PRJM011005 ORDER BY descricao;
    
    IF EX = 1 THEN
		SET MESSAGE = "ERROR: Falha no filtro da Classificação!!" ;
        SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Cliente cadastrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_cliente_lista` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_cliente_lista`(
	par_nrocelular varchar(11)
)
BEGIN
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
	SET @sql = concat('SELECT * FROM PRJM011002 PRJM002  ');
	SET @sql = concat(@sql, '	INNER JOIN PRJM011001 PRJM001 ON PRJM001.pessoa_id = PRJM002.pessoa_id ');
	SET @sql = concat(@sql, '	INNER JOIN PRJM011003 PRJM003 ON PRJM003.pessoa_id = PRJM002.pessoa_id ');
	SET @sql = concat(@sql, '	INNER JOIN PRJM011004 PRJM004 ON PRJM004.pessoa_id = PRJM002.pessoa_id  ');
	SET @sql = concat(@sql, '	INNER JOIN PRJM011005 PRJM005 ON PRJM005.classificacao_id = PRJM002.classificacao_id ');
	SET @sql = concat(@sql, ' WHERE PRJM005.classificacao_id > 0  ');
	SET @sql = concat(@sql, '	AND PRJM001.situacao = 0 ');
    
    IF par_nrocelular IS NOT NULL THEN
		SET @sql = concat(@sql, '	AND PRJM0003.nrocelular = ',par_nrocelular);
    END IF;
    
	SET @sql = concat(@sql, ' ORDER BY PRJM002.pessoa_id; ');
        
	PREPARE STMT FROM @sql;
    EXECUTE STMT;
    SELECT @sql;
	IF EX = 1 THEN
		SET MESSAGE = "ERROR: Erro ao filtrar Clientes!!" ;
        SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Clientes filtrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_cliente_save` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_cliente_save`(
	par_usuario_id INT(11),
	par_nome varchar(256),
	par_nrocelular varchar(11),
	par_classificacao_id int(11)
)
BEGIN
	DECLARE par_numcelular, par_pessoa_id INT;
    
    
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
    SELECT pessoa_id INTO par_pessoa_id FROM PRJM011003 WHERE nrocelular = par_nrocelular;
    
    IF par_pessoa_id IS NULL THEN
		INSERT INTO PRJM011001 (dtcadastro) VALUES (now());
        SET par_pessoa_id = LAST_INSERT_ID();
        
        INSERT INTO PRJM011002 (pessoa_id, usuario_id, nome, classificacao_id) VALUES (par_pessoa_id, par_usuario_id, par_nome, par_classificacao_id);
        IF EX = 1 THEN
			SET MESSAGE = "ERROR: Não foi possível salvar os dados do cliente!!" ;
		ELSE
			INSERT INTO PRJM011003 (pessoa_id, nrocelular) VALUES (par_pessoa_id, par_nrocelular);
			IF EX = 1 THEN
				SET MESSAGE = "ERROR: Não foi possível salvar o elefone do cliente!!" ;
			END IF ;
        END IF ;
	ELSE
		SET EX = 1;
		IF EX = 1 THEN
			SET MESSAGE = "ERROR: Esse telefone já está cadastrado!!" ;
		END IF ;
    END IF;
    IF EX = 1 THEN
		SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Cliente cadastrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_cliente_selectById` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_cliente_selectById`(
	par_pessoa_id int(11)
)
BEGIN
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
    SELECT * FROM PRJM011002 PRJM002 
		INNER JOIN PRJM011001 PRJM001 ON PRJM001.pessoa_id = PRJM002.pessoa_id 
		INNER JOIN PRJM011003 PRJM003 ON PRJM003.pessoa_id = PRJM002.pessoa_id 
	WHERE PRJM002.pessoa_id = par_pessoa_id;
    
    IF EX = 1 THEN
		SET MESSAGE = "ERROR: Erro ao filtrar Cliente!!" ;
        SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Cliente cadastrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_cliente_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_cliente_update`(
	par_usuario_id int(11),
	par_pessoa_id int(11),
	par_celular_id int(11),
	par_nome varchar(256),
	par_nrocelular varchar(11),
	par_classificacao_id int(11)
)
BEGIN
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
	
    UPDATE PRJM011002
	SET
		usuario_id 			= par_usuario_id,
		nome 				= par_nome,
		classificacao_id 	= par_classificacao_id
	WHERE pessoa_id = par_pessoa_id;
    
    IF EX = 1 THEN
		SET MESSAGE = "ERROR: Erro ao atualizar os dados dos Cliente!!" ;
	ELSE
		UPDATE PRJM011003
        SET
			nrocelular = par_nrocelular
		WHERE celular_id = par_celular_id;
        SET MESSAGE = "ERROR: Erro ao atualizar o celular do Cliente!!" ;
        
    END IF;
    
    IF EX = 1 THEN
		SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Dados do Cliente atualizado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_pessoa_save` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_pessoa_save`(
	par_usuario INT(11),
	par_nome varchar(256),
	par_nrocelular varchar(11),
	par_email varchar(64),
	par_classificacao_id int(11),
	par_situacao char(1),
	par_login varchar(64),
	par_senha varchar(64),
	par_inadmin char(1)
)
BEGIN
	DECLARE par_numcelular, par_pessoa_id INT;
    
    
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
    SELECT nrocelular INTO par_numcelular FROM PRJM011003 WHERE nrocelular = par_nrocelular;
    
    IF par_numcelular IS NULL THEN
		INSERT INTO PRJM011001 (dtcadastro) VALUES (now());
        SET par_pessoa_id = LAST_INSERT_ID();
        
        INSERT INTO PRJM011002 (pessoa_id, usuario_id, nome, classificacao_id) VALUES (par_pessoa_id, par_usuario_id, par_nome, par_classificacao_id);
        IF EX = 1 THEN
			SET MESSAGE = "ERROR: Não foi possível salvar os dados do cliente!!" ;
		ELSE
			INSERT INTO PRJM011003 (pessoa_id, nrocelular) VALUES (par_pessoa_id, par_nrocelular);
			IF EX = 1 THEN
				SET MESSAGE = "ERROR: Não foi possível salvar o elefone do cliente!!" ;
			END IF ;
        END IF ;
    END IF;
    IF EX = 1 THEN
		SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Cliente cadastrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `prc_user_update` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `prc_user_update`(
	par_usuario_id int(11),
	par_pessoa_id int(11),
	par_login varchar(64),
	par_senha varchar(64),
	par_inadmin int(11)
)
BEGIN
	DECLARE MESSAGE varchar(1000);
    DECLARE EX SMALLINT DEFAULT 0;
	DECLARE CONTINUE HANDLER FOR SQLEXCEPTION SET EX = 1;
    DECLARE EXIT HANDLER FOR 1062 SELECT  "ERROR: ERRO de duplicidade do ID." AS MESSAGE;
	DECLARE CONTINUE HANDLER FOR SQLSTATE '23000' SELECT 'ERROR: Erro no código SQL.' AS MESSAGE;
    START TRANSACTION;
    
    
    IF EX = 1 THEN
		SELECT MESSAGE;
		ROLLBACK;
	ELSE
		SET MESSAGE = "SUCCESS: Cliente cadastrado com sucesso!!" ;
        SELECT MESSAGE;
		COMMIT;
	END IF;
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-19 17:48:21
