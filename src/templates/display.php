<!DOCTYPE html>
<html>

<head>
    <title>Optimal Schedule</title>
</head>

<body>
    <h1>Optimal Schedule</h1>
    <table border="1">
        <th>Time</th>
        <th>CourseID</th>
        <th>Faculty</th>
        {% for row in csv_data %}
        <tr>
            {% for col in row %}
                {% if col == "1" %}
                    
                {% elif col == "m800" %}
                    <td>Monday at 8:00 am</td>
                {% elif col == "m930" %}
                    <td>Monday at 9:30 am</td>
                {% elif col == "m1100" %}
                    <td>Monday at 11:00 am</td>
                {% elif col == "m200" %}
                    <td>Monday at 2:00 pm</td>

                {% elif col == "t830" %}
                    <td>Tuesday at 8:30 am</td>
                {% elif col == "t1000" %}
                    <td>Monday at 10:00 am</td>
                {% elif col == "t1130" %}
                    <td>Monday at 11:30 am</td>
                {% elif col == "t100" %}
                    <td>Monday at 1:00 pm</td>
                {% elif col == "t230" %}
                    <td>Monday at 2:30 pm</td>
                {% else %}
                    <td>{{ col }}</td>
                {% endif %}
            {% endfor %}
        </tr>
        {% endfor %}
    </table>
</body>

</html>
