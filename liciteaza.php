<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<html>
    <head>

        <title> Licitatie </title>
        <link rel="stylesheet" type="text/css" href="style.css">
         
    </head>
    <body>
        <font face="Arial">
            <div class="bara_prezentare">
                <ul class="bara_start">
                    <img class="poza_logo" src="poze/logo_site.png">
                    <li><a href="despre_noi.php">Despre noi</a></li>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </div>
            <div class="masini_liciteaza1">
                <h1>BMW Seria 3</h1>
                <div class="masini_liciteaza2">
                    <img class ="poza_masina_liciteaza" src="poze/E46.jpg">
                    <ul class="Detalii1_liciteaza">
                        <p>Capacitate motor:1995 cm^3</p>
                        <p>Putere:150 CP</p>
                        <p>Combustibil:Diesel</p>
                        <p>Caroserie:Berlina</p>
                        <p>Culoare:Gri</p>
                        <p>An de fabricatie:2002</p>
                    </ul>
                    <ul class="Detalii2_liciteaza">
                        <p>Numar de usi:3</p>
                        <p>Cutie de viteze:Automata</p>
                        <p>Volan:Partea stanga</p>
                        <p>Rulaj:292 000 km</p>
                        <font color="red">
                        <p id="pret">Pret actual:1200$</p>
                        <P>Timp ramas pana la incheierea licitatiei: <span id="timp_ramas">00:01:00</span></P>
                        </font>
                    </ul>
                </div>
                <button class="Liciteaza_final" id="buton_licitatie">Liciteaza!</a></button>
            </div>
        </font>
        <script src="script_liciteaza.js"></script>
    </body>
</html>