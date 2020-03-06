<?php

    if($this->getControl(['action','pageID']) === true and $action == 'del' and is_numeric($pageID)){

        $askPage = $mysqli->query("SELECT * FROM kb_pages WHERE id = '".$pageID."'");
        if($askPage->num_rows > 0){

            $pi = $askPage->fetch_assoc();

            $del = $mysqli->query("DELETE FROM kb_pages WHERE id = '".$pageID."'");
            if($del){

                if(file_exists($this->settings['THEMEDIR'].'pages/'.$pi['template'].'.php')){
	                unlink($this->settings['THEMEDIR'].'pages/'.$pi['template'].'.php');
                }

	            $result = [
		            'status' => 'success',
		            'message' => $pi['title']._(' page delete'),
	            ];
            }else{
	            $result = [
		            'status' => 'danger',
		            'message' => $pi['title']._(' not page delete'),
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
	<div class="sidebar-content content-padding">

        <div class="page-title">
            <h1><?=$this->pageTitle();?></h1>
            <p><?=$this->pageDesc();?></p>
        </div>
        <hr>

        <?php
            if(isset($result)){
        ?>
        <div class="alert alert-<?=$result['status']?> bg-<?=$result['status']?> text-white"><?=$result['message']?></div>
        <?php
            }
        ?>

        <div class="btn-group mb-3">
            <a href="?page=<?=$page?>" class="btn btn-primary <?=(!isset($type)?'active':'')?>"><?=_('All Page')?></a>
            <?php
                $pageType = $mysqli->query("SELECT * FROM kb_pages GROUP BY type");
                if($pageType->num_rows > 0){
                    while($pt = $pageType->fetch_assoc()){
            ?>
            <a href="?page=<?=$page?>&action=filter&type=<?=$pt['type']?>" class="btn btn-primary <?=((isset($type) and $type==$pt['type'])?'active':'')?>"><?=mb_convert_case($pt['type'], MB_CASE_TITLE)?></a>
            <?php
                    }
                }
            ?>
        </div>

        <div class="card">
            <h5 class="card-header"><?=$this->pageInfo['title']?> List</h5>
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Page Icon</th>
                            <th scope="col">Page Name</th>
                            <th scope="col">Template</th>
                            <th scope="col">Menu</th>
                            <th scope="col">Events</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $allPages = $this->getPageList($type??'all','type');
                            foreach($allPages as $p){
                        ?>
                        <tr>
                            <th scope="row"><?=$p['id']?></th>
                            <td><i class="<?=$p['iconClass']?>"></i></td>
                            <td><?=$p['title']?></td>
                            <td><?=$p['template']?></td>
                            <td><?=$p['menu']==1?'<div class="text-success">'._('Yes').'</div>':'<div class="text-danger">'._('No').'</div>'?></td>
                            <td>
                                <a href="?page=keybmin-page-operations-page-edit&pageID=<?=$p['id']?>" class="btn btn-primary"><?=_('Edit')?></a>
                                <a href="?page=<?=$page?>&action=del&pageID=<?=$p['id']?>" class="btn btn-danger del-btn"><?=_('Del')?></a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

	</div>
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>