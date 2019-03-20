<?php

namespace Custom\Composer\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class PluginAppInstaller extends LibraryInstaller
{
    public function getInstallPath(PackageInterface $package)
    {
        $extra = $package->getExtra();
        list(, $name) = explode("/", $package->getPrettyName());
        $name = str_replace(
            ' ',
            '',
            ucwords(str_replace(['-', '_'], [' ', ' '], $name))
        );
        if (empty($extra['vendor'])) {
            return 'plugins' . DIRECTORY_SEPARATOR . $name;
        } else {
            return $extra['vendor'] . DIRECTORY_SEPARATOR . $name;
        }
    }

    public function supports($packageType)
    {
        return 'cakephp-app-plugin' === $packageType;
    }
}
