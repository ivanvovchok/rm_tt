<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Lang;
use App\DTO\LoginData;
use App\DTO\RegisterData;
use App\Repositories\UserRepository;
use App\Validation\Validator;

readonly class AuthService
{
    public function __construct(
        private UserRepository $repository = new UserRepository(),
        private Validator      $validator = new Validator()
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function validateRegistration(RegisterData $data): array
    {
        $errors = [];

        if ($data->firstName === '') {
            $errors[] = Lang::get('first_name_required');
        }
        if ($data->lastName === '') {
            $errors[] = Lang::get('last_name_required');
        }

        if ($msg = $this->validator->validateEmail($data->email)) {
            $errors[] = $msg;
        }

        if ($this->repository->existsByEmail($data->email)) {
            $errors[] = Lang::get('email_already_exists');
        }

        if ($msg = $this->validator->validatePhone($data->phone)) {
            $errors[] = $msg;
        }

        if ($msg = $this->validator->validatePassword($data->password)) {
            $errors[] = $msg;
        }

        return $errors;
    }

    public function register(RegisterData $data): void
    {
        $this->repository->create([
            'first_name' => $data->firstName,
            'last_name'  => $data->lastName,
            'email'      => $data->email,
            'phone'      => $data->phone,
            'password'   => $data->password,
        ]);
    }

    /**
     * @return array<int, string>
     */
    public function login(LoginData $data): array
    {
        $errors = [];

        if ($msg = $this->validator->validateEmail($data->email)) {
            $errors[] = $msg;
        }

        if ($msg = $this->validator->validatePassword($data->password)) {
            $errors[] = $msg;
        }

        if (!empty($errors)) {
            return $errors;
        }

        $user = $this->repository->findByEmail($data->email);

        if (!$user || !password_verify($data->password, $user->password)) {
            return [Lang::get('invalid_credentials')];
        }

        $_SESSION['user_id']   = $user->id;
        $_SESSION['user_name'] = $user->first_name;

        return [];
    }
}
