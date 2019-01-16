<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/11/2018
 * Time: 11:55
 */

namespace app\view\band;

use core\mvc\view\HtmlPage;
use app\model\BandModel;

class BandInfo extends HtmlPage
{

    protected $album_types;
    protected $albums;

    /**
     * BandInfo constructor.
     */
    public function __construct(BandModel $model = null, $album_types = null, $albums = null)
    {
        $this->model = is_null($model) ? new BandModel() : $model;
        $this->album_types = $album_types;
        $this->albums = $albums;
        $this->htmlFile = 'app/view/band/band_info.phtml';
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

    /**
     * @return null
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * @param null $albums
     */
    public function setAlbums($albums)
    {
        $this->albums = $albums;
    }
}