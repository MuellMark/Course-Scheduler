from flask import Flask, request, render_template
import csv
import io
import test
import subprocess
import sys
import os
from collections import defaultdict
from io import StringIO


app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = app.static_folder

@app.route('/')
def index():
    return render_template('landing_page.php')
@app.route('/home')
def home():
    return render_template('landing_page.php')
@app.route('/dynamic')
def dynamic():
    return render_template('dynamic_merge.php')
@app.route('/faq')
def faq():
    return render_template('faq.php')
@app.route('/option')
def option():
    return render_template('csv_option.php')
@app.route('/howto')
def howto():
    return render_template('about-howto.php')
@app.route('/importpg')
def importpg():
    return render_template('import_csv.php')

def getCSVData():
    csv_file_path = "output.csv"

    # Initialize an empty list to store the data from the CSV file
    csv_data = []
    # Open the CSV file and read its contents
    with open(csv_file_path, newline='') as csvfile:
        csv_reader = csv.reader(csvfile)
        # Iterate over each row in the CSV file
        for row in csv_reader:
            # Append each row to the csv_data list
            csv_data.append(row)
    return csv_data

def organizeData():
    # Create a defaultdict to store entries based on the code
    entries = defaultdict(list)

    # Read the input CSV file
    with open('output.csv', 'r') as csvfile:
        reader = csv.reader(csvfile)
        for row in reader:
            number, code, label, *rest_var = row
            # number, code, label, professor, money = row
            if len(rest_var) >= 1:
                faculty = rest_var[0]
            else:
                faculty = "Faculty TBD"
            entries[code].append((number, label, faculty))

    # Write the merged data to the output CSV file
    with open("output.csv", 'w', newline='') as csvfile:
        writer = csv.writer(csvfile)
        for code, data_list in entries.items():
            if len(data_list) > 1:  # Only merge if there are multiple entries with the same code
                merged_row = [data_list[0][0], code]
                data_list = sum(data_list,())
                expanded_list = []
                for item in data_list:
                    if isinstance(item, tuple):
                        expanded_list.extend(item)
                    else:
                        expanded_list.append(item)
                merged_row.extend([entry[0:] for entry in expanded_list])
                writer.writerow(merged_row)
            else:
                writer.writerow([data_list[0][0], code, data_list[0][1], data_list[0][2]])

@app.route('/upload', methods=['POST'])
def upload():
    csv_file = request.files['csv_file']
    if csv_file:
        # Read the uploaded CSV file
        csv_data = csv_file.read().decode('utf-8')
        csv_reader = csv.reader(io.StringIO(csv_data))

        test.createFile(csv_file,app)
        test.write_csv_to_file(csv_reader, "input.csv")
        command = "python File_Convertor.py input.csv csv both"
        subprocess.call(command, shell=True)

        # Render HTML template with CSV data
        if(notInfeasible()):
            organizeData()
            csv_function_data = getCSVData()
            return render_template('display.php', csv_data=csv_function_data)
        else:
            return "Not feasible"
    else:
        return "No file uploaded!"

# TODO grab from 2nd column
@app.route("/force", methods=['GET', 'POST'])
def force():
    f = open('user_output.csv','r')
    newf = open('force.csv','w')
    lines = f.readlines() # read old content
    newf.write("<forced_courses>" + "\n" + request.form['course'] + "," + request.form['time'] + "\n") # write new content at the beginning
    for line in lines: # write old content after new
        newf.write(line)
    newf.close()
    f.close()
    command = "python File_Convertor.py force.csv csv both"
    subprocess.call(command, shell=True)
    if(notInfeasible()):
        organizeData()
        csv_function_data = getCSVData()
        return render_template('display.php', csv_data=csv_function_data)
    else:
        return "Not feasible"

@app.route("/swap", methods=['GET', 'POST'])
def swap():
    f = open('user_output.csv','r')
    newf = open('swap.csv','w')
    lines = f.readlines() # read old content
    newf.write("<swapped_courses>" + "\n" + request.form['course1'] + "," + request.form['course2'] + "\n") # write new content at the beginning
    for line in lines: # write old content after new
        newf.write(line)
    newf.close()
    f.close()
    command = "python File_Convertor.py swap.csv swap both output.csv"
    subprocess.call(command, shell=True)
    if(notInfeasible()):
        organizeData()
        csv_function_data = getCSVData()
        return render_template('display.php', csv_data=csv_function_data)
    else:
        return "Not feasible"

def notInfeasible():
    with open('user_output.csv', 'r', newline='') as file:
        reader = csv.reader(file)
        # Skip the header row
        next(reader, None)
        # Count the number of data rows
        num_rows = sum(1 for _ in reader)
        # Check if there are at least two rows
        return num_rows >= 2

if __name__ == '__main__':
    app.run(host="0.0.0.0", port="8080")