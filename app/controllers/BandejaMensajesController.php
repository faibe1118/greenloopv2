<?php

class BandejaMensajesController extends Controller {

    public function index() {
        $this->view('bandejaMensajes/index',[]);
    }
}