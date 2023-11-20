<?php

class OrdemServicoAtendimento extends TRecord
{
    const TABLENAME  = 'ordem_servico_atendimento';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $ordem_servico;
    private $solucao;
    private $causa;
    private $problema;
    private $tecnico;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tecnico_id');
        parent::addAttribute('ordem_servico_id');
        parent::addAttribute('solucao_id');
        parent::addAttribute('causa_id');
        parent::addAttribute('problema_id');
        parent::addAttribute('data_atendimento');
        parent::addAttribute('horario_inicial');
        parent::addAttribute('horario_final');
        parent::addAttribute('obs');
            
    }

    /**
     * Method set_ordem_servico
     * Sample of usage: $var->ordem_servico = $object;
     * @param $object Instance of OrdemServico
     */
    public function set_ordem_servico(OrdemServico $object)
    {
        $this->ordem_servico = $object;
        $this->ordem_servico_id = $object->id;
    }

    /**
     * Method get_ordem_servico
     * Sample of usage: $var->ordem_servico->attribute;
     * @returns OrdemServico instance
     */
    public function get_ordem_servico()
    {
    
        // loads the associated object
        if (empty($this->ordem_servico))
            $this->ordem_servico = new OrdemServico($this->ordem_servico_id);
    
        // returns the associated object
        return $this->ordem_servico;
    }
    /**
     * Method set_solucao
     * Sample of usage: $var->solucao = $object;
     * @param $object Instance of Solucao
     */
    public function set_solucao(Solucao $object)
    {
        $this->solucao = $object;
        $this->solucao_id = $object->id;
    }

    /**
     * Method get_solucao
     * Sample of usage: $var->solucao->attribute;
     * @returns Solucao instance
     */
    public function get_solucao()
    {
    
        // loads the associated object
        if (empty($this->solucao))
            $this->solucao = new Solucao($this->solucao_id);
    
        // returns the associated object
        return $this->solucao;
    }
    /**
     * Method set_causa
     * Sample of usage: $var->causa = $object;
     * @param $object Instance of Causa
     */
    public function set_causa(Causa $object)
    {
        $this->causa = $object;
        $this->causa_id = $object->id;
    }

    /**
     * Method get_causa
     * Sample of usage: $var->causa->attribute;
     * @returns Causa instance
     */
    public function get_causa()
    {
    
        // loads the associated object
        if (empty($this->causa))
            $this->causa = new Causa($this->causa_id);
    
        // returns the associated object
        return $this->causa;
    }
    /**
     * Method set_problema
     * Sample of usage: $var->problema = $object;
     * @param $object Instance of Problema
     */
    public function set_problema(Problema $object)
    {
        $this->problema = $object;
        $this->problema_id = $object->id;
    }

    /**
     * Method get_problema
     * Sample of usage: $var->problema->attribute;
     * @returns Problema instance
     */
    public function get_problema()
    {
    
        // loads the associated object
        if (empty($this->problema))
            $this->problema = new Problema($this->problema_id);
    
        // returns the associated object
        return $this->problema;
    }
    /**
     * Method set_pessoa
     * Sample of usage: $var->pessoa = $object;
     * @param $object Instance of Pessoa
     */
    public function set_tecnico(Pessoa $object)
    {
        $this->tecnico = $object;
        $this->tecnico_id = $object->id;
    }

    /**
     * Method get_tecnico
     * Sample of usage: $var->tecnico->attribute;
     * @returns Pessoa instance
     */
    public function get_tecnico()
    {
    
        // loads the associated object
        if (empty($this->tecnico))
            $this->tecnico = new Pessoa($this->tecnico_id);
    
        // returns the associated object
        return $this->tecnico;
    }

    
}

