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
        if(Session::get('idrol')==3 && Session::get('iduser')!=null){
            return \Fuel\Core\Response::redirect('welcome/not_found');
        }
        $q = "SELECT * FROM clientes WHERE `id` =".Session::get('iduser');
        $data['cliente'] = DB::query($q)->as_assoc()->execute();
        $data["pending"] = $data['cliente'][0]["pending"];
        //return View::forge('user/pending',$data)->render();
        $this->template->title = "Tareas pendientes";
        $this->template->content = View::forge('user/pending',$data);
    }
}
