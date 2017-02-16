-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Player(
id SERIAL PRIMARY KEY,
playername varchar(20) NOT NULL,
password varchar(30) NOT NULL
);

CREATE TABLE Lure(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id) ON DELETE CASCADE,
lurename varchar(50) NOT NULL,
-- korvataan enumilla
luretype varchar(50) NOT NULL,
color varchar(50) NOT NULL
-- kuva
);
-- 
CREATE TABLE Spot(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id) ON DELETE CASCADE,
spotname varchar(100) NOT NULL,
description varchar(1000) NOT NULL
-- kuva
);
-- 
CREATE TABLE Species(
id SERIAL PRIMARY KEY,
name_fin varchar(50) NOT NULL,
name_lat varchar(50)
-- kuva
);
-- 
CREATE TABLE Trip(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id) ON DELETE CASCADE,
tripname varchar(50) NOT NULL,
tripday date NOT NULL,
start_time time NOT NULL,
end_time time NOT NULL,
temperature decimal,
water_temperature decimal,
clouds varchar(50) NOT NULL,
wind_mps integer,
-- korvataan enumilla
wind_direction varchar(50) NOT NULL,
description varchar(1000)
);

CREATE TABLE Fish(
id SERIAL PRIMARY KEY,
player_id INTEGER REFERENCES Player(id) ON DELETE CASCADE,
trip_id INTEGER REFERENCES Trip(id) ON DELETE CASCADE,
species_id INTEGER REFERENCES Species(id) ON DELETE CASCADE,
spot_id INTEGER REFERENCES Spot(id) ON DELETE CASCADE,
lure_id INTEGER REFERENCES Lure(id) ON DELETE CASCADE,
weight decimal,
length_cm decimal,
-- korvataan enumilla
fishing_method varchar(50) NOT NULL,
fish_description varchar(500)
-- kuva
);