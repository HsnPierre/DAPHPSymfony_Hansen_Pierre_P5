<?php $title = ''; ?>
<?php $subtitle =''; ?>

<?php ob_start(); ?>
<h1></h1>
<p></p> 

<?php $content = ob_get_clean(); ?>

<?php require('Views/template.php'); ?>