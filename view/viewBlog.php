<?php $title = 'Blog'; ?>
<?php $subtitle ='Ceci est mon blog'; ?>
<?php $image ="public/img/blog-bg.jpg"; ?>

<?php ob_start(); ?>



<?php $content = ob_get_clean(); ?>

<?php require('view/template.php'); ?>