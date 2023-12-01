<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

/**
 * @OA\Info(title="API Personas", version="1.0")
 *
 */
class PersonaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/persona",
     *     tags={"Persona"},
     *     summary="Mostrar personas",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las personas."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */

    public function index()
    {
        $personas = Persona::all();
        $personas->load('user');
        return response()->json(['success' => true,
            'data' => $personas,
            'message' => 'Lista de personas'], 200);

    }

    /**
     * @OA\Post(
     *      path="/api/persona",
     *      operationId="postPersona",
     *      tags={"Persona"},
     *      summary="Lista de personas",
     *      description="Lista de personas",
     *     @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nombre", type="string", example="Noe"),
     *              @OA\Property(property="descripcion", type="string", example="descripcion de la persona"),
     *              @OA\Property(property="user_id", type="string", example="1"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function store(Request $request)
    {
        Persona::create($request->all());
        $personas = Persona::all();
        return response()->json(['success' => true,
            'data' => $personas,
            'message' => 'Registrar persona'], 200);
    }

    /**
     * @OA\Get(
     *      path="/api/persona/{id}",
     *      operationId="getPersona",
     *      tags={"Persona"},
     *      summary="Optener persona por id",
     *      description="Optener persona por id",
     *     @OA\Parameter(
     *      name="id",
     *      description="id,
     *      eg; 1",
     *      required=true,
     *      in="path",
     *      @OA\Schema(type="integer")),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function show($id)
    {
        $persona = Persona::find($id);

        if (is_null($persona)) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Persona no encontrada ID'
            ], 400);
        } else {
            $persona->user = $persona->user;
        }
        return response()->json([
            'success' => true,
            'data' => $persona,
            'message' => 'Persona por su ID'
        ], 200);

    }

    /**
     * @OA\Put(
     *      path="/api/persona/{id}",
     *      operationId="updatePersona",
     *      tags={"Persona"},
     *      summary="Lista de personas",
     *      description="Lista de personas",
     *      @OA\Parameter(
     *      name="id",
     *      description="id,
     *      eg; 1",
     *      required=true,
     *      in="path",
     *      @OA\Schema(type="integer")),
     *      @OA\RequestBody(
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="nombre", type="string", example="Juliaca"),
     *              @OA\Property(property="descripcion", type="string", example="Juliaca"),
     *              @OA\Property(property="user_id", type="integer", example="1")
     *
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function update(Request $request, $id)
    {
        Persona::find($id)->update($request->all());
        return response()->json(['success' => true,
            'data' => Persona::all(),
            'message' => 'Lista de personas'], 200);

    }

    /**
     * @OA\Delete(
     *      path="/api/persona/{id}",
     *      operationId="deletePersona",
     *      tags={"Persona"},
     *      summary="Lista de personas",
     *      description="Lista de personas",
     *      @OA\Parameter(
     *      name="id",
     *      description="id,
     *      eg; 1",
     *      required=true,
     *      in="path",
     *      @OA\Schema(type="integer")),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     * @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *  )
     */

    public function destroy($id)
    {
        Persona::find($id)->delete();
        return response()->json(['success' => true,
            'data' => Persona::all(),
            'message' => 'Lista de personas'], 200);
    }
}
