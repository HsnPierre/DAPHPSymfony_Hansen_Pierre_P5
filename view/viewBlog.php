<?php $title = 'Blog'; ?>
<?php $subtitle ='Ceci est mon blog'; ?>

<?php ob_start(); ?>
<h1>Mon blog</h1>
<p>Lorem ipsum 2</p> 

<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>