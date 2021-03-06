<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 22:34
 */

namespace app\view\genre;

use app\model\UserModel;
use core\mvc\view\HtmlPage;
use app\dao\BandDao;
use app\dao\AlbumDao;
use core\util\Classes;

final class GenreList extends HtmlPage
{

    public function __construct($model = null, $sqlData = null, $regPerPage = null, $currentPage = null, $previousPage = null, $nextPage = null, $lastPage = null)
    {
        parent::__construct($model, $sqlData, $regPerPage, $currentPage, $previousPage, $nextPage, $lastPage);
        $this->htmlFile = 'app/view/genre/genre_list.phtml';
    }

    public function createList($arrayObj, $header, $arrayGetters, $controller)
    {
        if ($arrayObj) {
            echo "<table class=\"table table-striped table-borderless text-center\">";
            echo "<thead class=\"thead-light\">";
            echo "<tr>";
            //..cria o cabeçalho percorrendo o array header e criando as células.
            foreach ($header as $field) {
                echo "<th>$field</th>";
            }
            if ($this->activeUser != new UserModel()) {
                if ($this->activeUser->getTypeUser() != 'U') {
                    echo "<th class=\"text-right\">Editar/Excluir</th>";
                }
            }
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($arrayObj as $obj) {
                echo "<tr>";
                foreach ($arrayGetters as $getter) {
                    echo "<td class=\"align-middle\">";
                    if (method_exists($obj, $getter)) {
                        echo call_user_func(array($obj, $getter));
                    } else {
                        echo "<pre style=\"color:red\">Objeto ou método inválido!</pre>";
                    }
                    echo "</td>";
                }

                // Contagem Nº Bandas
                echo "<td class=\"align-middle\">";
                echo (new BandDao())->selectCount('band.' . BandDao::COL_GENRE . " = " . $obj->getId());
                echo "</td>";

                // Contagem Nº Álbums
                $count = 0;
                $bands = (new BandDao())->selectAll('band.' . BandDao::COL_GENRE . " = " . $obj->getId());
                foreach ($bands as $band) {
                    $count += (new AlbumDao())->selectCount(AlbumDao::COL_BAND . " = " . $band->getId());
                }
                echo "<td class=\"align-middle\">";
                echo $count;
                echo "</td>";

                if ($this->activeUser != new UserModel()) {
                    if ($this->activeUser->getTypeUser() != 'U') {
                        /*echo "<td class=\"text-right\"><a href=\"".Classes::getUrlForController($controller)."/editar/{$obj->getId()}\">" .
                            "<i class=\"fas fa-pen fa-sm\"></i>"
                            . "</a></td>";*/
                        echo "<td class=\"text-right\"><a href=\"/Metalpedia/".Classes::getUrlForController($controller)."/editar/{$obj->getId()}\">
                    <button type=\"button\" class=\"btn btn-danger btn-sm\">
                        <i class=\"fas fa-cog\"></i> Editar
                    </button>
                </a></td>";
                    }
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        $this->objectNotFound();
        //parent::createList($arrayObj, $header, $arrayGetters, $controller); // TODO: Change the autogenerated stub
    }

}