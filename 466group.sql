DROP TABLE Meal;
DROP TABLE Micronutrients;
DROP TABLE FoodBeverage;
DROP TABLE UserWeight;
DROP TABLE Workout;
DROP TABLE User;

/**
 * Table USER
 * id       : ID Of the user, non auto increment, primary key
 * name     : name of the user
 * password : password of the user (app access)
 */
CREATE TABLE User(
    id              INT         NOT NULL    PRIMARY KEY,
    name            VARCHAR(25) NOT NULL,
    password        VARCHAR(48) NOT NULL
);

/**
 * Table WORKOUT
 * id               : ID Of the user, non auto increment, foreign key
 * workoutType      : name of the user
 * workoutBur       : password of the user (app access)
 * workoutIntensity : Intensity of the workout (light, medium, intense)
 * workoutDate      : Date of the workout
 * workoutTime      : Time of the workout
 */
CREATE TABLE Workout(
    id                  INT         NOT NULL,
    workoutType         VARCHAR(12) NULL,
    workoutDur          TIME        NULL,
    workoutIntensity    VARCHAR(10) NULL,
    workoutDate         DATE        NOT NULL,
    workoutTime         TIME        NOT NULL    PRIMARY KEY,

    FOREIGN KEY (id) REFERENCES User(id)
);

/**
 * Table WEIGHT
 * id               : ID Of the user, non auto increment    (FOREIGN KEY)
 * userWeight       : Weight of the user                    (PRIMARY KEY)
 * weightDate       : Date the weight was recorded
 * weightTime       : Time the weight was recorded
 */
CREATE TABLE UserWeight(
    id                  INT         NOT NULL,
    currentWeight       FLOAT       NOT NULL,
    weightDate          DATE        NOT NULL,
    weightTime          TIME        NOT NULL            PRIMARY KEY,

    FOREIGN KEY (id) REFERENCES User(id)
);

/**
 * Table FOODBEVERAGE
 * foodName         : Name of the food      (PRIMARY KEY)
 * gramsPerServ     : Grams per serving
 * calories         : Calories per serving
 */
CREATE TABLE FoodBeverage(
    foodname            VARCHAR(48) NOT NULL    PRIMARY KEY,
    gramsPerServ        FLOAT       NULL,
    calories            INT         NULL
);

/**
 * Table MICRONUTRIENTS
 * nutrientName         : Name of the nutrient          (PRIMARY KEY)
 * reccomendedDose      : Reccomended daily does
 * foodname             : Name of the food              (FOREIGN KEY)
 */
CREATE TABLE Micronutrients(
    nutrientName        VARCHAR(32) NOT NULL,
    reccomendedDose     INT         NULL,
    foodname            VARCHAR(48) NOT NULL,

    FOREIGN KEY (foodname) REFERENCES FoodBeverage(foodname)
);

/**
 * Table MEAL
 * mealDate         : Date the meal was eaten           
 * mealTime         : Time the meal was eaten           
 * foodname         : Name of the food                  (FOREIGN KEY)
 * id               : ID of the user it belongs to      (FOREIGN KEY)
 */
CREATE TABLE Meal(
    mealDate            DATE        NOT NULL,
    mealTime            TIME        NOT NULL,
    foodname            VARCHAR(48) NOT NULL,
    id                  INT         NOT NULL,

    FOREIGN KEY (foodname) REFERENCES FoodBeverage(foodname),
    FOREIGN KEY (id) REFERENCES User(id)
);

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
    VALUES  (1, 'Pushup', '1:00', 'intense', '2020-19-11', '15:30'),
            (1, 'Situp', '0:30', 'moderate', '2020-12-11', '15:32'),
            (3, 'Run', '15:30', 'moderate', '2020-16-11', '11:30'),
            (4, 'BenchPress', '5:00', 'light', '2020-21-11', '10:28');

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
    VALUES  ('protein',     6,      'cashews'),
            ('fat',         12,     'cashews'),
            ('carbs',       9,      'cashews'),
            ('fiber',       1,      'cashews'),
            ('protein',     0.3,    'apple'),
            ('carbs',       13.8,   'apple'),
            ('sugar',       10.4,   'apple'),
            ('fiber',       2.4,    'apple'),
            ('protein',     1.3,    'banana'),
            ('fiber',       3.1,    'banana'),
            ('fat',         0.4,    'banana'),
            ('potassium',   0.09,   'banana'),
            ('fat',         7,      'cookie'),
            ('sodium',      135,    'cookie'),
            ('carbs',       25,     'cookie'),
            ('fiber',       1.2,    'cookie'),
            ('sugar',       14,     'cookie'),
            ('protein',     1,      'cookie'),
            ('fat',         2,      'ham'),
            ('sodium',      0.26,   'ham'),
            ('carbs',       1.5,    'ham'),
            ('fiber',       0,      'ham'),
            ('sugar',       1.25,   'ham'),
            ('carbs',       1,      'cheese'),
            ('fat',         10,     'cheese'),
            ('protein',     7,      'cheese'),
            ('calcium',     200,    'cheese');

/**
 * Poulate the meal table with pre-determined values
 */
INSERT INTO Meal
    VALUES  ('2020-20-11',        '11:29',     'ham',       1),
            ('2020-15-11',        '12:13',     'cheese',    1),
            ('2020-09-11',        '12:40',     'banana',    2),
            ('2020-17-11',        '12:10',     'ham',       3),
            ('2020-13-11',        '10:11',     'apple',     2),
            ('2020-14-11',        '12:30',     'cookie',    4);

/**
 * Poulate the weight table with pre-determined values
 */
INSERT INTO UserWeight
    VALUES  (1,     180,    '2020-25-10',   '12:40'),
            (2,     142,    '2020-02-11',   '09:15'),
            (3,     167,    '2020-20-11',   '19:40'),
            (4,     192,    '2020-16-11',   '10:23');