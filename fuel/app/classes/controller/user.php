<?php

class Controller_User extends Controller_Template{

    public function action_new_pass(){
        /*$user = Session::get('user');
        if ($user == "") {
            return Response::redirect('welcome/login');
        } else {
            $q = "SELECT * FROM contratos WHERE `idcliente` =".Session::get('iduser');
            $data['contracts'] = DB::query($q)->as_assoc()->execute();
            //$data['contracts'] = $res["_result:protected"];*/
        //return Response::forge(View::forge('welcome/index',$data));
        $this->template->title = "Cambiar la contraseña asociada al usuario";
        $this->template->content = View::forge('user/new_pass');
        //}
    }

    public function action_pending(){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }
        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['cliente'] = DB::query($q)->as_assoc()->execute();
        $data["pending"] = $data['cliente'][0]["pending"];

        $this->template->title = "Tareas pendientes";
        $this->template->content = View::forge('user/pending',$data);
    }

    public function action_perfil(){
        if(Session::get('iduser')==null){
            return \Fuel\Core\Response::redirect('welcome/login');
        }
        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['cliente'] = DB::query($q)->as_assoc()->execute();
        $data["cliente"] = $data['cliente'][0];

        $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser');
        $data['contactos'] = DB::query($q)->as_assoc()->execute();

        $this->template->title = "Datos básicos del cliente";
        $this->template->content = View::forge('user/perfil',$data);
    }

    public function action_contrato($idcontract){

        $q = "SELECT * FROM contratos WHERE `idcliente` =".Session::get('iduser')." AND id=".$idcontract;
        $data['contrato'] = DB::query($q)->as_assoc()->execute();
        $data["contrato"] = $data['contrato'][0];

        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['customer'] = DB::query($q)->as_assoc()->execute();
        $data["customer"] = $data['customer'][0];

        $isCPP=($data["customer"]["tipo"] == 6)? true: false;

        $q = "SELECT * FROM servicios_contratados WHERE `idcontrato` =".$data['contrato']['id'];
        $data['services'] = DB::query($q)->as_assoc()->execute();

        $q = "SELECT * FROM personals WHERE `id` =".$data['contrato']['idpersonal'];
        $data['rep'] = DB::query($q)->as_assoc()->execute();
        $data['rep'] =  $data['rep'][0];

        if(count($data['services'])==1 ){
            $data['services'] = $data['services'][0];
            if($data['services']['idtipo_servicio']==3) {
                return View::forge('user/contrato_gestoria', $data)->render();
            }
        }

        if($isCPP){
            $q = "SELECT nombre FROM clientes WHERE `id` =".$data['rep']["idcliente"];
            $data["aaff_nombre"] = DB::query($q)->as_assoc()->execute();
            return View::forge('user/contrato_cpp',$data)->render();
        }else{
            return View::forge('user/contrato',$data)->render();
        }
    }
}
