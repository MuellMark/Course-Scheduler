<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
</head>
<body>
    <h1><span>Non variable</span></h1>
    <h1><span>csv_data: {{csv_data}}</span></h1>
    <h1><span>Name: {{test}}</span></h1>
</body>
</html>

<body>
    <h1>CSV Data</h1>
    <table border="1">
        {% for row in csv_data %}
            <tr>
                {% for col in row %}
                    <td>{{ col }}</td>
                {% endfor %}
            </tr>
        {% endfor %}
    </table>
</body>
</html>