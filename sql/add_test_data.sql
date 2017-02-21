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
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-05-02', '09:00:00', '13:00:00', 11, 9, 'melko pilvistä', 7, 'etelä');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-05-22', '10:00:00', '15:00:00', 14, 13, 'melko selkeää', 4, 'lounas');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-06-22', '10:00:00', '14:00:00', 19, 17, 'selkeää', 1, 'luode');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-06-29', '09:45:00', '14:00:00', 17, 17, 'pilvistä', 8, 'pohjoinen');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-07-11', '15:00:00', '19:30:00', 23, 20, 'selkeää', 2, 'lounas');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-08-15', '16:00:00', '18:00:00', 20, 19, 'puolipilvistä', 5, 'kaakko');
INSERT INTO Trip (player_id, tripname, tripday, start_time, end_time, temperature, water_temperature, clouds, wind_mps, wind_direction) VALUES (1, 'Mökkireissu', '2016-09-28', '08:00:00', '16:00:00', 14, 13, 'puolipilvistä', 6, 'lounas');

-- Fish testidata
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 2, 1, 12, 3.4, 65, 'heitto', 'kaislikon reunasta');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 3, 1, 1, 1, 2.4, 52, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 1, 5, 9, 4.4, 18, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 3, 5, 7, 0.2, 50, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 4, 2, 3, 8, 3.1, 102, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 1, 8, 1, 2.6, 73, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 4, 7, 10, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 4, 2, 5, 9, 0.8, 60, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 1, 1, 15, 1.6, 56, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 2, 6, 1, 4.6, 78, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 4, 1, 7, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 2, 4, 6, 9, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 4, 4, 3, 13, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 7, 2, 7, 5, 0.6, 84, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 7, 2, 2, 13, 4.9, 38, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 3, 1, 9, 16, 0.6, 56, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 4, 3, 2, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 4, 6, 14, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 2, 3, 2, 4, 4.8, 119, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 3, 6, 4, 1.0, 22, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 3, 2, 14, 3.8, 40, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 1, 9, 8, 0.1, 27, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 2, 8, 1, 4.1, 40, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 3, 7, 13, 0.6, 37, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 5, 1, 9, 5, 2.9, 18, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 2, 4, 2, 12, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 2, 1, 3, 11, 4.1, 53, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 6, 3, 6, 16, 4.5, 32, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 4, 8, 13, 0, 0, 'heitto', '');
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 3, 4, 1, 3, 0, 0, 'heitto', '');
