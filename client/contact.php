<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #214b80;
    color: white;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
}

.contact-container {
    background-color: #214b80;
    padding: 50px;
    border-radius: 12px;
    border: 3px solid white;
    text-align: center;
    width: 100%;
    max-width: 80%; /* à¸‚à¸¢à¸²à¸¢à¸„à¸§à¸²à¸¡à¸à¸§à¹‰à¸²à¸‡à¸Ÿà¸­à¸£à¹Œà¸¡ */
    box-shadow: 0px 6px 16px rgba(0, 0, 0, 0.3);
}

h1 {
    margin-bottom: 30px;
    font-size: 36px; /* à¸‚à¸™à¸²à¸”à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£à¹ƒà¸«à¸à¹ˆà¸‚à¸¶à¹‰à¸™ */
    color: white;
    border-bottom: 2px solid white;
    padding-bottom: 10px;
}

.contact-desc {
    margin-bottom: 30px;
    font-size: 18px;
    color: white;
    white-space: nowrap;
}

.contact-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 100%;
}

label {
    margin: 10px 0 5px;
    text-align: left;
    width: 100%;
    font-size: 18px; /* à¸›à¸£à¸±à¸šà¸‚à¸™à¸²à¸”à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£ */
}

input, textarea {
    padding: 15px;
    margin-bottom: 20px;
    border: none;
    border-radius: 6px;
    width: 100%; /* à¸—à¸³à¹ƒà¸«à¹‰ input à¸„à¸£à¸­à¸šà¸„à¸¥à¸¸à¸¡à¸„à¸§à¸²à¸¡à¸à¸§à¹‰à¸²à¸‡à¸‚à¸­à¸‡ container */
    background-color: white;
    color: #333;
    font-size: 16px; /* à¸‚à¸™à¸²à¸”à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£à¹ƒà¸™à¸à¸¥à¹ˆà¸­à¸‡ input */
}

textarea {
    height: 150px; /* à¸›à¸£à¸±à¸šà¸‚à¸™à¸²à¸”à¸‚à¸­à¸‡ textarea */
}

button {
    padding: 15px 30px;
    background-color: #3b75e5;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 18px; /* à¸‚à¸™à¸²à¸”à¸•à¸±à¸§à¸­à¸±à¸à¸©à¸£à¹ƒà¸«à¸à¹ˆà¸‚à¸¶à¹‰à¸™ */
    width: 30%; /* à¸—à¸³à¹ƒà¸«à¹‰à¸›à¸¸à¹ˆà¸¡à¸à¸§à¹‰à¸²à¸‡à¸‚à¸¶à¹‰à¸™ */
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2a5db7;
}

/* Media Query à¸ªà¸³à¸«à¸£à¸±à¸šà¸«à¸™à¹‰à¸²à¸ˆà¸­à¸¡à¸·à¸­à¸–à¸·à¸­ */
@media (max-width: 1024px) {
    .contact-container {
        padding: 30px;
        max-width: 90%;
    }

    h1 {
        font-size: 28px;
    }

    button {
        width: 100%; /* à¸›à¸£à¸±à¸šà¹ƒà¸«à¹‰à¸›à¸¸à¹ˆà¸¡à¸à¸§à¹‰à¸²à¸‡à¹€à¸•à¹‡à¸¡à¸žà¸·à¹‰à¸™à¸—à¸µà¹ˆà¸ªà¸³à¸«à¸£à¸±à¸šà¸¡à¸·à¸­à¸–à¸·à¸­ */
    }
}
    </style>
</head>
<body>
    <div class="contact-container">
        <h1>Contact us</h1>
        <p class="contact-desc">You can comment / ask / report through this form</p>
        <form class="contact-form">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>

            <label for="fullname">Full name</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Send</button>
        </form>
    </div>
</body>
</html>
