<?php

declare(strict_types=1);

namespace App\Validators;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ActivityValidator
{
    private ValidatorInterface $validator;

    final public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    final public static function validate(): self
    {
        return new self();
    }

    final public function store(array $input): void
    {
        $constraint = new Assert\Collection([
            'title' => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\NotNull(),
            ]),
            'email' => new Assert\Optional([
                new Assert\Email(),
            ]),
        ], missingFieldsMessage: '{{ field }} cannot be null');

        $violations = $this->validator->validate($input, $constraint);

        if ($violations->count() > 0) {
            throw new BadRequestHttpException((string) $violations->get(0)->getMessage());
        }
    }

    final public function update(array $input): void
    {
        $constraint = new Assert\Collection([
            'title' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\NotNull(),
            ]),
            'email' => new Assert\Optional([
                new Assert\Email(),
            ]),
        ], missingFieldsMessage: '{{ field }} cannot be null');

        $violations = $this->validator->validate($input, $constraint);

        if ($violations->count() > 0) {
            throw new BadRequestHttpException((string) $violations->get(0)->getMessage());
        }
    }
}
