
/**
 * Poulate the user table with pre-determined values
 */
INSERT INTO User 
    VALUES  (1, 'ehren',    'notagoodpassword'),
            (2, 'bob',      'maybeagoodpassword'),
            (3, 'tom',      'alrightthisisbetter'),
            (4, 'john',     'bestpasswordrighthere');

/**
 * Poulate the workout table with pre-determined values
 */
INSERT INTO Workout
    VALUES  (1, 'Pushup', '1:00', 'intense', '2020-11-19', '15:30'),
            (1, 'Situp', '0:30', 'moderate', '2020-12-11', '15:32'),
            (3, 'Run', '15:30', 'moderate', '2020-09-21', '11:30'),
            (4, 'BenchPress', '5:00', 'light', '2020-04-19', '10:28');

/**
 * Poulate the foodbeverage table with pre-determined values
 */
INSERT INTO FoodBeverage
    VALUES  ('cheese',  5.1,    15),
            ('ham',     57,     69),
            ('cookie',  34,     160),
            ('banana',  168,    84),
            ('apple',   242,    130),
            ('cashews', 28,     157);

/**
 * Poulate the micronutrients table with pre-determined values
 */
INSERT INTO Micronutrients
    VALUES  ('protein',     80),
            ('fat',         12),
            ('carbs',       9),
            ('fiber',       1),
            ('sugar',       10),
            ('potassium',   4),
            ('sodium',      135),
            ('calcium',     200);

/**
 * Poulate the meal table with pre-determined values
 */
INSERT INTO Meal
    (mealDate, mealTime, id)
    VALUES  ('2020-10-11',        '11:29', 3),
            ('2020-07-23',        '12:01', 2),
            ('2020-09-23',        '13:23', 4),
            ('2020-04-23',        '16:54', 1),
            ('2020-11-23',        '5:53',  1),
            ('2020-02-23',        '23:24', 2),
            ('2020-03-23',        '16:34', 3),
            ('2020-08-23',        '14:10', 4);

/**
 * Poulate the weight table with pre-determined values
 */
INSERT INTO UserWeight
    VALUES  (1,     180,    '2020-10-25',   '12:40'),
            (2,     142,    '2020-02-11',   '09:15'),
            (3,     167,    '2020-11-20',   '19:40'),
            (4,     192,    '2020-11-16',   '10:23');

INSERT INTO MealContains
    (mealId, foodName, amount)
    VALUES  (1, 'cheese', 2),
            (1, 'cashews', 20),
            (2, 'apple', 20),
            (2, 'cookie', 20),
            (3, 'cheese', 20),
            (3, 'cashews', 20),
            (4, 'cashews', 20),
            (4, 'apple', 20),
            (5, 'banana', 20),
            (6, 'cashews', 20),
            (7, 'apple', 20),
            (8, 'cookie', 20),
            (4, 'ham', 20);

INSERT INTO FoodContains
    VALUES  ('cheese',  'calcium',    15),
            ('ham',     'protein',     40),
            ('cookie',  'sugar',     8),
            ('banana',  'potassium',    30),
            ('apple',   'fiber',    2),
            ('cashews', 'carbs',     15);
