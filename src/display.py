from flask import Flask, request, render_template
import csv
import io

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('dynamic_merge.php')

@app.route('/upload', methods=['POST'])
def upload():
    csv_file = request.files['csv_file']
    if csv_file:
        # Read the uploaded CSV file
        csv_data = csv_file.read().decode('utf-8')
        csv_reader = csv.reader(io.StringIO(csv_data))

        # Render HTML template with CSV data
        return render_template('display.html', csv_data=csv_reader)
    else:
        return "No file uploaded!"

if __name__ == '__main__':
    app.run(debug=True)
