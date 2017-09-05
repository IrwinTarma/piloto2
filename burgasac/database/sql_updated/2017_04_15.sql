ALTER TABLE `produccion`.`proveedores`   
  ADD COLUMN `tipo_proveedor_id` INT DEFAULT 0 NULL AFTER `id`;

  ALTER TABLE `produccion`.`proveedores`   
  DROP COLUMN `tipo_proveedor_id`;

CREATE TABLE `produccion`.`proveedor_tipo`(  
  `id` INT NOT NULL AUTO_INCREMENT,
  `proveedor_id` INT,
  `tipo_proveedor_id` INT,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;


ALTER TABLE `produccion`.`proveedores`   
  CHANGE `created_at` `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
  ADD COLUMN `deleted_at` TIMESTAMP NULL AFTER `updated_at`;
ALTER TABLE `produccion`.`proveedores`   
  ADD COLUMN `user_created_at` VARCHAR(45) NULL AFTER `deleted_at`,
  ADD COLUMN `user_updated_at` VARCHAR(45) NULL AFTER `user_created_at`,
  ADD COLUMN `user_deleted_at` VARCHAR(45) NULL AFTER `user_updated_at`,
  ADD COLUMN `userid_created_at` INT NULL AFTER `user_deleted_at`,
  ADD COLUMN `userid_updated_at` INT NULL AFTER `userid_created_at`,
  ADD COLUMN `userid_deleted_at` INT NULL AFTER `userid_updated_at`;