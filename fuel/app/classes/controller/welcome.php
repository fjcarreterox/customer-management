<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.8
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2016 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{
	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index(){
        $user = Session::get('user');
        if ($user == "") {
            return Response::redirect('welcome/login');
        } else {
            $q = "SELECT * FROM contratos WHERE `idcliente` =".Session::get('iduser');
            $data['contracts'] = DB::query($q)->as_assoc()->execute();
            //$data['contracts'] = $res["_result:protected"];
            return Response::forge(View::forge('welcome/index',$data));
        }
    }

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}

	public function action_login(){
		if (Input::method() == 'POST'){
            $q = "SELECT * FROM clientes WHERE `cif_nif` ='".Input::post('username')."'";
            $user = DB::query($q)->execute();
			if($user!=NULL){
				$pass=$user->get('password');
				/*if(strcmp(md5(Input::post('pass')),$pass)==0){*/
				if(strcmp(Input::post('pass'),$pass)==0){
					Session::create();
					Session::set('user',Input::post('username'));
					Session::set('iduser',$user->get('id'));
					Session::set('username',$user->get('nombre'));
					Session::set('idrol',$user->get('role'));
					return Response::redirect('/');
				}
				else{
					Session::set_flash('error', 'Error en el acceso');
					Response::redirect('welcome/login');
				}
			}
			else{
				//User not found
				return Response::forge(View::forge('welcome/login'));
			}
		}
		else{
			//Not a submit process
			return Response::forge(View::forge('welcome/login'));
		}
	}

    public function action_logout(){
        Session::delete('user');
        Session::delete('iduser');
        Session::delete('username');
        Session::delete('idrol');
        Session::destroy();
        return Response::redirect('welcome/login');
    }
}
