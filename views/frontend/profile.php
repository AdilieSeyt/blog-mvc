<!DOCTYPE html>
<html>
<?php require '././partials/frontend/head_assets.php'; ?>
<?php ob_start(); ?>
 <body class="article-body">
	<div class="container-fluid">

    <?php require '././partials/frontend/header.php'; ?>

		<div class="row my-3 article-content">

			
        <?php require '././partials/frontend/nav.php'; ?>


			<main class="col-9">
                <?php foreach ($alerts as $alert):?>
                    <p class="text-danger"><?php echo $alert;?></p>
                <?php endforeach;?>
                <?php foreach ($success as $succes):?>
                    <p class="text-success"><?php echo $succes;?></p>
                <?php endforeach;?>		
				<form action="index.php?page=profile&user_id=<?= $_SESSION['user']['id'];?>" method="post" class="p-4 row flex-column">

					<h4 class="pb-4 col-sm-8 offset-sm-2">Mise à jour des informations utilisateur</h4>

					
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="firstname">Prénom <b class="text-danger">*</b></label>
						<input class="form-control" value="<?= isset($user) ? $user['firstname'] : ''; ?>" type="text" placeholder="Prénom" name="firstname" id="firstname" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="lastname">Nom de famille</label>
						<input class="form-control" value="<?= isset($user) ? $user['lastname'] : ''; ?>" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="email">Email <b class="text-danger">*</b></label>
						<input class="form-control" value="<?= isset($user) ? $user['email'] : ''; ?>" type="email" placeholder="Email" name="email" id="email" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="password">Mot de passe (uniquement si vous souhaitez modifier votre mot de passe actuel)</label>
						<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="password_confirm">Confirmation du mot de passe (uniquement si vous souhaitez modifier votre mot de passe actuel)</label>
						<input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="bio">Biographie</label>
						<textarea class="form-control" name="bio" id="bio" placeholder="Ta vie Ton oeuvre..."><?= isset($user) ? $user['bio'] : ''; ?></textarea>
					</div>

					<div class="text-right col-sm-8 offset-sm-2">
						<p class="text-danger">* champs requis</p>
						<input class="btn btn-success" type="submit" name="update" value="Valider" />
					</div>
                    <!-- Si $user existe, on ajoute un champ caché contenant l'id de l'utilisateur à modifier pour la requête UPDATE -->
                    <?php if(isset($user)): ?>
                        <input type="hidden" name="id" value="<?= $_SESSION['user']['id']?>" />
                    <?php endif; ?>

				</form>
			</main>
		</div>

		<footer class="row mt-3">
	<div class="col py-2 text-right">
		<b>Footer du site</b>
	</div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.1/jquery.fancybox.min.js"></script>

<!-- <script src="js/main.js"></script> -->

	</div>
 </body>
</html>