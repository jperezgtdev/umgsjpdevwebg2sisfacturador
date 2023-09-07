-- -----------------------------------------------------
-- Schema facturador
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema facturador
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `facturador` DEFAULT CHARACTER SET utf8 ;
USE `facturador` ;

-- -----------------------------------------------------
-- Table `facturador`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(12) NULL,
  `nit` VARCHAR(15) NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_cliente`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Rol` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `rol` VARCHAR(45) NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Persona` (
  `id_persona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `DPI` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `fecha_crear` DATE NULL,
  `usario_crear` INT NOT NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` INT NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_persona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_rol` INT NOT NULL,
  `id_persona` INT NOT NULL,
  `usuario` VARCHAR(45) NULL,
  `clave` VARCHAR(45) NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_usuario_rol1_idx` (`id_rol` ASC) VISIBLE,
  INDEX `fk_usuario_persona1_idx` (`id_persona` ASC) VISIBLE,
  CONSTRAINT `fk_usuario_rol1`
    FOREIGN KEY (`id_rol`)
    REFERENCES `facturador`.`Rol` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `facturador`.`Persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `categoria` VARCHAR(45) NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Producto` (
  `id_producto` INT NOT NULL AUTO_INCREMENT,
  `id_categoria` INT NOT NULL,
  `producto` VARCHAR(45) NULL,
  `existencia` INT NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_producto`),
  INDEX `fk_producto_categoria1_idx` (`id_categoria` ASC) VISIBLE,
  CONSTRAINT `fk_producto_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `facturador`.`Categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Factura` (
  `id_factura` INT NOT NULL AUTO_INCREMENT,
  `referencia` VARCHAR(20) NULL,
  `id_cliente` INT NOT NULL,
  `fecha` VARCHAR(45) NULL,
  `serie` VARCHAR(45) NULL,
  `numero` VARCHAR(45) NULL,
  `authorization` VARCHAR(45) NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_factura`),
  INDEX `fk_factura_cliente1_idx` (`id_cliente` ASC) VISIBLE,
  CONSTRAINT `fk_factura_cliente1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `facturador`.`Cliente` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Detalle_Factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Detalle_Factura` (
  `id_producto` INT NOT NULL,
  `id_factura` INT NOT NULL,
  `cantidad` VARCHAR(45) NULL,
  `precio` FLOAT NULL,
  PRIMARY KEY (`id_producto`, `id_factura`),
  INDEX `fk_detalle_factura_factura1_idx` (`id_factura` ASC) VISIBLE,
  CONSTRAINT `fk_detalle_factura_producto1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `facturador`.`Producto` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_factura_factura1`
    FOREIGN KEY (`id_factura`)
    REFERENCES `facturador`.`Factura` (`id_factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Proveedor` (
  `id_proveedor` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `nit` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_proveedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Compra` (
  `id_compra` INT NOT NULL AUTO_INCREMENT,
  `id_producto` INT NOT NULL,
  `id_proveedor` INT NOT NULL,
  `cantidad` VARCHAR(45) NULL,
  `precio_compra` VARCHAR(45) NULL,
  `fecha_crear` DATE NULL,
  `usuario_crear` VARCHAR(45) NULL,
  `fecha_mod` DATE NULL,
  `usuario_mod` VARCHAR(45) NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`id_compra`),
  INDEX `fk_compra_producto1_idx` (`id_producto` ASC) VISIBLE,
  INDEX `fk_compra_proveedor1_idx` (`id_proveedor` ASC) VISIBLE,
  CONSTRAINT `fk_compra_producto1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `facturador`.`Producto` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compra_proveedor1`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `facturador`.`Proveedor` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `facturador`.`Sesiones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `facturador`.`Sesiones` (
  id_sesion INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  token VARCHAR(255) NOT NULL,
  fecha_creacion DATETIME NOT NULL,
  fecha_actualizacion DATETIME NOT NULL,
  FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    ON DELETE CASCADE
    ON UPDATE CASCADE
)
ENGINE = InnoDB;



INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES (1, 'Papel');
INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES (2, 'Libros');
INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES (3, 'Cuadernos');
INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES (4, 'Lapicero');
INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES (5, 'Organizacion');

INSERT INTO `rol` (`id_rol`, `rol`) VALUES (1, 'Administrador');
INSERT INTO `rol` (`id_rol`, `rol`) VALUES (2, 'Usuario');

INSERT INTO `persona` (`id_persona`, `nombre`, `DPI`, `direccion`, `telefono`, `fecha_crear`, `usario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (1, 'Juan Pérez', '123456789', 'Calle 123, Ciudad', '5555-1234', '2023-08-03', 1, NULL, NULL, 'Activo');
INSERT INTO `persona` (`id_persona`, `nombre`, `DPI`, `direccion`, `telefono`, `fecha_crear`, `usario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (4, 'Victor Lopez', '8495869283', '15 calle, Zona 10', '5555-4567', '2023-09-06', 1, NULL, NULL, 'Activo');
INSERT INTO `persona` (`id_persona`, `nombre`, `DPI`, `direccion`, `telefono`, `fecha_crear`, `usario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (2, 'Erick Mayen', '987654321', 'Avenida 12 zona 21, Pueblo', '5555-5678', '2023-08-03', 1, NULL, NULL, 'Activo');
INSERT INTO `persona` (`id_persona`, `nombre`, `DPI`, `direccion`, `telefono`, `fecha_crear`, `usario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (3, 'Marlon Ivan', '543216789', 'Calle Principal, Villa', '5555-9876', '2023-08-03', 1, NULL, NULL, 'Activo');

INSERT INTO `usuario` (`id_usuario`, `id_rol`, `id_persona`, `usuario`, `clave`, `fecha_crear`, `usuario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (1, 1, 1, 'admin123', 'aafdc23870ecbcd3d557b6423a8982134e17927e', '2023-08-03', '1', '2023-09-05', '1', 'Activo');
INSERT INTO `usuario` (`id_usuario`, `id_rol`, `id_persona`, `usuario`, `clave`, `fecha_crear`, `usuario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (2, 1, 2, 'erick', 'aafdc23870ecbcd3d557b6423a8982134e17927e', '2023-09-03', '1', '2023-09-05', '1', 'Activo');
INSERT INTO `usuario` (`id_usuario`, `id_rol`, `id_persona`, `usuario`, `clave`, `fecha_crear`, `usuario_crear`, `fecha_mod`, `usuario_mod`, `estado`) VALUES (57, 1, 3, 'marlon', 'aafdc23870ecbcd3d557b6423a8982134e17927e', '2023-09-05', '1', NULL, NULL, 'activo');

