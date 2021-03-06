<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 22:19
 */

namespace app\controller;

use core\mvc\Controller;
use app\model\GenreModel;
use app\dao\GenreDao;
use app\view\genre\GenreView;
use app\view\genre\GenreList;

final class GenreCtr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new GenreModel();
        $this->dao = new GenreDao();
        $this->view = new GenreView();
        $this->viewList = new GenreList();
    }

    /**
     * Pega os dados da model e alimenta a View - abstrato, pois será implementados nos herdeiros.
     */
    public function viewToModel()
    {
        $this->model = new GenreModel(
            $this->post['id_genre'],
            $this->post['name_genre']
        );
    }

    public function showList()
    {
        if($this->post){
            $this->criteria = "upper (" . GenreDao::COL_GENRE . ") like upper('%{$this->post['data'][0]}%')";
            $this->orderBy = GenreDao::COL_GENRE;
        }
        parent::showList(); // TODO: Change the autogenerated stub
    }

    public function getGenres() {
        if (isset($this->get['name_genre'])) {
            $name_genre = $this->get['name_genre'];
            $criteria = "upper (" . GenreDao::COL_GENRE . ") like upper('%{$name_genre}%')";
            $genres = (new GenreDao())->selectAllAsJson($criteria, GenreDao::COL_GENRE);
            echo $genres;
        }
    }
}