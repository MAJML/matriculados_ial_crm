<?php

namespace App\Model;

use Core\Model;

class InicioModel extends Model
{
    public function countMatriculados($desde, $hasta)
    {
        $query = $this->db->prepare("SELECT count(*) + 
        (SELECT count(*) FROM cliente_matriculas WHERE date(created_at) between '".$desde."' and '".$hasta."') as matriculados
        from clientes CL
        left join cliente_seguimientos CLS on CLS.cliente_id=CL.id
        where CL.deleted_at is null and CLS.deleted_at is null and CLS.estado_id=4 
        and CLS.estado_detalle_id=8 and date(CL.ultimo_contacto) between '".$desde."' and '".$hasta."'");
        $query->execute();
        return $query->fetch();
    }

    public function metaLeads()
    {
        $query = $this->db->prepare("SELECT * from meta_leads where id=1");
        $query->execute();
        return $query->fetch();
    }

    public function countPerdidos($desde, $hasta)
    {
        $query = $this->db->prepare("SELECT count(*) as perdidos
        from clientes CL
        where CL.deleted_at is null and CL.estado_id=6 and date(CL.ultimo_contacto) between '".$desde."' and '".$hasta."'");
        $query->execute();
        return $query->fetch();
    }

    public function countNoContactados($desde, $hasta)
    {
        $query = $this->db->prepare("SELECT count(*) as noContactados
        from clientes CL
        where CL.deleted_at is null and CL.estado_id=5 and date(CL.ultimo_contacto) between '".$desde."' and '".$hasta."'");
        $query->execute();
        return $query->fetch();
    }

    public function countLeadsEntrantes($desde, $hasta)
    {
        $query = $this->db->prepare("SELECT count(*) as leadsEntrantes
        from clientes CL
        where CL.deleted_at is null and date(CL.created_at) between '".$desde."' and '".$hasta."'");
        $query->execute();
        return $query->fetch();
    }

}