<?php

namespace Pontifex\Rest\Api\Pagination;

use Pontifex\Rest\Api\Pagination\Exceptions\IncorrectPageNumberException;
use Pontifex\Rest\Api\Pagination\Exceptions\IncorrectPageSizeException;

trait Pagination
{
    /**
     * @throws IncorrectPageNumberException
     * @throws IncorrectPageSizeException
     */
    public function extractPaginationParams(
        array $pageArr,
        int $defaultNumber,
        int $defaultSize
    ): array {
        $pageNumber = (isset($pageArr['number']))
            ? (int) $pageArr['number']
            : $defaultNumber;

        if ($pageNumber <= 0) {
            throw new IncorrectPageNumberException();
        }

        $pageSize = (isset($pageArr['size']))
            ? (int) $pageArr['size']
            : $defaultSize;

        if ($pageSize <= 0) {
            throw new IncorrectPageSizeException();
        }

        return [$pageNumber, $pageSize];
    }
}
