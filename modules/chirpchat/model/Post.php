<?php

namespace ChirpChat\Model;

use \ChirpChat\Model\Category;

class Post{
    /**
     * @param string $idPost
     * @param string|null $titre
     * @param string $message
     * @param string $datePubli
     * @param \ChirpChat\Model\Category[] $categorie
     * @param $utilisateur
     * @param int $commentAmount
     * @param int $likeAmount
     */
    public function __construct(public string $idPost,?string $titre, public string $message,string $datePubli, private array $categorie,private $utilisateur, public int $commentAmount, public int $likeAmount ){ }

    public function getUser() : User{
        return $this->utilisateur;
    }

    /**
     * @return Category[]
     */
    public function getCategories() : array{
        return $this->categorie;
    }

    public function isLikedByUser($userId) : bool{
        $postRepo = new \ChirpChat\Model\PostRepository(Database::getInstance()->getConnection());
        return $postRepo->isAlreadyLiked($this->idPost, $userId);

    }
}