

#### version à deux fonction : simple et correspondances regroupée (boolean cor) + retourne set of holderVoyage[]

create type holder as (id int, depart varchar, arrivee varchar, distance int, idvoyage int, conducteur int,trajet int, tarif int, nbplace int, heuredepart int, contraintes varchar);


## holder avec voyage selement
create type holderVoyage as (id int, conducteur int, trajet int, tarif int, nbplace int, heuredepart int, contraintes varchar);


### FCT Correspondances : Appel fct recursive
create or replace function getCorrCallRec(cor boolean, dep varchar(100), fin varchar(100)) returns setof holderVoyage[] AS $$
DECLARE
	i int;
	sumTimeDistance numeric;
	trajetIdList holderVoyage[];
	currentTrajet holderVoyage;
	currentTrajetIdList holderVoyage[];
	myCursor refcursor;
BEGIN
	sumTimeDistance:=0.0;
	i:=0;
	OPEN myCursor for select getCorrRec(cor, dep, fin, trajetIdList, SumTimeDistance);
	LOOP
	FETCH myCursor INTO currentTrajetIdList;
		return next currentTrajetIdList;
		if currentTrajetIdList is not null THEN
			raise notice 'Possibilité numero %', i;
			FOREACH currentTrajet IN ARRAY currentTrajetIdList LOOP
				raise notice 'voyage : %', currentTrajet;
			END LOOP;
			i:=i+1;
		else
			exit;
		end if;
	END LOOP;
	CLOSE myCursor;

	return;
END;
$$ LANGUAGE plpgsql;


### FCT recursive pour correspondance


create or replace function getCorrRec(cor boolean, dep varchar(100), fin varchar(100), trajetIdList holderVoyage[], SumTimeDistance numeric) returns setof holderVoyage[] AS $$
DECLARE
    myRecord holder;
    myCursor REFCURSOR;
	myVoyage holderVoyage;
BEGIN
	OPEN myCursor FOR select trajet.id as idTrajet, trajet.depart as depart, trajet.arrivee as arrivee, trajet.distance as distance, voyage.id as voyageId, voyage.conducteur as conducteur, voyage.trajet as trajet, voyage.tarif as tarif, voyage.nbplace as nbplace, voyage.heuredepart as heuredepart, voyage.contraintes as contraintes from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and nbplace>0 and heuredepart>SumTimeDistance;
    LOOP
        FETCH myCursor into myRecord;
        EXIT WHEN NOT FOUND;
		select * from jabaianb.voyage where id=myRecord.idVoyage into myVoyage;
        select array_cat(trajetIdList, ARRAY[myVoyage]) into trajetIdList;
        if (myRecord.arrivee != fin and cor) THEN
			return next getCorrRec(cor, myRecord.arrivee, fin, trajetIdList, myRecord.heuredepart+myRecord.distance/60);
        else
			if (myRecord.arrivee = fin) then
            	return next ARRAY[trajetIdList];
			end if;
        end if;
		select array_remove(trajetIdList, myVoyage) into trajetIdList;
    END LOOP;
    return;
END;
$$ LANGUAGE plpgsql;















##### version récupérant tableau d'ID de voyages  ->> test correction sur tableau




### FCT Correspondances : Appel fct recursive
create or replace function getCorrCallRec(cor boolean, dep varchar(100), fin varchar(100)) returns setof int[][] AS $$
DECLARE
	i int;
	sumTimeDistance numeric;
	trajetIdList int[];
	currentTrajet int;
	currentTrajetIdList int[];
	myCursor refcursor;
BEGIN
	sumTimeDistance:=0.0;
	i:=0;
	OPEN myCursor for select getCorrRec(cor, dep, fin, trajetIdList, SumTimeDistance);
	LOOP
	FETCH myCursor INTO currentTrajetIdList;
		if currentTrajetIdList is not null THEN
			return next currentTrajetIdList;
		else
			exit;
		end if;
	END LOOP;
	CLOSE myCursor;

	return;
END;
$$ LANGUAGE plpgsql;


### FCT recursive pour correspondance


create or replace function getCorrRec(cor boolean, dep varchar(100), fin varchar(100), trajetIdList int[], SumTimeDistance numeric) returns setof int[][] AS $$
DECLARE
    myRecord record;
    myCursor REFCURSOR;
BEGIN
	OPEN myCursor FOR select trajet.id as idTrajet, trajet.depart as depart, trajet.arrivee as arrivee, trajet.distance as distance, voyage.id as voyageId, voyage.conducteur as conducteur, voyage.trajet as trajet, voyage.tarif as tarif, voyage.nbplace as nbplace, voyage.heuredepart as heuredepart, voyage.contraintes as contraintes from jabaianb.trajet join jabaianb.voyage on voyage.trajet=trajet.id where depart=dep and nbplace>0 and heuredepart>SumTimeDistance;
    LOOP
        FETCH myCursor into myRecord;
        EXIT WHEN NOT FOUND;
        select array_cat(trajetIdList, ARRAY[myRecord.voyageId]) into trajetIdList;
        if (myRecord.arrivee != fin and cor) THEN
			return next getCorrRec(cor, myRecord.arrivee, fin, trajetIdList, myRecord.heuredepart+myRecord.distance/60);
        else
			if (myRecord.arrivee = fin) then
            	return next trajetIdList;
			end if;
        end if;
		select array_remove(trajetIdList, myRecord.voyageId) into trajetIdList;
    END LOOP;
    return;
END;
$$ LANGUAGE plpgsql;



