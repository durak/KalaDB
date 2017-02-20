-- Player testidata
INSERT INTO Player (playername, password) VALUES ('KumiJ', 'ColdAsIce');

-- Lure testidata
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 23 g', 'lusikka', 'sininen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 23 g', 'lusikka', 'punainen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 18 g', 'lusikka', 'sininen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 18 g', 'lusikka', 'punainen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 18 g', 'lusikka', 'ruskea');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 18 g', 'lusikka', 'vihreä');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Rapala Countdown. 9 cm', 'vaappu', 'vihreä');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Purelure', 'vaappu', 'oranssi');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Nils Master Invincible, 12 cm', 'vaappu', 'papukaija');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Nils Master Invincible, 15 cm', 'vaappu', 'sininen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Bomber Long, 16 cm', 'vaappu', 'sininen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Lotto, 9 g', 'lippa', 'oranssi');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Motoroil-mato, 8 cm ', 'jigi', 'ruskea');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Kalapyrstö, 12 cm ', 'jigi', 'keltainen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Heittoperho, 20 g ', 'perho', 'punainen');
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Blue Fox Lucius, 26 g ', 'lusikka', 'papukaija');



-- Spot testidata
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Silakkarysä', 'Perinnepaikka #1');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Ukkokivi', 'Antaa harvoin mitään, mutta täältä ne isot on tulleet...');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Lammassaari', 'Perinnepaikka letkeään saaresta kalastamiseen. Nimi ansaittu joskus 70-luvulla, kun kalastajien ohi lipui hukkunut lammas. Syksyllä ahvenia.');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Suntti', '');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Suntin karikko', '');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Lilltervon sillan etelä', 'Sameaa vettä, ruohosuojaukset pakolliset');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Lilltervon sillan pohjoinen', 'Havaintoja saaduista +10 kg');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Högan', '');
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Karingrund', 'Aina voi yrittää. Tänne kuoli saarelainen joskus ennen muinoin.');

-- Species testidata
INSERT INTO Species (name_fin, name_lat) VALUES ('Hauki', 'Esox lucius');
INSERT INTO Species (name_fin, name_lat) VALUES ('Ahven', 'Perca fluviatilis');
INSERT INTO Species (name_fin, name_lat) VALUES ('Kuha', 'Sander lucioperca');
INSERT INTO Species (name_fin) VALUES ('Munat pataan');


-- Trip testidata
-- INSERT INTO Trip (player_id, tripname, temperature, water_temperature, clouds, wind_mps, wind_direction, description) VALUES (1, 'testireissu', 2, 2, 'puolipilvistä', 8, 'itä', '---');

-- Fish testidata
-- INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 1, 1, 1, 2000, 50, 'pilkki', '---');
