<?php

namespace App\Http\Controllers;
use App\Data\ProjectDto;
use App\Data\TaskDto;
use App\Repositories\Contracts\AdvertRepository;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Контроллер для кошек
 *
 * Class CatsController
 *
 * @package App\Http\Controllers\Objects
 */
class MainController extends Controller
{


    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Auth::user();
    }





}
