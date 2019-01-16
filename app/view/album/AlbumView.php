<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 15/11/2018
 * Time: 14:20
 */

namespace app\view\album;

use core\mvc\view\HtmlPage;
use app\model\AlbumModel;
use core\util\Session;

final class AlbumView extends HtmlPage
{

    protected $bands;
    protected $songs;
    protected $album_types;

    /**
     * AlbumView constructor.
     */
    public function __construct(AlbumModel $model = null, $bands = null, $songs = null, $album_types = null)
    {
        $this->model = is_null($model) ? new AlbumModel() : $model;
        $this->bands = $bands;
        $this->songs = $songs;
        $this->album_types = $album_types;
        $this->htmlFile = Session::getSession('activeUser') ? 'app/view/album/album_view.phtml' : 'app/view/home/home.phtml';
    }

    /**
     * @return null
     */
    public function getBands()
    {
        return $this->bands;
    }

    /**
     * @param null $bands
     */
    public function setBands($bands)
    {
        $this->bands = $bands;
    }

    /**
     * @return null
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * @param null $songs
     */
    public function setSongs($songs)
    {
        $this->songs = $songs;
    }

    /**
     * @return null
     */
    public function getAlbumTypes()
    {
        return $this->album_types;
    }

    /**
     * @param null $album_types
     */
    public function setAlbumTypes($album_types)
    {
        $this->album_types = $album_types;
    }

}