<?php

namespace LittleThings;

class JsonPostRepository implements PostRepository, JsonRepository {
    private $filePath;

    private $json;

    public $postArray;

    function __construct($filePath) {
        $this->filePath = $filePath;

        $this->json = $this->readJson();
    }

    /**
     * Creates array of posts from associative array
     *
     * @param array $posts
     * @return array
     **/
    protected function hydrate(array $posts) {
        return array_map(function ($post) {
            return new Post(
                $post['id'],
                $post['date'],
                $post['authorId'],
                $post['title'],
                $post['slug']
            );
        }, $posts);
    }

    public function all() {
    }

    public function add(Post $post) {
        $this->postArray[] = $post;
    }

    public function findById($id) {
        $all = $this->all();
        foreach ($all as $post) {
            if ($post->id == $id)
                return $post;
        }
    }

    public function readJson() {
        return file_get_contents($this->filePath);
    }

    public function writeJson(array $data) {

    }
}