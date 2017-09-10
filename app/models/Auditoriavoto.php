<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Auditoriavoto extends Eloquent {

		protected $table = 'auditoriavotos';

		protected $fillable = ['ip'];


	public static $errors;

	public static function isValid($data, $rules)
		{

			$validation = Validator::make($data, $rules);

			if ($validation->passes()) return true;

				static::$errors = $validation->messages();

			return false;
		}


		public static function voto() {

			$salida = true;

			$cookie_id = 0;
			$cookie_vv = "";


			$encuesta = DB::table('encuestas')
												->where('activo', '=', 'si')
												->orderBy('id', 'desc')
												->first();

			if ($encuesta) {


					if (isset($_COOKIE["cookie_id"])) {
						$cookie_id = $_COOKIE["cookie_id"];
					}

					if (isset($_COOKIE["cookie_vv"])) {
						$cookie_vv = $_COOKIE["cookie_vv"];
					}

					$ip = Auditoriavoto::get_client_ip();
					$sess = Session::getId();

					$auditoriavoto = DB::table('auditoriavotos')
															->where('cookie', '=', $cookie_vv)
															->where('encuestas_id', '=', $encuesta->id)
															->first();

					if ($auditoriavoto) {


						$salida = false;

					}

					$auditoriavoto = DB::table('auditoriavotos')
															->where('session', '=', $sess)
															->where('encuestas_id', '=', $encuesta->id)
															->first();

					if ($auditoriavoto) {
						$salida = false;
					}


					$auditoriavoto = DB::table('auditoriavotos')
															->where('ip', '=', $ip)
															->where('encuestas_id', '=', $encuesta->id)
															->first();

					if ($auditoriavoto) {

							$datetime1 = new DateTime($auditoriavoto->created_at);
							$datetime2 = new DateTime();
							$interval = $datetime1->diff($datetime2);
							$horas = $interval->format('%h%');

							if ($horas < 2 ) {
								$salida = false;
							}

					}
			} else {
				$salida = false;
			}

			return $salida;


		}




			public static function get_client_ip() {
			    $ipaddress = '';
			    if (getenv('HTTP_CLIENT_IP'))
			        $ipaddress = getenv('HTTP_CLIENT_IP');
			    else if(getenv('HTTP_X_FORWARDED_FOR'))
			        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
			    else if(getenv('HTTP_X_FORWARDED'))
			        $ipaddress = getenv('HTTP_X_FORWARDED');
			    else if(getenv('HTTP_FORWARDED_FOR'))
			        $ipaddress = getenv('HTTP_FORWARDED_FOR');
			    else if(getenv('HTTP_FORWARDED'))
			       $ipaddress = getenv('HTTP_FORWARDED');
			    else if(getenv('REMOTE_ADDR'))
			        $ipaddress = getenv('REMOTE_ADDR');
			    else
			        $ipaddress = 'UNKNOWN';
			    return $ipaddress;
			}



						public static function get_client_os() {
								$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

						    $os_platform    =   "Unknown OS Platform";
						    $os_array       =   array(
						                            '/windows nt 6.3/i'     =>  'Windows 8.1',
						                            '/windows nt 6.2/i'     =>  'Windows 8',
						                            '/windows nt 6.1/i'     =>  'Windows 7',
						                            '/windows nt 6.0/i'     =>  'Windows Vista',
						                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
						                            '/windows nt 5.1/i'     =>  'Windows XP',
						                            '/windows xp/i'         =>  'Windows XP',
						                            '/windows nt 5.0/i'     =>  'Windows 2000',
						                            '/windows me/i'         =>  'Windows ME',
						                            '/win98/i'              =>  'Windows 98',
						                            '/win95/i'              =>  'Windows 95',
						                            '/win16/i'              =>  'Windows 3.11',
						                            '/macintosh|mac os x/i' =>  'Mac OS X',
						                            '/mac_powerpc/i'        =>  'Mac OS 9',
						                            '/linux/i'              =>  'Linux',
						                            '/ubuntu/i'             =>  'Ubuntu',
						                            '/iphone/i'             =>  'iPhone',
						                            '/ipod/i'               =>  'iPod',
						                            '/ipad/i'               =>  'iPad',
						                            '/android/i'            =>  'Android',
						                            '/blackberry/i'         =>  'BlackBerry',
						                            '/webos/i'              =>  'Mobile'
						                        );
						    foreach ($os_array as $regex => $value) {
						        if (preg_match($regex, $user_agent)) {
						            $os_platform    =   $value;
						        }
						    }
						    return $os_platform;
						}


						public static function get_client_browser() {
								$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

						    $browser        =   "Unknown Browser";
						    $browser_array  =   array(
						                            '/msie/i'       =>  'Internet Explorer',
						                            '/firefox/i'    =>  'Firefox',
						                            '/safari/i'     =>  'Safari',
						                            '/chrome/i'     =>  'Chrome',
						                            '/opera/i'      =>  'Opera',
						                            '/netscape/i'   =>  'Netscape',
						                            '/maxthon/i'    =>  'Maxthon',
						                            '/konqueror/i'  =>  'Konqueror',
						                            '/mobile/i'     =>  'Handheld Browser'
						                        );
						    foreach ($browser_array as $regex => $value) {
						        if (preg_match($regex, $user_agent)) {
						            $browser    =   $value;
						        }
						    }
						    return $browser;
						}




}
