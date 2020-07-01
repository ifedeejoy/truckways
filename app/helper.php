<?php
    function setActive($path, $active = 'active') {
        return call_user_func_array('Request::is', (array)$path) ? $active : '';
    }

    function formatPhone($numbers)
    {
        if(is_array($numbers)):
            $phone = array();
            $numbers = array_shift($numbers);
            foreach($numbers as $number):
                $lead = substr($number, 0, 1);
                if($lead == 0):
                    $num = substr($number, 1);
                    $phone[] = '+234'.$num;
                elseif(substr($number, 0, 3) == '234'):
                    $num = substr($number, 3);
                    $phone[] = '+234'.$num;
                endif;
            endforeach;
            return implode(', ', $phone);
        else:
            $lead = substr($numbers, 0, 1);
            if($lead == 0):
                $num = substr($numbers, 1);
                $phone = '+234'.$num;
            elseif(substr($numbers, 0, 3) == '234'):
                $num = substr($numbers, 3);
                $phone = '+234'.$num;
            endif;
            return $phone;
        endif;
    }