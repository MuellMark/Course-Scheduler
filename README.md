[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/MuellMark/Course-Scheduler)](https://github.com/MuellMark/Course-Scheduler/issues)

# Course-Scheduler

![] https://github.com/MuellMark/Course-Scheduler/blob/main/src/static/images/1407271393_piraty_06.gif
Welcome!

## Table of Contents

- [About](#about)
- [Demo](#demo)
- [Installation](#installation)
- [Tools](#tools)
- [Contributors](#contributors)

## About
Course scheduling is laborious and subject to many fixed university requirements. However, there are enough changing factors to make it difficult to reuse schedules from prior years, making it cumbersome for department chairs. By documenting these course and faculty restrictions, a Python tool has already been created that takes in CSV files of said constraints and generates a linear program that runs through an existing tool for linear programming, PyGLPK, to schedule the courses. 

While this tool is already usable by some, it is unintuitive and requires some programming knowledge to run. This computer science capstone project aims to create a user-friendly web-based version of the scheduler so that more departments can utilize it to schedule their courses. This site includes intuitive interfaces to create CSV files, run the software tool, and display the generated schedule.
<br>
  
## Demo
*TODO*
<br>

## Tools
The Scheduler operates off of a Python script running Python GNU Linear Programming Kit (PyGLPK). The script is fed in 1-2 CSV files containing all the course and faculty constraints. Based on these constraints, a linear program is created modeled as a 2D matrix. This linear program is then passed into PyGLPK, where it is solved, checked for feasibility, and exported to a separate CSV file. This CSV file is passed back to the website for proper display.
<br>

## Installation

*TODO* When a useable version is ready detail instruction will be included
<br>

## Contributors

- [Yahya Hamdallah](https://github.com/Hamdally)
- [Mark Mueller](https://github.com/MuellMark)
- [Kate Nguyen](https://github.com/katenguyen10)
- [Colby Sullivan](https://github.com/colbySullivan)
