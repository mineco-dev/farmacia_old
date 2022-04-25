CREATE TABLE select_1 (
  id int NOT NULL default '0',
  opcion varchar(255) NOT NULL default '',
  PRIMARY KEY  (id)
) 

INSERT INTO select_1 (id, opcion) VALUES (1, 'Opción 1'),
INSERT INTO select_1 values (2, 'Opción 2')
INSERT INTO select_1 values (3, 'Opción 3')
INSERT INTO select_1 values (4, 'Opción 4')

CREATE TABLE select_2 (
  id int NOT NULL default '0',
  opcion varchar(255) NOT NULL default '',
  relacion int NOT NULL default '0',
  PRIMARY KEY  (id)
)

select * from select_2

INSERT INTO select_2 VALUES (1, 'Opción 1.1', 1)
INSERT INTO select_2 VALUES (2, 'Opción 1.2', 1)
INSERT INTO select_2 VALUES (3, 'Opción 1.3', 1)
INSERT INTO select_2 VALUES (4, 'Opción 1.4', 1)
INSERT INTO select_2 VALUES (5, 'Opción 2.1', 2)
INSERT INTO select_2 VALUES (6, 'Opción 2.2', 2)
INSERT INTO select_2 VALUES (7, 'Opción 3.1', 3)
INSERT INTO select_2 VALUES (8, 'Opción 3.2', 3)
INSERT INTO select_2 VALUES (9, 'Opción 3.3', 3)
INSERT INTO select_2 VALUES (10, 'Opción 3.4', 3)
INSERT INTO select_2 VALUES (11, 'Opción 4.1', 4)
INSERT INTO select_2 VALUES (12, 'Opción 4.2', 4)

CREATE TABLE select_3 (
  id int NOT NULL default '0',
  opcion varchar(255) NOT NULL default '',
  relacion int NOT NULL default '0',
  PRIMARY KEY  (id)
)

INSERT INTO select_3  VALUES (1, 'Opción 1.1.1', 1)
INSERT INTO select_3  VALUES (2, 'Opción 1.1.2', 1)
INSERT INTO select_3  VALUES (3, 'Opción 1.2.1', 2)
INSERT INTO select_3  VALUES (4, 'Opción 1.2.2', 2)
INSERT INTO select_3  VALUES (5, 'Opción 1.3.1', 3)
INSERT INTO select_3  VALUES (6, 'Opción 1.3.2', 3)
INSERT INTO select_3  VALUES (7, 'Opción 1.4.1', 4)
INSERT INTO select_3  VALUES (8, 'Opción 1.4.2', 4)
INSERT INTO select_3  VALUES (9, 'Opción 2.1.1', 5)
INSERT INTO select_3  VALUES (10, 'Opción 2.1.2', 5)
INSERT INTO select_3  VALUES (11, 'Opción 2.2.1', 6)
INSERT INTO select_3  VALUES (12, 'Opción 2.2.2', 6)
INSERT INTO select_3  VALUES (13, 'Opción 3.1.1', 7)
INSERT INTO select_3  VALUES (14, 'Opción 3.1.2', 7)
INSERT INTO select_3  VALUES (15, 'Opción 3.2.1', 8)
INSERT INTO select_3  VALUES (16, 'Opción 3.2.2', 8)
INSERT INTO select_3  VALUES (17, 'Opción 3.3.1', 9)
INSERT INTO select_3  VALUES (18, 'Opción 3.3.2', 9)
INSERT INTO select_3  VALUES (19, 'Opción 3.4.1', 10)
INSERT INTO select_3  VALUES (20, 'Opción 3.4.2', 10)
INSERT INTO select_3  VALUES (21, 'Opción 4.1.1', 11)
INSERT INTO select_3  VALUES (22, 'Opción 4.1.2', 11)
INSERT INTO select_3  VALUES (23, 'Opción 4.2.1', 12)
INSERT INTO select_3  VALUES (24, 'Opción 4.2.2', 12)