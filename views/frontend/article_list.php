<!DOCTYPE html>
<html>
 <head>

	 <title><?php if(isset($_GET['category_id'])): ?><?php echo $selectedCategory['name']; ?><?php else: ?>Tous les articles<?php endif; ?> - Mon premier blog !</title>
   <?php require '././partials/frontend/head_assets.php'; ?>

 </head>
 <body class="article-list-body">
	<div class="container-fluid">

		<?php require '././partials/frontend/header.php'; ?>

		<div class="row my-3 article-list-content">

			<?php require('././partials/frontend/nav.php'); ?>

			<main class="col-9">
				<section class="all_aricles">
					<header>
						<?php if(isset($_GET['category_id'])): ?>
						<h1 class="mb-4"><?php echo $selectedCategory['name']; ?></h1>
						<?php else: ?>
						<h1 class="mb-4">Tous les articles :</h1>
						<?php endif; ?>
					</header>

					<?php if(isset($_GET['category_id'])): ?>
					<div class="category-description mb-4">
					<?php echo $selectedCategory['description']; ?>
					</div>
					<?php endif; ?>
					<!-- s'il y a des articles à afficher -->
					<?php if(count($articles) > 0): ?>
						<?php foreach($articles as $key => $article): ?>
							<?php if( !isset($_GET['category_id']) OR ( isset($_GET['category_id']) AND $article['category_id'] == $_GET['category_id'] ) ): ?>
							<article class="mb-4">
								<h2><?php echo $article['title']; ?></h2>
								<div class="row">
									<?php if( !empty($article['image'])): ?>
										<div class="col-12 col-md-4 col-lg-3">
											<img class="img-fluid" src="././assets/img/<?= $article['image']; ?>" alt="" />
										</div>
									<?php endif; ?>								 
									<?php if( !isset($_GET['category_id'])): ?>
									<b class="article-category">[<?php echo $article['name']; ?>]</b>  
									<?php endif; ?>
									<span class="article-date">
										<!-- affichage de la date de l'article selon le format %A %e %B %Y -->
										<?php echo strftime("%A %e %B %Y", strtotime($article['published_at'])); ?>
									</span>
									<div class="article-content">
										<?php echo $article['summary']; ?>
									</div>
									<a href="index.php?page=article&article_id=<?php echo $article['id']; ?>">> Lire l'article</a>
								</div>
							</article>
							<?php endif; ?>
						<?php endforeach; ?>
					<!-- s'il n'y a pas d'articles à afficher -->
					<?php else: ?>
						aucun article
					<?php endif; ?>
				</section>
			</main>

		</div>

		<?php require '././partials/frontend/footer.php'; ?>

	</div>
 </body>
</html>
