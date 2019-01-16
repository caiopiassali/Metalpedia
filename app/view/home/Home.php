<?php
namespace app\view\home;

use core\mvc\view\HtmlPage;
use app\dao\BandDao;
use app\dao\AlbumDao;

class Home extends HtmlPage{

    protected $msgError;
    protected $bands;
    protected $albums;

    public function __construct($msgError = null)
    {        
        $this->htmlFile = 'app/view/home/home.phtml';
        $this->msgError = $msgError;
        $this->bands = (new BandDao())->selectAll(null, BandDao::COL_ID . ' DESC', null, 9);
        $this->albums = (new AlbumDao())->selectAll(null, AlbumDao::COL_ID . ' DESC', null, 9);
    }


}