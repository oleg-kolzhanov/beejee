<?php declare(strict_types=1);

namespace App\Controllers;

use App\Dto\RequestTransformer;

/**
 * Controller.
 */
class ApiController extends Controller
{
    private RequestTransformer $requestTransformer;

    public function __construct(RequestTransformer $requestTransformer)
    {
        $this->requestTransformer = $requestTransformer;

        parent::__construct();
    }

    public function index(): string
    {

        if (isset($_POST)) {
            $requestDto =  $this->requestTransformer->transform($_POST);
        }

        $data = [
            "draw" => 1,
            "recordsTotal" => 57,
            "recordsFiltered" => 57,
            "data" => [
                [
                    "Airi",
                    "Satou",
                    "Accountant",
                ],
                [
                    "Angelica",
                    "Ramos",
                    "Chief Executive Officer (CEO)",
                ],
                [
                    "Ashton",
                    "Cox",
                    "Junior Technical Author",
                ],
            ]
        ];

        return $this->resource($data);
    }
}