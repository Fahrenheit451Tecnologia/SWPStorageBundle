<?php

/**
 * This file is part of the Superdesk Web Publisher Storage Bundle.
 *
 * Copyright 2016 Sourcefabric z.ú. and contributors.
 *
 * For the full copyright and license information, please see the
 * AUTHORS and LICENSE files distributed with this source code.
 *
 * @copyright 2016 Sourcefabric z.ú.
 * @license http://www.superdesk.org/license
 */
namespace spec\SWP\Bundle\StorageBundle\DependencyInjection\Driver;

use PhpSpec\ObjectBehavior;
use SWP\Bundle\StorageBundle\DependencyInjection\Driver\ORMDriver;
use SWP\Component\Storage\DependencyInjection\Driver\PersistenceDriverInterface;
use Symfony\Component\DependencyInjection\Parameter;

/**
 * @mixin ORMDriver
 */
class ORMDriverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ORMDriver::class);
    }

    function it_implements_driver_interface()
    {
        $this->shouldImplement(PersistenceDriverInterface::class);
    }

    function it_returns_object_manager_service_name()
    {
        $this->getObjectManagerId()->shouldReturn('doctrine.orm.default_entity_manager');
    }

    function it_returns_class_metadata_name()
    {
        $this->getClassMetadataClassName()->shouldReturn('\\Doctrine\\ORM\\Mapping\\ClassMetadata');
    }

    function it_returns_repository_class_parameter()
    {
        $this->getDriverRepositoryParameter()->shouldHaveParameterName('swp.orm.repository.class');
    }

    function it_is_supported()
    {
        $this->isSupported(ORMDriver::$type)->shouldReturn(true);
    }

    function it_is_not_supported()
    {
        $this->isSupported('fake')->shouldReturn(false);
    }

    public function getMatchers()
    {
        return [
            'haveParameterName' => function(Parameter $parameter, $expectedName) {
                return (string) $parameter === $expectedName;
            }
        ];
    }
}