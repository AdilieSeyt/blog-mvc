
<nav class="col-3 py-2 categories-nav">
<?php if (isset($_SESSION['user'])): ?>
	<p class="h2 text-center">Salut <?php echo $_SESSION['user']['firstname']; ?> !</p>
	<p>
		<a class="d-block btn btn-danger mb-4 mt-2" href="index.php?logout">Déconnexion</a>

		<?php if ($_SESSION['user']['is_admin'] != 1): ?>
                <!-- pour ne pas afficher le bouton profile quand on est sur la page user_profile !-->
                <?php //if ($_POST['login'] ): ?>
                    <a class="d-block btn btn-warning mb-4 mt-2" href="index.php?page=profile">Profile</a>
                <?php //endif; ?>
            <?php endif; ?>

		<?php  //print_r($_SERVER); ?>
		<?php if ($_SESSION['user']['is_admin'] == 1): ?>
			<a class="d-block btn btn-warning mb-4 mt-2" href="index.php?page=admin">Administration</a>
		<?php endif; ?>
     </p>
    <!-- Sinon afficher un boutton de connexion -->
    <?php else: ?>
        <a class="d-block btn btn-primary mb-4 mt-2" href="index.php?page=login_register">Connexion / inscription</a>
    <?php endif; ?>
	<b>Catégories :</b>
	<ul>
		<li><a href="index.php?page=article_list">Tous les articles</a></li>
		<!-- liste des catégories -->
		<?php foreach($categoriesList as $key => $category): ?>
		<li><a href="index.php?page=article_list&category_id=<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
		<?php endforeach; ?>
	</ul>
</nav>
