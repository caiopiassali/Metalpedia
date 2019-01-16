<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 26/10/2018
 * Time: 20:53
 */

namespace core\util;

use app\dao\AlbumDao;
use app\dao\BandDao;
use app\dao\CountryDao;
use app\dao\GenreDao;

class Classes
{

    public static function getUrlForController($controller) {
        switch ($controller) {
            case 'CountryCtr':
                return 'paises';
            case 'GenreCtr':
                return 'generos';
            case 'BandCtr':
                return 'bandas';
            case 'AlbumCtr':
                return 'albums';
            default:
                break;
        }
    }

    public static function getDaoForController($controller) {
        switch ($controller) {
            case 'CountryCtr':
                return new CountryDao();
            case 'GenreCtr':
                return new GenreDao();
            case 'BandCtr':
                return new BandDao();
            case 'AlbumCtr':
                return new AlbumDao();
            default:
                break;
        }
    }

}