-- Player testidata
INSERT INTO Player (playername, password) VALUES ('KumiJ', 'ColdAsIce');

-- Lure testidata
INSERT INTO Lure (player_id, lurename, luretype, color) VALUES (1, 'Krokodil, 12gr', 'lusikka', 'sininen');

-- Spot testidata
INSERT INTO Spot (player_id, spotname, description) VALUES (1, 'Silakkarysä', '--');

-- Species testidata
INSERT INTO Species (name_fin, name_lat) VALUES ('Hauki', 'Esox lucius');

-- Trip testidata
INSERT INTO Trip (player_id, tripname, temperature, water_temperature, clouds, wind_mps, wind_direction, description) VALUES (1, 'testireissu', 2, 2, 'puolipilvistä', 8, 'itä', '---');

-- Fish testidata
INSERT INTO Fish (player_id, trip_id, species_id, spot_id, lure_id, weight, length_cm, fishing_method, fish_description) VALUES (1, 1, 1, 1, 1, 2000, 50, 'pilkki', '---');
