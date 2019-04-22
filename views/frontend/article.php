
<!DOCTYPE html>
<html>
 <head>

	<title><?php echo $article['title']; ?> - Mon premier blog !</title>

   <?php require '././partials/frontend/head_assets.php'; ?>

 </head>
 <body class="article-body">
	<div class="container-fluid">

		<?php require '././partials/frontend/header.php'; ?>

		<div class="row my-3 article-content">

			<?php require '././partials/frontend/nav.php'; ?>

			<main class="col-9">
				<article>
					<?php if( !empty($article['image'])): ?>
                        <img class="pb-4 img-fluid w-50" src="././assets/img/<?= $article['image']; ?>" alt="" />
                    <?php endif; ?>
					<h1><?php echo $article['title']; ?></h1>
					<b class="article-category">[<?php echo $article['category_name']; ?>]</b>
					<span class="article-date">
						<!-- affichage de la date de l'article selon le format %A %e %B %Y -->
						<?php echo strftime("%A %e %B %Y", strtotime($article['published_at'])); ?>
					</span>
					<div class="article-content">
						<?php echo $article['content']; ?>
					</div>
				</article>
			</main>

		</div>

		<?php require '././partials/frontend/footer.php'; ?>

	</div>
 </body>
</html>
