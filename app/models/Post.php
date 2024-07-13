<?php
  class Post {
    private $db;
    
    public function __construct(){
      $this->db = new Database;
    }

    // Get All Posts
    public function getPosts(){
      $this->db->query("SELECT *, 
                        posts.id as postId, 
                        users.id as userId
                        FROM posts 
                        INNER JOIN users 
                        ON posts.userId = users.id
                        ORDER BY posts.createdAt DESC;");

      $results = $this->db->resultset();

      return $results;
    }

    // Get Post By ID
    public function getPostById($id){
      $this->db->query("SELECT * FROM posts WHERE id = :id");

      $this->db->bind(':id', $id);
      
      $row = $this->db->single();

      return $row;
    }

    // Add Post
    public function addPost($data){
      // Prepare Query
      $this->db->query('INSERT INTO posts (title, userId, body) 
      VALUES (:title, :userId, :body)');

      // Bind Values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':userId', $data['userId']);
      $this->db->bind(':body', $data['body']);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update Post
    public function updatePost($data){
      // Prepare Query
      $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');

      // Bind Values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':body', $data['body']);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Post
    public function deletePost($id){
      // Prepare Query
      $this->db->query('DELETE FROM posts WHERE id = :id');

      // Bind Values
      $this->db->bind(':id', $id);
      
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }