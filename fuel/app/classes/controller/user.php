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

        $q = "SELECT tipo FROM tipo_clientes WHERE `id` =".$data["cliente"]["tipo"];
        $data['tipo'] = DB::query($q)->as_assoc()->execute();
        $data["tipo"] = $data['tipo'][0]["tipo"];

        $q = "SELECT * FROM personals WHERE `idcliente` =".Session::get('iduser');
        $data['contactos'] = DB::query($q)->as_assoc()->execute();
        //$data["contactos"]
        $this->template->title = "Datos básicos del cliente";
        $this->template->content = View::forge('user/perfil',$data);
    }
}
