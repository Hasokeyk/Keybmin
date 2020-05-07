<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Array 2 Html Form  - Inputs</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>
<body>

<section class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Array 2 Html Form  - Inputs</h1>
            <form action="" method="post">
                <?php

                    require "../src/a2hf.php";

                    use a2hf\a2hf;

                    $a2hf = new a2hf();

                    $input = $a2hf->createTextFormElement([
                        'name' => 'text',
                        'label' => 'Your Name',
                        'value' => 'Hasan Yüksektepe',
                        'placeholder' => 'ÖRN: Hasan Yüksektepe',
                        'labelClass' => 'text-center w-100',
                        'inputClass' => 'text-success',
                    ],true);

                    $input = $a2hf->createTextareaFormElement([
                        'name' => 'textarea',
                        'label' => 'Address',
                        'value' => 'Hasan Yüksektepe',
                        'placeholder' => 'ÖRN: Hasan Yüksektepe',
                        'cols' => '30',
                        'rows' => '5',
                        'labelClass' => 'text-center w-100',
                        'inputClass' => 'text-primary',
                    ],true);

                    $input = $a2hf->createRadioFormElement([
                        'name' => 'contract',
                        'label' => 'Contract',
                        'value' => 'Hasan Yüksektepe',
                        'cols' => '30',
                        'rows' => '5',
                        'labelClass' => 'text-danger',
                        'inputClass' => 'text-primary',
                    ],true);

                    $input = $a2hf->createCheckboxFormElement([
                        'name' => 'rememberme',
                        'label' => 'Remember Me',
                        'value' => 'Hasan Yüksektepe',
                        'cols' => '30',
                        'rows' => '5',
                        'labelClass' => 'text-info',
                        'inputClass' => 'text-primary',
                    ],true);

                    $input = $a2hf->createSelectFormElement([
                        'name' => 'selected-value',
                        'label' => 'Selected Value',
                        'cols' => '30',
                        'rows' => '5',
                        'labelClass' => 'text-info',
                        'inputClass' => 'text-primary',
                        'data' => [
                            [
                                'text' => 'Select 1',
                                'value' => 'select-1',
                            ],
                            [
                                'text' => 'Select 2',
                                'value' => 'select-2',
                            ],
                            [
                                'text' => 'Select 3',
                                'value' => 'select-3',
                            ],
                        ],
                        'selected' => 'select-2'
                    ],true);

                    $input = $a2hf->createSelectFormElement([
                        'name' => 'select-option',
                        'label' => 'Selected Option',
                        'value' => 'Hasan Yüksektepe',
                        'placeholder' => 'ÖRN: Hasan Yüksektepe',
                        'cols' => '30',
                        'rows' => '5',
                        'labelClass' => 'text-info',
                        'inputClass' => 'text-primary',
                        'data' => [
                            [
                                'text' => 'Select 1',
                                'value' => 'select-1',
                            ],
                            [
                                'text' => 'Select 2',
                                'value' => 'select-2',
                            ],
                            [
                                'text' => 'Select 3',
                                'value' => 'select-3',
                                'selected' => true
                            ],
                        ],
                    ],true);

                ?>
            </form>
        </div>
    </div>
</section>
</body>
</html>
