<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc\view;

use core\util\Session;
use core\util\Paginator;
use core\util\Classes;
use http\Url;


/**
 * Description of HtmlPage
 *
 * @author jlgregorio81
 */
abstract class HtmlPage {

    protected $model;
    protected $htmlFile = null;
    //..dados de paginação
    protected $sqlData;
    protected $regPerPage;
    protected $currentPage;
    protected $previousPage;
    protected $nextPage;
    protected $lastPage;
    
    protected $activeUser; //..armazenar o nome do usuário logado

    public function __construct($model = null, $sqlData = null, $regPerPage = null, $currentPage = null, $previousPage = null, $nextPage = null, $lastPage = null) {
        $this->model = $model;
        $this->sqlData = $sqlData;
        $this->regPerPage = $regPerPage;
        $this->previousPage = $previousPage;
        $this->currentPage = $currentPage;
        $this->nextPage = $nextPage;
        $this->lastPage = $lastPage;
        $this->activeUser = Session::getSession('activeUser') ? Session::getSession('activeUser') : 'Visitante';
    }

    /**
     * Método para desenhar o topo da página - definido pelo arquivo top.phtml.
     */
    protected function drawHeader() {
        require_once 'header.phtml';
    }

    /**
     * Método para desenhar o rodapé da página - definido pelo arquivo bottom.phtml.
     */
    protected function drawFooter() {
        require_once 'footer.phtml';
    }

    public function show() {
        $this->drawHeader();
        require_once $this->htmlFile;
        $this->drawFooter();
    }

    public function getModel() {
        return $this->model;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getHtmlFile() {
        return $this->htmlFile;
    }

    public function getSqlData() {
        return $this->sqlData;
    }

    public function getRegPorPag() {
        return $this->regPerPage;
    }

    public function getCurrentPage() {
        return $this->currentPage;
    }

    public function getPreviousPage() {
        return $this->previousPage;
    }

    public function getNextPage() {
        return $this->nextPage;
    }

    public function getLastPage() {
        return $this->lastPage;
    }

    public function setHtmlFile($htmlFile) {
        $this->htmlFile = $htmlFile;
    }

    public function setSqlData($dadosSql) {
        $this->sqlData = $dadosSql;
    }

    public function setRegPerPage($regPorPag) {
        $this->regPerPage = $regPorPag;
    }

    public function setCurrentPage($pagAtual) {
        $this->currentPage = $pagAtual;
    }

    public function setPreviousPage($pagAnterior) {
        $this->previousPage = $pagAnterior;
    }

    public function setNextPage($pagProxima) {
        $this->nextPage = $pagProxima;
    }

    public function setLastPage($pagUltima) {
        $this->lastPage = $pagUltima;
    }

    /**
     * 
     * @param array $header Um array de strings com os nomes dos campos a ser exibido no cabeçalho     
     * @param array $arrayGetters Um array de strings com os nomes dos métodos gets para pegar os respectivos dados do cabeçalho
     * @param array $arrayObj Um array de objetos com os models que serão usados para criar a tabela/lista
     * @param string $controller o nome do controlador para criar o link de recuperação de um objeto único
     */
    public function createList($arrayObj, $header, $arrayGetters, $controller) {
        //..se houver array de objetos, então...
        if ($arrayObj) {
            echo "<table class=\"table table-striped table-borderless\">";
            echo "<thead class=\"thead-light\">";
            echo "<tr>";
            //..cria o cabeçalho percorrendo o array header e criando as células.
            foreach ($header as $field) {
                echo "<th>$field</th>";
            }
            if ($this->activeUser != 'Visitante') {
                if ($this->activeUser->getTypeUser() != 'U') {
                    echo "<th class=\"text-right\">Editar/Excluir</th>";
                }
            }
            //echo "<th class=\"text-right\">Editar/Excluir</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($arrayObj as $obj) {
                echo "<tr>";
                foreach ($arrayGetters as $getter) {
                    echo "<td>";
                    if (method_exists($obj, $getter)) {
                        echo call_user_func(array($obj, $getter));                       
                    } else {                        
                        echo "<pre style=\"color:red\">Objeto ou método inválido!</pre>";
                    }
                    echo "</td>";
                }
                //echo "<td class=\"text-right\"><a href=\"Request.php?class={$controller}&method=showView&id={$obj->getId()}\">" .
                if ($this->activeUser != 'Visitante') {
                    if ($this->activeUser->getTypeUser() != 'U') {
                        echo "<td class=\"text-right\"><a href=\"".Classes::getUrlForController($controller)."/editar/{$obj->getId()}\">" .
                            "<i class=\"fas fa-pen fa-sm\"></i>"
                            . "</a></td>";
                    }
                }
                /*echo "<td class=\"text-right\"><a href=\"".Classes::getUrlForController($controller)."/editar/{$obj->getId()}\">" .
                "<img style=\"margin-left: 50%;\" src=\"" . \core\Application::ICON_OPEN . "\">"
                . "</a></td>";*/
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        }
        $this->objectNotFound();
        //$this->createPagination($controller);
    }

    public function objectNotFound() {
        if (!$this->model && $_POST) {
            echo "<img class=\"myicon float-left\" src=\"" . \core\Application::ICON_NOT_FOUND . "\">";
            echo "<h1><small>" . \core\Application::MSG_NOT_FOUND . "</small></h1>";
        }
    }

    public function createPagination($controller) {
        if ($this->model) {
            echo "<div class=\"row mt-3 mb-3\">";
            echo "<div class=\"col-sm-12 text-right\">";
            $paginator = new Paginator(Classes::getDaoForController($controller)->selectCount(Session::getSession('criteria')), $this->regPerPage, $this->currentPage, '/Metalpedia/'.Classes::getUrlForController($controller).'?page=(:num)');
            echo $paginator;
            echo "</div>";
            echo "</div>";
        }
    }

}
