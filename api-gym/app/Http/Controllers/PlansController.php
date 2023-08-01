<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlansRequest;
use App\Services\PlansServices\CreatePlansService;

class PlansController extends Controller {
    public function create(CreatePlansRequest $req){
        $createPlansService = new CreatePlansService();
        return $createPlansService->execute($req->all());
    }
}
