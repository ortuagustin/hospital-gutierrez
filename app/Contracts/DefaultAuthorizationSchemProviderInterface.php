<?php

namespace App\Contracts;

/**
 * Generates the default authorization schema for the application;
 * that is, it can create all the required Roles, Permissions and grant access to
 * each role accordingly
 */
interface DefaultAuthorizationSchemProviderInterface
{
    /**
     * Clears all Roles and Permissions
     * Creates the default set of Roles
     * Creates the default set of Permissions
     * Creates the default Role-Permission schema
     */
    public function resetToDefault();

    /**
     * Creates the default Roles for the system, only if they dont exist
     */
    public function createDefaultRoles();

    /**
     * Creates the default Permissions for the system, only if they dont exist
     */
    public function createDefaultPermissions();
}
