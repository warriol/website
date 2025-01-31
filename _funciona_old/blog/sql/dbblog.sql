

    CREATE TABLE `usuarios` (
    `idUsuario` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `usuario` VARCHAR( 50 ) NOT NULL ,
    `password` CHAR( 32 ) NOT NULL ,
    `email` VARCHAR( 50 ) NOT NULL ,
    `tipo` ENUM( 'comun', 'admin' ) NOT NULL DEFAULT 'comun'
    ) ENGINE = MYISAM ;





    CREATE TABLE `noticias` (
    `idNoticia` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `titulo` VARCHAR( 50 ) NOT NULL ,
    `copete` VARCHAR( 255 ) NOT NULL ,
    `cuerpo` TEXT NOT NULL ,
    `idUsuario` INT( 11 ) NOT NULL ,
    `idCategoria` INT( 11 ) NOT NULL ,
    `fPublicacion` TIMESTAMP NOT NULL ,
    `fCreacion` TIMESTAMP NOT NULL ,
    `fModificacion` TIMESTAMP NOT NULL
    ) ENGINE = MYISAM ;





    CREATE TABLE `categorias` (
    `idCategoria` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `valor` VARCHAR( 50 ) NOT NULL
    ) ENGINE = MYISAM ;



	CREATE TABLE `comentarios` (
	`idComentario` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`comentario` VARCHAR( 255 ) NOT NULL ,
	`idUsuario` INT( 11 ) UNSIGNED NOT NULL ,
	`idNoticia` INT( 11 ) UNSIGNED NOT NULL ,
	`estado` ENUM( 'sin validar', 'apto' ) NOT NULL DEFAULT 'sin validar',
	`fCreacion` TIMESTAMP NOT NULL
	) ENGINE = MYISAM ;