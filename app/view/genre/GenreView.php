<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 22:26
 */

namespace app\view\genre;

use core\mvc\view\HtmlPage;
use app\model\GenreModel;
use core\util\Session;

final class GenreView extends HtmlPage
{

    /**
     * GenreView constructor.
     */
    public function __construct(GenreModel $model = null)
    {
        $this->model = is_null($model) ? new GenreModel() : $model;
        $this->htmlFile = Session::getSession('activeUser') ? 'app/view/genre/genre_view.phtml' : 'app/view/home/home.phtml';
    }
}