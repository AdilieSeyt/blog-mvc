<?php

    require_once('./models/dbconnect.php');
    


function userInfo($sesionUserId){
    $db = dbConnect();
	$query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute([$sesionUserId]);
	//$user contiendra les informations de l'utilisateur dont l'id a été envoyé en paramètre d'URL
    return $user = $query->fetch();
}




function updateProfile($firstname, $lastname, $email, $bio, $user_id, $password = 'unknown', $password_confirm = 'unknown'){
    $db = dbConnect();
    //début de la chaîne de caractères de la requête de mise à jour
    $queryString = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email, bio = :bio ';
    //début du tableau de paramètres de la requête de mise à jour
    $queryParameters = [ 
        'firstname' => htmlspecialchars(ucfirst($firstname)), 
        'lastname' => htmlspecialchars(strtoupper($lastname)), 
        'email' => htmlspecialchars($email), 
        'bio' => htmlspecialchars($bio), 
        'id' => $user_id
    ];
    if ($password != 'unknown') {
        if ($password == $password_confirm){
            $query_string .= ', password = :password ';
            $query_parameters['password'] = md5($password);
        }
    }
    if (($password == 'unknown') OR ($password != 'unknown' AND $password == $password_confirm)){
        $query_string .= ' WHERE id = :id';
        $query = $db->prepare($queryString);
    }
    return $result = $query->execute($queryParameters);
}