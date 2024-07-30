<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = ['nome_evento', 'data_inicio', 'data_fim', 'data_prazo_inscricao', 'responsavel', 'telefone_responsavel', 'email_responsavel', 'uf', 'cidade', 'local', 'descricao', 'logo_evento', 'limite_nscritos', 'url_inscricao'];
}