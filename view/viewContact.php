<?php $title = 'Contact'; ?>
<?php $subtitle ='Nous contacter'; ?>

<?php ob_start(); ?>
<h1>Page de contact</h1>
<p>Lorem ipsum 3</p> 

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>