create table Airline
	(al_name		varchar(25),
	 primary key (al_name)
	);

create table Airplane
	(ap_id			varchar(10),
	 al_name		varchar(25),
	 ap_name		varchar(20),
	 seat			numeric(3,0),
	 primary key (ap_id, al_name),
	 foreign key (al_name) references Airline(al_name)
		on delete cascade
	);

create table Airport
	(airport_name	varchar(25),
	 city			varchar(10),
	 primary key (airport_name)
	);

create table Flight
	(f_id			varchar(10),
	 d_date_time	varchar(25),
	 al_name		varchar(25),
	 ap_id			varchar(10),
	 d_airport		varchar(25),
	 a_airport		varchar(25),
	 a_date_time	varchar(25),
	 base_price		numeric(5,2),
	 status			varchar(10),

	 primary key (f_id, d_date_time, al_name),
	 foreign key (al_name) references Airline(al_name)
		on delete cascade,
	 foreign key (ap_id) references Airplane(ap_id)
	 	on delete set null,
	 foreign key (d_airport) references Airport(airport_name)
	 	on delete set null,
	 foreign key (a_airport) references Airport(airport_name)
	 	on delete set null
	);

create table Staff
	(user_name		varchar(15),
	 al_name		varchar(25),
	 password		varchar(15),
	 first_name		varchar(10),
	 last_name		varchar(10),
	 date_of_birth	date,

	 primary key (user_name),
	 foreign key (al_name) references Airline(al_name)
		on delete set null
	);

create table Staff_phone
	(user_name		varchar(15),
	 phone	        numeric(15,0),

	 primary key (user_name), 
	 foreign key (user_name) references Staff(user_name)
		on delete cascade
	);


create Table Customer
	(c_email		varchar(15),
	 c_name			varchar(15),
	 password		varchar(50),
	 building_name	varchar(15),
	 street			varchar(15),
	 city			varchar(15),
	 state			varchar(10),
	 phone_num		numeric(15,0),
	 passport_num	varchar(15),
	 passport_expiration	date,
	 passport_country		varchar(10),
	 date_of_birth	date,

	 primary key (c_email)
	);

create table Ticket
	(t_id  			varchar(15),
	 f_id			varchar(10),
	 al_name		varchar(25),
	 d_date_time	varchar(25),
	 c_email		varchar(15),
	 sold_price		numeric(5,2),
	 card_type		varchar(15),
	 card_num		varchar(15),
	 name_on_card	varchar(15),
	 exp_date		date,
	 purchase_date_time		varchar(25),

	 primary key (t_id),
	 foreign key (al_name, f_id, d_date_time) references Flight(al_name, f_id, d_date_time)
		on delete set null
	);

create table Rating
	(c_email		varchar(20),
	 f_id			varchar(10),
	 d_date_time	varchar(20),
	 al_name		varchar(25),
	 rate			varchar(5),
	 comment		varchar(50),

	 primary key (c_email, f_id, d_date_time, al_name),
	 foreign key (c_email) references Customer(c_email)
		on delete cascade,
	 foreign key (al_name, f_id, d_date_time) references Flight(al_name, f_id, d_date_time)
		on delete cascade
	);