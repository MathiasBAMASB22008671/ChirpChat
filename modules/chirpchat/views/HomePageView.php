<?php

namespace ChirpChat\Views;

use Chirpchat\Model\Database;
use ChirpChat\Model\Post;
use ChirpChat\Model\User;
use ChirpChat\Model\UserRepository;

class HomePageView {

    private string $categoriesView;
    private string $postListView;
    private string $bestPostView;

    public function setCategoriesView() : HomePageView{
        ob_start();
        ?> <div id="categories">
            <h1 id="titreCategorie"> Catégories </h1>
            <a href="index.php?action=categorie" id="liensCategories">ANIMAUX</a>
        </div>
        <?php
        $this->categoriesView = ob_get_clean();
        return $this;
    }

    public function setPostListView($postList) : HomePageView {
        ob_start();
        ?><div id="postList">
        <?php if(isset($_SESSION['ID'])){?>
            <form action="index.php?action=sendPost" id="writePostSection" method="post">
                <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/436/436299.png">
                <div id="userInputContent">
                    <input type="text" placeholder="Donnez un titre !" name="titre"></input>
                    <textarea spellcheck="false" maxlength="160" placeholder="Envoyez un message !" name="message"></textarea>
                    <input type="submit" value="POSTER">
                </div>
            </form>
        <?php } foreach($postList as $post){
            (new \ChirpChat\Views\PostView($post))->show();
        }?></div><?php

        $this->postListView = ob_get_clean();
        return $this;
    }


    public function setBestPostView() : HomePageView {
        ob_start();
        ?>
        <div id="bestPost">
        </div>
        <?php
        $this->bestPostView = ob_get_clean();
        return $this;
    }

    public function displayHomePageView($user) : void {
        ob_start();
        ?><main style="display: flex;justify-content: space-around">
            <?= $this->categoriesView ?>
            <?= $this->postListView ?>
            <?= $this->bestPostView ?>
        </main>
        <?php

        $content = ob_get_clean();
        (new \ChirpChat\Views\MainLayout("Accueil", $content))->show(['homePage'], $user);
    }
}
