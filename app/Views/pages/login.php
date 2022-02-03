<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <title><?= 'Connexion' ?> </title>
    <link href="<?=base_url('assets/css/styleLog.css')?>" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png" href="<?=base_url('assets/img/w3cam-logo.jpg')?>"/>
    <img src="<?=base_url('assets/img/w3cam-logo.jpg')?>" alt="logo W3CAM" class="logo" />
</head>

<body>
    <div id="container">
        <!-- zone de connexion -->

        <form action="<?= base_url('Home/login');?>" method="POST">
            <h1>Connexion</h1>
            

            
            <label><b>Email d'utilisateur</b></label>
            <input type="text" placeholder="Entrer l'email d'utilisateur" name="email" value="" required>

            <label><b>Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="passwd" required>

            <input type="submit" id='submit' value='Se connecter'>
            <?php /*
            if (isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if ($err == 1 || $err == 2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
            */?>
            <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-warning">
                       <?= session()->getFlashdata('msg') ?>
                    </div>
            <?php endif;?>
        </form>
    </div>
</body>

</html>