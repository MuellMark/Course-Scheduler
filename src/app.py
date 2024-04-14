from flask import Flask, request, render_template
import csv
import io
import test
import subprocess
import sys
import os


app = Flask(__name__)
app.config['UPLOAD_FOLDER'] = app.static_folder

@app.route('/')
def index():
    name = test.returnName()
    return render_template('dynamic_merge.php', content=name)
@app.route('/home')
def home():
    return render_template('landing_page.php')
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

@app.route('/upload', methods=['POST'])
def upload():
    csv_file = request.files['csv_file']
    if csv_file:
        # Read the uploaded CSV file
        csv_data = csv_file.read().decode('utf-8')
        csv_reader = csv.reader(io.StringIO(csv_data))
        filename = request.files['csv_file'].filename
        
        test.createFile(csv_file,app)
        test.write_csv_to_file(csv_reader, "static/input.csv")
        subprocess.call([sys.executable, "File_Convertor.py", "static/input.csv"])

        csv_file_path = 'output.csv'

        # Initialize an empty list to store the data from the CSV file
        csv_data = []

        # Open the CSV file and read its contents
        with open(csv_file_path, newline='') as csvfile:
            csv_reader = csv.reader(csvfile)
            # Iterate over each row in the CSV file
            for row in csv_reader:
                # Append each row to the csv_data list
                csv_data.append(row)
        csv_reader = csv_data
        # Render HTML template with CSV data
        # os.remove("static/output") # Remove created file
        return render_template('display.php', csv_data=csv_reader, test=filename)
    else:
        return "No file uploaded!"

if __name__ == '__main__':
    app.run(host="0.0.0.0")
