<?php
/**
 * PluginAppInstallerTest.php
 *
 * @author  Fernando Pita <fpita111@gmail.com>
 * @license https://opensource.org/licenses/mit-license.php MIT License
 * @see     https://github.com/kranemora/plugin-app-installer
 */
namespace Custom\Test\Composer\TestCase\Installer;

use Composer\Composer;
use Composer\Config;
use Composer\Package\Package;
use Composer\Repository\RepositoryManager;
use Custom\Composer\Installer\PluginAppInstaller;
use PHPUnit\Framework\TestCase;

/**
 * PluginAppInstaller test case
 */
class PluginAppInstallerTest extends TestCase
{

    /**
     * PluginAppInstaller instance
     *
     * @var \Custom\Composer\Installer\PluginAppInstaller
     */
    public $installer;

    /**
     * Sets up the test case.
     * This method is called before the tests
     * of this test suite are run.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $composer = new Composer();
        $config = new Config();

        $composer->setConfig($config);
        $io = $this->getMockBuilder('Composer\IO\IOInterface')->getMock();

        $rm = new RepositoryManager(
            $io,
            $config
        );

        $composer->setRepositoryManager($rm);

        $this->installer = new PluginAppInstaller($io, $composer);
    }

    /**
     * Tears down any static object changes and restore them.
     * This method is called after the tests
     * of this test suite have finished running.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test getInstallPath method
     *
     * @return void
     */
    public function testGetInstallPath()
    {
        $package = new Package('my-brand-name/my-project', '1.0', '1.0');
        $package->setType('cakephp-app-plugin');
        $installPath = $this->installer->getInstallPath($package);
        $this->assertEquals('plugins/MyProject', $installPath);

        $package->setExtra(['vendor' => 'myFolder']);
        $installPath = $this->installer->getInstallPath($package);
        $this->assertEquals('myFolder/MyProject', $installPath);
    }

    /**
     * Test supports method
     *
     * @return void
     */
    public function testSupports()
    {
        $packageType = 'cakephp-app-plugin';
        $this->assertTrue($this->installer->supports($packageType));

        $packageType = 'cakephp-plugin';
        $this->assertFalse($this->installer->supports($packageType));
    }
}
