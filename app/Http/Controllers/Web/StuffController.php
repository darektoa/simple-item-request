<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Stuff;
use Illuminate\Http\Request;

class StuffController extends Controller
{
    public function index() {
        $stuffs = Stuff::with(['location'])->paginate(5);

        return view('pages.stuff.index', compact('stuffs'));
    }
}
