CREATE OR REPLACE FUNCTION getCorrespondance (cor boolean,dep varchar(100), fin varchar(100)) 
returns REFCURSOR as $$ 
declare
result REFCURSOR;
begin 
	IF cor=TRUE THEN
		raise notice 'blob';
	ELSE 
		open result for select * from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and arrivee=fin;
		--FETCH FORWARD ALL FROM result ;
		return result;
	END IF;
	return result;
end; 
$$ LANGUAGE plpgsql;




create type holder as (idtrajet int, depart varchar, arrivee varchar, distance int,idvoyage int, conducteur int,trajet int, tarif int, nbplace int, heuredepart int, contraintes varchar);

create or replace function getCorrespondance(cor boolean, dep varchar(100), fin varchar(100)) returns setof holder AS $$
declare
    r record;
begin
    IF cor = FALSE THEN
        for r in select * from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and nbplace>0 loop
        	raise notice '%',r;
            perform(getCorRec(dep,fin,r.heuredepart+r.distance));
        end loop;
    ELSE
        for r in select * from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and arrivee=fin loop
            return next r;
        end loop;
    END IF;
    return;
end
$$ language 'plpgsql';


requete :
select id from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and nbplace>0 and heuredepart>sumtimedistance

create or replace function getCorrCallRec(dep varchar(100), fin varchar(100),hour) returns void AS $$
DECLARE
    i int;
    currenrInt int;
    corresList int[];
BEGIN
    i:=0;
    FOREACH corresList IN ARRAY getCorrRec(dep, fin) LOOP
        raise notice 'Possibilité numero %', i;
        FOREACH currentInt IN ARRAY corresList LOOP
            raise notice 'trajet : %', currentInt;
        END LOOP;
        i:=i+1;
    END LOOP;
END;
$$ LANGUAGE plpgsql;

create or replace function getCorrCallRec(dep varchar(100), fin varchar(100)) returns void AS $$
DECLARE
    i int;
    trajetIdList int[];
    currenrInt int;
    currentTrajetIdList int[];
BEGIN
    sumDistance:=0;
    i:=0;
    FOREACH currentTrajetIdList SLICE 1 IN ARRAY getCorrRec(dep, fin, trajetIdList, SumTimeDistance) LOOP
        raise notice 'Possibilité numero %', i;
        FOREACH currentInt IN ARRAY corresList LOOP
            raise notice 'trajet : %', currentInt;
        END LOOP;
        i:=i+1;
    END LOOP;
END;
$$ LANGUAGE plpgsql;

#

create or replace function getCorrRec(dep varchar(100), fin varchar(100), trajetIdList int[], SumTimeDistance int) returns setof int[] void AS $$
DECLARE
    myRecord record;
    myCursor REFCURSOR;
BEGIN
    OPEN myCursor FOR select voyage.id as id, trajet.arrivee as arrivee, voyage.distance as distance, trajet.heuredepart as heuredepart from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and nbplace>0 and heuredepart>sumtimedistance;
    LOOP
        FETCH myCursor into myRecord;
        EXIT WHEN NOT FOUND;
        if (myRecord.arrivee != fin)
            return next getCorrRec(myRecord.arrivee, fin, array_append(trajetIdList, myRecord.id), myRecord.heuredepart+myRecord.distance)
        endif;
    END LOOP;
    return;
END;
$$ LANGUAGE plpgsql;