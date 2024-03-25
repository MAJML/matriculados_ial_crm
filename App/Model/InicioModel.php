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

    public function dataAsesoresSeguimiento($desde, $hasta)
    {
        $query = $this->db->prepare("SELECT
                J1.*
        From (
        select US.name, US.last_name, EST.name as estado, CLS.user_id_register, CLS.cliente_id, CLS.created_at from cliente_seguimientos CLS
        left join users US on US.id=CLS.user_id_register
        inner join estados EST on EST.id=CLS.estado_id
        where CLS.deleted_at is null and US.deleted_at is null and CLS.estado_id in(4,5,6) and date(CLS.created_at) between '".$desde."' and '".$hasta."'
        Union all
        Select 'repetido' as name, 'repetido' as last_name, 'CIERRE' as estado,'0' as user_id_register, cliente_id, created_at 
        from cliente_matriculas where date(created_at) between '".$desde."' and '".$hasta."'
        ) as J1
        Order by J1.created_at desc limit 20");
        $query->execute();
        return $query->fetchAll();
    }

}