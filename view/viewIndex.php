<?php $title = 'Home Page'; ?>
<?php $subtitle ='Hello world !'; ?>

<?php ob_start(); ?>
<h1>Hello world !</h1>
<p>Lorem ipsum</p> 

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>