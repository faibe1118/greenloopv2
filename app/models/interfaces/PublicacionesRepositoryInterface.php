<?php

interface PublicacionesRepositoryInterface{
    public function guardarPublicacion($data);
    public function obtenerPublicacionporid($idPublicacion);
    public function obtenerPublicaciones();
    public function obtenerPublicacionesPendientes();
    public function obtenerPublicacionesAprobadas();
    public function obtenerPublicacionesPorMaterial($nombreMaterial);
    public function obtenerPublicacionesPorPrecio($minimo, $maximo);
    public function obtenerPublicacionesPorUbicacion($Ubicacion);
    public function actualizarPublicacion($idPublicacion, $data);  // Actualiza una publicación
    public function obtenerPublicacionesPorUsuario($idUsuario); 
}