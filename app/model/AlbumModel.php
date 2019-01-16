<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 09/11/2018
 * Time: 19:24
 */

namespace app\model;

use core\mvc\Model;

final class AlbumModel extends Model {

    private $name_album;
    private $release_date;
    private $cover_album;
    private $album_type;
    private $band;

    /**
     * AlbumModel constructor.
     * @param $name_album
     * @param $release_date
     * @param $cover_album
     * @param $album_type
     * @param $band
     */
    public function __construct($id = null, $name_album = null, $release_date = null,
                                $cover_album = null, $album_type = null, BandModel $band = null)
    {
        parent::__construct($id);
        $this->name_album = $name_album;
        $this->release_date = $release_date;
        $this->cover_album = $cover_album;
        $this->album_type = $album_type;
        $this->band = is_null($band) ? new BandModel() : $band;
    }

    /**
     * @return mixed
     */
    public function getNameAlbum()
    {
        return $this->name_album;
    }

    /**
     * @param mixed $name_album
     */
    public function setNameAlbum($name_album)
    {
        $this->name_album = $name_album;
    }

    /**
     * @return mixed
     */
    public function getReleaseDate()
    {
        return $this->release_date;
    }

    /**
     * @param mixed $release_date
     */
    public function setReleaseDate($release_date)
    {
        $this->release_date = $release_date;
    }

    /**
     * @return mixed
     */
    public function getCoverAlbum()
    {
        return $this->cover_album;
    }

    /**
     * @param mixed $cover_album
     */
    public function setCoverAlbum($cover_album)
    {
        $this->cover_album = $cover_album;
    }

    /**
     * @return mixed
     */
    public function getAlbumType()
    {
        return $this->album_type;
    }

    /**
     * @param mixed $album_type
     */
    public function setAlbumType($album_type)
    {
        $this->album_type = $album_type;
    }

    /**
     * @return BandModel
     */
    public function getBand()
    {
        return $this->band;
    }

    /**
     * @param BandModel $band
     */
    public function setBand($band)
    {
        $this->band = $band;
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}