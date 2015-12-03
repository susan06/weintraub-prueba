<?php

class RolesController extends \BaseController {
	public function vistaCrear () {
		$roles = Role::all();
		$user_id=Auth::user()->id;
		/*$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();*/
		return View::make("dashboard.roles.crearRol")->with(array("roles" => $roles));
	}
	public function vistaAsignar () {
		/*$users = User::join("assigned_roles","assigned_roles.user_id","=","users.id")
					   ->join("roles","roles.id","=","assigned_roles.role_id")
					   ->get(); */
		$uId = DB::table("neighbors")->where("neighbors.user_id","=",Auth::user()->id)->get(array("urbanism_id"));
		$users = Neighbors::where("urbanism_id","=",$uId[0]->urbanism_id)
							->join("users","users.id","=","neighbors.user_id")
							->join("assigned_roles","assigned_roles.user_id","=","users.id")
							->join("roles","roles.id","=","assigned_roles.role_id")
							->get();
		$roles = Role::all();
		
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',Auth::user()->id)
					   ->first();

		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
		
		return View::make("dashboard.roles.asignarRol")->with(array("users" => $users,"roles" => $roles, 'breadcrumbs_data' => $breadcrumbs_data));
	}
	public function vistaPermisos () {
		$roles = Role::select("id","name")->orderBy("id")->get();
		$permisos = PermissionRole::where("role_id","=","2")
									->select("id","estado")
									->orderBy("id")
									->get();

		$user_id=Auth::user()->id;
		$breadcrumbs = Neighbors::select('neighbors.name as name_ne','neighbors.last_name','urbanisms.name as name_ur ')
					   ->join('neighbors_properties','neighbors.id','=','neighbors_properties.neighbors_id')
					   ->join('urbanisms','neighbors_properties.urbanism_id','=','urbanisms.id')
					   ->where('neighbors.user_id','=',$user_id)
					   ->first();

		$breadcrumbs_data=$breadcrumbs->name_ne." ".$breadcrumbs->last_name." [".$breadcrumbs->name_ur."]";
		
		return View::make("dashboard.roles.rolPermisos")->with(array("roles" => $roles,"permisos" => $permisos, 'breadcrumbs_data' => $breadcrumbs_data));
	}
	public function tablaRolesPermiso () {
		$id = Input::get("id");
		$roles = Role::select("id","name")->orderBy("id")->get();
		$permisos = PermisosRoles::where("role_id","=",$id)
									->select("id","estado")
									->orderBy("id")
									->get();
		$html = View::make("dashboard.roles.rolesTablaPermisos")->with(array("roles" => $roles,"permisos" => $permisos,"role" => Input::get("role"),"id" => $id));
		$datos = (string) $html;
		return Response::json(array(
			"datos" => $datos
		));
	}
	public function cambiarPermisos () {
		/*$id = Input::get("id");
		$state = Input::get("state");*/
		$datos = (string) Input::get("datos");
		$array = explode(",", $datos);
		$num = count($array);
		for ($i = 0; $i < $num; $i++) {
			$permisos = explode(".", $array[$i]);
			$id = (int) $permisos[0];
			$estado = (int) $permisos[1];
			$permiso = PermisosRoles::find($id);	
			$permiso->estado = $estado;
			$permiso->save();
		}
		/*$permiso = PermissionRole::find($id);
		$permiso->state = $state;
		$permiso->save();*/
		return Response::json(array(
			"estado" => 1
		));
	}
	public function crearRol () {
		$rol = Input::all();
		$reglas = array(
			"rol" => "required|alpha"
		);
		$mensajes = array(
			"rol.required" => "Ingrese un Rol",
			"rol.alpha" => "Solo se permiten letras"
		);
		$validar = Validator::make($rol,$reglas,$mensajes);
		if ($validar->passes()) {
			$permisos = Permisos::orderBy("id")->get();
			$role = new Role();
			$role->name = Input::get("rol");
			$role->save();
			foreach ($permisos as $permiso) {
				$rol = new PermisosRoles();
				$rol->role_id = $role->id;
				$rol->estado = 0;
				$rol->permission_id = $permiso['id'];	
				$rol->save();
			}
			$html = (string) View::make("dashboard.roles.rolesTablaRoles")->with(array("roles" => Role::all()));
			return Response::json(array(
				"estado" => 1,
				"html" => $html
			));
		} else {
			return Response::json(array(
				"estado" => 2,
				"error" => $validar->getMessageBag()->toArray()
			));
		}
	}
	public function asignarRol () {
		$datos = (string) Input::get("rol");
		$array = explode(",",$datos);
		$num = count($array);
		for ($i = 0; $i < $num; $i++) {
			$roles = explode(".", $array[$i]);
			$id = (int) $roles[1];
			$rol = (int) $roles[0];
			//$permisos = Permisos::all();
			//$permisos = Permisos::find($id);
			Permisos::where("user_id","=",$id)->update(array("role_id" => $rol));
			//$permisos->role_id = $rol;
			//$permisos->save();
		}
		return Response::json(array(
			"estado" => 1
		));
	}
	public function eliminarRol () {
		$rol = Input::get("rol");
		$roles = AssignedRoles::where("role_id","=",$rol)->get();
		if(count($roles) > 0) {
			return Response::json(array(
				"estado" => "1"
			));	
		} else {
			$role = Role::find($rol);
			$role->delete();
			$permisos = PermisosRoles::where("role_id","=",$rol)->delete();
			$html = (string) View::make("dashboard.roles.rolesTablaRoles")->with(array("roles" => Role::all()));
			return Response::json(array(
				"estado" => "2",
				"html" => $html
			));
		}
	}
}
