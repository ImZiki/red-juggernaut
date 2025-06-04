<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Atributos asignables.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    /**
     * Atributos que deberían ser casteados.
     *
     * @var list<string, string>
     */
    protected $casts = [
        'media' => 'array', // Para almacenar rutas de multimedia como JSON
    ];

    /**
     * Relación inversa: Un post pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Puedes añadir un método para subir archivos multimedia aquí.
     */
    public function uploadMedia($mediaFile)
    {
        // Lógica para almacenar el archivo multimedia en un directorio y devolver la ruta
        // Almacena en el directorio "media" dentro de "public"
        return $mediaFile->store('media', 'public');
    }
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
}
