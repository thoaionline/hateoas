<?php
/**
 * @copyright 2014 Integ S.A.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Javier Lorenzana <javier.lorenzana@gointegro.com>
 */

namespace GoIntegro\Hateoas\JsonApi\Request;

// HTTP.
use Symfony\Component\HttpFoundation\Request;

class DefaultLocaleNegotiator implements LocaleNegotiatorInterface
{
    /**
     * @param Request $request
     */
    public function negotiate(Request $request)
    {
        return $request->getPreferredLanguage();
    }
}
