<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/10/2018
 * Time: 15:19
 */

namespace app\model;

use core\mvc\Model;

final class CountryModel extends Model {

    private $name_country;
    private $iso_country;
    private $iso3_country;
    private $flag_country;

    /**
     * CountryModel constructor.
     * @param $name_country
     * @param $flag_country
     */
    public function __construct($id = null, $name_country = null, $iso_country = null, $iso3_country = null, $flag_country = null)
    {
        parent::__construct($id);
        $this->name_country = $name_country;
        $this->iso_country = $iso_country;
        $this->iso3_country = $iso3_country;
        $this->flag_country = $flag_country;
    }

    /**
     * @return null
     */
    public function getNameCountry()
    {
        return $this->name_country;
    }

    /**
     * @param null $name_country
     */
    public function setNameCountry($name_country)
    {
        $this->name_country = $name_country;
    }

    /**
     * @return mixed
     */
    public function getIsoCountry()
    {
        return $this->iso_country;
    }

    /**
     * @param mixed $iso_country
     */
    public function setIsoCountry($iso_country)
    {
        $this->iso_country = $iso_country;
    }

    /**
     * @return mixed
     */
    public function getIso3Country()
    {
        return $this->iso3_country;
    }

    /**
     * @param mixed $iso3_country
     */
    public function setIso3Country($iso3_country)
    {
        $this->iso3_country = $iso3_country;
    }

    /**
     * @return null
     */
    public function getFlagCountry()
    {
        return $this->flag_country;
    }

    /**
     * @param null $flag_country
     */
    public function setFlagCountry($flag_country)
    {
        $this->flag_country = $flag_country;
    }

    public function show()
    {
        // TODO: Implement show() method.
    }
}