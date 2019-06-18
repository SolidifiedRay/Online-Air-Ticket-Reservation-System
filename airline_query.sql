#1.
SELECT *
FROM Flight
WHERE d_date_time > NOW()

#2.
SELECT*
FROM Flight
WHERE status = "delayed"

#3.
SELECT Customer.c_name
FROM Customer, Ticket
WHERE Customer.c_email = Ticket.c_email

#4.
SELECT *
FROM Airplane
WHERE al_name = "China Eastern"


SELECT *
FROM Airplane
WHERE al_name = "emirates"