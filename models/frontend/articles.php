<?php

	require_once('./models/dbconnect.php');

	
	function articleList(){
		$db = dbConnect();

		$query = $db->query('SELECT title, published_at, summary, a.id, GROUP_CONCAT(name) AS name, a.image 
		FROM article a INNER JOIN articles_categories ac
		ON a.id = ac.article_id  
		INNER JOIN  category c
		ON ac.category_id = c.id
		WHERE published_at <= NOW() AND is_published=1 
		GROUP BY a.id
		ORDER BY published_at DESC LIMIT 0, 3 ');
		return $homeArticles=$query->fetchAll();
	}





	//selection des articles de la catégorie demandée
	function artParCategory($categoryId){
		$db = dbConnect();
		$queryArticles = $db->prepare('SELECT a.*, ac.category_id
		FROM article a INNER JOIN articles_categories ac
		ON a.id = ac.article_id  
		WHERE published_at <= NOW() AND is_published=1 AND ac.category_id = ?
		ORDER BY published_at DESC');
		$queryArticles->execute( [ $categoryId ] );
		return $articles = $queryArticles->fetchAll();
	}

	//selection des informations de la catégorie demandée
	function selectCategory( $categoryId ){
		$db = dbConnect();
		$queryCategory = $db->prepare('SELECT * FROM category WHERE id = ?');
		$queryCategory->execute( [ $categoryId ] );
		return $selectedCategory = $queryCategory->fetch();
	}


	function allArticlesList(){
	//si pas decatégorie demandée j'affiche tous les articles
	$db = dbConnect();
	$queryArticles = $db->query('SELECT title, published_at, summary, a.id, GROUP_CONCAT(name) AS name, a.image 
		FROM article a INNER JOIN articles_categories ac
		ON a.id = ac.article_id  
		INNER JOIN  category c
		ON ac.category_id = c.id
		WHERE is_published=1 
		GROUP BY a.id 
		ORDER BY published_at DESC');
		return $articles = $queryArticles->fetchAll();

	}


function openArticle ($article_id){
		$db = dbConnect();
		$query = $db->prepare('SELECT a.*, GROUP_CONCAT(name) as category_name 
		FROM article a INNER JOIN articles_categories ac
		ON a.id = ac.article_id  
		INNER JOIN  category c
		ON ac.category_id = c.id
		WHERE a.id = ?');
		$query->execute([$article_id]);
		return $article = $query->fetch();
	}