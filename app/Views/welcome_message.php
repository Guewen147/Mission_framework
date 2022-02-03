
<html>

<head>
    <title>W3CAM</title>
    <link href="/public/assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="/public/assets/img/w3cam-logo.jpg" />
    <img src="/public/assets/img/w3cam-logo.jpg" alt="logo W3CAM" class="logo" />
</head>

<body>
    </div>
    <div class="bar-navigation">
        <nav class="main-navigation">
            <div class="nav-menu">
                <ul>
                    <li>
                        <a href="#">Info commande</a>
                        <ul class='children'>
                            <li>
                                <form name="commandeAxis" action=<?php echo base_url('Home/commandeAxis') ?> method="GET">
                                    <input id="tete" type="submit" value=" Commande AXIS">
                            </li>
                            <li>
                                <form name="commandeHikvision" action=<?php echo base_url('Home/commandehikvision') ?> method="GET">
                                    <input id="tete" type="submit" value=" Commande HikVision">
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="ubitech.php">Ubitech</a>
                    </li>
                    <li>
                        <a href="#">Modification Prix HikVision</a>
                        <ul class='children'>
                            <li>
                                <form name="prixHikvision" action=<?php echo base_url('Home/prixhikvission') ?> method="GET">
                                    <input id="tete" type="submit" value="Modification Prix HIKVISION">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Document Forcast JC</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('Home/login') ?>">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

</body>