INSERT INTO school_years (name, starts_at, ends_at)
VALUES ('2025-2026', '2025-09-15', '2026-06-30');


INSERT INTO teachers (id, first_name, last_name, email)
VALUES ('EMP002', 'Maud', 'Wera', 'maude.wera@hepl.be'),
       ('EMP003', 'Nathalie', 'Nicolay', 'nathalie.nicolay@hepl.be'),
       ('EMP004', 'Carine', 'Geradon', 'carine.geradon@hepl.be'),
       ('EMP005', 'Veronique', 'Etienne', 'veronique.etienne@hepl.be'),
       ('EMP007', 'Cedric', 'Muller', 'cedric.muller@hepl.be'),
       ('EMP008', 'Eric', 'Delayen', 'eric.delayen@hepl.be'),
       ('EMP009', 'Julie', 'Danguy', 'julie.danguy@hepl.be'),
       ('EMP011', 'Anne', 'Lussardi', 'anne.lussardi@hepl.be'),
       ('EMP012', 'Xavier', 'Spirlet', 'xavier.spirlet@hepl.be'),
       ('EMP014', 'Nicolas', 'Claisse', 'nicolas.claisse@hepl.be'),
       ('EMP015', 'Mariama', 'BounaFaa', 'mariama.bounafaa@hepl.be'),
       ('EMP016', 'Thomas', 'Boudron', 'thomas.boudron@hepl.be'),
       ('EMP017', 'Louise', 'Zilles', 'louise.zilles@hepl.be'),
       ('EMP018', 'Maelle', 'Vivegnis', 'maelle.vivegnis@hepl.be'),
       ('EMP019', 'Olivier', 'Borremans', 'olivier.borremans@hepl.be'),
       ('EMP020', 'Dylan', 'Jacquet', 'dylan.jacquet@hepl.be'),
       ('EMP021', 'Daniel', 'Schreurs', 'daniel.schreurs@hepl.be'),
       ('EMP023', 'Myriam', 'Dupont', 'myriam.dupont@hepl.be'),
       ('EMP024', 'Francois', 'Muller', 'francois.muller@hepl.be'),
       ('EMP025', 'Jerome', 'Ponente', 'jerome.ponente@hepl.be'),
       ('EMP028', 'Maxime', 'Fitoussi', 'maxime.fitoussi@hepl.be'),
       ('EMP029', 'Peter', 'Langer', 'peter.langer@hepl.be'),
       ('EMP030', 'Dominique', 'Vilain', 'dominique.vilain@hepl.be'),
       ('EMP031', 'Francois', 'Parmentier', 'francois.parmentier@hepl.be');


INSERT INTO ues (school_year_name, code, title, description, credits, responsible_teacher_id)
VALUES ('2025-2026', 'UE201', '(W) Design Web', '', 14, 'EMP023'),
       ('2025-2026', 'UE202', '(W) Design d''applications mobiles', '', 2, 'EMP031'),
       ('2025-2026', 'UE203', '(W) Développement côté client', '', 6, 'EMP021'),
       ('2025-2026', 'UE204', '(W) Développement côté serveur', '', 6, 'EMP030'),
       ('2025-2026', 'UE205', '(W) Multimédia', '', 6, 'EMP021'),
       ('2025-2026', 'UE206', '(W) Systèmes de gestion de contenu', '', 4, 'EMP021'),
       ('2025-2026', 'UE207', 'Anglais  - 3', '', 2, 'EMP003'),
       ('2025-2026', 'UE208', 'Anglais  - 4', '', 2, 'EMP003'),
       ('2025-2026', 'UE209', 'Communication', '', 3, 'EMP012'),
       ('2025-2026', 'UE2010', 'Culture artistique - 2', '', 2, 'EMP012'),
       ('2025-2026', 'UE2011', 'Entreprise', '', 2, 'EMP005'),
       ('2025-2026', 'UE2012', 'Graphisme - 3', '', 4, 'EMP011'),
       ('2025-2026', 'UE2013', 'Graphisme - 4', '', 4, 'EMP011');


INSERT INTO aas (ue_code, code, title, quadrimester, hours_per_year)
VALUES ('UE201', 'AA201', 'Design Web - 1 (30)', 1, 30),
       ('UE201', 'AA202', 'Design Web - 2 (30)', 1, 30),
       ('UE201', 'AA203', 'Design Web - 3 (15)', 2, 15),
       ('UE201', 'AA204', 'Design Web - 4 (30)', 2, 30),
       ('UE201', 'AA205', 'Design Web - 5 (30)', 2, 30),
       ('UE201', 'AA206', 'Design Web - 6 (30)', 2, 30),

       ('UE202', 'AA207', 'Design d''applications mobiles (30)', 2, 30),
       ('UE203', 'AA208', 'Développement côté client - 1 (30)', 1, 30),
       ('UE203', 'AA209', 'Développement côté client - 2 (45)', 1, 45),

       ('UE204', 'AA2010', 'Développement côté serveur (60)', 2, 60),
       ('UE205', 'AA2011', 'Multimédia (60)', 2, 60),
       ('UE206', 'AA2012', 'Systèmes de gestion de contenu (45)', 2, 45),
       ('UE207', 'AA2013', 'Anglais  3 (30)', 1, 30),
       ('UE208', 'AA2014', 'Anglais  4 (30)', 2, 30),
       ('UE209', 'AA2015', 'Communication (60)', 1, 30),
       ('UE2010', 'AA2016', 'Culture artistique - 2 (30)', 2, 30),
       ('UE2011', 'AA2017', 'Entreprise (30)', 2, 30),
       ('UE2012', 'AA2018', 'Graphisme - 3 (45)', 1, 30),
       ('UE2013', 'AA2019', 'Graphisme - 4 (45)', 1, 30);


INSERT INTO aa_teacher (aa_code, teacher_id)
VALUES ('AA201', 'EMP023'),
       ('AA202', 'EMP023'),
       ('AA203', 'EMP002'),
       ('AA204', 'EMP002'),
       ('AA205', 'EMP020'),
       ('AA206', 'EMP020'),
       ('AA207', 'EMP031'),
       ('AA208', 'EMP021'),
       ('AA209', 'EMP021'),

       ('AA2010', 'EMP030'),
       ('AA2011', 'EMP021'),
       ('AA2012', 'EMP021'),
       ('AA2013', 'EMP003'),
       ('AA2014', 'EMP003'),
       ('AA2015', 'EMP012'),
       ('AA2016', 'EMP012'),
       ('AA2017', 'EMP005'),
       ('AA2018', 'EMP011'),
       ('AA2019', 'EMP011');

INSERT INTO `groups` (code, school_year_name)
VALUES ('TECG2 W201', '2025-2026'),
       ('TECG2 W202', '2025-2026');


INSERT INTO classrooms (name)
VALUES ('L20'),
       ('L21'),
       ('L22'),
       ('L23'),
       ('L24'),
       ('L25'),
       ('L26'),
       ('L01'),
       ('L02'),
       ('L03'),
       ('L04'),
       ('L05'),
       ('Léo'),
       ('LPO1'),
       ('LPO2'),
       ('LPO3'),
       ('LPO4'),
       ('LPO5');


INSERT INTO students (matricule, first_name, last_name, email)
VALUES ('7340109162', 'Baaroun', 'Alyssa', 'alyssa.baaroun@student.hepl.be'),
       ('7340132062', 'Bibbiano', 'Chiara', 'chiara.bibbiano@student.hepl.be'),
       ('7340136767', 'Brohée', 'Maé', 'mae.brohee@student.hepl.be'),
       ('7340131981', 'Cakir', 'Sükeyne-Havin', 'sukeyna.cakir@student.hepl.be'),
       ('7340072103', 'Claes', 'Samantha', 'samantha.claes@student.hepl.be'),
       ('7340106511', 'Coban', 'Seren', 'seren.coban@student.hepl.be'),
       ('7340108069', 'de Freitas', 'Isabella', 'isabella.defreitas@student.hepl.be'),
       ('7340112347', 'Dida', 'Amina', 'amina.dida@student.hepl.be'),
       ('7340093429', 'Gaspar', 'Julien', 'julien.gaspar@student.hepl.be'),
       ('7340091657', 'Gerard', 'Dimitri', 'dimitri.gerard@student.hepl.be'),
       ('7340068167', 'Gurrera', 'Laura', 'laura.gurrera@student.hepl.be'),
       ('7340112354', 'Haddaji', 'Maroia', 'maroia.haddaji@student.hepl.be'),
       ('7340108376', 'Jacquemin-Fanti', 'Marie', 'marie.jacquemin-fanti@student.hepl.be'),
       ('7340068554', 'Keza', 'Jennifer', 'jennifer.keza@student.hepl.be'),
       ('7340124049', 'Ledina', 'Gabriel', 'gabriel.ledina@student.hepl.be'),
       ('7340128873', 'Lèbre', 'Eliott', 'eliott.lebre@student.hepl.be'),
       ('7340127414', 'Malchair', 'Laurine', 'laurine.malchair@student.hepl.be'),
       ('7340091814', 'Meex', 'Valentin', 'valentin.meex@student.hepl.be'),
       ('7340046321', 'Meziani', 'Wassila', 'wassila.meziani@student.hepl.be'),
       ('7340115392', 'Okulska', 'Edyta', 'edyta.okulska@student.hepl.be'),
       ('7340083324', 'Onysiak', 'Aleksander', 'aleksander.onysiak@student.hepl.be'),
       ('7340108491', 'Pennartz', 'Dorian', 'dorian.pennartz@student.hepl.be'),
       ('7340111263', 'Perpète', 'Noah', 'noah.perpete@student.hepl.be'),
       ('7340135849', 'Rabhioui', 'Assia', 'assia.rabhioui@student.hepl.be'),
       ('7340106269', 'Schmitz', 'Eline', 'eline.schmitz@student.hepl.be');


INSERT INTO sessions (aa_code, title, teacher_id, starts_at, ends_at, classroom)
VALUES ('AA208', 'Séance 1', 'EMP021', '2025-09-17 08:30:00', '2025-09-17 12:30:00', 'Léo'),
       ('AA208', 'Séance 1', 'EMP021', '2025-09-17 13:30:00', '2025-09-17 17:30:00', 'Léo'),
       ('AA2012', 'Séance 1', 'EMP021', '2025-09-19 08:30:00', '2025-09-19 12:30:00', 'Léo'),
       ('AA2012', 'Séance 1', 'EMP021', '2025-09-19 13:30:00', '2025-09-19 17:30:00', 'Léo'),

       ('AA208', 'Séance 2', 'EMP021', '2025-09-24 08:30:00', '2025-09-24 12:30:00', 'Léo'),
       ('AA208', 'Séance 2', 'EMP021', '2025-09-24 13:30:00', '2025-09-24 17:30:00', 'Léo'),
       ('AA2012', 'Séance 2', 'EMP021', '2025-09-26 08:30:00', '2025-09-26 12:30:00', 'Léo'),
       ('AA2012', 'Séance 2', 'EMP021', '2025-09-26 13:30:00', '2025-09-26 17:30:00', 'Léo'),

       ('AA208', 'Séance 3', 'EMP021', '2025-10-01 08:30:00', '2025-10-01 12:30:00', 'Léo'),
       ('AA208', 'Séance 3', 'EMP021', '2025-10-01 13:30:00', '2025-10-01 17:30:00', 'Léo'),
       ('AA2012', 'Séance 3', 'EMP021', '2025-10-03 08:30:00', '2025-10-03 12:30:00', 'Léo'),
       ('AA2012', 'Séance 3', 'EMP021', '2025-10-03 13:30:00', '2025-10-03 17:30:00', 'Léo'),

       ('AA208', 'Séance 4', 'EMP021', '2025-10-08 08:30:00', '2025-10-08 12:30:00', 'Léo'),
       ('AA208', 'Séance 4', 'EMP021', '2025-10-08 13:30:00', '2025-10-08 17:30:00', 'Léo'),
       ('AA2012', 'Séance 4', 'EMP021', '2025-10-10 08:30:00', '2025-10-10 12:30:00', 'Léo'),
       ('AA2012', 'Séance 4', 'EMP021', '2025-10-10 13:30:00', '2025-10-10 17:30:00', 'Léo'),

       ('AA208', 'Séance 5', 'EMP021', '2025-10-15 08:30:00', '2025-10-15 12:30:00', 'Léo'),
       ('AA208', 'Séance 5', 'EMP021', '2025-10-15 13:30:00', '2025-10-15 17:30:00', 'Léo'),
       ('AA2012', 'Séance 5', 'EMP021', '2025-10-17 08:30:00', '2025-10-17 12:30:00', 'Léo'),
       ('AA2012', 'Séance 5', 'EMP021', '2025-10-17 13:30:00', '2025-10-17 17:30:00', 'Léo'),

       ('AA208', 'Séance 6', 'EMP021', '2025-10-22 08:30:00', '2025-10-22 12:30:00', 'Léo'),
       ('AA208', 'Séance 6', 'EMP021', '2025-10-22 13:30:00', '2025-10-22 17:30:00', 'Léo'),
       ('AA2012', 'Séance 6', 'EMP021', '2025-10-24 08:30:00', '2025-10-24 12:30:00', 'Léo'),
       ('AA2012', 'Séance 6', 'EMP021', '2025-10-24 13:30:00', '2025-10-24 17:30:00', 'Léo'),

       ('AA208', 'Séance 7', 'EMP021', '2025-11-05 08:30:00', '2025-11-05 12:30:00', 'Léo'),
       ('AA208', 'Séance 7', 'EMP021', '2025-11-05 13:30:00', '2025-11-05 17:30:00', 'Léo'),
       ('AA2012', 'Séance 7', 'EMP021', '2025-11-07 08:30:00', '2025-11-07 12:30:00', 'Léo'),
       ('AA2012', 'Séance 7', 'EMP021', '2025-11-07 13:30:00', '2025-11-07 17:30:00', 'Léo'),

       ('AA208', 'Séance 8', 'EMP021', '2025-11-12 08:30:00', '2025-11-12 12:30:00', 'Léo'),
       ('AA208', 'Séance 8', 'EMP021', '2025-11-12 13:30:00', '2025-11-12 17:30:00', 'Léo'),
       ('AA2012', 'Séance 8', 'EMP021', '2025-11-14 08:30:00', '2025-11-14 12:30:00', 'Léo'),
       ('AA2012', 'Séance 8', 'EMP021', '2025-11-14 13:30:00', '2025-11-14 17:30:00', 'Léo'),

       ('AA208', 'Séance 9', 'EMP021', '2025-11-19 08:30:00', '2025-11-19 12:30:00', 'Léo'),
       ('AA208', 'Séance 9', 'EMP021', '2025-11-19 13:30:00', '2025-11-19 17:30:00', 'Léo'),
       ('AA2012', 'Séance 9', 'EMP021', '2025-11-21 08:30:00', '2025-11-21 12:30:00', 'Léo'),
       ('AA2012', 'Séance 9', 'EMP021', '2025-11-21 13:30:00', '2025-11-21 17:30:00', 'Léo'),

       ('AA208', 'Séance 10', 'EMP021', '2025-11-26 08:30:00', '2025-11-26 12:30:00', 'Léo'),
       ('AA208', 'Séance 10', 'EMP021', '2025-11-26 13:30:00', '2025-11-26 17:30:00', 'Léo'),
       ('AA2012', 'Séance 10', 'EMP021', '2025-11-28 08:30:00', '2025-11-28 12:30:00', 'Léo'),
       ('AA2012', 'Séance 10', 'EMP021', '2025-11-28 13:30:00', '2025-11-28 17:30:00', 'Léo'),

       ('AA208', 'Séance 11', 'EMP021', '2025-12-03 08:30:00', '2025-12-03 12:30:00', 'Léo'),
       ('AA208', 'Séance 11', 'EMP021', '2025-12-03 13:30:00', '2025-12-03 17:30:00', 'Léo'),
       ('AA2012', 'Séance 11', 'EMP021', '2025-12-05 08:30:00', '2025-12-05 12:30:00', 'Léo'),
       ('AA2012', 'Séance 11', 'EMP021', '2025-12-05 13:30:00', '2025-12-05 17:30:00', 'Léo'),

       ('AA208', 'Séance 12', 'EMP021', '2025-12-10 08:30:00', '2025-12-10 12:30:00', 'Léo'),
       ('AA208', 'Séance 12', 'EMP021', '2025-12-10 13:30:00', '2025-12-10 17:30:00', 'Léo'),
       ('AA2012', 'Séance 12', 'EMP021', '2025-12-02 08:30:00', '2025-12-02 12:30:00', 'Léo'),
       ('AA2012', 'Séance 12', 'EMP021', '2025-12-02 13:30:00', '2025-12-02 17:30:00', 'Léo'),

       ('AA208', 'Séance 13', 'EMP021', '2025-12-17 08:30:00', '2025-12-17 12:30:00', 'Léo'),
       ('AA208', 'Séance 13', 'EMP021', '2025-12-17 13:30:00', '2025-12-17 17:30:00', 'Léo'),
       ('AA2012', 'Séance 13', 'EMP021', '2025-12-19 08:30:00', '2025-12-19 12:30:00', 'Léo'),
       ('AA2012', 'Séance 13', 'EMP021', '2025-12-19 13:30:00', '2025-12-19 17:30:00', 'Léo');


INSERT INTO session_group (session_id, group_code)
VALUES (1, 'TECG2 W201'),
       (2, 'TECG2 W202'),
       (3, 'TECG2 W201'),
       (4, 'TECG2 W202'),

       (5, 'TECG2 W201'),
       (6, 'TECG2 W202'),
       (7, 'TECG2 W201'),
       (8, 'TECG2 W202'),

       (9, 'TECG2 W201'),
       (10, 'TECG2 W202'),
       (11, 'TECG2 W201'),
       (12, 'TECG2 W202'),

       (13, 'TECG2 W201'),
       (14, 'TECG2 W202'),
       (15, 'TECG2 W201'),
       (16, 'TECG2 W202'),

       (17, 'TECG2 W201'),
       (18, 'TECG2 W202'),
       (19, 'TECG2 W201'),
       (20, 'TECG2 W202'),

       (20, 'TECG2 W201'),
       (21, 'TECG2 W202'),
       (22, 'TECG2 W201'),
       (23, 'TECG2 W202'),

       (24, 'TECG2 W201'),
       (25, 'TECG2 W202'),
       (26, 'TECG2 W201'),
       (27, 'TECG2 W202'),

       (28, 'TECG2 W201'),
       (29, 'TECG2 W202'),
       (30, 'TECG2 W201'),
       (31, 'TECG2 W202'),

       (32, 'TECG2 W201'),
       (33, 'TECG2 W202'),
       (34, 'TECG2 W201'),
       (35, 'TECG2 W202'),

       (36, 'TECG2 W201'),
       (37, 'TECG2 W202'),
       (38, 'TECG2 W201'),
       (39, 'TECG2 W202'),

       (40, 'TECG2 W201'),
       (41, 'TECG2 W202'),
       (42, 'TECG2 W201'),
       (43, 'TECG2 W202'),

       (44, 'TECG2 W201'),
       (45, 'TECG2 W202'),
       (46, 'TECG2 W201'),
       (47, 'TECG2 W202'),

       (48, 'TECG2 W201'),
       (49, 'TECG2 W202'),
       (50, 'TECG2 W201'),
       (51, 'TECG2 W202');

COMMIT;
