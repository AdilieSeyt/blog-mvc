<?php
// require_once('_tools.php');
require_once('controllers/frontend/controller.php');




if(isset($_GET['page'])){

  switch ($_GET['page']) {
    case 'article_list':
    allArticles();

      break;
    case 'article':
    article();
      break;

    case 'login_register':
    loginRegister();
      break;
    case 'profile':
    profile();
    break;
    default:

        break;
  }

}
else{
  if(isset($_GET['logout'])){
    unset($_SESSION['user']);
		header('location:index.php');
    }
    home();

}

