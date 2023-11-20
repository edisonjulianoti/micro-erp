<?php

class Problema extends TRecord
{
    const TABLENAME  = 'problema';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
            
    }

    /**
     * Method getOrdemServicoAtendimentos
     */
    public function getOrdemServicoAtendimentos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('problema_id', '=', $this->id));
        return OrdemServicoAtendimento::getObjects( $criteria );
    }

    public function set_ordem_servico_atendimento_tecnico_to_string($ordem_servico_atendimento_tecnico_to_string)
    {
        if(is_array($ordem_servico_atendimento_tecnico_to_string))
        {
            $values = Pessoa::where('id', 'in', $ordem_servico_atendimento_tecnico_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_tecnico_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_tecnico_to_string = $ordem_servico_atendimento_tecnico_to_string;
        }

        $this->vdata['ordem_servico_atendimento_tecnico_to_string'] = $this->ordem_servico_atendimento_tecnico_to_string;
    }

    public function get_ordem_servico_atendimento_tecnico_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_tecnico_to_string))
        {
            return $this->ordem_servico_atendimento_tecnico_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('problema_id', '=', $this->id)->getIndexedArray('tecnico_id','{tecnico->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_ordem_servico_to_string($ordem_servico_atendimento_ordem_servico_to_string)
    {
        if(is_array($ordem_servico_atendimento_ordem_servico_to_string))
        {
            $values = OrdemServico::where('id', 'in', $ordem_servico_atendimento_ordem_servico_to_string)->getIndexedArray('id', 'id');
            $this->ordem_servico_atendimento_ordem_servico_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_ordem_servico_to_string = $ordem_servico_atendimento_ordem_servico_to_string;
        }

        $this->vdata['ordem_servico_atendimento_ordem_servico_to_string'] = $this->ordem_servico_atendimento_ordem_servico_to_string;
    }

    public function get_ordem_servico_atendimento_ordem_servico_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_ordem_servico_to_string))
        {
            return $this->ordem_servico_atendimento_ordem_servico_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('problema_id', '=', $this->id)->getIndexedArray('ordem_servico_id','{ordem_servico->id}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_solucao_to_string($ordem_servico_atendimento_solucao_to_string)
    {
        if(is_array($ordem_servico_atendimento_solucao_to_string))
        {
            $values = Solucao::where('id', 'in', $ordem_servico_atendimento_solucao_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_solucao_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_solucao_to_string = $ordem_servico_atendimento_solucao_to_string;
        }

        $this->vdata['ordem_servico_atendimento_solucao_to_string'] = $this->ordem_servico_atendimento_solucao_to_string;
    }

    public function get_ordem_servico_atendimento_solucao_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_solucao_to_string))
        {
            return $this->ordem_servico_atendimento_solucao_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('problema_id', '=', $this->id)->getIndexedArray('solucao_id','{solucao->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_causa_to_string($ordem_servico_atendimento_causa_to_string)
    {
        if(is_array($ordem_servico_atendimento_causa_to_string))
        {
            $values = Causa::where('id', 'in', $ordem_servico_atendimento_causa_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_causa_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_causa_to_string = $ordem_servico_atendimento_causa_to_string;
        }

        $this->vdata['ordem_servico_atendimento_causa_to_string'] = $this->ordem_servico_atendimento_causa_to_string;
    }

    public function get_ordem_servico_atendimento_causa_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_causa_to_string))
        {
            return $this->ordem_servico_atendimento_causa_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('problema_id', '=', $this->id)->getIndexedArray('causa_id','{causa->nome}');
        return implode(', ', $values);
    }

    public function set_ordem_servico_atendimento_problema_to_string($ordem_servico_atendimento_problema_to_string)
    {
        if(is_array($ordem_servico_atendimento_problema_to_string))
        {
            $values = Problema::where('id', 'in', $ordem_servico_atendimento_problema_to_string)->getIndexedArray('nome', 'nome');
            $this->ordem_servico_atendimento_problema_to_string = implode(', ', $values);
        }
        else
        {
            $this->ordem_servico_atendimento_problema_to_string = $ordem_servico_atendimento_problema_to_string;
        }

        $this->vdata['ordem_servico_atendimento_problema_to_string'] = $this->ordem_servico_atendimento_problema_to_string;
    }

    public function get_ordem_servico_atendimento_problema_to_string()
    {
        if(!empty($this->ordem_servico_atendimento_problema_to_string))
        {
            return $this->ordem_servico_atendimento_problema_to_string;
        }
    
        $values = OrdemServicoAtendimento::where('problema_id', '=', $this->id)->getIndexedArray('problema_id','{problema->nome}');
        return implode(', ', $values);
    }

    
}

