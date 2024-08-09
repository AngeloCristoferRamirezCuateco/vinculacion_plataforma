<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\UsuarioRol;
use App\Models\Rol;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class UsuarioController extends Controller
{

    // Registrar usuarios
    public function register(Request $request)
    {
        Log::info('Inicio del registro de usuario.', ['request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'id_empresa' => 'required|exists:Empresas,id_empresa',
                'nombreUsuario' => 'required|string|max:255',
                'apellidoPaterno' => 'required|string|max:255',
                'apellidoMaterno' => 'nullable|string|max:255',
                'telefonoUsuario' => 'required|string|max:20',
                'correoUsuario' => 'required|email|max:255|unique:Usuarios,correoUsuario',
                'passwordUsuario' => 'required|string|max:255',
                'evaluacionUsuario' => 'nullable|integer|min:1|max:10',
                'curriculumUsuario' => 'nullable|string|max:255',
                'id_rol' => 'required|exists:Roles,id_rol',
            ]);

            Log::info('Datos validados correctamente.', ['validatedData' => $validatedData]);

            if (!$request->filled('evaluacionUsuario')) {
                $validatedData['evaluacionUsuario'] = 0; // o cualquier valor predeterminado que prefieras
            }
            if (!$request->filled('curriculumUsuario')) {
                $validatedData['curriculumUsuario'] = ''; // o cualquier valor predeterminado que prefieras
            }

            // Encriptar la contraseña
            $validatedData['passwordUsuario'] = Hash::make($request->passwordUsuario);

            $usuario = Usuario::create($validatedData);

            Log::info('Usuario creado correctamente.', ['usuario' => $usuario]);

            UsuarioRol::create([
                'id_usuario' => $usuario->id_usuario,
                'id_rol' => $request->id_rol,
            ]);

            Log::info('Rol asignado correctamente.', ['id_usuario' => $usuario->id_usuario, 'id_rol' => $request->id_rol]);

            Mail::to($usuario->correoUsuario)->send(new ExampleMail($usuario));
            Log::info('Correo enviado');

            return redirect()->route('admin.panelregisteruser')->with('success', 'Usuario creado exitosamente.');
        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error durante el registro del usuario.', ['exception' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error durante el registro del usuario.')->withInput();
        }
    }

    //Mostrar usuarios
    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios, 200);
    }

    public function buscarUsuarios(Request $request)
    {
        $query = $request->input('query');
        $usuarios = Usuario::query()
            ->where('nombreUsuario', 'LIKE', '%' . $query . '%')
            ->orWhere('apellidoPaterno', 'LIKE', '%' . $query . '%')
            ->orWhere('apellidoMaterno', 'LIKE', '%' . $query . '%')
            ->orWhere('correoUsuario', 'LIKE', '%' . $query . '%')
            ->orWhere('telefonoUsuario', 'LIKE', '%' . $query . '%')
            ->get();

        return view('dashboars.Administradores.tablasalumnos', compact('usuarios'));
    }
//Buscar usuarios
   
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario, 200);
    }
    // Actualizar usuario
    public function update(Request $request, $id)
    {
        Log::info('Inicio de la función update.', ['id' => $id, 'request' => $request->all()]);

        try {
            $validatedData = $request->validate([
                'nombreUsuario' => 'required|string|max:255',
                'apellidoPaterno' => 'required|string|max:255',
                'apellidoMaterno' => 'nullable|string|max:255',
                'correoUsuario' => 'required|email|max:255|unique:Usuarios,correoUsuario,' . $id . ',id_usuario',
            ]);

            Log::info('Datos validados.', ['validatedData' => $validatedData]);

            $usuario = Usuario::findOrFail($id);
            Log::info('Usuario encontrado.', ['usuario' => $usuario]);

            $usuario->update($validatedData);
            Log::info('Datos actualizados.', ['usuario' => $usuario]);

            //return response()->json(['message' => 'Usuario actualizado correctamente.'], 200);
            //return redirect()->route('admin.paneleditUsers');
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error al actualizar el usuario.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error al actualizar el usuario.'], 500);
        }
    }

    //Metodo borrar usuario
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        //return response()->json(['message' => 'Usuario eliminado correctamente.'], 200);
        return redirect()->back();
    }


    public function logoutUser(Request $request)
    {
        Log::info('Inicio del proceso de cierre de sesión.');

        // Cierra la sesión del usuario autenticado
        Auth::logout();
        Log::info('Usuario deslogueado.');

        // Invalida la sesión actual
        $request->session()->invalidate();
        Log::info('Sesión invalidada.');

        // Regenera el token CSRF
        $request->session()->regenerateToken();
        Log::info('Token CSRF regenerado.');

        // Redirige al usuario a la página principal u otra ruta
        return redirect()->route('empresas.inicio');
    }

    //Funcion para que solo usara el representante de empresa
    public function registerRepresentante(Request $request)
    {
        Log::info('Inicio del registro de usuario representante.', ['request' => $request->all()]);

        try {
            // Obtener el id_empresa del representante
            $id_empresa = Auth::user()->id_empresa;

            $validatedData = $request->validate([
                'nombreUsuario' => 'required|string|max:255',
                'apellidoPaterno' => 'required|string|max:255',
                'apellidoMaterno' => 'nullable|string|max:255',
                'telefonoUsuario' => 'required|string|max:20',
                'correoUsuario' => 'required|email|max:255|unique:Usuarios,correoUsuario',
                'passwordUsuario' => 'required|string|max:255',
                'evaluacionUsuario' => 'nullable|integer|min:1|max:10',
                'curriculumUsuario' => 'nullable|string|max:255',
                'id_rol' => 'required|exists:Roles,id_rol',
            ]);

            Log::info('Datos validados correctamente.', ['validatedData' => $validatedData]);

            // Agregar id_empresa al array de datos validados
            $validatedData['id_empresa'] = $id_empresa;

            if (!$request->filled('evaluacionUsuario')) {
                $validatedData['evaluacionUsuario'] = 0; // o cualquier valor predeterminado que prefieras
            }
            if (!$request->filled('curriculumUsuario')) {
                $validatedData['curriculumUsuario'] = ''; // o cualquier valor predeterminado que prefieras
            }

            // Encriptar la contraseña
            $validatedData['passwordUsuario'] = Hash::make($request->passwordUsuario);

            $usuario = Usuario::create($validatedData);

            Log::info('Usuario creado correctamente.', ['usuario' => $usuario]);

            UsuarioRol::create([
                'id_usuario' => $usuario->id_usuario,
                'id_rol' => $request->id_rol,
            ]);

            Log::info('Rol asignado correctamente.', ['id_usuario' => $usuario->id_usuario, 'id_rol' => $request->id_rol]);

            Mail::to($usuario->correoUsuario)->send(new ExampleMail($usuario));
            Log::info('Correo enviado');

            return redirect()->route('representante.panelInicio');
        } catch (ValidationException $e) {
            Log::error('Error de validación.', ['errors' => $e->errors()]);
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error durante el registro del usuario.', ['exception' => $e->getMessage()]);
            return response()->json(['message' => 'Error durante el registro del usuario.'], 500);
        }
    }

    public function updateProfile(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'email' => 'required|email',
            'telefono' => 'required|string',
            'descripcion' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'curriculum' => 'nullable|file|mimes:pdf,doc,docx|max:4096',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        if ($user instanceof Usuario) {
            // Actualizar la foto de perfil
            if ($request->hasFile('profile_image')) {
                // Eliminar la imagen existente si está presente
                if ($user->foto1 && Storage::exists($user->foto1)) {
                    Storage::delete($user->foto1);
                }

                // Obtener el archivo de la imagen
                $file = $request->file('profile_image');

                // Obtener el tamaño del archivo en kilobytes
                $fileSize = $file->getSize() / 1024; // Tamaño en KB

                // Guardar la nueva imagen de perfil
                $profileImagePath = $file->store('profile_images');
                $user->foto1 = $profileImagePath;

                // Verificar que el archivo se haya guardado correctamente
                if (Storage::exists($profileImagePath)) {
                    Log::info('Foto de perfil actualizada correctamente. Tamaño de la imagen: ' . number_format($fileSize, 2) . ' KB');
                } else {
                    Log::error('No se pudo guardar la foto de perfil.');
                }
            }

            // Actualizar la foto de portada
            if ($request->hasFile('cover_image')) {
                // Eliminar la imagen existente si está presente
                if ($user->foto2 && Storage::exists($user->foto2)) {
                    Storage::delete($user->foto2);
                }

                // Obtener el archivo de la imagen
                $file = $request->file('cover_image');

                // Obtener el tamaño del archivo en kilobytes
                $fileSize = $file->getSize() / 1024; // Tamaño en KB

                // Guardar la nueva imagen de portada
                $coverImagePath = $file->store('cover_images');
                $user->foto2 = $coverImagePath;

                // Verificar que el archivo se haya guardado correctamente
                if (Storage::exists($coverImagePath)) {
                    Log::info('Foto de portada actualizada correctamente. Tamaño de la imagen: ' . number_format($fileSize, 2) . ' KB');
                } else {
                    Log::error('No se pudo guardar la foto de portada.');
                }
            }

            // Actualizar el currículum
            if ($request->hasFile('curriculum')) {
                // Eliminar el currículum existente si está presente
                if ($user->curriculumUsuario && Storage::exists($user->curriculumUsuario)) {
                    Storage::delete($user->curriculumUsuario);
                }

                // Guardar el nuevo currículum
                $curriculumPath = $request->file('curriculum')->store('curriculums');
                $user->curriculumUsuario = $curriculumPath;

                Log::info('Currículum actualizado correctamente.');
            }

            // Actualizar otros campos del usuario
            $user->correoUsuario = $request->input('email');
            $user->telefonoUsuario = $request->input('telefono');
            $user->descripcion = $request->input('descripcion');
            $user->save(); // Guarda los cambios en la base de datos

            return redirect()->back()->with('success', 'Perfil actualizado con éxito');
        } else {
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }
    }

    //Funcion de busqueda de Usuarios para Administradores 
    
}
