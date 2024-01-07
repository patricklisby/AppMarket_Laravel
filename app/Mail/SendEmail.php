<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Categorias;


class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    /** 
* The demo object instance. 
* 
* 
*/
    public $datos;
    public $vista;
    /** 
* Create a new message instance. 
* 
* @return void 
*/

    public function __construct($datos, $vista)
    {
        $this->datos = $datos;
        $this->vista = $vista;

    }
    /** 
* Build the message. 
* 
* @return $this 
*/
    public function build()
    {
        if($this->vista == "cat"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.categorias')
            ->subject('Información de Categorias AppMarket');
        }
        if($this->vista == "cli"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.clientes')
            ->subject('Información de Clientes AppMarket');
        }
        if($this->vista == "prv"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.proveedores')
            ->subject('Información de Proveedores AppMarket');
        }
        if($this->vista == "prd"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.productos')
            ->subject('Información de Productos AppMarket');
        }
        if($this->vista == "usu"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.usuarios')
            ->subject('Información de Usuarios AppMarket');
        }
        if($this->vista == "bit"){
            return $this->from('AppMarketUCR@gmail.com')
            ->view('emails.bitacoras')
            ->subject('Información de Bitacoras AppMarket');
        }

        
     
    }
}