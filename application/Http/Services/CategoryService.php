<?php

namespace Services;

use Models\Category;

class CategoryService{

    private $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function findAll(){
        return $this->category->getAll();
    }

    public function findByPk($id){
        return $this->category->findByPk($id);
    }

    public function create($body){
        if($body->name != null && $body->tax_percent != null){
            return $this->category->insert($body->name, $body->tax_percent);
        }
        return false;   
    }

    public function update($id, $body){
        if($body->name == null && $body->tax_percent == null){
            return false;
        }
        return $this->category->update($id, $body->name, $body->tax_percent);
    }

    public function delete($id){
        return $this->category->delete($id);
    }
}