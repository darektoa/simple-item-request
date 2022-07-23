<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\{Stuff, StuffRequest, User};
use Illuminate\Http\Request;

class StuffRequestController extends Controller
{
    public function index() {
        $stuffRequests = StuffRequest::with(['user', 'stuffs'])
            ->paginate(10);

        return view('pages.stuff-request.index', compact('stuffRequests'));
    }


    public function create() {
        $stuffs = Stuff::with(['location'])->get();
        $users  = User::with(['departement'])->get();

        return view('pages.stuff-request.create', compact('stuffs', 'users'));
    }
}
