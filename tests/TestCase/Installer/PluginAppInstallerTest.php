<?php
namespace Custom\Test\Composer\TestCase\Installer;

use Composer\Composer;
use Composer\Config;
use Composer\Package\Package;
use Composer\Repository\RepositoryManager;
use Custom\Composer\Installer\PluginAppInstaller;
use PHPUnit\Framework\TestCase;

class PluginAppInstallerTest extends TestCase
{
    public $installer;

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

    public function tearDown()
    {
        parent::tearDown();
    }

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

    public function testSupports()
    {
        $packageType = 'cakephp-app-plugin';
        $this->assertTrue($this->installer->supports($packageType));

        $packageType = 'cakephp-plugin';
        $this->assertFalse($this->installer->supports($packageType));
    }
}
