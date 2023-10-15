<?php

namespace ChirpChat\Views;

use ChirpChat\Model\Category;
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
            <h1 id="titreCategorie"> Catégories </h1><br/>
            <a href="index.php?action=categorieAnimaux" id="lienCategorieAnimaux">ANIMAUX</a><br/>
            <a href="index.php?action=categorieSport" id="lienCategorieSport">SPORT</a><br/>
            <a href="index.php?action=categorieAuto" id="lienCategorieAuto">VOITURES</a><br/>
            <a href="index.php?action=categorieGaming" id="lienCategorieGaming">GAMING</a>
            <a href="index.php?action=categoryList"><p>Voir plus</p></a>
        </div>
        <?php
        $this->categoriesView = ob_get_clean();
        return $this;
    }

    public function setPostListView($postList, $categories) : HomePageView {
        ob_start();
        ?><div id="postList">
        <?php if(isset($_SESSION['ID'])){?>

            <form action="index.php?action=sendPost" id="writePostSection" method="post">
                <img alt="photo de profil" src="https://cdn-icons-png.flaticon.com/512/436/436299.png">
                <div id="userInputContent">
                    <input type="text" placeholder="Donnez un titre !" name="titre" required></input>
                    <textarea spellcheck="false" maxlength="160" placeholder="Envoyez un message !" name="message" required></textarea>
                    <input type="submit" value="POSTER">
                    <select id="category" multiple name="categories[]" required>
                        <?php $this->getCategoriesList($categories) ?>
                    </select>
                    <script>
                        new SlimSelect({
                            select: '#category',
                            settings: {
                                placeholderText: 'Choisir une catégorie',
                                searchPlaceholder: 'Rechercher',
                            }
                        })
                    </script>
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
            <h1 id="titreBestPost"> Les plus likés </h1><br/>
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
        (new \ChirpChat\Views\mainLayout("Accueil", $content))->show(['homepage.css', 'post.css'],$user);
    }

    /**
     * @param Category[] $categoriesList
     * @return void
     */
    public function getCategoriesList(array $categoriesList) : void{
        echo sizeof($categoriesList);
        foreach($categoriesList as $category){
            echo '<option>' . $category->getLibelle() . '</option>';
        }
    }
}