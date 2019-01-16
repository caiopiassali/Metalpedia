<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 15/11/2018
 * Time: 14:26
 */

namespace app\controller;

use app\dao\SongDao;
use app\model\BandModel;
use app\model\SongModel;
use app\view\album\AlbumInfo;
use core\mvc\Controller;
use app\model\AlbumModel;
use app\dao\AlbumDao;
use app\view\album\AlbumView;
use app\view\album\AlbumList;
use app\dao\BandDao;
use app\model\AlbumTypeEnum;
use core\util\SimpleImage;
use core\util\Strings;
use core\mvc\view\Message;
use core\Application;

final class AlbumCtr extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->model = new AlbumModel();
        $this->dao = new AlbumDao();
        $this->view = new AlbumView();
        $this->viewList = new AlbumList();
        $this->viewInfo = new AlbumInfo();
    }

    /**
     * Pega os dados da model e alimenta a View - abstrato, pois será implementados nos herdeiros.
     */
    public function viewToModel()
    {
        $this->model = new AlbumModel(
            $this->post['id'],
            $this->post['name_album'],
            $this->post['release_date'],
            $this->model->getCoverAlbum(),
            $this->post['album_type'],
            new BandModel($this->post['id_band'])
        );
    }

    public function showView()
    {
        $bands = (new BandDao())->selectAll(null, BandDao::COL_BAND . ', ' . BandDao::COL_ID);
        $this->view->setBands($bands);
        if (isset($this->get['id'])) {
            $songs = (new SongDao())->selectAll(
                SongDao::COL_ALBUM . " = {$this->get['id']}",
                SongDao::COL_NUMBER . " ASC"
            );
            $this->view->setSongs($songs);
        }
        $album_types = (AlbumTypeEnum::getConstants());
        $this->view->setAlbumTypes($album_types);
        parent::showView(); // TODO: Change the autogenerated stub
    }

    public function showInfo()
    {
        $songs = (new SongDao())->selectAll(
            SongDao::COL_ALBUM . " = {$this->get['id']}",
            SongDao::COL_NUMBER . " ASC"
        );
        $this->viewInfo->setSongs($songs);
        $total_length = $this->dao->selectLength($this->get['id']);
        $this->viewInfo->setTotalLength($total_length);
        parent::showInfo(); // TODO: Change the autogenerated stub
    }

    public function showList()
    {
        $album_types = (AlbumTypeEnum::getConstants());
        $this->viewList->setAlbumTypes($album_types);

        if($this->post){
            $this->criteria = "1 = 1";
            if ($this->post['data'][4]) {
                $this->criteria .= " and upper (" . AlbumDao::COL_ALBUM . ") like upper('%{$this->post['data'][4]}%')";
            }
            if ($this->post['data'][0]) {
                $this->criteria .= " and " . AlbumDao::COL_BAND . " = {$this->post['data'][0]}" ;
            }
            if ($this->post['data'][1]) {
                $this->criteria .= " and " . AlbumDao::COL_DATE . " > '{$this->post['data'][1]}'";
            }
            if ($this->post['data'][2]) {
                $this->criteria .= " and " . AlbumDao::COL_DATE . " < '{$this->post['data'][2]}'";
            }
            if ($this->post['data'][3]) {
                $this->criteria .= " and " . AlbumDao::COL_TYPE . " = '{$this->post['data'][3]}'";
            }
        }

        if (isset($this->post['orderBy'])) {
            $this->orderBy = $this->post['orderBy'];
        } else {
            $this->orderBy = AlbumDao::COL_ID . ' DESC';
        }

        parent::showList(); // TODO: Change the autogenerated stub
    }

    public function run()
    {
        try {
            $command = null;
            if (isset($this->post['command']))
                $command = strtolower($this->post['command']);
            else if (isset($this->post['submit']))
                $command = strtolower($this->post['submit']);
            switch ($command) {
                case 'salvar':

                    $cover = isset($_FILES['cover_album']) ? $_FILES['cover_album'] : null;

                    if (is_null($this->model->getId())) {
                        if (!is_null($cover)) {
                            $coverfile = new SimpleImage();
                            $coverfile->load($cover['tmp_name']);
                            $coverfile->save('core/img/covers/' . time() . $coverfile->getExtension());
                            $this->model->setCoverAlbum(time() . $coverfile->getExtension());
                        }
                    }

                    $this->insertUpdate();
                    break;
                case 'excluir':
                    $this->delete();
                    break;
                case 'novo':
                    $this->showView();
                    break;
                case 'listar':
                    $this->showList();
                    break;
                case 'relatório':
                    $this->showViewRpt();
                    break;
                default:
                    break;
            }

            //parent::run();
        } catch (\Exception $ex) {
            echo $ex;
        }
    }

    public function delete()
    {
        try {
            //..alimenta o model com os dados da view
            $this->viewToModel();

            // Delete primeiro as músicas
            // Executa o loop para deletar as músicas
            if ($this->post['data']) {
                foreach ($this->post['data'] as $i=>$song) {
                    (new SongCtr(new SongModel(
                        $song[0] != '' ? $song[0] : null
                    )))->run(true);
                }
            }

            //..invoca o método delete passando por parâmetro o id do modelo
            $this->dao->delete($this->model->getId());
            //..cria uma view de suecesso
            $msg = new Message(Application::MSG_TITLE_DEFAULT, Application::MSG_SUCCESS, Application::ICON_SUCCESS);
        } catch (Exception $ex) {
            //..caso ocorra algum erro, cria uma view de erro
            $msg = new Message(Application::MSG_TITLE_DEFAULT, Application::MSG_ERROR, Application::ICON_ERROR);
        }
        finally {
            //..exibie a view criada.
            $msg->show();
        }
    }

    public function insertUpdate()
    {
        try {
            //..alimenta o model com os dados da View
            $this->viewToModel();
            //..seta o modelo atualizado no objeto DAO
            $this->dao->setModel($this->model);
            //..invoca o método insertUpdate para persistir o Model
            $albumId = intval($this->dao->insertUpdate(true));

            // Executa o loop para salvar as músicas
            if ($this->post['data']) {
                foreach ($this->post['data'] as $i=>$song) {
                    (new SongCtr(new SongModel(
                        $song[0] != '' ? $song[0] : null,
                        Strings::formatInput($song[1]),
                        $i+1,
                        $song[2],
                        Strings::formatInput($song[3]),
                        new AlbumModel($this->model->getId() != '' ? $this->model->getId() : $albumId)
                    )))->run();
                }
            }

            //..cria uma view com mensagem de sucesso.
            $msg = new Message(
                Application::MSG_TITLE_DEFAULT,
                Application::MSG_SUCCESS,
                Application::ICON_SUCCESS
            );
            $msg->show();
        } catch (Exception $ex) {
            echo $ex;
            $msg = new Message(
                Application::MSG_TITLE_DEFAULT,
                Application::MSG_ERROR,
                Application::ICON_ERROR
            );
            $msg->show();
        }
    }

}