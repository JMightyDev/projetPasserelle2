<?php
    $path = BASE_URL;
?>
<!DOCTYPE html>
<html lang="fr" class="h-100">
    <head>
        <script src="<?= $path ?>node_modules/tarteaucitronjs/tarteaucitron.min.js"></script>
        <script>
            tarteaucitron.init({
                "privacyUrl": "", /* Privacy policy url */
                "bodyPosition": "bottom", /* or top to bring it as first element for accessibility */

                "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
                "cookieName": "tarteaucitron", /* Cookie name */

                "orientation": "middle", /* Banner position (top - bottom - middle - popup) */

                "groupServices": false, /* Group services by category */
                "showDetailsOnClick": true, /* Click to expand the description */
                "serviceDefaultState": "wait", /* Default state (true - wait - false) */

                "showAlertSmall": false, /* Show the small banner on bottom right */
                "cookieslist": false, /* Show the cookie list */
                
                "showIcon": true, /* Show cookie icon to manage cookies */
                // "iconSrc": "", /* Optional: URL or base64 encoded image */
                "iconPosition": "BottomRight", /* Position of the icon between BottomRight, BottomLeft, TopRight and TopLeft */

                "adblocker": false, /* Show a Warning if an adblocker is detected */

                "DenyAllCta" : true, /* Show the deny all button */
                "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
                "highPrivacy": true, /* HIGHLY RECOMMANDED Disable auto consent */
                "alwaysNeedConsent": false, /* Ask the consent for "Privacy by design" services */
                
                "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

                "removeCredit": false, /* Remove credit link */
                "moreInfoLink": true, /* Show more info link */
                "useExternalCss": false, /* If false, the tarteaucitron.css file will be loaded */
                "useExternalJs": false, /* If false, the tarteaucitron.services.js file will be loaded */

                // "cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for subdomain website */

                "readmoreLink": "", /* Change the default readmore link pointing to tarteaucitron.io */
                
                "mandatory": true, /* Show a message about mandatory cookies */
                "mandatoryCta": true, /* Show the disabled accept button when mandatory on */
                
                // "customCloserId": "", /* Optional a11y: Custom element ID used to open the panel */

                "googleConsentMode": true, /* Enable Google Consent Mode v2 for Google ads and GA4 */
                
                "partnersList": false /* Details the number of partners on the popup and middle banner */
            });
        </script>
        <meta charset="UTF-8">
        <meta name="description" content="Knight's Corner - The place white knights developpers discuss">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $title ?> | JMighty</title>
        <link rel="stylesheet" href="<?= $path ?>public/design/default.css"/>
        <link rel="shortcut icon" type="image/png" href="<?= $path ?>public/assets/favicon.png">
    </head>

    <body class="bg-secondary pt-5 d-flex flex-column h-100">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MM7V8R9"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        <header>
            <nav class="navbar navbar-expand-lg bg-perso1 fixed-top" data-bs-theme="dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= $path ?>./">Knight's Corner</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <?php if ($onglet == "articles") { ?>
                                    <a class="nav-link active" aria-current="page" href="<?= $path ?>articles">Articles</a>
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= $path ?>articles">Articles</a>
                                <?php } ?>
                            </li>
                            <li class="nav-item">
                                <?php if ($onglet == "projects") { ?>
                                    <a class="nav-link active" aria-current="page" href="<?= $path ?>projects">Projets</a>
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= $path ?>projects">Projets</a>
                                <?php } ?>
                            </li>
                        </ul>
                        <ul class="navbar-nav d-flex">
                            <?php if (isset($_SESSION['username'])) { ?>
                                <span class="navbar-text me-5">Bienvenue <?= htmlspecialchars($_SESSION['username']); ?> !</span>
                                <li class="nav-item">
                                    <a href="<?= $path ?>logout" class="nav-link">Se déconnecter</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a href="<?= $path ?>login" class="nav-link">Se connecter</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main class="flex-shrink-0 mb-4">
            <?= $content ?>
        </main>
        <hr class="hr mt-auto mb-0 mx-5">
        <footer class="footer py-3">
            <div class="container">
                <span class="text-perso1">© JMighty 2024</span> - <a href="#" id="open_preferences_center">Change your preferences</a>
            </div>
        </footer>
        <script src="<?= $path ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            tarteaucitron.user.gtagUa = 'G-F5Y6FV48JS';
            tarteaucitron.user.gtagCrossdomain = ['jmighty.fr', 'blog.jmighty.fr'];
            tarteaucitron.user.googletagmanagerId = 'GTM-5MM7V8R9';
            (tarteaucitron.job = tarteaucitron.job || []).push('googletagmanager');
            (tarteaucitron.job = tarteaucitron.job || []).push('gtag');
            (tarteaucitron.job = tarteaucitron.job || []).push('gcmanalyticsstorage');
            (tarteaucitron.job = tarteaucitron.job || []).push('gcmfunctionality');
        </script>
    </body>
</html>