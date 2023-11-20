<?php

class ApiError extends TRecord
{
    const TABLENAME  = 'api_error';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('classe');
        parent::addAttribute('metodo');
        parent::addAttribute('url');
        parent::addAttribute('dados');
        parent::addAttribute('erro_message');
        parent::addAttribute('created_at');
            
    }

    
}

