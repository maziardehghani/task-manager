<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Testing\TestResponse;

trait TestTools
{
    public string $token = '';
    public string $user = 'maziar@gmail.com';

    public function login(): void
    {
        $user = User::query()->where('email', $this->user)->first();

        $this->token = $user->createToken('test-token')->plainTextToken;
    }

    protected function getData(string $url): TestResponse
    {
        $this->login();
        return $this->withHeaders(
            [
                "Accept" => "application/json",
                "Authorization" => 'Bearer ' . $this->token

            ]
        )->getJson($url);
    }

    protected function postData(string $url, array $data): TestResponse
    {
        $this->login();
        return $this->withHeaders(
            [
                "Accept" => "application/json",
                "Authorization" => 'Bearer ' . $this->token

            ]
        )->postJson($url, $data);
    }

    protected function deleteData(string $url): TestResponse
    {
        $this->login();

        return $this->withHeaders([

            "Accept" => "application/json",
            "Authorization" => 'Bearer ' . $this->token

        ])->deleteJson($url);
    }

}
