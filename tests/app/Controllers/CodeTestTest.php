<?php

namespace Tests\app\Controllers;

use CodeIgniter\I18n\Time;
use CodeIgniter\Test\FeatureTestTrait;
use Tests\Support\Database\DatabaseTestCase;

class CodeTestTest extends DatabaseTestCase
{
    use FeatureTestTrait;
//    use FeatureTestTrait;


    public function testCanViewContactView()
    {
        $response = $this->call('get', '/');
        $response->assertStatus(200);
        $response->assertSee('Contact Us');
    }

    public function testCanViewContactListTable()
    {
        $response = $this->call('get', 'en/contact-list');
        $response->assertStatus(200);
        $response->assertSee('Contact List');
    }

    public function testAddContact()
    {
        $newContact = [
            'name' => 'foo',
            'phone' => '22222222222',
            'ctype' => 'Contact Type 1',
            'bday' => Time::now(),
            'description' => 'foo bar'
        ];
        $response = $this->post('/add', $newContact);

        $newContact['id_ctype'] = $newContact['ctype'];
        unset($newContact['ctype']);
        unset($newContact['description']);
        
        $this->seeInDatabase('contact', $newContact);

        $response->assertJSONFragment(['status' => 'Contact inserted Successfully']);
        $response->assertStatus(200);
    }

    public function testGetAllContacts()
    {
        $contact1 = fake(\App\Models\Contact::class,null,true);
        $contact2 = fake(\App\Models\Contact::class,null,true);
        $contact3 = fake(\App\Models\Contact::class,null,true);

        $response = $this->get('/contacts');

        $response->assertJSONExact(['contact' => [$contact1,$contact2,$contact3]]);
    }

    public function testCanEditContact()
    {
        db_connect()->table('contact')->truncate();

        $contact = fake(\App\Models\Contact::class,null,true);

        $this->seeInDatabase('contact',[
            'id' => $contact['id']
        ]);

        $response = $this->post('/edit', [
            'contact_id' => $contact['id']
        ]);

        $response->assertJSONExact(['contact' => $contact]);
    }

    public function testCanUpdateContact()
    {
        db_connect()->table('contact')->truncate();

        $contact = fake(\App\Models\Contact::class,null,true);

        $this->seeInDatabase('contact', $contact);

        $newData = [
            'contact_id' => $contact['id'],
            'name' => 'foo',
            'phone' => '22222222222222',
            'ctype' => 'Contact Type 1',
            'bday' => Time::now()->subYears(20)->format('Y-m-d H:i:s')
        ];

        $response = $this->post('/update', $newData);

        $newData['id'] = $newData['contact_id'];
        unset($newData['contact_id']);
        $newData['id_ctype'] = $newData['ctype'];
        unset($newData['ctype']);

        $this->seeInDatabase('contact', $newData);
        $response->assertJSONExact(['status' => 'Update Successfully!']);
        $response->assertStatus(200);
    }

    public function testCanDeleteContact()
    {
        $contact = fake(\App\Models\Contact::class,null,true);

        $this->seeInDatabase('contact', $contact);

        $response = $this->post('/delete', [
            'contact_id' => $contact['id']
        ]);

        $this->dontSeeInDatabase('contact', [
            'id' => $contact['id']
        ]);
        $response->assertStatus(200);
    }

}
