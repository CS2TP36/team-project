<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressStorage extends Controller
{
    function showEdit() {
        return view('pages.Edit-Address');
    }
    function showAdd() {
        return view('pages.newaddresspage');
    }
}
