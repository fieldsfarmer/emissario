INSERT INTO User (First_Name, Last_Name, Email, `Password`, City, State, Country, Phone, Created_On, Modified_On)
SELECT *
FROM (
	SELECT 'Felicia' AS First_Name, 'Chandra' AS Last_Name, 'fchandr2@illinois.edu' AS Email, '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa' AS `Password`, 'Urbana' AS City, 'IL' AS State, 'USA' AS Country, '999-999-9999' AS Phone, NOW() AS Created_On, NOW() AS Modified_On
    UNION SELECT 'Yang', 'Lu', 'yanglu7@illinois.edu', '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa', 'Urbana', 'IL', 'USA', '999-999-9999', NOW(), NOW()
    UNION SELECT 'Kaiwei', 'Wang', 'kwang57@illinois.edu', '$2y$10$QMd5nB54dJWaAeb4dCk3D.hZJXPk9otlR1xtyqoioACF7lHR4vcBa', 'Urbana', 'IL', 'USA', '999-999-9999', NOW(), NOW()
) Tmp
WHERE NOT EXISTS (
	SELECT U.ID
    FROM User U
    WHERE U.Email = Tmp.Email);

INSERT INTO Travel (User_ID, Origin_City, Origin_Country, Destination_City, Destination_Country, Travel_Date, Created_On, Modified_On)
SELECT *
FROM (
	SELECT 1 AS User_ID, 'Urbana' AS Origin_City, 'USA' AS Origin_Country, 'Jakarta' AS Destination_City, 'Indonesia' AS Destination_Country, '2015-12-21' AS Travel_Date, NOW() AS Created_On, NOW() AS Modified_On
    UNION SELECT 1, 'Jakarta', 'Indonesia', 'Urbana', 'USA', '2016-01-05', NOW(), NOW()
) Tmp
WHERE NOT EXISTS (
	SELECT T.ID
    FROM Travel T
    WHERE T.User_ID = Tmp.User_ID
		AND T.Origin_City = Tmp.Origin_City
        AND T.Origin_Country = Tmp.Origin_Country
        AND T.Destination_City = Tmp.Destination_City
        AND T.Travel_Date = Tmp.Travel_Date
);

INSERT INTO Friend (User_ID1, User_ID2, Pending, Created_On, Modified_On)
SELECT *
FROM (
	SELECT 1 AS User_ID1, 2 AS User_ID2, 0 AS Pending, NOW() AS Created_On, NOW() AS Modified_On
    UNION SELECT 3, 1, 0, NOW(), NOW()
) Tmp
WHERE NOT EXISTS (
	SELECT F.User_ID1
    FROM Friend F
    WHERE (F.User_ID1 = Tmp.User_ID1
			AND F.User_ID2 = Tmp.User_ID2)
        OR (F.User_ID2 = Tmp.User_ID1
			AND F.User_ID1 = Tmp.User_ID2)
);

INSERT INTO Wish (User_ID, Description, Weight, Destination_City, Destination_Country, Compensation, Created_On, Modified_On)
SELECT *
FROM (
	SELECT 1 AS User_ID, 'Help me buy 5 packets of authentic green tea pocky.' AS Description, '500 gr' AS Weight, 'Kyoto' AS Destination_City, 'Japan' AS Destination_Country, 'I will treat you to lunch' AS Compensation, NOW() AS Created_On, NOW() AS Modified_On
    UNION SELECT 1, 'Deliver a book to my sister', '2 lbs', 'Singapore', 'Singapore', NULL, NOW(), NOW()
) Tmp
WHERE NOT EXISTS (
	SELECT W.ID
    FROM Wish W
    WHERE W.User_ID = Tmp.User_ID
		AND W.Description = Tmp.Description
        AND W.Destination_City = Tmp.Destination_City
        AND W.Destination_Country = Tmp.Destination_Country
);

INSERT INTO Message (Sender_ID, Recipient_ID, Title, Content, Unread, Wish_ID, Created_On, Modified_On)
SELECT *
FROM (
	SELECT 1 AS Sender_ID, 2 AS Recipient_ID, 'Green Tea Pocky' AS Title, 'Hi Yang,\nWhere in Kyoto did you buy the green tea pocky last time?' AS Content, 0 AS Unread, 1 AS Wish_ID, NOW() AS Created_On, NOW() AS Modified_On
    UNION SELECT 2, 1, 'RE: Green Tea Pocky', 'Sorry, can''t remember', 1, 1, NOW(), NOW()
) Tmp
WHERE NOT EXISTS (
	SELECT M.ID
    FROM Message M
    WHERE M.Sender_ID = Tmp.Sender_ID
		AND M.Recipient_ID = Tmp.Recipient_ID
        AND M.Title = Tmp.Title
        AND M.Content = Tmp.Content
);