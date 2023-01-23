<?php

function state($state) {
	if ($state=='Inactivo') {
		return '<span class="badge badge-danger">'.$state.'</span>';
	} elseif ($state=='Activo') {
		return '<span class="badge badge-success">'.$state.'</span>';
	}
	return '<span class="badge badge-dark">'.$state.'</span>';
}

function roleUser($user, $badge=true) {
	$num=1;
	$roles="";
	foreach ($user['roles'] as $rol) {
		if ($user->hasRole($rol->name)) {
			$roles.=($user['roles']->count()==$num) ? $rol->name : $rol->name."<br>";
			$num++;
		}
	}

	if (!is_null($user['roles']) && !empty($roles)) {
		if ($badge) {
			return '<span class="badge badge-primary">'.$roles.'</span>';
		} else {
			return $roles;
		}
	} else {
		if ($badge) {
			return '<span class="badge badge-dark">Desconocido</span>';
		} else {
			return 'Desconocido';
		}
	}
}

function active($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'active';
				}
			}
		}
		return '';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'active' : '';
		}
	}
}

function menu_expanded($path, $group=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($group)) {
				if (request()->is($url)) {
					return 'true';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'true';
				}
			}
		}
		return 'false';
	} else {
		if (is_null($group)) {
			return request()->is($path) ? 'true' : 'false';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'true' : 'false';
		}
	}
}

function submenu($path, $action=null) {
	if (is_array($path)) {
		foreach ($path as $url) {
			if (is_null($action)) {
				if (request()->is($url)) {
					return 'class=active';
				}
			} else {
				if (is_int(strpos(request()->path(), $url))) {
					return 'show';
				}
			}
		}
		return '';
	} else {
		if (is_null($action)) {
			return request()->is($path) ? 'class=active' : '';
		} else {
			return is_int(strpos(request()->path(), $path)) ? 'show' : '';
		}
	}
}

function selectArray($arrays, $selectedItems) {
	$selects="";
	foreach ($arrays as $array) {
		$select="";
		if (count($selectedItems)>0) {
			foreach ($selectedItems as $selected) {
				if (is_object($selected) && $selected->slug==$array->slug) {
					$select="selected";
					break;
				} elseif ($selected==$array->slug) {
					$select="selected";
					break;
				}
			}
		}
		$selects.='<option value="'.$array->slug.'" '.$select.'>'.$array->name.'</option>';
	}
	return $selects;
}

function store_files($file, $file_name, $route, $disk='public') {
	$image=$file_name.".".$file->getClientOriginalExtension();
	if (Storage::disk($disk)->exists($route.$image)) {
		Storage::disk($disk)->delete($route.$image);
	}
	Storage::disk($disk)->putFileAs($route, $file, $image);
	return $image;
}

function image_exist($file_route, $image, $user_image=false, $large=true) {
	if (file_exists(public_path().$file_route.$image)) {
		$img=asset($file_route.$image);
	} else {
		if ($user_image) {
			$img=asset("/admins/img/template/usuario.png");
		} else {
			if ($large) {
				$img=asset("/admins/img/template/imagen.jpg");
			} else {
				$img=asset("/admins/img/template/image.jpg");
			}
		}
	}

	return $img;
}

function session_flash_messages($type, $title, $msg, $alert='lobibox', $size='normal', $position='bottom right', $delay=5000, $height=60) {
	session()->flash('alert', $alert);
	session()->flash('size', $size);
	session()->flash('type', $type);
	session()->flash('title', $title);
	session()->flash('msg', $msg);
	session()->flash('position', $position);
	session()->flash('delay', $delay);
	session()->flash('messageHeight', $height);
}

function currency_format($number, $symbol='', $side_symbol='Derecha', $decimals=2, $decimals_separator=',', $thousands_separator='.') {
	$number=$number ?? str_pad(0.0, $decimals+2, 0);
	$number_format=number_format($number, $decimals, $decimals_separator, $thousands_separator);
	if ($side_symbol=='Izquierda') {
		return $symbol.$number_format;
	}
	return $number_format.$symbol;
}

function calculate_commission($amount, $fixed_commission, $percentage_commission, $percentage_iva) {
	if ($amount>0) {
		if ($amount<50000) {
			$type='1';
			$value=$fixed_commission;
			$commission=$fixed_commission;
			$iva=($percentage_iva>0) ? (($commission*$percentage_iva)/100) : 0.00;
		} else {
			$type='2';
			$value=$percentage_commission;
			$commission=($percentage_commission>0) ? (($amount*$percentage_commission)/100) : 0.00;
			$iva=($percentage_iva>0) ? (($commission*$percentage_iva)/100) : 0.00;
		}
		return ['commission' => $commission, 'type_commission' => $type, 'value_commission' => $value, 'iva' => $iva];
	}
	return ['commission' => 0.00, 'type_commission' => '1', 'value_commission' => $fixed_commission, 'iva' => 0.00];
}