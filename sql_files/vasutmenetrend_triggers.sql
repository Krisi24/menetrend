--------------------------------------------------------
--  DDL for Trigger AR_NAPLO
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "TEST3"."AR_NAPLO" 
AFTER UPDATE OF ar OR INSERT ON jegyek
FOR EACH ROW
 WHEN (OLD.ar != NEW.ar) BEGIN
    IF UPDATING THEN 
        INSERT INTO arnaplo VALUES (SYSDATE, :OLD.ar, :NEW.ar, :NEW.tipus);
    ELSIF INSERTING THEN
        INSERT INTO arnaplo VALUES (SYSDATE, 0, :NEW.ar, :NEW.tipus);
    END IF;
END;
/
ALTER TRIGGER "TEST3"."AR_NAPLO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger FIZ_NAPLO
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "TEST3"."FIZ_NAPLO" 
AFTER UPDATE OF fizetes OR INSERT ON dolgozok
FOR EACH ROW
 WHEN (OLD.fizetes != NEW.fizetes) BEGIN
    IF UPDATING THEN 
        INSERT INTO fiznaplo VALUES (SYSDATE, :OLD.fizetes, :NEW.fizetes, :NEW.szemelyiszam);
    ELSIF INSERTING THEN
        INSERT INTO fiznaplo VALUES (SYSDATE, 0, :NEW.fizetes, :NEW.szemelyiszam);
    END IF;
END;
/
ALTER TRIGGER "TEST3"."FIZ_NAPLO" ENABLE;
--------------------------------------------------------
--  DDL for Trigger LOGIN_NAPLOZAS_BE
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "TEST3"."LOGIN_NAPLOZAS_BE" 
AFTER LOGON ON DATABASE
BEGIN
    INSERT INTO loginnaplo VALUES (SYSDATE, USER, NULL);
END;
/
ALTER TRIGGER "TEST3"."LOGIN_NAPLOZAS_BE" ENABLE;
--------------------------------------------------------
--  DDL for Trigger LOGIN_NAPLOZAS_KI
--------------------------------------------------------

  CREATE OR REPLACE EDITIONABLE TRIGGER "TEST3"."LOGIN_NAPLOZAS_KI" 
BEFORE LOGOFF ON DATABASE
BEGIN
    INSERT INTO loginnaplo VALUES (SYSDATE, USER, NULL);
END;
/
ALTER TRIGGER "TEST3"."LOGIN_NAPLOZAS_KI" ENABLE;
