<?php $title = 'Erreur'; ?>

<?php ob_start(); ?>
<p>Une erreur est survenue</p> 

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>