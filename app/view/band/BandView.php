<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 26/10/2018
 * Time: 22:47
 */

namespace app\view\band;

use core\mvc\view\HtmlPage;
use app\model\BandModel;
use core\util\Session;

final class BandView extends HtmlPage
{

    protected $countries;
    protected $genres;

    /**
     * BandView constructor.
     */
    public function __construct(BandModel $model = null, $countries = null, $genres = null)
    {
        $this->model = is_null($model) ? new BandModel() : $model;
        $this->countries = $countries;
        $this->genres = $genres;
        $this->htmlFile = Session::getSession('activeUser') ? 'app/view/band/band_view.phtml' : 'app/view/home/home.phtml';
    }

    /**
     * @return null
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param null $countries
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;
    }

    /**
     * @return mixed
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param mixed $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }
}