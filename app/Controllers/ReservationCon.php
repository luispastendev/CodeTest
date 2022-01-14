<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Reservation;

class ReservationCon extends BaseController
{
    public function index()
    {

        return view(
            'reservationView/reservation',
            ['locale' => $this->request->getLocale()]
        );
    }


    public function new()
    {
        $reservation = new Reservation();
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'rtype' => $this->request->getPost('rtype'),
            'rdate' => $this->request->getPost('rdate'),
            'description' => $this->request->getPost('description')
        ];
        $reservation->save($data);
        $data = ['status' => 'Reservation created Ok'];
        return $this->response->setJSON($data);
    }

    public function tableForm()
    {
        return view('reservationView/reservationList', ['locale' => $this->request->getLocale()]);
    }
    public function fetch()
    {
        $table = new Reservation();
        $data['reservation'] =  $table->findAll();
        return $this->response->setJSON($data);
    }

    public function modif()
    {
        $table = new Reservation();
        $reservation_id = $this->request->getPost('reservation_id');
        $data['reservation'] = $table->find($reservation_id);
        return $this->response->setJSON($data);
    }

    public function saveChange()
    {
        $table = new Reservation();
        $reservation_id = $this->request->getPost('reservation_id');
        $data = [
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'rtype' => $this->request->getPost('rtype'),
            'rdate' => $this->request->getPost('rdate'),
            'description' => $this->request->getPost('description'),
        ];
        $table->update($reservation_id, $data);
        $message = ['status' => 'Update Successfully!'];
        return $this->response->setJSON($message);
    }

    public function erase()
    {
        $table = new Reservation();
        $table->delete($this->request->getPost('reservation_id'));
        $message = ['status' => 'Delete Successfully!'];
        return $this->response->setJSON($message);
    }
}
