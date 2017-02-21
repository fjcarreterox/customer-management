<?php

class Controller_Doc extends Controller_Template{

	public function action_index(){
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Doc &raquo; Index';
		$this->template->content = View::forge('doc/index', $data);
	}

    /*public function action_cert($idcliente){
        $data["name"] = Model_Cliente::find($idcliente)->get('nombre');
        return View::forge('doc/cert',$data)->render();
    }*/

    public function action_seguridad(){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }

        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $c = DB::query($q)->as_assoc()->execute()[0];
        $idc = Session::get('iduser');

        //$c=Model_Cliente::find($idc);
        $isCPP=($c["tipo"] == 6)? true: false;

        $q = "SELECT * FROM tipo_clientes WHERE `id` =".$c["tipo"];
        $type = DB::query($q)->as_assoc()->execute()[0]["tipo"];

        //getting all the customer data
        $data["idc"]=$idc;
        $data["type"] = $type;
        $data["cname"]=$c["nombre"];
        $data["cif"]=$c["cif_nif"];
        $data["dir"]=$c["direccion"];
        $data["cp"]=$c["cpostal"];
        $data["loc"]=$c["loc"];
        $data["prov"]=$c["prov"];

        //workers info
        $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND `relacion`= 4";
        $data['trab'] = DB::query($q)->as_assoc()->execute();
        /*$data['trab'] = Model_Personal::find('all',array('where'=>array('idcliente'=>$idc,'relacion'=>4)));*/

        //Registered files info
        $q = "SELECT * FROM ficheros WHERE `idcliente` =".Session::get('iduser');
        $files_raw = DB::query($q)->as_assoc()->execute();

        //Obtaining the max level for all the registered files
        $max_level = 0;
        $levels = array("No especificado","Básico","Medio","Alto");
        foreach($files_raw as $f){
            $q = "SELECT * FROM tipo_ficheros WHERE `id` =".$f["idtipo"];
            $fname = DB::query($q)->as_assoc()->execute()[0]["tipo"];
            $final = DB::query($q)->as_assoc()->execute()[0]["finalidad"];

            $files[]=array(
                "id" => $f["id"],
                "idtype" => $f["idtipo"],
                "name" => $fname,
                "target" => $final,
                "level_name" => $levels[$f["nivel"]],
                "idlevel" => $f["nivel"],
                "supp" => $f["soporte"]
            );
            if($f["nivel"] > $max_level){
                $max_level=$f["nivel"];
            }
        }
        $data['files'] = $files;
        $data['max_level'] = $max_level;

        $q = "SELECT * FROM cesiones WHERE `idcliente` =".Session::get('iduser');
        $data['ces'] = DB::query($q)->as_assoc()->execute();

        if($isCPP){
            $q = "SELECT * FROM cesiones WHERE `idcliente` =".Session::get('iduser');
            $data['ces'] = DB::query($q)->as_assoc()->execute();

            $q = "SELECT * FROM rel_comaaffs WHERE `idcom` =".Session::get('iduser');
            $rels_aaff = DB::query($q)->as_assoc()->execute();

            $reps_data = null;
            foreach($rels_aaff as $rel_aaff){

                $q = "SELECT * FROM clientes WHERE `id` =".$rel_aaff["idaaff"];
                $aaff = DB::query($q)->as_assoc()->execute()[0];

                $q = "SELECT * FROM personals WHERE `idcliente` =".$aaff["id"]." AND `relacion` = 1";
                $rep = DB::query($q)->as_assoc()->execute()[0];

                if ($rep != null) {
                    $reps_data[] = array(
                        "nombre" => $rep["nombre"],
                        "dni" => $rep["dni"],
                        "nombre_aaff" => $aaff["nombre"],
                        "dir" => $aaff["direccion"],
                        "cp" => $aaff["cpostal"],
                        "loc" => $aaff["loc"],
                        "prov" => $aaff["prov"]
                    );
                }
            }

            $data['reps'] = $reps_data;
            $data['num_reps'] = count($reps_data);

            $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND `relacion` = 6";
            $data['pres'] = DB::query($q)->as_assoc()->execute()[0];

            return View::forge('doc/seguridad_cpp',$data)->render();
        }
        else{
            $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND `relacion` = 1";
            $data['reps'] = DB::query($q)->as_assoc()->execute()[0];
            //$data['reps'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 1)));

            $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND `relacion` = 3";
            $data['rep_seg'] = DB::query($q)->as_assoc()->execute()[0];
            //$data['rep_seg'] = Model_Personal::find('first', array('where' => array('idcliente' => $idc, 'relacion' => 3)));

            $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND `relacion` = 6";
            $data['personal'] = DB::query($q)->as_assoc()->execute()[0];
            //$data['personal'] = Model_Personal::find('first',array('where'=>array('idcliente'=>$idc,'relacion'=>6)));
            return View::forge('doc/seguridad',$data)->render();
        }
    }

    public function action_clausula($type){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }

        $t=strtoupper($type);
        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['cliente'] = DB::query($q)->as_assoc()->execute();
        $data['name']=$data['cliente'][0]['nombre'];
        $data['cif']=$data['cliente'][0]['cif_nif'];
        $data['dir']=$data['cliente'][0]['direccion'].", ".$data['cliente'][0]['cpostal'].", ".$data['cliente'][0]['loc'].", en la provincia de ".$data['cliente'][0]['prov'];
        switch($t){
            case 'E':
                $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND relacion=4";
                $data['trab'] = DB::query($q)->as_assoc()->execute();
                return View::forge('doc/clause/employee',$data)->render();
                break;
            case 'C':
                return View::forge('doc/clause/customer',$data)->render();
                break;
            default: break;
        }
    }

    public function action_coletilla(){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }

        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['cliente'] = DB::query($q)->as_assoc()->execute();
        $data["name"] = $data['cliente'][0]["nombre"];
        return View::forge('doc/coletilla',$data)->render();
    }
/*
    public function action_factura($idfac){
        $f = Model_Factura::find($idfac);
        $data["num_fact"] = $f->num_fact;
        $data["num_cuota"] = $f->num_cuota;
        $data["year"] = $f->anyo_cobro;
        $data["fecha_emision"] = $f->fecha_emision;
        $idsc = Model_Servicios_Contratado::find($f->get('idsc'));
        $data["importe"] = $idsc->cuota;
        $data["nombre_serv"] = Model_Servicio::find($idsc->idtipo_servicio)->get('nombre');
        $query = Model_Factura::query()->where('idsc', $idsc->id);
        $data["total_fact"] = $query->count();
        $idcont = Model_Contrato::find($idsc->get('idcontrato'));
        $data["forma"] = $idsc->forma_pago;
        $data["cname"] = Model_Cliente::find($idcont->get('idcliente'))->get('nombre');
        $data["cif"] = Model_Cliente::find($idcont->get('idcliente'))->get('cif_nif');
        $data["dir"] = Model_Cliente::find($idcont->get('idcliente'))->get('direccion');
        $data["cp"] = Model_Cliente::find($idcont->get('idcliente'))->get('cpostal');
        $data["loc"] = Model_Cliente::find($idcont->get('idcliente'))->get('loc');
        $data["prov"] = Model_Cliente::find($idcont->get('idcliente'))->get('prov');
        return View::forge('doc/factura',$data)->render();
    }

    public function action_solicitud_video($idcliente){
        $af = Model_Rel_Comaaff::find('first',array('where'=>array('idcom'=>$idcliente)));
        $data["afname"] = Model_Cliente::find($af->idaaff)->get('nombre');
        $data["afdir1"] = Model_Cliente::find($af->idaaff)->get('direccion');
        $data["afdir2"] = Model_Cliente::find($af->idaaff)->get('cpostal').' - '.Model_Cliente::find($af->idaaff)->get('prov');
        $data["name"] = Model_Cliente::find($idcliente)->get('nombre');
        $data["dir"] = Model_Cliente::find($idcliente)->get('direccion').", con C.P. ".Model_Cliente::find($idcliente)->get('cpostal').", en ".Model_Cliente::find($idcliente)->get('loc').", en la provincia de ".Model_Cliente::find($idcliente)->get('prov');
        return View::forge('doc/solicitud',$data)->render();
    }*/

    public function action_cesiones(){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }

        $q = "SELECT * FROM cesiones WHERE `idcliente` =".Session::get('iduser');
        $cesiones = DB::query($q)->as_assoc()->execute();

        $cesionaria = 0;
        foreach($cesiones as $c){
            if($cesionaria != $c["idcesionaria"]){
                $cesionaria = $c["idcesionaria"];
                $data['cesiones'][] = $c;
            }
        }
        $this->template->title = 'Contratos de cesión de datos';
        $this->template->content = View::forge('doc/cesiones', $data);
    }

    public function action_cesion($idces){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }

        $idc=Session::get('iduser');

        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $c = DB::query($q)->as_assoc()->execute()[0];

        $q = "SELECT * FROM tipo_clientes WHERE `id` =".$c["tipo"];
        $type = DB::query($q)->as_assoc()->execute()[0]["tipo"];

        $isCPP=($c["tipo"] == 6)? true: false;
        $data['cname'] = $c["nombre"];
        $data['type'] = $type;
        $data['cif_nif'] = $c["cif_nif"];
        $data["dir"]=$c["direccion"];
        $data["cp"]=$c["cpostal"];
        $data["loc"]=$c["loc"];
        $data["prov"]=$c["prov"];

        $files = array();
        if($isCPP){
            $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser')." AND relacion=6";
            $data['pres'] = DB::query($q)->as_assoc()->execute()[0];

            $q = "SELECT * FROM personals WHERE `idcliente` =".$idces." AND relacion=1";
            $rep_legal = DB::query($q)->as_assoc()->execute()[0];

            $rep_legal_name = str_repeat(".",120);
            $rep_legal_dni = str_repeat(".",50);
            if($rep_legal != null){
                $rep_legal_name = $rep_legal["nombre"];
                $rep_legal_dni = $rep_legal["dni"];
            }
            $rep["nombre"] = $rep_legal_name;
            $rep["dni"] = $rep_legal_dni;

            $q = "SELECT * FROM clientes WHERE `id` =".$idces;
            $ces = DB::query($q)->as_assoc()->execute()[0];

            $rep["nombre_aaff"] = $ces["nombre"];
            $rep["aaff_type"] = $ces["tipo"];
            $rep["activ"] = $ces["actividad"];
            $rep["cif_nif"] = $ces["cif_nif"];
            $rep["dir"] = $ces["direccion"];
            $rep["cp"] = $ces["cpostal"];
            $rep["loc"] = $ces["loc"];
            $rep["prov"] = $ces["prov"];

            $q = "SELECT * FROM cesiones WHERE `idcliente` =".Session::get('iduser')." AND `idcesionaria`=".$idces;
            $cesion = DB::query($q)->as_assoc()->execute()[0];

            if($cesion != null){
                $q = "SELECT * FROM ficheros WHERE `id` =".$cesion["idfichero"];
                $idtipo= DB::query($q)->as_assoc()->execute()[0]["idtipo"];

                $q = "SELECT * FROM tipo_ficheros WHERE `id` =".$idtipo;
                $files[]["type"] = DB::query($q)->as_assoc()->execute()[0]["tipo"];
            }
            else {
                $files_tmp = Model_Fichero::find('all', array('where' => array('idcliente' => $idc)));
                foreach ($files_tmp as $f) {
                    $files[]["type"] = Model_Tipo_Fichero::find($f->idtipo)->get('tipo');
                }
            }

            $data['files'] = $files;
            $data['rep'] = $rep;

            return View::forge('doc/cesion_cpp',$data)->render();
        }
        else{
            $q = "SELECT * FROM cesiones WHERE `idcliente` =".$idc." AND `idcesionaria`=".$idces;
            $cesiones = DB::query($q)->as_assoc()->execute();

            foreach ($cesiones as $c){
                $q = "SELECT * FROM ficheros WHERE `id` =".$c["idfichero"];
                $f = DB::query($q)->as_assoc()->execute()[0];

                $q = "SELECT * FROM tipo_ficheros WHERE `id` =".$f["idtipo"];
                $t = DB::query($q)->as_assoc()->execute()[0]["tipo"];

                $files[] = array(
                    "type" => $t,
                    "level" => $f["nivel"],
                    "supp" => $f["soporte"]);
            }
            $data['files'] = $files;

            $q = "SELECT * FROM personals WHERE `idcliente` =".$idc." AND `relacion`=1";
            $data['rep_legal'] = DB::query($q)->as_assoc()->execute()[0];

            $q = "SELECT * FROM clientes WHERE `id` =".$idces;
            $data['ces'] = DB::query($q)->as_assoc()->execute()[0];

            $q = "SELECT * FROM personals WHERE `idcliente` =".$idces." AND `relacion`=1";
            $data['rep_legal_ces'] = DB::query($q)->as_assoc()->execute()[0];

            return View::forge('doc/cesion',$data)->render();
        }
    }
}
