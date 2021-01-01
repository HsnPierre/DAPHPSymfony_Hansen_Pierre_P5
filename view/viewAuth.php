<?php $title = 'Authentification'; ?>
<?php $subtitle ="Page d'authentification"; ?>

<?php ob_start(); ?>
<h1>Page d'authentification</h1>
<p>Lorem ipsum 4</p> 

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>