<?php 

namespace App\Http\Controllers;

use DateTime;

class AgeController extends Controller
{
    public function age($birthday)
    {
        $birthday = date('Y-m-d', strtotime($birthday));

        $birthday = new DateTime($birthday);
        $dateNow = new DateTime("today");

        $y = $dateNow->diff($birthday)->y;
        $m = $dateNow->diff($birthday)->m;
        $d = $dateNow->diff($birthday)->d;

        return response()->json([
            'year_of_birth'  => $y,
            'month_of_birth' => $m,
            'day_of_birth'   => $d,
        ]);
    }

    public function gageAge($birthday)
    {
        $birthday = date('Y-m-d', strtotime($birthday));

        $birthday = new DateTime($birthday);
        $dateNow = new DateTime("today");

        $y = $dateNow->diff($birthday)->y;
        
        if ($y % 2 == 0) {
            $number  = true;
            $message = 'Your age is even';
        } else {
            $number  = false;
            $message = 'Your age is odd';
        }

        return response()->json([
            'number'  => $number,
            'message' => $message
        ]);
    }
}
