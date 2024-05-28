<?php

namespace Pontifex\Rest\Api\Pagination;

use Pontifex\Rest\Api\IApi;
use Pontifex\Rest\Api\Pagination\Exceptions\IncorrectPageNumberException;
use Pontifex\Rest\Api\Pagination\Exceptions\IncorrectPageSizeException;
use Symfony\Component\HttpFoundation\InputBag;

trait Pagination
{
    /**
     * @throws IncorrectPageNumberException
     * @throws IncorrectPageSizeException
     * @psalm-return array{0:positive-int, 1:positive-int}
     */
    public function extractPaginationParams(
        InputBag $query,
        int $defaultNumber,
        int $defaultSize
    ): array {
        $page = $query->all(IApi::PAGE_PARAM);

        $pageNumber = ($page['number']) ? (int) $page['number'] : $defaultNumber;

        if ($pageNumber <= 0) {
            throw new IncorrectPageNumberException();
        }

        $pageSize = ($page['size']) ? (int) $page['size'] : $defaultSize;

        if ($pageSize <= 0) {
            throw new IncorrectPageSizeException();
        }

        return [$pageNumber, $pageSize];
    }
}
