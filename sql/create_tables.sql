-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Player(
id SERIAL PRIMARY KEY,
playername varchar(50),
password varchar(50)
);

CREATE TABLE Lure(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
lurename varchar(50) NOT NULL,
-- korvataan enumilla
luretype varchar(50) NOT NULL,
color varchar(50) NOT NULL
-- kuva
);
-- 
CREATE TABLE Spot(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
spotname varchar(50) NOT NULL,
description varchar(50) NOT NULL
-- kuva
);
-- 
CREATE TABLE Species(
id SERIAL PRIMARY KEY,
name_fin varchar(50) NOT NULL,
name_lat varchar(50) NOT NULL
-- kuva
);
-- 
CREATE TABLE Trip(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
tripname varchar(50) NOT NULL,
tripday date,
start_time time,
end_time time,
temperature decimal NOT NULL,
water_temperature decimal NOT NULL,
-- korvataan enumilla
clouds varchar(50) NOT NULL,
wind_mps integer NOT NULL,
-- korvataan enumilla
wind_direction varchar(50) NOT NULL,
description varchar(1000)
);

CREATE TABLE Fish(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id),
trip_id INTEGER REFERENCES Trip(id),
species_id INTEGER REFERENCES Species(id),
spot_id INTEGER REFERENCES Spot(id),
lure_id INTEGER REFERENCES Lure(id),
weight decimal NOT NULL,
length_cm decimal NOT NULL,
-- korvataan enumilla
fishing_method varchar(50) NOT NULL,
fish_description varchar(500)
-- kuva
);