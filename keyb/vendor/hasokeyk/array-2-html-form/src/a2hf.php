<?php

    namespace a2hf;

	class a2hf{

	    public $postSave = false;

        function __construct($args = []){

            $this->postSave = $args['postSave']??false;

        }

        function createFormElement($elements = [],$echo=true){

		    $text = '';
			foreach($elements as $element){
				if($element['type'] == 'text'){
					$text .= $this->createTextFormElement($element,$echo);
				}else if($element['type'] == 'password'){
                    $text .= $this->createPasswordFormElement($element,$echo);
				}else if($element['type'] == 'checkbox'){
                    $text .= $this->createCheckboxFormElement($element,$echo);
				}else if($element['type'] == 'radio'){
                    $text .= $this->createRadioFormElement($element,$echo);
				}else if($element['type'] == 'select'){
                    $text .= $this->createSelectFormElement($element,$echo);
				}else if($element['type'] == 'textarea'){
                    $text .= $this->createTextareaFormElement($element,$echo);
				}else{
				    $text .= 'Empty';
                }
			}

			if($echo == false){
			    return $text;
            }

		}

		function createTextFormElement($element,$echo=true){

			$name   = $element['name']??$this->convertSlug($element['label'],'_');
            $value  = $this->postSaveControl($element['name'])??($element['value']??'');

			$text = '<div class="form-group">';
            $text .= '<label for="'.($name).'" class="col-form-label '.($element['labelClass']??'').'">'.($element['label']).'</label>';
            $text .= '<input id="'.($name).'" name="'.($name).'" type="text" class="form-control '.($name).' '.($element['inputClass']??'').'" value="'.($value).'" placeholder="'.($element['placeholder']??'').'" required>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function createPasswordFormElement($element,$echo=true){

			$name = $element['name']??$this->convertSlug($element['label'],'_');
            $value  = $this->postSaveControl($element['name'])??($element['value']??'');

			$text = '<div class="form-group">';
            $text .= '<label for="'.($name).'" class="col-form-label '.($element['labelClass']??'').'">'.($element['label']).'</label>';
            $text .= '<input id="'.($name).'" name="'.($name).'" type="password" class="form-control '.($name).' '.($element['inputClass']??'').'" value="'.($value).'" placeholder="'.($element['placeholder']??'').'" required>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function createTextareaFormElement($element,$echo=true){

			$name = $element['name']??$this->convertSlug($element['label'],'_');
            $value  = $this->postSaveControl($element['name'])??($element['value']??'');

			$text = '<div class="form-group">';
            $text .= '<label for="'.($name).'" class="col-form-label '.($element['labelClass'])??''.'">'.($element['label']).'</label>';
            $text .= '<textarea id="'.($name).'" name="'.($name).'" type="text" class="form-control '.($name).' '.($element['inputClass']).'" placeholder="'.($element['placeholder']??'').'" cols="'.($element['cols']??'50').'" rows="'.($element['rows']??'10').'" required>'.($value).'</textarea>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function createRadioFormElement($element,$echo=true){

			$name = $element['name']??$this->convertSlug($element['label'],'_');

			$text = '<div class="custom-control custom-radio">';
            $text .= '<input id="'.($name).'" name="'.($name).'[]" type="radio" value="'.($element['value']).'" class="custom-control-input '.($name).' '.($element['inputClass']).'" required>';
            $text .= '<label for="'.($name).'" class="custom-control-label '.($element['labelClass'])??''.'">'.($element['label']).'</label>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function createCheckboxFormElement($element,$echo=true){

			$name = $element['name']??$this->convertSlug($element['label'],'_');

			$text = '<div class="custom-control custom-checkbox">';
            $text .= '<input id="'.($name).'" name="'.($name).'[]" type="checkbox" value="'.($element['value']).'" class="custom-control-input '.($name).' '.($element['inputClass']).'" required>';
            $text .= '<label for="'.($name).'" class="custom-control-label '.($element['labelClass'])??''.'">'.($element['label']).'</label>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function createSelectFormElement($element,$echo=true){

			$name   = $element['name']??$this->convertSlug($element['label'],'_');
			$text = '<div class="form-group">';
            $text .= '<label for="'.($name).'" class="col-form-label">'.($element['label']).'</label>';
            $text .= '<select class="form-control '.($element['class']??'').'" name="'.($name).'" id="'.($name).'" required '.(implode(' ', $element['param']??[])).'>';

            if(isset($element['data'])){
                foreach($element['data'] as $option){
                    $selected = false;

                    $value  = $option['value']??mb_strtolower($option['text'],'UTF8');

                    if(((isset($option['selected']) and $option['selected']=='true')) and $selected === false){
                        $selected = true;
                    }else if(isset($element['selected']) and $value == $element['selected'] and $selected === false){
                        $selected = true;
                    }else{
                        $selected = false;
                    }

                    $text .= '<option value="'.$value.'" '.($selected==true?'selected':'').'>'.$option['text'].'</option>';
                }
            }else{
                $text .= '<option value="0">Empty [Data] Parameter</option>';
            }

            $text .= '</select>';
            $text .= '</div>';

            return $this->output($text,$echo);

		}

		function output($text=null, $echo=true){

		    if($echo==true){
		        echo $text;
            }else{
		        return $text;
            }

        }
		
		function convertSlug($string, $separator = '-') {
		    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
		    $special_cases = array( '&' => 'and', "'" => '');
		    $string = mb_strtolower( trim( $string ), 'UTF-8' );
		    $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
		    $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
		    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
		    $string = preg_replace("/[$separator]+/u", "$separator", $string);
		    return $string;
		}

		function postSaveControl($post=false){
            if($post != false and $this->postSave == true){
                if(isset($_POST[$post]) and !empty($_POST[$post])){
                    return $_POST[$post];
                }
            }
            return;
        }

        function getSecurity(){
            $degerler = array();
            foreach($_GET as $p => $d){
                if(is_string($_GET[$p]) === true){
                    $degerler[$p] = trim(strip_tags($d));
                }
            }
            return $degerler;
        }

        function postSecurity(){
            $degerler = array();
            foreach($_POST as $p => $d){
                if(is_string($_POST[$p]) === true){
                    $degerler[$p] = trim(strip_tags($d));
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
	
	}