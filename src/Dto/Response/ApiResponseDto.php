<?php

namespace App\Dto\Response;

class ApiResponseDto
{
    private string $message;

    private object $data;

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): ApiResponseDto
    {
        $this->message = $message;
        return $this;
    }

    public function getData(): object
    {
        return $this->data;
    }

    public function setData(object $data): ApiResponseDto
    {
        $this->data = $data;
        return $this;
    }


}