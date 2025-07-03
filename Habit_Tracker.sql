CREATE DATABASE Habit_Tracker;

USE Habit_Tracker;

CREATE TABLE Users (
    User_Id INT AUTO_INCREMENT PRIMARY KEY ,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Password VARCHAR(100) NOT NULL
);

CREATE TABLE Habits(
    Habit_Id INT AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100) NOT NULL,
    Description TEXT(65000),
    Start_Date DATE ,
    Start_Time TIME,
    End_Time TIME,
    Importance ENUM('Nomral','Important','Crucial'),
    Frequency INT ,  
    User_Id int FOREIGN KEY REFERENCES Users(User_Id),
);


CREATE TABLE Habit_Logs(
    Logs_Id INT AUTO_INCREMENT NOT NULL,
    Status ENUM('Done', 'Missed'),
    Note TEXT,
    Mood TEXT,
    Date DATE,
    Time TIME,
    Habit_Id FOREIGN KEY Habits(Habit_Id),
)
CREATE TABLE Journal_Note(
    Journal_Id INT AUTO_INCREMENT NOT NULL,
    Date DATE,
    Journal TEXT,
    User_Id FOREIGN KEY Users(User_Id)
);
