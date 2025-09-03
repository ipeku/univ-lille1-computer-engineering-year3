import psycopg2 as db_api

att_names = lambda cur : (att[0] for att in cur.description)
row_dict = lambda cur,row : dict(zip(att_names(cur),row))

class DataLayer :
    def __init__(self, **connection_parms) :
        self.conn=db_api.connect(**connection_parms)
        self.conn.autocommit=True
        self.conn.cursor().execute('set search_path = communes_mel')
    def create_tables(self) :
        cur = self.conn.cursor()
        create_communes = '''
            create schema if not exists communes_mel;
            drop table if exists communes cascade;
            drop table if exists import;
            drop table if exists territoires;
            create table import (
                insee char(5) primary key,
                nom  varchar(30),
                territoire varchar(30),
                surface  numeric(10,2),
                perimetre numeric(10,2),
                geo_point_2d jsonb,
                geo_shape  jsonb 
            );
            create table territoires(
              id serial primary key,
              nom varchar(30) unique
            );
            create table communes (
                insee char(5) primary key,
                nom  varchar(30),
                territoire int,
                surface  numeric(10,2),
                perimetre numeric(10,2),
                lat float,
                lon float,
                geo_shape  jsonb,
                foreign key (territoire) references territoires(id)
            );
        '''
        cur.execute(create_communes)
        
    def create_views(self) :
        sql = """
            drop view if exists limits cascade;
            create view limits as
            WITH points AS (
                     SELECT jsonb_array_elements((communes.geo_shape -> 'coordinates'::text) -> 0) AS p,
                        communes.insee,
                        communes.territoire
                       FROM communes
                    )
             SELECT points.insee,
                points.territoire,
                (points.p -> 0)::numeric AS lon,
                (points.p -> 1)::numeric AS lat
               FROM points
            ;
            create view bb_communes as
            SELECT limits.insee,
                min(limits.lat) AS min_lat,
                max(limits.lat) AS max_lat,
                min(limits.lon) AS min_lon,
                max(limits.lon) AS max_lon
               FROM limits
              GROUP BY limits.insee
              ORDER BY limits.insee
            ;
            create view bb_territoires as
            SELECT limits.territoire,
                min(limits.lat) AS min_lat,
                max(limits.lat) AS max_lat,
                min(limits.lon) AS min_lon,
                max(limits.lon) AS max_lon
               FROM limits
              GROUP BY limits.territoire
              ORDER BY limits.territoire
            ;
        """;
        cur = self.conn.cursor()
        cur.execute(sql)
          
    
    def reload_communes(self, values):
        cur = self.conn.cursor()
        # nettoyage :
        cur.execute("""
            truncate territoires restart identity cascade;
            truncate import;
        """)
        # import données dans un table provisoire :
        sql = "insert into import select * from json_populate_recordset(null::import, %s)"
        from psycopg2.extras import Json
        cur.execute(sql,  [db_api.extras.Json(values)])
        
        # peuplement des tables territoires et communes :
        cur.execute("""
            update import set territoire='HAUTE DEULE' where territoire is null;
            insert into territoires(nom) select distinct territoire from import;
            insert into communes(insee,nom,surface,perimetre,geo_shape, lat,lon,territoire)
                select insee,import.nom,surface,perimetre, geo_shape,
                       (geo_point_2d->>0)::float, (geo_point_2d->>1)::float, territoires.id
                    from import
                    join territoires on territoires.nom=import.territoire
            ;

        """)
    
  
   
   
        
        


    
if __name__ == '__main__' :
  #pass
    from db_config import get_db_parms

    dl = DataLayer(**get_db_parms('localhost'))
    
    dict_filter = lambda d,l : {k:d[k] for k in d.keys()&l}
    
    import json
#     data = json.load(open('mel_communes.json'))
#     
#     comm = [ dict_filter(x['fields'],('insee','nom','surface','perimetre','territoire','geo_point_2d','geo_shape')) for x in data ]
#     dl.create_tables()
#     dl.create_views()
#     dl.reload_communes(comm)

