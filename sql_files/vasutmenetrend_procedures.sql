--------------------------------------------------------
--  DDL for Procedure JEGY_ELLENORZES
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "TEST3"."JEGY_ELLENORZES" (tranzakcioszamm IN NUMBER, jaratszamm IN NUMBER )
IS
    jegy vasarlas%ROWTYPE;
    szoveg varchar2(40);
BEGIN
    SELECT * INTO jegy FROM VASARLAS WHERE tranzakcioszam = tranzakcioszamm;

    IF jegy.jaratszam != jaratszamm AND jegy.meddig >= SYSDATE THEN
        RAISE_APPLICATION_ERROR(-20001, 'Nem erre a j�ratra sz�l a jegy!');
    ELSIF  jegy.meddig < SYSDATE OR jegy.jaratszam != jaratszamm  THEN
        RAISE_APPLICATION_ERROR(-20001, 'A jegy �rv�nytelen!');
    ELSIF jegy.mettol > SYSDATE  THEN
        RAISE_APPLICATION_ERROR(-20001, 'A jegyre sz�l� j�rat m�g nem indult el!');
    ELSE 
        szoveg := CONCAT(tranzakcioszamm,'sz�m� jegy �rv�nyes!');
        DBMS_OUTPUT.PUT_LINE (szoveg);
    END IF;
END;

/
--------------------------------------------------------
--  DDL for Procedure NEW_JARAT
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "TEST3"."NEW_JARAT" (varos1 IN VARCHAR2, varos2 IN VARCHAR2,
time_indul IN VARCHAR2, time_erkezik IN VARCHAR2,
tav IN NUMBER, potjegy_ar IN NUMBER
)
IS
    time_start DATE  := TO_DATE(time_indul, 'YYYY-MM-DD HH24:MI:SS');
    time_end DATE  := TO_DATE(time_erkezik, 'YYYY-MM-DD HH24:MI:SS');
    new_jaratszam NUMBER;
    szoveg varchar2(40);
BEGIN
    SELECT COUNT(*)INTO new_jaratszam FROM menetrend;
    IF new_jaratszam != 0  THEN
         SELECT MAX(jaratszam)INTO new_jaratszam FROM menetrend;
    END IF;
    IF varos1 = varos2 THEN
       RAISE_APPLICATION_ERROR(-20001, 'A v�rosok nem eggyezhetnek meg!');
    ELSIF  time_start >= time_end  THEN
        RAISE_APPLICATION_ERROR(-20001, 'Helytelen indul�si, �rkez�si id�!');
    ELSE 
        new_jaratszam := new_jaratszam + 1;
        INSERT INTO MENETREND (JARATSZAM, HONNAN, HOVA, DATUM_INDUL, DATUM_ERKEZIK, KM, POTJEGY) VALUES
        (new_jaratszam, varos1, varos2, time_start, time_end, tav, potjegy_ar);
        szoveg := CONCAT(new_jaratszam,' sz�m� jegy �rv�nyes!');
        DBMS_OUTPUT.PUT_LINE (szoveg);
    END IF;
END;

/
--------------------------------------------------------
--  DDL for Procedure NEW_VASARLAS
--------------------------------------------------------
set define off;

  CREATE OR REPLACE EDITIONABLE PROCEDURE "TEST3"."NEW_VASARLAS" (
jaratszamm IN NUMBER, jegy_tipus IN VARCHAR2 , db IN NUMBER , szemelyiszamm IN CHAR
)
IS
    check_var NUMBER;
    ut NUMBER;
    osszeg NUMBER := 0;
    potjegy_ar NUMBER := 0;
    mettol DATE;
    meddig DATE;
    tranzakcioszam_max NUMBER(38,0); 
BEGIN
    SELECT datum_indul INTO mettol FROM menetrend WHERE jaratszamm = jaratszam;
    SELECT datum_erkezik INTO meddig FROM menetrend WHERE jaratszamm = jaratszam;
        -- ellen�rz�s, hogy m�g megy-e a j�rat
        -- j�rat indul�sa ut�n m�g 15perccel lehet venni jegyet
    IF (mettol + (1/1440*15)) < SYSDATE THEN
        RAISE_APPLICATION_ERROR(2004, 'A J�ratra m�r nem lehet venni jegyet');
    END IF;
        -- jegy �rv�nyess�g�nek kiegl�sz�t�se + id�vel, k�s�sek, stb v�gett
    mettol := mettol - (1/1440*15); --15p
    meddig := meddig + (1/1440*30); --30p

    -- alap�rt�k be�ll�t�s ha nincs m�g rekord a t�bl�ban
    select count(*)INTO check_var from vasarlas; 
    IF check_var = 0 THEN
        tranzakcioszam_max := 0;
    ELSE 
     SELECT MAX(tranzakcioszam) INTO tranzakcioszam_max FROM vasarlas;
    END IF;

      -- v�g�sszeg �sszesz�mol�sa
    SELECT AR INTO osszeg FROM JEGYEK WHERE tipus LIKE jegy_tipus;
    SELECT potjegy INTO potjegy_ar FROM menetrend WHERE jaratszamm = jaratszam;
    SELECT km INTO ut FROM menetrend WHERE jaratszamm = jaratszam;
    osszeg := ( (osszeg * (ut/10)) + potjegy_ar ) * db ;

    tranzakcioszam_max := tranzakcioszam_max + 1;
    INSERT INTO "VASARLAS" (TRANZAKCIOSZAM, BEFIZETETT_OSSZEG, METTOL, MEDDIG, JEGY_TIPUS, DB, JARATSZAM, SZEMELYISZAM) 
    VALUES (tranzakcioszam_max, osszeg,
            mettol,meddig,
             jegy_tipus, db, jaratszamm, szemelyiszamm );
END;

/
