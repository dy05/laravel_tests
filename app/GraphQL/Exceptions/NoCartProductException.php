<?php

namespace App\GraphQL\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class NoCartProductException extends Exception implements RendersErrorsExtensions
{
    public function __construct()
    {
        parent::__construct('No products found in the cart.');
    }

    /**
     * @return true
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return 'custom';
    }

    /**
     * @return array
     */
    public function extensionsContent(): array
    {
        return [];
    }
}
