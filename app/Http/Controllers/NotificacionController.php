<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        /*
        $notifications = "
            SELECT * 
            FROM notifications 
            WHERE notifiable_id = auth()->user()->id
            AND read_at = NULL
        ";
        */ 
        $notificaciones = auth()->user()->unreadNotifications;

        /*
        foreach($notificaciones as $notificacion) {
            $query = "
                UPDATE notifications 
                SET read_at = NOW()  
                WHERE id = $notificacion->id
            ";
            $exec_query = $db->query($query); 
        }
        */ 
        // auth()->user()->unreadNotifications->markAsRead();

        return view("notificaciones.index", [
            "notificaciones" => $notificaciones
        ]);
    }
}