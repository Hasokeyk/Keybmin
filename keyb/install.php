<?php

    use keybmin_install\keybmin_install;


    use a2hf\a2hf;
    $a2hf = new a2hf([
        'postSave' => true
    ]);

    $_SESSION['siteDIR'] = $_SERVER['REQUEST_URI'];

    $post = $a2hf->postSecurity();
    extract($post);

    if($post){
        $require = $a2hf->postControl(['host','databaseName','username','password']);
        if($require === true){

            try {

                $keybminIns = new keybmin_install($host,$username,$password,$databaseName,$dbtype);

                $install = $keybminIns->install(KEYB.'library/sql/'.$dbtype.'.sql');

                if($install){

                    $vars = [
                        '-{LOCALHOST}-' => $host,
                        '-{USERNAME}-' => $username,
                        '-{PASSWORD}-' => $password,
                        '-{DATABASE}-' => $databaseName,
                        '-{DATABASETYPE}-' => $dbtype
                    ];

                    $configFilePath = ROOT.'/48186.php';
                    $configFile = file_get_contents($configFilePath);
                    foreach ($vars as $v => $d){
                        $configFile = str_replace($v,$d,$configFile);
                    }
                    file_put_contents($configFilePath,$configFile);
                    file_put_contents(KEYB.'lock.keybmin','true');

                    $log = 'Keybmin installed';
                }else{
                    $log = 'Keybmin not installed';
                }

                $result = [
                    'status' => $install==true?'success':'danger',
                    'message' => $log,
                ];

            }catch (Exception $err){
                $result = json_decode($err->getMessage(),true);
            }

        }else{
            echo $require;
        }
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Keybmin - Install</title>

    <!-- Bootstrap core CSS -->
    <link href="/keyb/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <meta name="theme-color" content="#007fff">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
</head>
<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Keybmin - Install</h2>
        </div>

        <div class="row">
            <div class="col-md-6 m-auto">
                <h4 class="mb-3 text-center">Database Information</h4>

                <?php
                    if(isset($result)){
                ?>
                <div class="alert alert-<?=$result['status']?>"><?=$result['message']?></div>
                <?php
                    }
                ?>

                <?php
                    if(isset($result['status']) and $result['status']=='success'){
                        header('Location:'.$_SERVER['REQUEST_URI']);
                    }else{
                ?>
                    <form action="" method="post">

                        <input type="hidden" name="post" value="true">

                        <div class="row">

                            <div class="col-lg-12">
                                <?php
                                $a2hf->createFormElement([
                                    [
                                        'type' => 'select',
                                        'name' => 'dbtype',
                                        'label' => 'Database Type',
                                        'placeholder' => 'ÖRN: localhost',
                                        'data' => [
                                            [
                                                'text' => 'Mysql/MariaDB',
                                                'value' => 'mysqli',
                                            ],
                                            [
                                                'text' => 'PostgreSQL',
                                                'value' => 'postgresql',
                                            ]
                                        ]
                                    ]
                                ])
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                $a2hf->createFormElement([
                                    [
                                        'type' => 'text',
                                        'name' => 'host',
                                        'label' => 'Host',
                                        'value' => 'localhost',
                                        'placeholder' => 'localhost or IP'
                                    ]
                                ])
                                ?>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                $a2hf->createFormElement([
                                    [
                                        'type' => 'text',
                                        'name' => 'port',
                                        'label' => 'Port',
                                        'placeholder' => 'Mysql : 3306 | Postgresql : 5432'
                                    ]
                                ])
                                ?>
                            </div>
                            <div class="col-lg-12">
                                <?php
                                $a2hf->createFormElement([
                                    [
                                        'type' => 'text',
                                        'name' => 'username',
                                        'label' => 'Username',
                                        'placeholder' => 'root'
                                    ],
                                    [
                                        'type' => 'password',
                                        'name' => 'password',
                                        'label' => 'Password',
                                        'placeholder' => 'Password'
                                    ],
                                    [
                                        'type' => 'text',
                                        'name' => 'databaseName',
                                        'label' => 'Database Name',
                                        'placeholder' => 'keybmin'
                                    ]
                                ])
                                ?>
                            </div>

                        </div>

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">INSTALL</button>
                    </form>
                <?php
                    }
                ?>


            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; Keybmin</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="//hayatikodla.net">Hasan Yüksektepe</a></li>
            </ul>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/keyb/assets/js/bootstrap/bootstrap.bundle.js"></script>

</body>
</html>
