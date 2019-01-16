<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 22/10/2018
 * Time: 21:28
 */

namespace app\dao;

use core\dao\Dao;
use app\model\GenreModel;

final class GenreDao extends Dao
{

    const COL_ID = 'id_genre';
    const COL_GENRE = 'name_genre';

    /**
     * GenreDao constructor.
     */
    public function __construct(GenreModel $model = null)
    {
        $this->model = is_null($model) ? new GenreModel() : $model;
        $this->tableName = 'genre';
        $this->tableId = self::COL_ID;
        $this->setColumns();
    }

    protected function setColumns()
    {
        $this->columns = array(
            self::COL_GENRE => $this->model->getNameGenre()
        );
    }

    public function findById($id)
    {
        $data = parent::findById($id);
        if ($data) {
            return new GenreModel(
                $id,
                $data[self::COL_GENRE]
            );
        }
        else {
            return null;
        }
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null)
    {
        try {
            $data = parent::selectAll($criteria, $orderBy, $groupBy, $limit, $offSet);
            if ($data) {
                $list = new \ArrayObject();
                foreach ($data as $genre) {
                    $list->append(new GenreModel(
                        $genre[$this->tableId],
                        $genre[self::COL_GENRE]
                    ));
                }
                return $list;
            } else
                return new \ArrayObject();
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function selectAllAsJson($criteria = null, $orderBy = null, $groupBy = null, $limit = null, $offSet = null)
    {
        try {
            $data = parent::selectAll($criteria, $orderBy, $groupBy, $limit, $offSet);
            if ($data) {
                return json_encode($data);
            } else
                return json_encode(array('status'=>'error'));
        } catch (\Exception $ex) {
            throw $ex;
        }
    }
}