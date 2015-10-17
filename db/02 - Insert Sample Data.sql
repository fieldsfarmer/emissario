INSERT INTO User (First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, Created_On, Modified_On)
SELECT First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'Felicia' AS First_Name, 'Chandra' AS Last_Name, 'fchandr2@illinois.edu' AS Email, '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa' AS `Password`, 'Urbana' AS City, 'IL' AS State, 'US' AS Country, '999-999-9999' AS Phone
    UNION SELECT 'Yang', 'Lu', 'yanglu7@illinois.edu', '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa', 'Urbana', 'IL', 'US', '999-999-9999'
    UNION SELECT 'Kaiwei', 'Wang', 'kwang57@illinois.edu', '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa', 'Urbana', 'IL', 'US', '999-999-9999'
) Tmp
WHERE NOT EXISTS (
	SELECT U.ID
    FROM User U
    WHERE U.Email = Tmp.Email);

INSERT INTO Travel (User_ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, Created_On, Modified_On)
SELECT User.ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'fchandr2@illinois.edu' AS Email, 'Urbana' AS Origin_City, 'US' AS Origin_Country, 'Jakarta' AS Destination_City, 'ID' AS Destination_Country, '2015-12-21' AS Travel_Date
    UNION SELECT 'fchandr2@illinois.edu', 'Jakarta', 'ID', 'Urbana', 'US', '2016-01-05'
) Tmp
INNER JOIN User ON User.Email = Tmp.Email
WHERE NOT EXISTS (
	SELECT T.ID
    FROM Travel T
    WHERE T.User_ID = User.ID
		AND T.Origin_City = Tmp.Origin_City
        AND T.Origin_Country = Tmp.Origin_Country
        AND T.Destination_City = Tmp.Destination_City
        AND T.Travel_Date = Tmp.Travel_Date
);

INSERT INTO Friend (User_ID1, User_ID2, Pending, Created_On, Modified_On)
SELECT U1.ID, U2.ID, Pending, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'fchandr2@illinois.edu' AS Email1, 'yanglu7@illinois.edu' AS Email2, 0 AS Pending
    UNION SELECT 'kwang57@illinois.edu', 'fchandr2@illinois.edu', 0
) Tmp
INNER JOIN User U1 ON U1.Email = Tmp.Email1
INNER JOIN User U2 ON U2.Email = Tmp.Email2
WHERE NOT EXISTS (
	SELECT F.User_ID1
    FROM Friend F
    WHERE (F.User_ID1 = U1.ID
			AND F.User_ID2 = U2.ID)
        OR (F.User_ID2 = U1.ID
			AND F.User_ID1 = U2.ID)
);

INSERT INTO Wish (User_ID, Description, Weight, Destination_City, Destination_Country, Compensation, Created_On, Modified_On)
SELECT User.ID, Description, Weight, Destination_City, Destination_Country, Compensation, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'fchandr2@illinois.edu' AS Email, 'Help me buy 5 packets of authentic green tea pocky.' AS Description, '500 gr' AS Weight, 'Kyoto' AS Destination_City, 'JP' AS Destination_Country, 'I will treat you to lunch' AS Compensation
    UNION SELECT 'fchandr2@illinois.edu', 'Deliver a book to my sister', '2 lbs', 'Singapore', 'SG', NULL
) Tmp
INNER JOIN User ON User.Email = Tmp.Email
WHERE NOT EXISTS (
	SELECT W.ID
    FROM Wish W
    WHERE W.User_ID = User.ID
		AND W.Description = Tmp.Description
        AND W.Destination_City = Tmp.Destination_City
        AND W.Destination_Country = Tmp.Destination_Country
);

INSERT INTO Message (Sender_ID, Recipient_ID, Title, Content, Unread, Wish_ID, Created_On, Modified_On)
SELECT Sender.ID, Recipient.ID, Title, Content, Unread, Wish_ID, NOW() AS Created_On, NOW() AS Modified_On
FROM (
	SELECT 'fchandr2@illinois.edu' AS Sender_Email, 'yanglu7@illinois.edu' AS Recipient_Email, 'Green Tea Pocky' AS Title, 'Hi Yang,\nWhere in Kyoto did you buy the green tea pocky last time?' AS Content, 0 AS Unread, 1 AS Wish_ID
    UNION SELECT 'yanglu7@illinois.edu', 'fchandr2@illinois.edu', 'RE: Green Tea Pocky', 'Sorry, can''t remember', 1, 1
) Tmp
INNER JOIN User Sender ON Sender.Email = Tmp.Sender_Email
INNER JOIN User Recipient ON Recipient.Email = Tmp.Recipient_Email
WHERE NOT EXISTS (
	SELECT M.ID
    FROM Message M
    WHERE M.Sender_ID = Sender.ID
		AND M.Recipient_ID = Recipient.ID
        AND M.Title = Tmp.Title
        AND M.Content = Tmp.Content
);