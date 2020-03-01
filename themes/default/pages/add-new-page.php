<?php

    if(isset($post) and !empty($post)){

        if($this->postControl(['pageName','pageDesc','pageLink','pageShortcode','pageTemplate','pageStatus','pageType','pageMenu','parentPageID'])){

	        print_r($_POST);
            $pageAuth = $_POST['pageAuth']??[1];
            if(isset($_POST['pageAuth'])){
	            $pageAuth = array_merge($pageAuth,["1"]);
            }else{
	            $pageAuth = [1];
            }
            $pageAuth = json_encode($pageAuth);
            print_r($pageAuth);


            $askPage = $mysqli->query("SELECT * FROM kb_pages WHERE shortcode = '".$pageShortcode."' OR template = '".$pageTemplate."'");
            if($askPage->num_rows == 0){

                $addPage = $mysqli->query("INSERT INTO kb_pages SET 
                title='".$pageName."',
                description='".$pageDesc."',
                link='".$pageLink."',
                template='".$pageShortcode."',
                shortcode='".$pageShortcode."',
                status='".$pageStatus."',
                control='1',
                menu='".$pageMenu."',
                type='".$pageType."',
                userAuth='".$pageAuth."',
                time='".time()."',
                parentID='".$parentPageID."'");
                if($addPage){

                    $open = fopen($this->settings['THEMEDIR'].'pages/'.$pageShortcode.'.php', 'w');
                    fwrite($open, file_get_contents($this->settings['THEMEDIR'].'templates/'.$pageTemplate));
                    fclose($open);

	                $result = [
		                'status' => 'success',
		                'message' => $pageName._(' Page Added'),
	                ];

                }else{
	                $result = [
		                'status' => 'danger',
		                'message' => _('Page Not Add'),
	                ];
                }

            }else{
                $result = [
                    'status' => 'danger',
                    'message' => _('This page is exists'),
                ];
            }

        }

    }

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [
	];

	require $this->settings['THEMEDIR']."/header.php";
	require $this->settings['THEMEDIR']."/sidebar.php";
?>
    <!-- ============================================================== -->
    <!-- wrapper  -->
    <!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="dashboard-ecommerce">
            <div class="container-fluid dashboard-content ">

                <?php
                    if(isset($result)){
                ?>
                <div class="alert alert-<?=$result['status']?> bg-<?=$result['status']?> text-white"><?=$result['message']?></div>
                <?php
                    }
                ?>

                <!-- ============================================================== -->
                <!-- basic form  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title"><?=$this->pageInfo['title']?></h3>
                            <p><?=$this->pageInfo['description']?></p>
                        </div>
                        <div class="card">
                            <h5 class="card-header"><?=$this->pageInfo['title']?> Form</h5>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="hidden" name="post" value="true">

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="pageName" class="col-form-label"><?=_('Page Name')?></label>
                                                <input id="pageName" name="pageName" type="text" class="form-control pageName" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pageDesc" class="col-form-label"><?=_('Page Description')?></label>
                                                <input id="pageDesc" name="pageDesc" type="text" class="form-control" required>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageLink" class="col-form-label"><?=_('Page Link')?></label>
                                                        <input id="pageLink" name="pageLink" type="text" class="form-control pageLink" value="?page=" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageShortcode" class="col-form-label"><?=_('Page Shortcode')?></label>
                                                        <input id="pageShortcode" name="pageShortcode" type="text" class="form-control pageShortcode" value="" readonly>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageTemplate" class="col-form-label"><?=_('Template')?></label>
                                                        <select class="form-control" name="pageTemplate" id="pageTemplate" required>
			                                                <?php
				                                                $templates = glob($this->settings['THEMEDIR'].'/templates/*.php');
				                                                foreach($templates as $template){
					                                                $fileName = basename($template);
					                                                ?>
                                                                    <option value="<?=$fileName?>"><?=$fileName?></option>
					                                                <?php
				                                                }
			                                                ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageStatus" class="col-form-label"><?=_('Status')?></label>
                                                        <select class="form-control" name="pageStatus" id="pageStatus" required>
                                                            <option value="1"><?=_('Active')?></option>
                                                            <option value="0"><?=_('Deactive')?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageType" class="col-form-label"><?=_('Page Type')?></label>
                                                        <select class="form-control" name="pageType" id="pageType">
                                                            <option value="normal"><?=_('Normal')?></option>
                                                            <option value="ajax"><?=_('Ajax')?></option>
                                                            <option value="warning"><?=_('warning')?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="pageMenu" class="col-form-label"><?=_('Do you look in the menu?')?></label>
                                                        <select class="form-control" name="pageMenu" id="pageMenu">
                                                            <option value="1"><?=_('Yes')?></option>
                                                            <option value="0"><?=_('No')?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="parentPageID" class="col-form-label"><?=_('Parent Page')?></label>
                                                <select class="form-control parentPageID" name="parentPageID" id="parentPageID" required>
                                                    <option value="0"><?=_('No Parent Page')?></option>
			                                        <?php
				                                        $allPage = $this->getPageList();
				                                        foreach($allPage as $page){
                                                    ?>
                                                    <option value="<?=$page['id']?>" data-pageshortcode="<?=$page['shortcode']?>"><?=$page['title']?></option>
                                                    <?php
				                                        }
			                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="pageAuth" class="col-form-label"><?=_('Choose Authorized?')?></label>
                                                <select class="form-control multiSelectBox" name="pageAuth[]" id="pageAuth" required multiple>
                                                <?php
	                                                $allAuth = $this->getAuthList();
	                                                foreach($allAuth as $auth){
                                                ?>
                                                    <option value="<?=$auth['id']?>" <?=$auth['id']==1?'selected disabled':''?>><?=$auth['authName']?></option>
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
                <!-- ============================================================== -->
                <!-- end basic form  -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end wrapper  -->
    <!-- ============================================================== -->
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>