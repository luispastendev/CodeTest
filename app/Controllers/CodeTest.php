<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Contact;

class CodeTest extends BaseController
{
    public function index()
    {
        return view(
            'contactView/contact',
            ['locale' => $this->request->getLocale()]
        );
    }

    public function add()
    {
        $contact = new Contact();
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'id_ctype' => $this->request->getPost('ctype'), // ctype o idctype??
            'bday' => $this->request->getPost('bday'),
//            'description' => $this->request->getPost('description') // ?? no en la misma tabla
        ];

        $contact->save($data);
        $data = ['status' => 'Contact inserted Successfully'];
        return $this->response->setJSON($data);
    }

    public function tableForm()
    {
        return view('contactView/contactList', ['locale' => $this->request->getLocale()]);
    }

    public function fetch()
    {
        $table = new Contact();
        $data['contact'] =  $table->findAll();
        return $this->response->setJSON($data);
    }

    public function edit()
    {
        $table = new Contact();
        $contact_id = $this->request->getPost('contact_id');
        $data['contact'] = $table->find($contact_id);
        return $this->response->setJSON($data);
    }

    public function update()
    {
        $table = new Contact();
        $contact_id = $this->request->getPost('contact_id');
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'id_ctype' => $this->request->getPost('ctype'), // id_ctype
            'bday' => $this->request->getPost('bday'),
        ];
        $table->update($contact_id, $data);
        $message = ['status' => 'Update Successfully!'];
        return $this->response->setJSON($message);
    }

    public function delete()
    {
        $table = new Contact();
        $table->delete($this->request->getPost('contact_id'));
        $message = ['status' => 'Delete Successfully!'];
        return $this->response->setJSON($message);
    }
}