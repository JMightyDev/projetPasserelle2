<?php

require_once('Manager.php');

class ArticleManager extends Manager {
    
    public function getArticles() {
        $bdd = $this->connection();
        return $articles = $bdd->query('SELECT * FROM articles WHERE type = 1 ORDER BY creation_datetime DESC');
    }

    public function getArticle($id) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('SELECT * FROM articles WHERE type = 1 AND id = ?');
        $stmt->execute([$id]);
        $article = $stmt->fetch();
        return $article;
    }

    public function addArticle($title, $subtitle, $cover, $content, $userId) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('INSERT INTO articles (title, subtitle, cover, content, type, creator) VALUES (?, ?, ?, ?, ?, ?)');
        $result = $stmt->execute([$title, $subtitle, $cover, $content, 1, $userId]); //type 1 = article, 2 = projet
        
        return $result;
    }

    public function updateArticle($title, $subtitle, $cover, $content, $idArticle) {
        $bdd = $this->connection();
        $req = $bdd->prepare('UPDATE articles SET title = ?, subtitle = ?, cover = ?, content = ? WHERE id = ? AND type = 1');
        $res = $req->execute([$title, $subtitle, $cover, $content, $idArticle]);

        return $res;
    }

    public function deleteArticle($id) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('DELETE FROM articles WHERE type = 1 AND id = ?');
        $res = $stmt->execute([$id]);

        return $res;
    }

    public function getProjects() {
        $bdd = $this->connection();
        return $articles = $bdd->query('SELECT * FROM articles WHERE type = 2 ORDER BY creation_datetime DESC');
    }
    
    public function getProject($id) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('SELECT * FROM articles WHERE type = 2 AND id = ?');
        $stmt->execute([$id]);
        $project = $stmt->fetch();
        return $project;
    }

    public function addProject($title, $subtitle, $cover, $content, $userId) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('INSERT INTO articles (title, subtitle, cover, content, type, creator) VALUES (?, ?, ?, ?, ?, ?)');
        $result = $stmt->execute([$title, $subtitle, $cover, $content, 2, $userId]); //type 1 = article, 2 = projet
        
        return $result;
    }

    public function updateProject($title, $subtitle, $cover, $content, $idProject) {
        $bdd = $this->connection();
        $req = $bdd->prepare('UPDATE articles SET title = ?, subtitle = ?, cover = ?, content = ? WHERE id = ? AND type = 2');
        $res = $req->execute([$title, $subtitle, $cover, $content, $idProject]);

        return $res;
    }

    public function deleteProject($id) {
        $bdd = $this->connection();

        $stmt = $bdd->prepare('DELETE FROM articles WHERE type = 2 AND id = ?');
        $res = $stmt->execute([$id]);
        
        return $res;
    }

    public function deleteComments($id) {
        $bdd = $this->connection();
        $stmt = $bdd->prepare('DELETE FROM comments WHERE article_id = ?');
        $res = $stmt->execute([$id]);

        return $res;
    }

    public function getComments($articleId) {
        $bdd = $this->connection();
        $req = $bdd->prepare('SELECT * FROM comments c, users u WHERE article_id = ? AND c.user_id = u.id ORDER BY creation_datetime DESC');
        $req->execute([$articleId]);
        return $req;
    }

    public function addComment($content, $userId, $articleId) {
        $bdd = $this->connection();
        $req = $bdd->prepare('INSERT INTO comments(content, user_id, article_id) VALUES (?, ?, ?)');
        $result = $req->execute([$content, $userId, $articleId]);
        return $result;
    }

    public function deleteComment($idComment, $userId) {
        $bdd = $this->connection();
        $req = $bdd->prepare('DELETE FROM comments WHERE id = ? AND user_id = ?');
        $result = $req->execute([$idComment, $userId]);
        return $result;
    }

}