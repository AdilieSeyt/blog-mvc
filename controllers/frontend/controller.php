<?php
require_once('./models/frontend/articles.php');
require_once('./models/frontend/login_register.php');
require_once('./models/frontend/profile.php');
require_once('./models/frontend/nav.php');



function home(){//articles
    $homeArticles = articleList();
    $categoriesList = nav();
    require('././views/frontend/index.php');
}

function allArticles(){
    //si une catégorie est demandée
if (isset($_GET['category_id'])) {
	//si l'id envoyé n'est pas un nombre entier, je redirige
	if (!ctype_digit($_GET['category_id'])) {
		header('location:index.php');
		exit;
	}
    $articles = artParCategory($_GET['category_id']);
    $selectedCategory = selectCategory($_GET['category_id']);

	//si la catégorie n'a pas été trouvé je redirige
	if ($selectedCategory == false) {
		header('location:index.php');
		exit;
	}
}
else {
    $articles = allArticlesList();
}
$categoriesList = nav();
require('././views/frontend/article_list.php');

//puis je récupère les données selon la requête générée avant
}




function article(){
	//si j'ai reçu article_id ET que c'est un nombre
	if(isset($_GET['article_id']) AND ctype_digit($_GET['article_id'])){
		$article = openArticle($_GET['article_id']);
        $categoriesList = nav();
        require_once('././views/frontend/article.php');

		//si aucun article n'a été trouvé je redirige
		// if($article == false){
		// 	header('location:index.php');
		// 	exit;
		// }
	}
	else{ //sinon je redirige
		header('location:index.php');
		exit;
	}
}




function loginRegister(){
$categoriesList = nav();

$alerts=[];
$success =[];

if(isset($_POST['login'])){
	if(!empty($_POST['email']) AND !empty($_POST['password'])){
        $selectedLogin = user_info($_POST['email'], $_POST['password']);
		if($_POST['email'] == $selectedLogin['email'] AND md5($_POST['password']) == $selectedLogin['password'] ){
			$_SESSION['user']['firstname'] = $selectedLogin['firstname'];
			$_SESSION['user']['is_admin'] = $selectedLogin['is_admin'];
            $_SESSION['user']['id'] = $selectedLogin['id'];
			header('location:index.php');
			exit;
		}elseif($_POST['email'] == $selectedLogin['email'] AND md5($_POST['password']) !== $selectedLogin['password']){
			$alerts['error_acces'] ="Le mot de passe n'est pas correcte";

		}else{
			$alerts['error_acces'] ="Vous n'etes pas inscris ";
		}
	}
	if(empty($_POST['email'])){
		$alerts['email'] ="L'adresse email est obligatoire";
	}
	if(empty($_POST['password'])){
		$alerts['password'] ="Le mot passe est obligatoire";
	}
}
$nameCategory = isset ($_POST['name']) ? ($_POST['name']) : NULL;
$description = isset ($_POST['description']) ? ($_POST['description']) : NULL;

if(isset($_POST['register'])){
	if(!empty($_POST['firstname']) AND !empty($_POST['email']) AND !empty($_POST['password']) AND !empty($_POST['password_confirm'])){
        $mailExiste = mail_existe($_POST['email']);
		if(!$mailExiste AND $_POST['password'] == $_POST['password_confirm']){
            $lastInsert = new_visitor($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['bio']);
			$_SESSION['user']['firstname'] = $_POST['firstname'];
            $_SESSION['user']['is_admin'] = 0;
            $_SESSION['user']['id']= $lastInsert;
			header('location:index.php');
			exit;
		}elseif($mailExiste){
			$alerts['mail_existe'] ="L'adresse email est existe déjà ";
		}else{
			$alerts['error_confirm'] ="Les motes de passe ne sont pas les memmes";
		}
	}
	if (empty($_POST['firstname'])){ 
		$alerts['firstname'] ="Le prénom est obligatoire";
	}
	if(empty($_POST['email'])){
		$alerts['email'] ="L'adresse email est obligatoire";
	}
	if(empty($_POST['password'])){
		$alerts['password'] ="Le mot passe est obligatoire";
	}
	if(empty($_POST['password_confirm'])){
		$alerts['password_confirm'] ="Veuillez confirmer le mot de passe";
	}
}
require('././views/frontend/login_register.php');

}



function profile(){
$categoriesList = nav();

$alerts=[];
$success =[];


//si on modifie un utilisateur, on doit séléctionner l'utilisateur en question (id envoyé dans URL) pour pré-remplir le formulaire plus bas
if(isset($_SESSION['user']['id'])){
    $user = userInfo($_SESSION['user']['id']);
}

//Si $_POST['update'] existe, cela signifie que c'est une mise à jour d'utilisateur
if(isset($_POST['update'])){
    if(empty($_POST['firstname']) OR empty($_POST['email'])){
		$alerts['empty'] ="Tous les champs sont obligatoire";
    }elseif(!empty($_POST['password'])){
        if($_POST['password'] != $_POST['password_confirm'] ){
            $alerts['password_diff'] ="Les mots de passe sont differents!";
        }else{
            $result = updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['bio'], $_POST['user_id'], $_POST['password'], $_POST['password_confirm']);
            //concaténation du champ password à mettre à jour
            // $queryString .= ', password = :password ';
            //ajout du paramètre password à mettre à jour
            // $queryParameters['password'] = hash('md5', $_POST['password']);
        }
    }else{
        $result = updateProfile($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['bio'], $_POST['user_id']);

    }
    if(isset($result) AND $result){
        $_SESSION['message']['updated']="Modification effectué avec succés";
        header('location:index.php');
        exit;
    }
    $user['firstname'] = $_POST['firstname'];
    $user['lastname'] = $_POST['lastname'];
    $user['email'] = $_POST['email'];
    $user['bio'] = $_POST['bio'];
}
require ('././views/frontend/profile.php');

}

