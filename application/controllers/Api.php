<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get('id');

        if ($id === null) {
            // Check if the users data store contains users
            if ($users) {
                // Set the response and exit
                $this->response([
                    'status' => true,
                    'message' => 'data found.',
                    'data' => $users
                ], RestController::HTTP_OK);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'no users were found'
                ], RestController::HTTP_BAD_REQUEST);
            }
        } else {
            if (array_key_exists($id, $users)) {
                $this->response([
                    'status' => true,
                    'message' => 'data found.',
                    'data' => $users[$id]
                ], RestController::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'no such user found'
                ], RestController::HTTP_BAD_REQUEST);
            }
        }
    }
}
