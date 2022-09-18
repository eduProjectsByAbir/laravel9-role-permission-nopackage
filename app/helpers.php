<?php

use Brian2694\Toastr\Facades\Toastr;

function TosterMessage($msg, $type, $position = "toast-top-right")
{
    switch ($type) {
        case 'Success':
            Toastr::success($msg, $type, ["positionClass" => $position]);
            break;
        case 'Error':
            Toastr::error($msg, $type, ["positionClass" => $position]);
            break;
        case 'Warning':
            Toastr::Warning($msg, $type, ["positionClass" => $position]);
            break;
        default:
            Toastr::success($msg, $type, ["positionClass" => $position]);
    }
}
