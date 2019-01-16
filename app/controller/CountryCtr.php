<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/10/2018
 * Time: 15:31
 */

namespace app\controller;

use core\mvc\Controller;
use app\model\CountryModel;
use app\dao\CountryDao;
use app\view\country\CountryView;
use app\view\country\CountryList;
use core\util\Session;

final class CountryCtr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new CountryModel();
        $this->dao = new CountryDao();
        $this->view = new CountryView();
        $this->viewList = new CountryList();
    }

    /**
     * Pega os dados da model e alimenta a View - abstrato, pois será implementados nos herdeiros.
     */
    public function viewToModel()
    {
        $this->model = new CountryModel(
            $this->post['id_country'],
            $this->post['name_country'],
            $this->post['iso_country'],
            $this->post['iso3_country'],
            $this->post['flag_country']
        );
    }

    public function showList()
    {
        if($this->post){
            if ($this->post['data'][0]) {
                $this->criteria = "upper (" . CountryDao::COL_COUNTRY . ") like upper('%{$this->post['data'][0]}%')";
                $this->criteria .= " or upper (" . CountryDao::COL_ISO. ") like upper('%{$this->post['data'][0]}%')";
                $this->criteria .= " or upper (" . CountryDao::COL_ISO3. ") like upper('%{$this->post['data'][0]}%')";
            }
            //$this->orderBy = CountryDao::COL_COUNTRY;
        }
        $this->orderBy = CountryDao::COL_COUNTRY;
        parent::showList();
    }

    public function getCountries() {
        if (isset($this->get['name_country'])) {
            $name_country = $this->get['name_country'];
            $criteria = "upper (" . CountryDao::COL_COUNTRY . ") like upper('%{$name_country}%')";
            $criteria .= "or upper (" . CountryDao::COL_ISO . ") like upper('%{$name_country}%')";
            $criteria .= "or upper (" . CountryDao::COL_ISO3 . ") like upper('%{$name_country}%')";
            $countries = (new CountryDao())->selectAllAsJson($criteria, CountryDao::COL_COUNTRY);
            echo $countries;
        }
    }

}