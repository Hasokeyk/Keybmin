<?php

	if(isset($post) and !empty($post)){

		$required = $keybmin->post_control(['settingLang','settingTheme']);
		if($required === true){

		    if(isset($_FILES['settingLogo']['name']) and !empty($_FILES['settingLogo']['name'])){
		        $settingLogo = new \Verot\Upload\Upload($_FILES['settingLogo']);
                if ($settingLogo->uploaded){
                    $settingLogo->process(UPLOADDIR.'/imgs/');
                    if ($settingLogo->processed){
                        $keybmin->db->query("UPDATE kb_settings SET val = '".$settingLogo->file_dst_name."' WHERE var = 'logo'");
                    }else{
                        echo 'error : ' . $settingLogo->error;
                    }
                }
            }

		    $settingVar = [
                'settingLang' => 'lang',
                'settingTheme' => 'theme',
            ];

		    foreach($settingVar as $setting => $var){
		        if(isset($_POST[$setting]) and !empty($setting)){
		            $keybmin->db->query("UPDATE kb_settings SET val = '".$_POST[$setting]."' WHERE var = '".$var."'");
                }
            }
		    
		    header('Refresh:0;');

		    $result = [
				'status' => 'success',
				'message' => _('Update Success'),
			];

		}else{
			$result = [
				'status' => 'danger',
				'message' => $required._('Parameter not found'),
			];
		}

	}

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [
	];

	require $this->settings['THEMEDIR']."/header.php";
	require $this->settings['THEMEDIR']."/sidebar.php";
?>
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <?php
                if(isset($result)){
            ?>
            <div class="alert alert-<?=$result['status']?> bg-<?=$result['status']?> text-white"><?=$result['message']?></div>
            <?php
                }
            ?>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title"><?=$keybmin->page_info['title']?></h3>
                        <p><?=$keybmin->page_info['description']?></p>
                    </div>

                    <div class="card">
                        <h5 class="card-header"><?=$keybmin->page_info['title']?> Form</h5>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="post" value="true">

                                <div class="row">
                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="page_name" class="col-form-label"><?=_('Logo')?></label>
                                                    <br>
                                                    <img src="<?=$this->settings['SITEURL'].'uploads/imgs/'.$this->settings['logo']?>" class="img-thumbnail mr-3">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group ">
                                                    <div class="custom-file-upload mt-5">
                                                        <h1>
                                                            Logo Upload
                                                        </h1>
                                                        <input id="file-upload" name="settingLogo" type="file"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="settingLang" class="col-form-label"><?=_('Language')?></label>
                                            <select class="form-control" name="settingLang" id="settingLang" required>
                                                <?php
                                                    $langs = glob(LANGDIR.'/*');
                                                    foreach($langs as $lang){
                                                        $fileName = basename($lang);
                                                        ?>
                                                        <option value="<?=$fileName?>" <?=($this->settings['lang']==$fileName)?'selected':''?>><?=$fileName?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="settingTheme" class="col-form-label"><?=_('Theme')?></label>
                                            <select class="form-control" name="settingTheme" id="settingTheme" required>
                                                <?php
                                                    $themes = glob(THEMEDIR.'/*');
                                                    foreach($themes as $theme){
                                                        $fileName = basename($theme);
                                                        ?>
                                                        <option value="<?=$fileName?>" <?=($this->settings['theme']==$fileName)?'selected':''?>><?=$fileName?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button class="btn btn-primary"><?=_('Save')?></button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>