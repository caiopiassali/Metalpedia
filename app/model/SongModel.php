<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/11/2018
 * Time: 16:30
 */

namespace app\model;

use core\mvc\Model;

final class SongModel extends Model
{

    private $name_song;
    private $number_song;
    private $length_song;
    private $lyrics_song;
    private $album;

    /**
     * SongModel constructor.
     * @param $name_song
     * @param $number_song
     * @param $length_song
     * @param $lyrics_song
     * @param $album
     */
    public function __construct($id = null, $name_song = null, $number_song = null, $length_song = null, $lyrics_song = null, $album = null)
    {
        parent::__construct($id);
        $this->name_song = $name_song;
        $this->number_song = $number_song;
        $this->length_song = $length_song;
        $this->lyrics_song = $lyrics_song;
        $this->album = is_null($album) ? new AlbumModel() : $album;
    }

    /**
     * @return null
     */
    public function getNameSong()
    {
        return $this->name_song;
    }

    /**
     * @param null $name_song
     */
    public function setNameSong($name_song)
    {
        $this->name_song = $name_song;
    }

    /**
     * @return null
     */
    public function getNumberSong()
    {
        return $this->number_song;
    }

    /**
     * @param null $number_song
     */
    public function setNumberSong($number_song)
    {
        $this->number_song = $number_song;
    }

    /**
     * @return null
     */
    public function getLengthSong()
    {
        return $this->length_song;
    }

    /**
     * @param null $length_song
     */
    public function setLengthSong($length_song)
    {
        $this->length_song = $length_song;
    }

    /**
     * @return null
     */
    public function getLyricsSong()
    {
        return $this->lyrics_song;
    }

    /**
     * @param null $lyrics_song
     */
    public function setLyricsSong($lyrics_song)
    {
        $this->lyrics_song = $lyrics_song;
    }

    /**
     * @return AlbumModel|null
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param AlbumModel|null $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}