<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 600px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            align-self: flex-start; /* ให้อยู่ด้านบนของ container */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #c4c4c4;
            text-align: center;
            padding: 10px;
            background-color: #a9c0e7;
        }

        th {
            background-color: #003366;
            color: white;
            vertical-align: top; /* ให้อักษรอยู่ด้านบนของเซลล์ */
        }

        form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #0050b3;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #c4c4c4;
            border-radius: 4px;
            background-color: #c4d9f2;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>RESERVATION</h1>
        <!-- ตารางที่อยู่ด้านบน -->
        <table>
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>Min. (Persons)</th>
                    <th>Max. (Persons)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>A</td>
                    <td>1</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>2</td>
                    <td>8</td>
                </tr>
                <tr>
                    <td>C</td>
                    <td>8</td>
                    <td>16</td>
                </tr>
            </tbody>
        </table>

        <!-- แบบฟอร์มกรอกข้อมูลที่อยู่ด้านล่างตาราง -->
        <form>
            <div class="form-group">
                <label for="user">User</label>
                <input type="text" id="user" name="user">
            </div>
            <div class="form-group">
                <label for="date">Date (YYYY-MM-DD)</label>
                <input type="text" id="date" name="date">
            </div>
            <div class="form-group">
                <label for="start-time">Start Time</label>
                <input type="text" id="start-time" name="start-time">
            </div>
            <div class="form-group">
                <label for="end-time">End Time</label>
                <input type="text" id="end-time" name="end-time">
            </div>
        </form>

        <button type="button">Check</button>
    </div>
</body>
</html>
