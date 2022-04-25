<?php
require_once("MyError.php");
require_once("dbconnect.php");
session_start();

$_SESSION['token'] = bin2hex(random_bytes(24));
// token = jeton unique à la session


if (!isset($_SESSION['error']))
    $_SESSION['error'] = new MyError;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Secure</title>
    <script src="tarteaucitron/tarteaucitron.js"></script>
    <script type="text/javascript">
        tarteaucitron.init({
            "privacyUrl": "cgu.php",
            /* Privacy policy url */

            "hashtag": "#tarteaucitron",
            /* Open the panel with this hashtag */
            "cookieName": "tarteaucitron",
            /* Cookie name */

            "orientation": "middle",
            /* Banner position (top - bottom) */

            "groupServices": false,
            /* Group services by category */

            "showAlertSmall": false,
            /* Show the small banner on bottom right */
            "cookieslist": false,
            /* Show the cookie list */

            "closePopup": false,
            /* Show a close X on the banner */

            "showIcon": true,
            /* Show cookie icon to manage cookies */
            //"iconSrc": "", /* Optionnal: URL or base64 encoded image */
            "iconPosition": "BottomRight",
            /* BottomRight, BottomLeft, TopRight and TopLeft */

            "adblocker": false,
            /* Show a Warning if an adblocker is detected */

            "DenyAllCta": true,
            /* Show the deny all button */
            "AcceptAllCta": true,
            /* Show the accept all button when highPrivacy on */
            "highPrivacy": true,
            /* HIGHLY RECOMMANDED Disable auto consent */

            "handleBrowserDNTRequest": false,
            /* If Do Not Track == 1, disallow all */

            "removeCredit": false,
            /* Remove credit link */
            "moreInfoLink": true,
            /* Show more info link */

            "useExternalCss": false,
            /* If false, the tarteaucitron.css file will be loaded */
            "useExternalJs": false,
            /* If false, the tarteaucitron.js file will be loaded */

            //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

            "readmoreLink": "",
            /* Change the default readmore link */

            "mandatory": true,
            /* Show a message about mandatory cookies */
        });

        tarteaucitron.services.mycustomservice = {

            "key": "mycustomservice",
            "type": "ads|analytic|api|comment|other|social|support|video",
            "name": "MyCustomService",
            "needConsent": true,
            "cookies": ['cookie', 'cookie2'],
            "readmoreLink": "/custom_read_more", // If you want to change readmore link
            "js": function() {
                "use strict";
                // When user allow cookie
            },
            "fallback": function() {
                "use strict";
                // when use deny cookie
            }

        };
    </script>
</head>

<body>
    <div class="wrapper">
        <section>
            <?php
            if (isset($_GET['error'])) {
                echo "<strong>" . $_SESSION['error'] . "</strong>";
            }

            if (!isset($_SESSION['user'])) {
                echo "<h1>Connectez-vous ! ou <a href='sign-in.php' class='lien'>inscrivez-vous içi</a></h1>";
            } else {
                echo "Bienvenue" . ucwords($_SESSION['user']['username']) . "!";
                echo "<a href='logout.php'>Deconnexion</a>";
            }
            ?>

            <!-- CREATION D'UN FORMULAIRE SIMPLE EN HTML POUR LE TRAVAILLER -->

            <form action="login.php" method="post">
                <!-- L'attribut ACTION décrit comment le formulaire HTML doit être traité (QUEL FICHIER?)
    L'attribut METHOD gère le processus de soumission des données
    POST : Les paramètres sont placés à l'intérieur du corps
    GET : Les paramètres sont placés à l'intérieur de l'URL (Vulnérable, présent en texte clair, peut-être lu par n'importe qui)  -->
                <p><input type="text" name="username" placeholder="Votre login" required></p>
                <p><input type="hidden" value="<?= $_SESSION['token'] ?>" name="token"></p>
                <p><input type="password" name="password" placeholder="Votre mot de passe" required></p>
                <input type="checkbox" name="souvenir" id="souvenir" />
                <label for="souvenir"> Se souvenir de moi</label>
                <p><input type="submit" value="Connexion" required></p>

            </form>
        </section>
    </div>

    <footer>
        <div class="rgpd">
            <a href="cgu.php">CGU</a> | <a href="ml.php">Mention légale</a>
        </div>
    </footer>
</body>



</html>