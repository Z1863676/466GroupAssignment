DROP TABLE FoodContains;
DROP TABLE MealContains;
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
 * workoutType      : type of workout
 * workoutDur       : Duration of workout
 * workoutIntensity : Intensity of the workout (light, medium, intense)
 * workoutDate      : Date of the workout (PRIMARY KEY)
 * workoutTime      : Time of the workout (PRIMARY KEY)
 */
CREATE TABLE Workout(
    id                  INT         NOT NULL,
    workoutType         VARCHAR(12) NULL,
    workoutDur          TIME        NULL,
    workoutIntensity    VARCHAR(10) NULL,
    workoutDate         DATE        NOT NULL,
    workoutTime         TIME        NOT NULL,

    PRIMARY KEY (id, workoutDate, workoutTime),
    FOREIGN KEY (id) REFERENCES User(id)
);

/**
 * Table WEIGHT
 * id               : ID Of the user, non auto increment    (FOREIGN KEY)
 * userWeight       : Weight of the user                    (PRIMARY KEY)
 * weightDate       : Date the weight was recorded	    (PRIMARY KEY)
 * weightTime       : Time the weight was recorded	    (PRIMARY KEY)
 */
CREATE TABLE UserWeight(
    id                  INT         NOT NULL,
    currentWeight       FLOAT       NOT NULL,
    weightDate          DATE        NOT NULL,
    weightTime          TIME        NOT NULL,

    PRIMARY KEY (id, weightDate, weightTime),
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
 */
CREATE TABLE Micronutrients(
    nutrientName        VARCHAR(32) PRIMARY KEY,
    reccomendedDose     INT         NULL
);

/**
 * Table MEAL
 * mealDate         : Date the meal was eaten           
 * mealTime         : Time the meal was eaten           
 * id               : ID of the user it belongs to      (PRIMARY KEY)(FOREIGN KEY)
 */
CREATE TABLE Meal(
    mealDate            DATE        NOT NULL,
    mealTime            TIME        NOT NULL,
    id                  INT         NOT NULL,
    mealId              INT	    AUTO_INCREMENT,

    PRIMARY KEY(mealId),
    FOREIGN KEY (id) REFERENCES User(id)
);

/**
 * Table MealContains
 * mealId           : Meal ID 				(PRIMARY KEY)(FOREIGN KEY)           
 * foodname         : name of food in the meal          (PRIMARY KEY)(FOREIGN KEY)
 * amount 	    : how much of the food is in that meal
 */

CREATE TABLE MealContains(
    mealId 		INT NOT NULL,
    foodname		VARCHAR(48) NOT NULL,
    amount 		INT 	NOT NULL,
    measuredIn		VARCHAR(10) DEFAULT 'oz',
    PRIMARY KEY (mealId, foodName),
    FOREIGN KEY (mealId) REFERENCES Meal(mealId),
    FOREIGN KEY (foodname) REFERENCES FoodBeverage(foodname)

);

/**
 * foodname         : name of food                    (PRIMARY KEY)(FOREIGN KEY)
 * nutrientName     : name of nutrient in the food    (PRIMARY KEY)(FOREIGN KEY)
 * amount 	    : how much of the nutrient is in that food
 */

CREATE TABLE FoodContains(
    foodname		VARCHAR(48) NOT NULL,
    nutrientName 	VARCHAR(32) NOT NULL,
    amount INT 	    NOT NULL,

    PRIMARY KEY (foodName, nutrientName),
    FOREIGN KEY (nutrientName) REFERENCES Micronutrients(nutrientName),
    FOREIGN KEY (foodname) REFERENCES FoodBeverage(foodname)
);


