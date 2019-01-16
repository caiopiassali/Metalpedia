<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/10/2018
 * Time: 15:32
 */

namespace app\view\country;

use core\mvc\view\HtmlPage;
use app\model\CountryModel;
use core\util\Session;

final class CountryView extends HtmlPage
{

    /**
     * CountryView constructor.
     */
    public function __construct(CountryModel $model = null)
    {
        $this->model = is_null($model) ? new CountryModel() : $model;
        $this->htmlFile = Session::getSession('activeUser') ? 'app/view/country/country_view.phtml' : 'app/view/home/home.phtml';
    }

}