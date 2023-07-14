<?php declare(strict_types=1);

namespace App\Controllers;

/**
 * Controller.
 */
class ApiController extends Controller
{
    public function index(): string
    {
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