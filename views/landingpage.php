<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>IPT- PROJECT</title>
      <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        /* CSS styles go here */
        
        /* Reset some basic styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #FFFFFF;
            background-color: #000000;
        }

        /* Navbar */
 
        .logo {
         display: flex;
         align-items: center;
        gap: 10px; /* Space between logo image and text */
        }
        .logo-image {
         width: 50px; /* Set the desired width */
        height: 50px; /* Set the desired height */
        object-fit: contain; /* Maintain the aspect ratio */
        }

       
        /* Hero Section */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 60px 40px;
            background: linear-gradient(116deg, #000000, #111111);
        }

        .hero-content {
            max-width: 50%;
        }

        .hero-content h1 {
    font-family: 'Orbitron', sans-serif; /* Font name from Google Fonts */
    font-size: 8rem;
    line-height: 1.2;
    color: #FFFFFF;
}



        .hero-content h1 span {
            color: #00aaff;
        }

        .hero-content p {
            margin: 20px 0;
            font-size: 1.1em;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #00aaff;
            color: #000000;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0088cc;
        }

        /* Hero Image */
        .hero-image img {
            max-width: 37rem;
            height: 43.5rem;
            border-radius: 10px;
        }
        /* Navigation Bar */
.navbar {
    display: flex;
    justify-content: flex-end;
    padding: 35px;
    background: linear-gradient(9deg, #000000, #111111);
}

.nav-content .nav-button {
    margin-left: 15px;
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
    border: 1px solid; /* Set border thickness */
    border-image: linear-gradient(33deg, #00d4ff, #ffffff) 1; /* Apply gradient to border */
    border-radius: 5px;
    transition: background-color 0.9s, color 0.9s;
    font-weight: bold;
}

.nav-content .nav-button:hover {
    background: linear-gradient(33deg, #00d4ff, #ffffff); /* Hover gradient for background */
    color: #000;
}


    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="nav-content">
            <a href="views\loginpage.php" class="nav-button">Login</a>
            <a href="signuppage.php" class="nav-button">Sign Up</a>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="hero">
        <div class="hero-content">
            <h1>Ahead of the <span>Future</span></h1>
            <p>
            Empowering Your World with the Latest Tech – Discover, Shop, and Thrive with Us!
            </p>
            <a href="views\loginpage.php" class="btn">Get Started →</a>
        </div>
        <div class="hero-image">
            <img src="public\images\watch.png" alt="Phone Image">
        </div>
    </section>
</body>
</html>
