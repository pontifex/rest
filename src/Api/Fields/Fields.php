<?php

namespace Pontifex\Rest\Api\Fields;

use Pontifex\Rest\Api\Fields\Exceptions\IncorrectFieldException;
use Pontifex\Rest\Api\Fields\Exceptions\NoFieldsException;
use Pontifex\Rest\Api\IApi;
use Symfony\Component\HttpFoundation\InputBag;

trait Fields
{
    /**
     * @throws IncorrectFieldException
     * @throws NoFieldsException
     */
    public function getFields(
        InputBag $query,
        string $type,
        array $allowedFieldsForType
    ): array {
        $inputFieldsForType = ($query->has($type))
            ? explode(IApi::FIELDS_SEPARATOR, $query->get($type))
            : [];

        return [
            $type => $this->match($inputFieldsForType, $allowedFieldsForType),
        ];
    }

    /**
     * @throws IncorrectFieldException
     * @throws NoFieldsException
     */
    private function match(array $inputFields, array $allowedFields): array
    {
        $match = [];

        foreach ($inputFields as $field) {
            if ('' === $field) {
                throw new IncorrectFieldException('Incorrect field: [empty field]');
            }

            if (! in_array($field, $allowedFields)) {
                throw new IncorrectFieldException(sprintf('Incorrect field: %s', $field));
            }

            $match[] = $field;
        }

        if (! count($match)) {
            throw new NoFieldsException();
        }

        return $match;
    }
}
