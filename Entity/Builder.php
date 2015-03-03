<?php
/**
 * @copyright 2014 Integ S.A.
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author Javier Lorenzana <javier.lorenzana@gointegro.com>
 */

namespace GoIntegro\Hateoas\Entity;

// JSON-API.
use GoIntegro\Hateoas\JsonApi\Request\Params;

class Builder
{
    const DEFAULT_BUILDER = 'default',
        DUPLICATED_BUILDER = "A builder for the resource type \"%s\" is already registered.";

    /**
     * @var array
     */
    private $builders = [];

    /**
     * @param Params $params
     * @param array $fields
     * @param array $relationships
     * @param array $metadata
     * @return \GoIntegro\Hateoas\JsonApi\ResourceEntityInterface
     */
    public function create(
        Params $params,
        array $fields,
        array $relationships = [],
        array $metadata = []
    )
    {
        return isset($this->builders[$params->primaryType])
            ? $this->builders[$params->primaryType]
                ->create(
                    $params->primaryClass, $fields, $relationships, $metadata
                )
            : $this->builders[self::DEFAULT_BUILDER]
                ->create(
                    $params->primaryClass, $fields, $relationships, $metadata
                );
    }

    /**
     * @param BuilderInterface
     */
    public function addBuilder(GenericBuilderInterface $builder, $resourceType)
    {
        if (isset($this->builders[$resourceType])) {
            $message = sprintf(self::DUPLICATED_BUILDER, $resourceType);
            throw new \ErrorException($message);
        }

        $this->builders[$resourceType] = $builder;

        return $this;
    }
}
