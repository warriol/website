

    CREATE TABLE `usuarios` (
                                `idUsuario` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
                                `email` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL COMMENT 'Nombre de usuario para iniciar sesion.',
                                `password` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
                                `nombre` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
                                `tipo` ENUM( 'comun', 'admin' ) NOT NULL DEFAULT 'comun'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    INSERT INTO `usuarios` (`tipo`, `email`, `password`, `usuario`) VALUES
        ( 'admin', 'warriol@gmail.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'Wilson Denis');



    CREATE TABLE `noticias` (
    `idNoticia` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `titulo` VARCHAR( 50 ) NOT NULL ,
    `copete` VARCHAR( 255 ) NOT NULL ,
    `cuerpo` TEXT NOT NULL ,
    `idUsuario` INT( 11 ) NOT NULL ,
    `idCategoria` INT( 11 ) NOT NULL ,
    `fPublicacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `fCreacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `fModificacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
    `fCreacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	) ENGINE = MYISAM ;