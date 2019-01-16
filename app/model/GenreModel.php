<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 21:23
 */

namespace app\model;

use core\mvc\Model;

final class GenreModel extends Model
{

    private $name_genre;

    /**
     * GenreModel constructor.
     * @param $name_genre
     */
    public function __construct($id = null, $name_genre = null)
    {
        parent::__construct($id);
        $this->name_genre = $name_genre;
    }

    /**
     * @return null
     */
    public function getNameGenre()
    {
        return $this->name_genre;
    }

    /**
     * @param null $name_genre
     */
    public function setNameGenre($name_genre)
    {
        $this->name_genre = $name_genre;
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}