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
    csv_data.sort(key=lambda x: x[1])
    return csv_data

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

        # Create a defaultdict to store entries based on the code
        entries = defaultdict(list)

        # Read the input CSV file
        with open('output.csv', 'r') as csvfile:
            reader = csv.reader(csvfile)
            for row in reader:
                number, code, label, professor = row
                entries[code].append((number, label, professor))

        # Write the merged data to the output CSV file
        with open("output.csv", 'w', newline='') as csvfile:
            writer = csv.writer(csvfile)
            for code, data_list in entries.items():
                if len(data_list) > 1:  # Only merge if there are multiple entries with the same code
                    merged_row = [data_list[0][0], code]
                    merged_row.extend([entry[1:] for entry in data_list])
                    writer.writerow(merged_row)
                else:
                    writer.writerow([data_list[0][0], code, data_list[0][1], data_list[0][2]])
        # Render HTML template with CSV data
        csv_function_data = getCSVData()
        return render_template('display.php', csv_data=csv_function_data)
    else:
        return "No file uploaded!"

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

    csv_function_data = getCSVData()

    return render_template('display.php', csv_data=csv_function_data)


if __name__ == '__main__':
    app.run(host="0.0.0.0", port="8080")