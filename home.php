<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
        <title>My Study KPI</title>
        <link rel = "stylesheet" href = "css/style.css">
        <link rel="stylesheet" href="css/login_register_style.css">
    </head>
    
    <body>
        <header class = "main">
            <nav>
                <a href = "home.php" class = "logo">
                    <img src = "img/logo.png"
                         width = auto
                         height = "105" />
                </a>
                
                <div class="menu-toggle" id="mobile-menu">
                <span></span>
                <span></span>
                <span></span>
                </div>
                
                <ul class = "menu">
                    <li><a href = "login_form.php">Login</a></li>
                    <li><a href = "register_form.php">Register</a></li>
                </ul>
            </nav>
            
            <div class = "main-heading">
                <h1>ANNOUNCEMENT</h1>
            </div>
        </header>
        
        <script>
        
            document.getElementById('mobile-menu').addEventListener('click', function() {
                document.querySelector('nav ul').classList.toggle('show');
            });
        
        </script>
    </body>
</html>