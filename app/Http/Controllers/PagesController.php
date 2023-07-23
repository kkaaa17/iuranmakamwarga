<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pagesAdminLte.index1');
    }

    public function index2()
    {
        return view('pagesAdminLte.index2');
    }

    public function index3()
    {
        return view('pagesAdminLte.index3');
    }

    public function datatables()
    {
        return view('pagesAdminLte.datatables');
    }
}
