<?php
/**
 * PluginAppInstaller.php
 *
 * @author  Fernando Pita <fpita111@gmail.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @see     https://github.com/kranemora/plugin-app-installer
 */
namespace Custom\Composer\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

/**
 * Install your CakePHP 3.0+ plugins in plugins folder inside your App
 *
 * La consola Bake de CakePHP genera plugins en la carpeta /plugins del sitio;
 * pero cuando se instalan a través de composer, los aloja en la carpeta /vendor.

 * Este plugin instala cualquier plugin que tenga asignado
 * el tipo "cakephp-app-plugin" en la carpeta /plugins del sitio.
 */
class PluginAppInstaller extends LibraryInstaller
{

    /**
     * Returns the installation path of a package
     *
     * @param PackageInterface $package Composer package
     *
     * @return string
     */
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

    /**
     * Decides if the installer supports the given type.
     *
     * This installer only supports package of type 'cakephp-app-plugin'.
     *
     * @param string $packageType Composer package type
     *
     * @return bool
     */
    public function supports($packageType)
    {
        return 'cakephp-app-plugin' === $packageType;
    }
}
