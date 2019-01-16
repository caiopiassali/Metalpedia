<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 15/11/2018
 * Time: 19:07
 */

namespace app\model;

use core\mvc\Enum;

final class AlbumTypeEnum extends Enum
{

    const Demo = 'Demo';
    const Single = 'Single';
    const Compilation = 'Compilation';
    const EP = 'EP';
    const LiveAlbum = 'Live Album';
    const StudioAlbum = 'Studio Album';

}