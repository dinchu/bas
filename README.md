# BAS test

## Description

The idea is to make a fast php CLI app to calculate salary dates given a set of rules

## Getting Started

### Dependencies

* In order to make sure everyone can execute this app regardless of the OS, I'm adding a Make command that will execute it insde a docker container. So the prerequisite is to have docker installed and running

### Installing

* No need to install anything, the only prerequisite is Docker
* you can also use a local php binary to execute the CLI app, please use the execute.php file


### Executing program

* How to run the program
* go to the directory of the project and execute  the following commands
```
make build
```
in windows is recommended to use powershell. If that's the case use the following command:
```
docker run -it --rm  -v ${PWD}:/usr/src/myapp --name basappInstance basapp
```

in unix based systems such as mac or linux use the following command:
```
make execute-unix
```

## Original task description

This assignment gives us a good understanding about the thought-process and the capabilities of the developer. This doesn’t have to be a rock-solid, highly scalable super fancy production-ready application, but just something that allows us to get an idea of the developer's skills and level.

Try to keep things simple. If frameworks, libraries or databases are needed to write the application, please mention them and the arguments why they were required in the documentation for this assignment.

NOTE: This is a sample code and will only be used for evaluation purposes

Requirements:

You are required to create a small command-line utility to help a fictional company determine the dates they need to pay salaries to their sales department.

This company is handling their sales payroll in the following way:

Sales staff gets a monthly fixed base salary and a monthly bonus.
The base salaries are paid on the last day of the month unless that day is a Saturday or a Sunday (weekend).
On the 15th of every month bonuses are paid for the previous month, unless that day is a weekend. In that case, they are paid the first Wednesday after the 15th. 
The output of the utility should be a CSV file, containing the payment dates for the remainder of this year. The CSV file should contain a column for the month name, a column that contains the salary payment date for that month, and a column that contains the bonus payment date

## Authors

Pablo Delgado
