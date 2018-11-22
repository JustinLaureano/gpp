<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Functions {
    public function check_access_rights()
    {   
        if (isset($_SESSION['userid']) && isset($_SESSION['userrights'])) {
            switch ($_SESSION['userrights']) {
                case $_SESSION['userrights'] == 'administrator':
                    return 'administrator';
                    break;
                case $_SESSION['userrights'] == 'user':
                    return 'user';
                    break;
                case $_SESSION['userrights'] == 'candidate':
                    return 'candidate';
                    break;
                default:
                    return false;
            }
        }
        else {
            return false;
        }
    }

    public function format_date($date_str, $format)
    {  
        switch($format) {
            case 'Y-m-d':
                $date = preg_replace('/\D/', '', $date_str);
                $formatted_date = substr($date, 0, 4) . '-' . substr($date, 4, 2) . '-' . substr($date, 6, 2);
                break;
            default:
                $formatted_date = $date_str;
        }
        return $formatted_date;
    }

    public function format_phone($phone)
    {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
    }
}