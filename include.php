<?php

/**
 * Simple include file for the library, so it can be used
 * easily with out composer.
 */

// Include the contracts
include 'source/Contract/Library.php';
include 'source/Contract/Object.php';
include 'source/Contract/Instance.php';
include 'source/Contract/Driver.php';

// Include the exceptions
include 'source/Exception.php';
include 'source/Exception/IncompleteLegend.php';
include 'source/Exception/InvalidDriver.php';
include 'source/Exception/BadMethodCall.php';
include 'source/Exception/UndefinedProperty.php';
include 'source/Exception/UndefinedMapping.php';
include 'source/Exception/UnresolvedLegend.php';
include 'source/Exception/InstanceExists.php';
include 'source/Exception/InstanceDoesNotExist.php';

// Include the drivers
include 'source/Driver/Simple.php';
include 'source/Driver/Strict.php';
include 'source/Driver/Expression.php';
include 'source/Driver/Domain.php';

// Include the source files
include 'source/Library.php';
include 'source/Object.php';
include 'source/Instance.php';
