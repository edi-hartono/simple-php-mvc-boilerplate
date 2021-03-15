<?php 
require('core/BaseController.php');
require('models/Book.php');

class Home extends BaseController
{
    public function index()
    {
        $book = new Book;
        $data = $book->getAllBoook();
        $this->view('index', ['books' => $data]);
    }
}