from flask import Flask, request, render_template
import csv
import io
from Python_Code import test
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

@app.route('/upload', methods=['POST'])
def upload():
    csv_file = request.files['csv_file']
    if csv_file:
        # Read the uploaded CSV file
        csv_data = csv_file.read().decode('utf-8')
        csv_reader = csv.reader(io.StringIO(csv_data))
        filename = request.files['csv_file'].filename
        test.createFile(csv_file,app,filename)
        # csv_file.save(os.path.join(
        #         app.config['UPLOAD_FOLDER'],
        #         request.files['csv_file'].filename
        #     ))
        # csv_reader = subprocess.call([sys.executable, "File_Convertor.py", "src/Python_Code/CSV_Files/testSingleFile2.csv"])
        # Render HTML template with CSV data
        os.remove("static/"+ filename) # Remove created file
        return render_template('display.php', csv_data=csv_reader, test=filename)
    else:
        return "No file uploaded!"

if __name__ == '__main__':
    app.run(debug=True)
