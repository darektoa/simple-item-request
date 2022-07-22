<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\StuffRequest;
use Illuminate\Http\Request;

class StuffRequestController extends Controller
{
    public function index() {
        $stuffRequests = StuffRequest::with(['user', 'stuffs'])
            ->paginate(10);

        return view('pages.stuff-request.index', compact('stuffRequests'));
    }
}
