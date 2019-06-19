--Yuanrui Chen yc3346
--Peiwen Tang pt1145

INSERT INTO Airline VALUES ('China Eastern');
INSERT INTO Airline VALUES ('Emirates');
INSERT INTO Airport VALUES('JFK','NYC');
INSERT INTO Airport VALUES('PVG','Shanghai');
INSERT INTO Airport VALUES ('AUH','Abu Dhabi');
INSERT INTO Customer VALUES ('pt1145@nyu.edu','peiwentang','12345','JAB','Jay St','NYC','NY',2020000000,'E1234567','2023-06-23','China','1998-06-08');
INSERT INTO Customer VALUES ('ny1111@nyu.edu','stud1','54321','RH','Jay St','NYC','NY',1019876567,'F3456712','2021-01-01','China','1997-01-01');
INSERT INTO Customer VALUES ('some@gmail.com','someone','hispassword','Smith Hall','St.George St.','Toronto','ON',9067871223,'H8866221','2024-01-20','Canada','1996-01-01');
INSERT INTO Airplane VALUES('CE1234','China Eastern', 'A310', 90);
INSERT INTO Airplane VALUES('E1234','Emirates', 'A318', 100);
INSERT INTO Staff VALUES ('staff1', 'China Eastern', '333333', 'Evelyn','Zhu','1997-10-23');
INSERT INTO Flight VALUES ('MU587','2019-05-01 11:30','China Eastern','CE1234','PVG','JFK','2019-05-01 14:25','500','On Time');
INSERT INTO Flight VALUES ('MU297','2019-03-21 20:20','China Eastern','CE1234','PVG','JFK','2019-03-21 23:15','450','Delay');
INSERT INTO Flight VALUES ('EY867','2019-06-18 00:45','Emirates','E1234','PVG','AUH','2019-06-18 06:20','350','Delay');
INSERT INTO Ticket VALUES('10001','MU587','China Eastern','2019-05-01 11:30','pt1145@nyu.edu','600','Debit','474479007339000','Peiwen Tang','2019-12-30','2019-04-01 09:00');
INSERT INTO Ticket VALUES('10002','EY867','Emirates','2019-06-18 00:45','some@gmail.com','500','Credit','876534207339000','First Last','2020-12-30','2019-06-01 12:00');
INSERT INTO Ticket VALUES('10003','MU297','China Eastern','2019-03-21 20:20','ny1111@nyu.edu','610','Credit','123456789000987','Jack Li','2022-01-01','2019-01-01 13:00');