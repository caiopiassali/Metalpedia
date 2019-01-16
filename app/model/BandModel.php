<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 23:08
 */

namespace app\model;

use core\mvc\Model;

final class BandModel extends Model
{

    private $name_band;
    private $bio_band;
    private $logo_band;
    private $photo_band;
    private $country;
    private $genre;

    /**
     * BandModel constructor.
     * @param $id_band
     * @param $name_band
     * @param $bio_band
     * @param $photo_band
     * @param $country
     * @param $genre
     */
    public function __construct($id = null, $name_band = null, $bio_band = null, $logo_band = null,
                                $photo_band = null, CountryModel $country = null, GenreModel $genre = null)
    {
        parent::__construct($id);
        $this->name_band = $name_band;
        $this->bio_band = $bio_band;
        $this->logo_band = $logo_band;
        $this->photo_band = $photo_band;
        $this->country = is_null($country) ? new CountryModel() : $country;
        $this->genre = is_null($genre) ? new GenreModel() : $genre;
    }

    /**
     * @return null
     */
    public function getNameBand()
    {
        return $this->name_band;
    }

    /**
     * @param null $name_band
     */
    public function setNameBand($name_band)
    {
        $this->name_band = $name_band;
    }

    /**
     * @return null
     */
    public function getBioBand()
    {
        return $this->bio_band;
    }

    /**
     * @param null $bio_band
     */
    public function setBioBand($bio_band)
    {
        $this->bio_band = $bio_band;
    }

    /**
     * @return mixed
     */
    public function getLogoBand()
    {
        return $this->logo_band;
    }

    /**
     * @param mixed $logo_band
     */
    public function setLogoBand($logo_band)
    {
        $this->logo_band = $logo_band;
    }

    /**
     * @return null
     */
    public function getPhotoBand()
    {
        return $this->photo_band;
    }

    /**
     * @param null $photo_band
     */
    public function setPhotoBand($photo_band)
    {
        $this->photo_band = $photo_band;
    }

    /**
     * @return null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param null $country
     */
    public function setCountry(CountryModel $country)
    {
        $this->country = $country;
    }

    /**
     * @return null
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param null $genre
     */
    public function setGenre(GenreModel $genre)
    {
        $this->genre = $genre;
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}