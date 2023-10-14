<?php

    require '_assets/includes/autoloader.php';

    session_start();

    if(filter_input(INPUT_GET, 'action')) {
        if ($_GET['action'] === 'inscription') {
            (new \ChirpChat\Controllers\Inscription())->execute();
        } else if ($_GET['action'] === 'connexion') {
            (new \ChirpChat\Controllers\ConnectionPage())->execute();
        } else if ($_GET['action'] === 'recuperation') {
            (new \ChirpChat\Controllers\Recovery())->execute();
        } else if ($_GET['action'] === 'registerUser') {
            (new \ChirpChat\Controllers\User)->register();
        } else if ($_GET['action'] === 'loginUser') {
            (new \ChirpChat\Controllers\User)->login();
        }  else if ($_GET['action'] === 'comment'){
            if(isset($_GET['id'])){
                (new \ChirpChat\Controllers\Comment())->displayComment();
            }
        }  else if ($_GET['action'] === 'search'){
            (new \ChirpChat\Controllers\Post())->searchPost();
        } else if ($_GET['action'] === 'categoryList'){
            (new \ChirpChat\Controllers\CategoryController())->displayCategoryListPage();
        } else if ($_GET['action'] === 'categoryCreation'){
            (new \ChirpChat\Controllers\CategoryController())->displayCategoryCreationPage();
        } else if ($_GET['action'] === 'createCategory'){
            (new \ChirpChat\Controllers\CategoryController())->createCategory();
        }

        // ---- A BESOIN QUE L'UTILISATEUR SOIT CONNECTÉ ----

        else if (!isset($_SESSION['ID'])){
            header("Location:index.php?action=connexion");
        }
        else if ($_GET['action'] === 'sendPost') {
            (new \ChirpChat\Controllers\Post)->addPost();
        } else if ($_GET['action'] === 'like'){
            (new \ChirpChat\Model\PostRepository(\Chirpchat\Model\Database::getInstance()->getConnection()))->addLike($_GET['id'],$_SESSION['ID']);
            header("Location:index.php#" . $_GET['id']);
        }
        else if ($_GET['action'] === 'addComment') {
            (new \ChirpChat\Controllers\Comment())->addComment();
        } else if ($_GET['action'] === 'privateMessage'){
            (new \ChirpChat\Controllers\PrivateMessageController())->displayPrivateMessagePageForUser($_SESSION['ID']);
        } else if ($_GET['action'] === 'privateMessageWith'){
            if(isset($_GET['id'])){
                (new \ChirpChat\Controllers\PrivateMessageController())->displayConversationBetweenUsers($_SESSION['ID'], $_GET['id']);
            }
        } else if ($_GET['action'] === 'sendMessageTo'){
            if(isset($_GET['id'])){
                (new \ChirpChat\Controllers\PrivateMessageController())->sendMessageTo($_GET['id']);
            }
        }
    }
    else {
        (new \ChirpChat\Controllers\HomePage)->execute();
    }



