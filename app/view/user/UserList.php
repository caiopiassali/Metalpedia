<?php
namespace app\view\user;

use core\mvc\view\HtmlPage;

final class UserList extends HtmlPage
{

    protected $msgError;

    public function __construct(
        $model = null,
        $sqlData = null,
        $regPerPage = null,
        $currentPage = null,
        $previousPage = null,
        $nextPage = null,
        $lastPage = null,
        $msgError = null
    )
    {
        parent::__construct(
            $model,
            $sqlData,
            $regPerPage,
            $currentPage,
            $previousPage,
            $nextPage,
            $lastPage
        );
        $this->htmlFile = 'app/view/user/user_list.phtml';
        $this->msgError = $msgError;
    }

}