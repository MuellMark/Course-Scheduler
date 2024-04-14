[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/MuellMark/Course-Scheduler)](https://github.com/MuellMark/Course-Scheduler/issues)

# Course Scheduling Service (CSS)
![bd64524d365b1cb58dcbed64e3a4e455](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8a4452a4-5f42-4f85-b7f6-4154368102b1)


## About

Welcome! Course scheduling is laborious and subject to many fixed university requirements. However, there are enough changing factors to make it difficult to reuse schedules from prior years, making it cumbersome for department chairs. By documenting these course and faculty restrictions, a Python tool has already been created that takes in CSV files of said constraints and generates a linear program that runs through an existing tool for linear programming, PyGLPK, to schedule the courses. 

While this tool is already usable by some, it is unintuitive and requires some programming knowledge to run. This computer science capstone project aims to create a user-friendly web-based version of the scheduler so that more departments can utilize it to schedule their courses. This site includes intuitive interfaces to create CSV files, run the software tool, and display the generated schedule.

  
## Demo
![5l89](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8cba9212-9d7a-43ce-9181-92ec9a8ab7cd)

The goal of the Southwestern University Course Scheduler was to make the course scheduling process as simple as possible. Therefore, the steps to accomplish this task are quite minimal. The requirements of the user include creating the CSV files and uploading them in the Python tool. The application will run PyGLPK and the resulting course schedule will be outputted for the user to download. Follow the steps below to do this. 

![Untitled video - Made with Clipchamp](https://github.com/MuellMark/Course-Scheduler/assets/88158644/b6be537d-a3d6-4e77-a2c4-d1236f0d9019)

1. From the Home page, click the Get Started button. This will take you to a page that gives two options: Create A New CSV or Import A CSV. 

    a. The import option is to be chosen if the user has an existing CSV file they would like to make alterations to.
      
        i. If so, click Import A CSV
        ii. Choose the CSV file to upload and click the Upload button
        iii. TODO: Next step when page is implemented
  
    b. If not, click Create A New CSV.

2. You have now been navigated to the Create CSV page. This is where all course and faculty restrictions will be defined. 

![Untitled video - Made with Clipchamp (1)](https://github.com/MuellMark/Course-Scheduler/assets/88158644/9a0819fa-feac-4d27-b4ac-87dd580464c0)

    a. Add all courses

       i. For each course, enter its name, abbreviation, specify if it is a four contact hour course or not, and the number of sections this course has. Check every time that the course is unable to be taught and then specify the course’s ID.
       ii. If there are other courses that conflict with this one, click the Add Conflicting Course button and write the name of that course. You can do this multiple times.
    
    b. Add all faculty
    
        i. For each faculty member, enter their name, indicate whether they need to teach in the prime time or no, and check every time that the professor is unable to teach. 
        ii. Then specify another course the professor is teaching. If there are other courses being taught, click the Add Course Taught button and write the name of that course. This can be done multiple times. 

4. Once these tables are filled out, click the Save as CSV button in the top right corner. This will download the CSV files to your machine.

5. Now that the CSV files have been created, they can be uploaded to the application to generate the schedule. Click the Next button. This will navigate to a page to begin uploading.
   
6. 

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
