<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 20/10/2018
 * Time: 15:32
 */

namespace app\view\country;

use core\mvc\view\HtmlPage;

final class CountryList extends HtmlPage
{

    public function __construct($model = null, $sqlData = null, $regPerPage = null, $currentPage = null, $previousPage = null, $nextPage = null, $lastPage = null)
    {
        parent::__construct($model, $sqlData, $regPerPage, $currentPage, $previousPage, $nextPage, $lastPage);
        $this->htmlFile = 'app/view/country/country_list.phtml';
    }

}