<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * @file app\Notifications\NuevoCandidato.php
 * @param  int $id_vacante vacantes.id
 * @param  string $nombre_vacante vacantes.titulo
 * @param  int $usuario_id users.id (users.rol=1, es decir, rol dev)
 */
class NuevoCandidato extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($id_vacante, $nombre_vacante, $usuario_id)
    {
        $this->id_vacante = $id_vacante;
        $this->nombre_vacante = $nombre_vacante;
        $this->usuario_id = $usuario_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * en este metodo definimos los canales por los cuales se realizaran notificaciones (via mail y almacenando en DB) (v237)
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     * 
     * Aca configuramos el formato del mail que le llegará a un rectuiter cuando un dev se postule a una de sus vacantes.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url("/notificaciones");
        return (new MailMessage)
            // ->line('The introduction to the notification.')
            // ->action('Notification Action', url('/'))
            // ->line('Thank you for using our application!');
            ->line("Has recibido un nuevo candidato en tu vacante.")
            ->line("La vacante es: $this->nombre_vacante")
            ->action('Ver Notificaciones', $url)
            ->line('Gracias por utilizar DevJobs');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    // metodo creado por nosotros en el video 236
    // este metodo almacenará las notificaciones en la DB, en la tabla notifications
    // el arreglo que retorna este metodo se convierte automaticamente en un objeto json para el almacenamiento en notifications.data
    public function toDatabase(object $notifiable)
    {
        return [
            "id_vacante" => $this->id_vacante,
            "nombre_vacante" => $this->nombre_vacante,
            "usuario_id" => $this->usuario_id
        ];
    }
}
