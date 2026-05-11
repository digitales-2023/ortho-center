# Migracion SQL - tba_visita.IdPago

Este ajuste corrige el error:

`Unknown column 'tba_visita.IdPago'`

## Consulta SQL

```sql
ALTER TABLE `tba_visita`
ADD COLUMN `IdPago` INT NULL DEFAULT NULL AFTER `IdHistoriaClinica`,
ADD INDEX `idx_visita_idpago` (`IdPago`),
ADD CONSTRAINT `fk_visita_pago`
  FOREIGN KEY (`IdPago`)
  REFERENCES `tba_pago`(`IdPago`)
  ON DELETE SET NULL
  ON UPDATE RESTRICT;
```

## Recomendacion

- Hacer backup antes de ejecutar cambios en estructura.
- Ejecutar la consulta en la base activa del proyecto (`dev_orthocenter`).
