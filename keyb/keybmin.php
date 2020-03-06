<?php

	namespace Keybmin;

	use MatthiasMullie\Minify;

	class keybmin{

		private $sessionName;
		public  $page       = 'login';
		public  $pageFile   = null;
		public  $pageInfo   = null;
		private $userInfo   = null;
		private $settings   = [];
		private $pageTitle  = 'Not Found Title';
		private $pageDesc   = 'Not Found Desc';
		private $test       = false;
		private $keys = [];

		function __construct($sessionName,$settings = []){
			global $mysqli,$db,$keybmin;

			$keybmin = $this;

			//putenv('LC_ALL='.$settings['lang']);
			setlocale(LC_ALL, $settings['lang']);
			bindtextdomain("*", ROOT."/langs");
			//bind_textdomain_codeset( 'keybmin', 'UTF-8' );
			textdomain("*");

			$this->sessionName  = $sessionName;
			$this->test         = $settings['test'];

			$get = $this->getSecurity();
			extract($get);
			$post = $this->postSecurity();
			extract($post);

			//GET SETTINGS
			$ask = $mysqli->query("SELECT * FROM kb_settings");
			if($ask->num_rows > 0){
				while($setting = $ask->fetch_assoc()){
					$this->settings[$setting['var']] = $setting['val'];
				}

				$this->settings = array_merge([
					'SITEURL' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/',
					'THEMEPATH' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/themes/'.$this->settings['theme'].'/',
					'THEMEDIR' => THEMEDIR.'/'.$this->settings['theme'].'/',
					'KEYBPATH' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/keyb/',
				],$this->settings);

			}else{
				$this->page = '500';
				goto goPage;
			}
			//GET SETTINGS

			//USER LOGIN CHECK
			$loginCheck = $this->loginCheck();
			if($loginCheck){
				$this->page = $_GET['page']??'dashboard';
			}else{
				$this->page = $_GET['page']??'login';
				goto goPage;
			}
			//USER LOGIN CHECK

			//PAGE EXITS
			if(is_dir(THEMEDIR.$this->settings['theme'])){
				goPage:
				$this->pageCheck($this->page);
				require $this->pageFile.'.php';
			}else{
				exit(THEMEDIR.$this->settings['theme'].' Theme Not Found');
			}
			//PAGE EXITS
		}

		function userLogin($mail,$password){
			global $mysqli;

			if(isset($mail,$password)){

				$ask = $mysqli->query("SELECT * FROM kb_users WHERE mail = '".$mail."' AND password='".md5($password)."'");
				if($ask->num_rows > 0){
					$info = $ask->fetch_assoc();

					$session = md5(time());
					$data = [
						'ID' => $info['id'],
						'fullName' => $info['fullName'],
						'mail' => $info['mail'],
						'loginTime' => time(),
						'session' => $session,
						'authID' => $info['authID']
					];

					setcookie($this->sessionName,json_encode($data));
					$_SESSION[$this->sessionName] = $data;

					$mysqli->query("UPDATE kb_users SET session='".$session."' WHERE id = '".$info['id']."'");

					$results = [
						'status' => 'success',
						'message' => _('Login Success. Wait...'),
					];

				}else{
					$results = [
						'status' => 'danger',
						'message' => _('User Not Found'),
					];
				}

			}else{
				$results = [
					'status' => 'danger',
					'message' => _('Parameters Not Found'),
				];
			}

			return $results;

		}

		function userRegister($fullname,$mail,$password,$confirmPassword){
			global $mysqli;

			if(isset($fullname,$mail,$password,$confirmPassword)){

				$ask = $mysqli->query("SELECT * FROM kb_users WHERE mail = '".$mail."'");
				if($ask->num_rows == 0){

					if($password == $confirmPassword){
						$register = $mysqli->query("INSERT INTO kb_users SET fullName = '".$fullname."',mail='".$mail."',password='".md5($password)."',authID='3',time='".time()."'");
						if($register){

							$this->userLogin($mail, $password);

							$results = [
								'status' => 'success',
								'message' => _('Register Success. Auto Login. Wait... '),
							];

						}else{
							$results = [
								'status' => 'danger',
								'message' => _('Register problem'),
							];
						}
					}else{
						$results = [
							'status' => 'danger',
							'message' => _('Password Not Match'),
						];
					}

				}else{
					$results = [
						'status' => 'danger',
						'message' => _('User Exists'),
					];
				}

			}else{
				$results = [
					'status' => 'danger',
					'message' => _('Parameters Not Found'),
				];
			}

			return $results;

		}

		function loginCheck(){
			global $mysqli,$db;

			if(isset($_SESSION[$this->sessionName]['session']) and !empty($_SESSION[$this->sessionName]['session'])){

				$seldosIOI = $db->query("SELECT * FROM users WHERE session = '".$_SESSION[$this->sessionName]['session']."'");
				$ask = $mysqli->query("SELECT * FROM kb_users WHERE session = '".$_SESSION[$this->sessionName]['session']."'");
				if($ask->num_rows > 0){
					$this->userInfo = array_merge($ask->fetch_assoc(),$seldosIOI[0]);
					return true;
				}else{
					session_destroy();
					return false;
				}

			}else{
				return false;
			}

		}

		function pageCheck($page){
			global $mysqli;

			$pageInfo = $this->pageInfo($page);
			if($pageInfo !== false){

				$this->pageTitle = $pageInfo['title'];
				$this->pageDesc  = $pageInfo['description'];

				if(file_exists(THEMEDIR.$this->settings['theme'].'/ajax/'.$pageInfo['template'].'.php') and $pageInfo['type']=='ajax'){
					$pageFile = THEMEDIR.$this->settings['theme'].'/ajax/'.$pageInfo['template'];
				}else if(file_exists(KEYB.'/pages/'.$pageInfo['template'].'.php') and $pageInfo['type']=='keybmin'){
					$pageFile = KEYB.'/pages/'.$pageInfo['template'];
				}else if(file_exists(THEMEDIR.$this->settings['theme'].'/'.$pageInfo['template'].'.php')){
					$pageFile = THEMEDIR.$this->settings['theme'].'/'.$pageInfo['template'];
				}else if(file_exists(THEMEDIR.$this->settings['theme'].'/pages/'.$pageInfo['template'].'.php')){
					$pageFile = THEMEDIR.$this->settings['theme'].'/pages/'.$pageInfo['template'];
				}else{
					header("HTTP/1.0 404 Not Found");
					$pageFile = THEMEDIR.$this->settings['theme'].'/'.'404';
					goto page404;
				}

				if($pageInfo['control'] == 1){

					if($this->loginCheck()){
						if(!$this->userAuthCheck($this->page,'template')){
							$this->page = 'banned';
							$pageInfo = $this->pageInfo($this->page);
							$pageFile = THEMEDIR.$this->settings['theme'].'/'.$this->page;

							$this->pageTitle = $pageInfo['title'];
							$this->pageDesc  = $pageInfo['description'];
							goto page404;
						}
					}else{
						$pageFile = THEMEDIR.$this->settings['theme'].'/'.'login';
						goto page404;
					}

				}

				page404:
				$this->pageFile = $pageFile;
				return true;
			}

			$this->pageFile = THEMEDIR.$this->settings['theme'].'/'.'404';
			return false;
		}

		function pageInfo($page){
			global $mysqli;

			$ask = $mysqli->query("SELECT * FROM kb_pages WHERE link = '?page=".$page."'");
			if($ask->num_rows > 0){
				$pageInfo = $ask->fetch_assoc();
				$this->pageInfo = $pageInfo;
				return $pageInfo;
			}

			return false;
		}

		function userAuthCheck($page,$type = 'shortcode'){
			global $mysqli;

			if($this->loginCheck()){
				$ask = $mysqli->query("SELECT * FROM kb_pages WHERE ".$type." = '".$page."'");
				if($ask->num_rows > 0){
					$pageInfo = $ask->fetch_assoc();

					if($pageInfo['control'] == '1'){
						$pageAuth = json_decode($pageInfo['userAuth']);

						foreach($pageAuth as $id => $authID){
							if($authID == $this->userInfo['authID']){
								return true;
								break;
							}
						}
					}else{
						return true;
					}

				}
			}

			return false;
		}

		function pageTitle(){
			echo $this->pageTitle;
		}

		function pageDesc(){
			echo $this->pageDesc;
		}

		function getSecurity(){
			global $mysqli;
			$degerler = array();
			foreach($_GET as $p => $d){
				if(is_string($_GET[$p]) === true){
					$degerler[$p] = trim(strip_tags($mysqli->escape_string($d)));
				}
			}
			return $degerler;
		}

		function postSecurity(){
			global $mysqli;
			$degerler = array();
			foreach($_POST as $p => $d){
				if(is_string($_POST[$p]) === true){
					$degerler[$p] = trim(strip_tags($mysqli->escape_string($d)));
				}
			}
			return $degerler;
		}

		function getControl($get){

			$kontrol = 0;
			foreach($get as $parametre){
				if(isset($_GET[$parametre]) and !empty($_GET[$parametre])){
					$kontrol ++;
				}else{
					return false;
					break;
				}
			}

			if(count($get)==$kontrol){
				return true;
			}else{
				return false;
			}

		}

		function postControl($post){

			$kontrol = 0;
			foreach($post as $parametre){
				if(isset($_POST[$parametre]) and !empty($_POST[$parametre])){
					$kontrol++;
				}else{
					return $parametre;
					break;
				}
			}

			if(count($post)==$kontrol){
				return true;
			}else{
				return false;
			}

		}

		function startsWith($haystack, $needle){
			$length = strlen($needle);
			return (substr($haystack, 0, $length) === $needle);
		}

		function endsWith($haystack, $needle){
			$length = strlen($needle);
			if ($length == 0) {
				return true;
			}

			return (substr($haystack, -$length) === $needle);
		}

		function preload($csses,$jses,$fileName='non'){

			if($csses != null){
				if($this->test == true){
					foreach($csses as $c){
						echo '<link rel="preload" href="'.$c.'" as="style">'."\n";
					}
				}else{
					echo '<link rel="preload" href="'.($this->settings['THEMEPATH'].'cache/'.$fileName.'.css').'" as="style">'."\n";
				}
			}

			if($jses != null){
				if($this->test == true){
					foreach($jses as $j){
						echo '<link rel="preload" href="'.$j.'" as="script">'."\n";
					}
				}else{
					echo '<link rel="preload" href="'.($this->settings['THEMEPATH'].'cache/'.$fileName.'.js').'" as="script">'."\n";
				}
			}

		}

		function cssMinify($csses = null,$fileName='non'){

			if($csses != null){
				if($this->test == false){

					if(!file_exists($this->settings['THEMEDIR'].'cache/'.$fileName.'.css')){
						$minifier = new Minify\CSS();
						foreach($csses as $c){
							$minifier->add($c);
						}
						$minifier->minify($this->settings['THEMEDIR'].'cache/'.$fileName.'.css');
					}

					echo '<link href="'.($this->settings['THEMEPATH'].'cache/'.$fileName.'.css').'" rel="stylesheet" type="text/css"/>'."\n";
				}else{
					$css = '';
					foreach($csses as $c){
						$css .= '<link href="'.$c.'" rel="stylesheet" type="text/css"/>'."\n";
					}
					echo $css;
				}

			}else{
				return false;
			}
		}

		function jsMinify($jses = null,$fileName='non'){

			if($jses != null){
				if($this->test == false){

					if(!file_exists($this->settings['THEMEDIR'].'cache/'.$fileName.'.js')){
						$minifier = new Minify\JS();
						foreach($jses as $j){

							if($this->startsWith($j,'http')){
								$j = file_get_contents($j);
							}

							$minifier->add($j);
						}
						$minifier->minify($this->settings['THEMEDIR'].'cache/'.$fileName.'.js');
					}

					echo '<script src="'.($this->settings['THEMEPATH'].'cache/'.$fileName.'.js').'" type="text/javascript"/></script>'."\n";
				}else{
					$js = '';
					foreach($jses as $j){
						$js .= '<script src="'.str_replace($this->settings['THEMEDIR'],$this->settings['THEMEPATH'],$j).'" type="text/javascript"/></script>'."\n";
					}
					echo $js;
				}
			}else{
				return false;
			}
		}

		function getSidebarMenuToArray($parentID = 0){
			global $mysqli;

			$allSidebarMenu = [];
			$getMenu = $mysqli->query("SELECT *,(SELECT parentID FROM kb_pages WHERE parentID = KP.id LIMIT 1) AS UST FROM kb_pages AS KP WHERE menu = 1 AND parentID = '".$parentID."' ORDER BY orderBy ASC");
			if($getMenu->num_rows > 0){
				while($menu = $getMenu->fetch_assoc()){
					if($menu['UST'] == ''){
						$allSidebarMenu[$menu['id']] = $menu;
					}else{
						$allSidebarMenu[$menu['id']] = $menu;
						$allSidebarMenu[$menu['id']]['sub'] = $this->getSidebarMenuToArray($menu['UST']);
					}
				}
			}

			return $allSidebarMenu;
		}

		function getSidebarMenuToHtml(
			$sidebarMenuArray,
			$page,
			$menuHtml = [
				'ulBefore'      => '<ul class="navbar-nav flex-column">'."\n",
				'ulAfter'       => '</ul>'."\n",
				'liBefore'      => '<li class="nav-item">'."\n",
				'liAfter'       => '</li>'."\n",
				'linkBefore'    => '<a class="nav-link %s" href="%s">'."\n",
				'linkAfter'     => "\n".'</a>'."\n",
				'subLinkBefore' => '<a class="nav-link dropdown %s" href="%s" data-toggle="collapse" aria-expanded="false" data-target="#%s" aria-controls="%s">'."\n",
				'subLinkAfter'  => "\n".'</a>'."\n",
			]
			,$sub = false
		){

			$m = $this->searchArrayValue($sidebarMenuArray, 'template', $page);

			if($sub == false){
				echo $menuHtml['ulBefore'];
			}else{
				$menu = end($sidebarMenuArray);
				printf($menuHtml['ulBefore'],'menu-'.$menu['parentID'],$m?'collapse show':'');
			}
			foreach($sidebarMenuArray as $id => $menu){

				if($this->userAuthCheck($menu['shortcode'])){
					echo $menuHtml['liBefore'];
					if(isset($menu['sub']) and is_array($menu['sub'])){

						printf($menuHtml['subLinkBefore'], ($menu['template']==$page?'active':''),$menu['link'], 'menu-'.$menu['UST'], 'menu-'.$menu['UST']);
						echo '<i class="'.$menu['iconClass'].'"></i>'.$menu['title'];
						echo $menuHtml['subLinkAfter'];
						$this->getSidebarMenuToHtml($menu['sub'],$page,
							[
								'ulBefore'      => '<div id="%s" class="collapse submenu %s" style=""><ul class="nav flex-column">'."\n",
								'ulAfter'       => '</ul></div>'."\n",
								'liBefore'      => '<li class="nav-item">'."\n",
								'liAfter'       => '</li>'."\n",
								'linkBefore'    => '<a class="nav-link %s" href="%s">'."\n",
								'linkAfter'     => "\n".'</a>'."\n",
								'subLinkBefore' => '<a class="nav-link dropdown %s" href="%s" data-toggle="collapse" aria-expanded="false" data-target="#%s" aria-controls="%s">'."\n",
								'subLinkAfter'  => "\n".'</a>'."\n"
							], true);

					}
					else{
						printf($menuHtml['linkBefore'], ($menu['template']==$page?'active':''),$menu['link'], 'menu-'.$menu['id'], 'menu-'.$menu['id']);
						echo '<i class="'.$menu['iconClass'].'"></i>'.$menu['title'];
						echo $menuHtml['linkAfter'];
					}
					echo $menuHtml['liAfter'];
				}
			}
			echo $menuHtml['ulAfter'];

		}

		function searchArrayValue($array = [],$needle,$haystrack){

			foreach($array as $key => $value){
				if(is_array($value)){
					$sub = $this->searchArrayValue($value, $needle, $haystrack);
					if($sub){
						return true;
					}
				}else{
					if($key == $needle){
						if($value == $haystrack){
							return true;
							break;
						}
					}
				}
			}

			return false;
		}

		function arrayValueLists($array = [],$keyName){

			foreach($array as $key => $value){

				if($key == $keyName){
					$this->keys[] = $value;
				}

				if(is_array($value)){
					$this->arrayValueLists($value, $keyName);
				}

			}

			return $this->keys;
		}

		function getAuthList(){
			global $mysqli;

			$allAuth = [];
			$askAuth = $mysqli->query("SELECT * FROM kb_auth");
			if($askAuth->num_rows > 0){
				while($auth = $askAuth->fetch_assoc()){
					$allAuth[] = $auth;
				}
			}

			return $allAuth;
		}

		function getPageList($filter = 'all',$filterType='type'){
			global $mysqli;

			$allPage = [];

			if($filter == 'all'){
				$sql = "SELECT * FROM kb_pages";
			}else{
				$sql = "SELECT * FROM kb_pages WHERE ".$filterType." = '".$filter."'";
			}

			$askPage = $mysqli->query($sql);
			if($askPage->num_rows > 0){
				while($page = $askPage->fetch_assoc()){
					if($this->userAuthCheck($page['shortcode'])){
						$allPage[] = $page;
					}
				}
			}

			return $allPage;
		}

		function getPageListTree($array,$sub=0){



		}
	}