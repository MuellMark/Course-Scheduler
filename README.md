[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/MuellMark/Course-Scheduler)](https://github.com/MuellMark/Course-Scheduler/issues)

# Course Scheduling Service (CSS)
![bd64524d365b1cb58dcbed64e3a4e455](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8a4452a4-5f42-4f85-b7f6-4154368102b1)


## About

Welcome! Course scheduling is laborious and subject to many fixed university requirements. However, there are enough changing factors to make it difficult to reuse schedules from prior years, making it cumbersome for department chairs. By documenting these course and faculty restrictions, a Python tool has already been created that takes in CSV files of said constraints and generates a linear program that runs through an existing tool for linear programming, PyGLPK, to schedule the courses. 

While this tool is already usable by some, it is unintuitive and requires some programming knowledge to run. This computer science capstone project aims to create a user-friendly web-based version of the scheduler so that more departments can utilize it to schedule their courses. This site includes intuitive interfaces to create CSV files, run the software tool, and display the generated schedule.

  
## Demo
![5l89](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8cba9212-9d7a-43ce-9181-92ec9a8ab7cd)

*TODO*
<br>

## Tools
![bunda-feia-cute](https://github.com/MuellMark/Course-Scheduler/assets/88158644/21c5dbc3-83e3-454c-9e24-b164bf32d48d)

The Scheduler operates off of a Python script running Python GNU Linear Programming Kit (PyGLPK). The script is fed in 1-2 CSV files containing all the course and faculty constraints. Based on these constraints, a linear program is created modeled as a 2D matrix. This linear program is then passed into PyGLPK, where it is solved, checked for feasibility, and exported to a separate CSV file. This CSV file is passed back to the website for proper display.
<br>

## Installation
![tumblr_ncgwg5Y3fG1tajjsfo1_400](https://github.com/MuellMark/Course-Scheduler/assets/88158644/a90928c8-0d35-4f42-b3b8-3dc142b57f16)

*TODO* When a useable version is ready detailed instructions will be included
<br>

## Contributors
![zU-Ct_](https://github.com/MuellMark/Course-Scheduler/assets/88158644/ffad1bbd-0801-4183-b9f1-2946fe2a659e)

- [Yahya Hamdallah](https://github.com/Hamdally)
- [Mark Mueller](https://github.com/MuellMark)
- [Kate Nguyen](https://github.com/katenguyen10)
- [Colby Sullivan](https://github.com/colbySullivan)
