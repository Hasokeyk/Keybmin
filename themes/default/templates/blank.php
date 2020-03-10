<?php

	$fileName = pathinfo((__FILE__))['filename'];

	$csses = [
	];

	require $this->settings['THEMEDIR']."/header.php";
	require $this->settings['THEMEDIR']."/sidebar.php";
?>
	<div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section-block" id="basicform">
                        <h3 class="section-title"><?=$this->pageInfo['title']?></h3>
                        <p><?=$this->pageInfo['description']?></p>
                    </div>

                    <!--CONTENT-->
                    <!--CONTENT-->

                </div>
            </div>

		</div>
	</div>
	<!-- ============================================================== -->
	<!-- end wrapper  -->
	<!-- ============================================================== -->
<?php
	require $this->settings['THEMEDIR']."/footer.php";
?>