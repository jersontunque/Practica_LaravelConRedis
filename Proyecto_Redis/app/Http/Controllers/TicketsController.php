<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TicketsController extends Controller
{
public function index(Request $request)
{
    $inicio = microtime(true);
    $objetos = collect($this->consulta($request))->map(fn($fila) => (object) $fila);
    $personas = Tickets::select('Persona')->distinct()->pluck('Persona');
    $tiempo = round((microtime(true) - $inicio) * 1000, 2);

    return view('objetos.index', [
        'objetos'  => $objetos,
        'personas' => $personas,
        'tiempo'   => $tiempo,
        'origen'   => 'MySQL (directo)',
        'ruta'     => 'objetos.index',
        'titulo'   => 'Listado de Objetos (MySQL)',
    ]);
}


  public function indexRedis(Request $request)
{
    $inicio = microtime(true);
    $clave = 'tickets:lista:' . md5(json_encode($request->only('persona', 'buscar')));
    [$datos, $desdeCache] = Cache::store('redis')->rememberWithWarmth(
        $clave,
        300,
        fn() => $this->consulta($request)
    );

    $objetos = collect($datos)->map(fn($fila) => (object) $fila);
    $personas = Cache::store('redis')->remember(
        'tickets:personas',
        300,
        fn() => Tickets::select('Persona')->distinct()->pluck('Persona')->toArray()
    );

    $tiempo = round((microtime(true) - $inicio) * 1000, 2);
    return view('objetos.index', [
        'objetos'  => $objetos,
        'personas' => $personas,
        'tiempo'   => $tiempo,
        'origen'   => $desdeCache ? 'Redis (caché)' : 'MySQL (primera carga, guardado en Redis)',
        'ruta'     => 'objetos.redis',
        'titulo'   => 'Listado de Objetos (Redis)',
    ]);
}


  private function consulta(Request $request): array
{
    return Tickets::query()
        ->when($request->persona, fn($q) => $q->persona($request->persona))
        ->when($request->buscar, fn($q) => $q->buscar($request->buscar))
        ->get()
        ->toArray();
}
}