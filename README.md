[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![GitHub issues](https://img.shields.io/github/issues/MuellMark/Course-Scheduler)](https://github.com/MuellMark/Course-Scheduler/issues)

# Course Scheduling Service (CSS)

![Screenshot 2024-04-22 103253](https://github.com/MuellMark/Course-Scheduler/assets/88158644/84156414-2983-448d-af76-f4e5027cdd54)

## About

![bd64524d365b1cb58dcbed64e3a4e455](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8a4452a4-5f42-4f85-b7f6-4154368102b1)

Welcome! Course scheduling is laborious and subject to many fixed university requirements. However, there are enough changing factors to make it difficult to reuse schedules from prior years, making it cumbersome for department chairs. By documenting these course and faculty restrictions, a Python tool has already been created that takes in CSV files of said constraints and generates a linear program that runs through an existing tool for linear programming, PyGLPK, to schedule the courses. 

While some already use this tool, it is unintuitive and requires some programming knowledge. This computer science capstone project aims to create a user-friendly web-based version of the scheduler so that more departments can utilize it to schedule their courses. This site includes intuitive interfaces to create CSV files, run the software tool, and display the generated schedule.

## Demo
![5l89](https://github.com/MuellMark/Course-Scheduler/assets/88158644/8cba9212-9d7a-43ce-9181-92ec9a8ab7cd)

The goal of the Southwestern University Course Scheduler was to make the course scheduling process as simple as possible. Therefore, the steps to accomplish this task are quite minimal. The user's requirements include creating and uploading the CSV files using Python. The application will run PyGLPK, and the resulting course schedule will be outputted for the user to download. Follow the steps below to do this. 

The goal of the Southwestern University Course Scheduler was to make the course scheduling process as simple as possible. Therefore, the steps to accomplish this task are quite minimal. The requirements of the user include creating the CSV files and uploading them in the Python tool. The application will run PyGLPK and the resulting course schedule will be outputted for the user to download. Follow the steps below to do this. 

1. From the Home page, click the Get Started button. This will take you to a page that gives two options: Create A New CSV or Import A CSV. 
   a. The import option is to be chosen if the user has an existing CSV file they would like to make alterations to.
   
      i. If so, click Import A CSV
      ii. Choose the CSV file to upload and click the Upload button and the outputted schedule will be displayed

   b. If not, click Create A New CSV.

3. You have now been navigated to the Create CSV page. This is where all course and faculty restrictions will be defined.

   a. Add all courses
   
         i. For each course, enter its name, abbreviation, specify if it is a four contact hour course or not, and the number of sections this course has. Check every time that the course is unable to be taught and then specify the course’s ID.
         ii. If there are other courses that conflict with this one, click the Add Conflicting Course and write the name of that course. This can be done multiple times. 

   b. Add all faculty

          i. For each faculty member, enter their name, indicate whether they need to teach in the prime time or no, and check every time that the professor is unable to teach. 

         iu. Then specify another course the professor is teaching. If there are other courses being taught, click the Add Course Taught button and write the name of that course. This can be done multiple times. 

3. Once these tables are filled out, click the Save as CSV button in the top right corner. This will download the CSV files to your machine.

4. Now that the CSV files have been created, they can be uploaded to the application to generate the schedule. Click the Next button. This will navigate to the import page. Import your recently downloaded csv file

5. Click Upload and the schedule will be generated

<br>

## Tools
![bunda-feia-cute](https://github.com/MuellMark/Course-Scheduler/assets/88158644/21c5dbc3-83e3-454c-9e24-b164bf32d48d)

1. The Scheduler operates from a Python script running Python GNU Linear Programming Kit (PyGLPK). The script is fed in 1-2 CSV files containing all the course and faculty constraints. A linear program modeled as a 2D matrix is created based on these constraints. This linear program is then passed into PyGLPK, where it is solved, checked for feasibility, and exported to a separate CSV file. This CSV file is passed back to the website for proper display.

<img src= "https://github.com/MuellMark/Course-Scheduler/assets/88158644/ce382ebf-a8a0-41d4-98d4-a2a3a5bef896" width="600" height="300">
  
2. Our responsibility is to ensure that, even as a capstone project, the project does not become obsolete due to poor design, readability, or usability after it is finished. The Scheduler front-end uses HTML, CSS, and JavaScript. These were chosen because they are accessible languages that do not require much programming knowledge to understand and learn. Utilizing these languages guarantees that the program will withstand industry changes. By design, you should see things where you expect them to be on a website, meaning you should make the tool as efficient as possible by designing it to make it easier for users to navigate. With users in mind, the tool is beginner-friendly and easy to use, with clear instructions and labeling. Error checks and handling are seen throughout creating and updating the course schedules, with immediate feedback in case of a problem.

![image](https://github.com/MuellMark/Course-Scheduler/assets/88158644/fb560950-262b-4459-8bae-f78189769a14)

3. What makes course scheduling so complex is adhering to all of the restrictions and requests made by faculty members while producing the most efficient schedule. This is where linear programming comes in. Linear programming is a mathematical modeling method that creates the best outcome where the constraints and the objective are represented by linear relationships. In the context of our application, the objective is to create the most efficient, optimized schedule. The constraints that the schedule must follow are the course and faculty restrictions that will be specified by the users. These include, but are not limited to, a faculty member’s teaching time availability, the classes being taught, and when they are offered.  The user will define the constraints in the Create CSV page, which will be explained in more depth in a later section. The application will implement a linear program with the objective and the constraints, and then using PyGLK, a software package that solves linear programs, will output the course schedule for the year.

![image](https://github.com/MuellMark/Course-Scheduler/assets/88158644/02450cd1-14d5-4e18-860a-521f854123e8)

4. Our program uses a Google Firebase database to store essential course information. It is used in the Create CSV page. When users enter a course into the course table, its name, abbreviation, the number of sections, and its course ID are added to the database. This allows the information to be saved and easily retrievable for future use. It allows the useful feature of autofill in the course table. 

<img src= "https://github.com/MuellMark/Course-Scheduler/assets/88158644/c7c3a9bc-2f9e-48f2-a1e4-ece54c622c17"  height="400">

   
<br>

## Contributors
![zU-Ct_](https://github.com/MuellMark/Course-Scheduler/assets/88158644/ffad1bbd-0801-4183-b9f1-2946fe2a659e)

- [Yahya Hamdallah](https://github.com/Hamdally)
- [Mark Mueller](https://github.com/MuellMark)
- [Kate Nguyen](https://github.com/katenguyen10)
- [Colby Sullivan](https://github.com/colbySullivan)
