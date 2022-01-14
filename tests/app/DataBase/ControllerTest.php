<?php

namespace CodeIgniter;

use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class ControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait, DatabaseTestTrait;

    public function testIndex()
    {
        $result = $this->withURI('http://localhost/TestCode/fr-FR/contact-us')
            ->controller(\App\Controllers\CodeTest::class)
            ->execute('index');

        $this->assertTrue($result->isOK());
    }
    public function testTableForm()
    {
        $result = $this->withURI('http://localhost/TestCode/fr-FR/contact-list')
            ->controller(\App\Controllers\CodeTest::class)
            ->execute('tableForm');

        $this->assertTrue($result->isOK());
    }
}
