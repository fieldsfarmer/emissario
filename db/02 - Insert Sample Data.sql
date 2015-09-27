INSERT INTO User (First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, Created_On, Modified_On) VALUES ('Felicia', 'Chandra', 'fchandr2@illinois.edu', 'Test123', 'Urbana', 'IL', 'USA', '999-999-9999', NOW(), NOW());
INSERT INTO User (First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, Created_On, Modified_On) VALUES ('Yang', 'Lu', 'yanglu7@illinois.edu', 'Test123', 'Urbana', 'IL', 'USA', '999-999-9999', NOW(), NOW());
INSERT INTO User (First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, Created_On, Modified_On) VALUES ('Kaiwei', 'Wang', 'kwang57@illinois.edu', 'Test123', 'Urbana', 'IL', 'USA', '999-999-9999', NOW(), NOW());

INSERT INTO Travel_Plan (User_ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, Created_On, Modified_On) VALUES (1, 'Urbana', 'USA', 'Jakarta', 'Indonesia', '2015-12-21', NOW(), NOW());
INSERT INTO Travel_Plan (User_ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, Created_On, Modified_On) VALUES (1, 'Jakarta', 'Indonesia', 'Urbana', 'USA', '2016-01-05', NOW(), NOW());

INSERT INTO Friend (User_ID1, User_ID2, Pending, Created_On, Modified_On) VALUES (1, 2, 0, NOW(), NOW());
INSERT INTO Friend (User_ID1, User_ID2, Pending, Created_On, Modified_On) VALUES (3, 1, 0, NOW(), NOW());