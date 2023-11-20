<?php

class GerarDadosController extends TPage
{
    public function __construct($param)
    {
        parent::__construct();
    }
    
    // função executa ao clicar no item de menu
    public function onShow($param = null)
    {
        FakeDataService::generateOS();
        
        new TMessage('info','Dados gerados!');
    }
}
