<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HelloWorldController extends Controller
{
    /**
     * Lista todos los ficheros de la carpeta storage/app.
     *
     * @return JsonResponse La respuesta en formato JSON.
     *
     * El JSON devuelto debe tener las siguientes claves:
     * - mensaje: Un mensaje indicando el resultado de la operación.
     * - contenido: Un array con los nombres de los ficheros.
     */
    public function index()
    {
        $files = Storage::allFiles();
        $response =
        [
            "mensaje" => "Listado de ficheros",
            "contenido" => $files
        ];
        return response()->json($response);
    }

     /**
     * Recibe por parámetro el nombre de fichero y el contenido. Devuelve un JSON con el resultado de la operación.
     * Si el fichero ya existe, devuelve un 409.
     *
     * @param filename Parámetro con el nombre del fichero. Devuelve 422 si no hay parámetro.
     * @param content Contenido del fichero. Devuelve 422 si no hay parámetro.
     * @return JsonResponse La respuesta en formato JSON.
     *
     * El JSON devuelto debe tener las siguientes claves:
     * - mensaje: Un mensaje indicando el resultado de la operación.
     */
    public function store(Request $request)
    {
        if (!$request->has('filename') || !$request->has('content')) {
            return response()->json([
                "mensaje" => "Faltan parámetros"
            ], 422);
        }
    
        $nombre = $request->filename;
        $contenido = $request->content;
    
        if (Storage::exists($nombre)) {
            return response()->json([
                "mensaje" => "El archivo ya existe"
            ], 409);
        }
    
        Storage::put($nombre, $contenido);
    
        return response()->json([
            "mensaje" => "Guardado con éxito"
        ], 200);
    }

     /**
     * Recibe por parámetro el nombre de fichero y devuelve un JSON con su contenido
     *
     * @param name Parámetro con el nombre del fichero.
     * @return JsonResponse La respuesta en formato JSON.
     *
     * El JSON devuelto debe tener las siguientes claves:
     * - mensaje: Un mensaje indicando el resultado de la operación.
     * - contenido: El contenido del fichero si se ha leído con éxito.
     */
    public function show(string $filename)
    {
        if (!Storage::exists($filename)) {
            return response()->json([
                "mensaje" => "Archivo no encontrado"
            ], 404);
        }
    
        $contenido = Storage::get($filename);
    
        return response()->json([
            "mensaje" => "Archivo leído con éxito",
            "contenido" => $contenido
        ], 200);
    }

    /**
     * Recibe por parámetro el nombre de fichero, el contenido y actualiza el fichero.
     * Devuelve un JSON con el resultado de la operación.
     * Si el fichero no existe devuelve un 404.
     *
     * @param filename Parámetro con el nombre del fichero. Devuelve 422 si no hay parámetro.
     * @param content Contenido del fichero. Devuelve 422 si no hay parámetro.
     * @return JsonResponse La respuesta en formato JSON.
     *
     * El JSON devuelto debe tener las siguientes claves:
     * - mensaje: Un mensaje indicando el resultado de la operación.
     */
    public function update(Request $request, string $filename)
    {
        if (!$filename || !$request->has('content')) {
            return response()->json([
                "mensaje" => "Faltan parámetros"
            ], 422);
        }
    
        $nombre = $filename;
        $contenido = $request->content;
    
        if (!Storage::exists($nombre)) {
            return response()->json([
                "mensaje" => "El archivo no existe"
            ], 404);
        }
    
        Storage::put($nombre, $contenido);
    
        return response()->json([
            "mensaje" => "Actualizado con éxito"
        ], 200);
    }

    /**
     * Recibe por parámetro el nombre de ficher y lo elimina.
     * Si el fichero no existe devuelve un 404.
     *
     * @param filename Parámetro con el nombre del fichero. Devuelve 422 si no hay parámetro.
     * @return JsonResponse La respuesta en formato JSON.
     *
     * El JSON devuelto debe tener las siguientes claves:
     * - mensaje: Un mensaje indicando el resultado de la operación.
     */
    public function destroy(string $filename)
    {
        if (!$filename) {
            return response()->json([
                "mensaje" => "Falta el parámetro 'filename'"
            ], 422);
        }
    
        $nombre = $filename;
    
        if (!Storage::exists($nombre)) {
            return response()->json([
                "mensaje" => "El archivo no existe"
            ], 404);
        }
    
        Storage::delete($nombre);
    
        return response()->json([
            "mensaje" => "Eliminado con éxito"
        ], 200);
    }
}