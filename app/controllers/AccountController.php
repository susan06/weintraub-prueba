<?php

class AccountController extends \BaseController {
	
	public function crearCuenta(){
		return View::make("dashboard.accounts.crearCuenta");
	}
	
	public function listaUsuarios(){
		$usuarios = User::paginate(5);
		return View::make("dashboard.accounts.listaUsuarios")->with(array("usuarios" => $usuarios,"i" => 1));
	}
	
	public function permisosCuenta(){
		$roles = Role::all();
		$permisos = PermisosRoles::where("role_id","=",1)->get();
		return View::make("dashboard.roles.permisosRoles")->with(array("roles" => $roles,"permisos" => $permisos));
	}
}
