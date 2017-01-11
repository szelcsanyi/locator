<?php

/**
 * Simple include file for the library, so it can be used
 * easily with out composer.
 */

// Include the contracts
include 'Source/Contract/Library.php';
include 'Source/Contract/Object.php';
include 'Source/Contract/Instance.php';
include 'Source/Contract/Driver.php';

// Include the exceptions
include 'Source/Exception.php';
include 'Source/Exception/IncompleteLegend.php';
include 'Source/Exception/InvalidDriver.php';
include 'Source/Exception/BadMethodCall.php';
include 'Source/Exception/UndefinedProperty.php';
include 'Source/Exception/UndefinedMapping.php';
include 'Source/Exception/UnresolvedLegend.php';
include 'Source/Exception/InstanceExists.php';
include 'Source/Exception/InstanceDoesNotExist.php';

// Include the drivers
include 'Source/Driver/Simple.php';
include 'Source/Driver/Strict.php';
include 'Source/Driver/Expression.php';
include 'Source/Driver/Domain.php';

// Include the source files
include 'Source/Library.php';
include 'Source/Object.php';
include 'Source/Instance.php';