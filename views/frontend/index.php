<!DOCTYPE html>
<html>
	<head>
		<title>Homepage - Mon premier blog !</title>
		<?php require '././partials/frontend/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require '././partials/frontend/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require '././partials/frontend/nav.php'; ?>

				<main class="col-9">
					<?php if (isset($_SESSION['message'])):?>
						<?php foreach ($_SESSION['message'] as $alert):?>
							<p class="text-success"><?php echo $alert;?></p>
							<?php unset($_SESSION['message']);?>
						<?php endforeach;?>
					<?php endif;?>

					<section class="latest_articles">
						<header class="mb-4"><h1>Les 3 derniers articles :</h1></header>

						<!-- les trois derniers articles -->

						<?php foreach($homeArticles as $key => $article): ?>
						<article class="mb-4">
							<h2><?php echo $article['title']; ?></h2>
							<div class="row">
								<?php if( !empty($article['image'])): ?>
									<div class="col-12 col-md-4 col-lg-3">
										<img class="img-fluid" src="././assets/img/<?= $article['image']; ?>" alt="" />
									</div>
								<?php endif; ?>	
								<b class="article-category">[<?php echo $article['name']; ?>]</b>  
								<span class="article-date">
									<!-- affichage de la date de l'article selon le format %A %e %B %Y -->
									<?php echo strftime("%A %e %B %Y", strtotime($article['published_at'])); ?>
								</span>
								<div class="article-content">
									<?php echo $article['summary']; ?>
								</div>
								<a href="article.php?article_id=<?php echo $article['id']; ?>">> Lire l'article</a>
							</div>
						</article>
						<?php endforeach; ?>

					</section>
					<div class="text-right">
						<a href="index.php?page=article_list">> Tous les articles</a>
					</div>
				</main>
			</div>

			<?php require '././partials/frontend/footer.php'; ?>

		</div>
	</body>
</html>
