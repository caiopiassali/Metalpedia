<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/11/2018
 * Time: 14:13
 */

namespace app\view\album;

use core\mvc\view\HtmlPage;
use app\model\AlbumModel;

class AlbumInfo extends HtmlPage
{

    protected $songs;
    protected $total_length;

    /**
     * AlbumInfo constructor.
     */
    public function __construct(AlbumModel $model = null, $songs = null, $total_length = null)
    {
        $this->model = is_null($model) ? new AlbumModel() : $model;
        $this->songs = $songs;
        $this->total_length = $total_length;
        $this->htmlFile = 'app/view/album/album_info.phtml';
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
    public function getTotalLength()
    {
        return $this->total_length;
    }

    /**
     * @param null $total_length
     */
    public function setTotalLength($total_length)
    {
        $this->total_length = $total_length;
    }
}