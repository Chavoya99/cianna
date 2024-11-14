<?php

namespace App\Http\Controllers;

use App\Models\ArchivoCasa;
use App\Models\Casa;
use App\Models\Postulacion;
use App\Models\User;
use App\Models\UserA;
use App\Models\UserB;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    
    public function redirectTo(){
        return redirect()->route('home');
    }
    public function show(){
        return view('home', ['texto'=>"Hola mundo"]);
    }

    public function home_invitado(){

        $casas = Casa::with(['archivos' => function ($query) {
            $query->where('clasificacion_archivo', 'img_cuarto');
        }])->limit(4)->get();

        $userA = UserA::with(['user.archivos' => function($query){
            $query->where('archivo_type', 'img_perf');
        }])->limit(3)->get();

        $userB = UserB::with(['user.archivos' => function($query){
            $query->where('archivo_type', 'img_perf');
        }])->limit(3)->get();

        $roomies = $userA->concat($userB);
        return view('profile.home', compact('casas', 'roomies'));
    }

    public function configuracion_cuenta(){
        if(Auth::user()->tipo == 'A'){
            $usuario = Auth::user()->user_a;
        }else if(Auth::user()->tipo == 'B')
        {
            $usuario = Auth::user()->user_b;
        }else{
            $usuario = Auth::user();
        }

        return view('profile.account-settings', compact('usuario'));
    }

    public function ver_perfil_usuario(){
        if(Auth::user()->tipo == 'A'){
            $usuario = Auth::user()->user_a;
        }else if(Auth::user()->tipo == 'B')
        {
            $usuario = Auth::user()->user_b;
        }else{
            $usuario = Auth::user();
        }
        

        $img_perfil = Auth::user()->archivos()->where('archivo_type', 'img_perf')->first();
        
        $img_casa = null;
        if(Auth::user()->tipo == 'A'){
            $img_casa = Auth::user()->user_a->casa->archivos()->where('clasificacion_archivo', '!=', 'compDom1')->where('clasificacion_archivo', '!=' , 'compDom2')->get();
        }

        return view('profile.my-profile', ['usuario'=>$usuario, 'img_perfil' => $img_perfil, 'carrera' => $this->obtener_nombre_carrera($usuario->carrera), 'img_casa' => $img_casa]);
    }

    public function actualizar_cuenta(Request $request){
        $request->validate([
            'desc' => 'required|min:1|max:300',
            'img_perf' => 'nullable|mimes:jpg,png,jpeg|max:4096',
            'mascota' => 'required',
            'edad' => 'required|integer|min:18|max:35',
            'sexo' => 'required',
            'padecimiento' => 'required',
            'lifestyle' => 'required',
            'carrera' => 'required',
            'kardex' => 'nullable|mimes:pdf|max:4096',
        ],[
            'desc.min' => 'Debes dar una descripción de al menos 100 caracteres',
            'img_perf.mimes' => 'Sólo se permiten imagenes .jpg, .png o .jpeg',
            'img_perf.max' => 'La imagen no debe pesar más de 4mb',
        ]);


        $num_mascotas = 0; //Cantidad de mascotas por defecto
        if($request->mascota == 'si'){
            $request->validate([
                'num-mascotas' => 'required|integer|min:1|max:10',
            ],
            [
                'num-mascotas.min' => 'La cantidad de mascotas debe ser mayor a 0',
                'num-mascotas.max' => 'La cantidad de mascotas no debe ser mayor a 10',
            ]);

            $num_mascotas = $request->input('num-mascotas');
            
        }
        
        if($request->input('nom-padecimiento') != null){
            $nom_padecimiento = $request->input('nom-padecimiento');
        }else{
            $nom_padecimiento = 'N/A';  //Si no hay nombre de padecimiento
        }

        if(Auth::user()->tipo == 'A'){
            $request->validate([
                'codigo' => ['required','regex:/^[a-zA-Z0-9_-]+$/', Rule::unique('users_a')->ignore(Auth::user()->user_a->codigo, 'codigo')]
            ]);
            $user = Auth::user()->user_a;
        }else if( Auth::user()->tipo == 'B'){
            $request->validate([
                'codigo' => ['required','regex:/^[a-zA-Z0-9_-]+$/', Rule::unique('users_b')->ignore(Auth::user()->user_b->codigo, 'codigo')]
            ]);
            $user = Auth::user()->user_b;
        }

        $user->update([
            'descripcion' => $request->desc,
            'mascota' => $request->mascota,
            'num_mascotas' => $num_mascotas,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'padecimiento' => $request->padecimiento,
            'nom_padecimiento' => $nom_padecimiento,
            'codigo' => $request->codigo,
            'lifestyle' => $request->lifestyle,
            'carrera' => $request->carrera,
        ]);

        if ($request->hasFile('img_perf')) {
            $imagen = $request->file('img_perf');
            $ubicacion = $imagen->store('imagenes_perfil', 'public');

            $user->user->archivos()->where('archivo_type', 'img_perf')->update([
                'archivo_type' => 'img_perf',
                'MIME' => $imagen->getClientMimeType(),
                'ruta_archivo' => $ubicacion,
            ]);
        }

        if ($request->hasFile('kardex')) {
            $kardex = $request->file('kardex');
            $ubicacion = $kardex->store('archivos_kardex', 'public');

            $user->user->archivos()->where('archivo_type', 'kardex')->update([
                'archivo_type' => 'kardex',
                'MIME' => $kardex->getClientMimeType(),
                'ruta_archivo' => $ubicacion,
            ]);
        }

        return redirect()->route('mi_perfil')->with('success', 'Perfil actualizado');
    }

    public function descargar_kardex(User $usuario){
        $archivo = $usuario->archivos()->where('archivo_type', 'kardex')->first();
        $this->authorize('descargar_archivo', [$archivo, $usuario]);

        if (Storage::disk('public')->exists($archivo->ruta_archivo)) {
            return response()->download(storage_path('app/public/'.$archivo->ruta_archivo), 'Kardex.pdf');
        }else{
            return back()->withErrors(['kardex' => 'El archivo no existe']);
        }
    }

    public function ver_kardex(User $usuario){
        $archivo = $usuario->archivos()->where('archivo_type', 'kardex')->first();
        $this->authorize('descargar_archivo', [$archivo, $usuario]);

        if (Storage::disk('public')->exists($archivo->ruta_archivo)) {
            return response()->file(storage_path('app/public/'.$archivo->ruta_archivo));
        }else{
            return back()->withErrors(['kardex' => 'El archivo no existe']);
        }

    }

    public function ver_detalles_casa(Casa $casa){

        if($casa->user_a->id == Auth::user()->id){
            //Configurar para redireccionar si se accede a la casa de mismo usuario autenticado
        }

        $img_casa = $casa->archivos()
        ->where('clasificacion_archivo', '!=', 'compDom1')
        ->where('clasificacion_archivo', '!=', 'compDom2')
        ->get()->toArray();
        return view('profile.room-details', compact('casa', 'img_casa'));
    }

    public function vista_previa_casa(Casa $casa){
        if(Auth::user()->tipo == 'A'){
            $casasRecomendadas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->where('user_a_id', '!=', Auth::id())->where('id', '!=', $casa->id)->limit(3)->get();
        }else if (Auth::user()->tipo == 'B'){
            $casasRecomendadas = Casa::with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');
            }])->where('id', '!=', $casa->id)->limit(3)->get();
        }
        

        $img_casa = $casa->archivos()->where('clasificacion_archivo', 'img_cuarto')->first();
        return view('profile.about-room', compact('casa', 'img_casa', 'casasRecomendadas'));
    }

    public function listado_casas(){
        return view('profile.homes-list');
    }

    public function vista_previa_roomie($roomie){
        if($roomie == Auth::id()){
            return redirect(route('mi_perfil'));
        }

        $user = User::where('id', $roomie)->first();
        
        $rutaImagenPerfil = $user->archivos()->where('archivo_type', 'img_perf')->first()->ruta_archivo;

        if($user->tipo == 'A'){
            $roomie_v = $user->user_a;
        }else if($user->tipo == 'B'){
            $roomie_v = $user->user_b;
        }

        $carrera = $this->obtener_nombre_carrera($roomie_v->carrera);

        if(Auth::user()->tipo == 'A'){
            $roomiesRecomendados = UserB::with(['user.archivos' => function($query){
                $query->where('archivo_type', 'img_perf');
            }])->where('user_id', '!=', $roomie)->limit(4)->get();
        }else if(Auth::user()->tipo == 'B'){
            $roomiesRecomendados = UserA::with(['user.archivos' => function($query){
                $query->where('archivo_type', 'img_perf');
            }])->where('user_id', '!=', $roomie)->limit(4)->get();
        }
        
        $listaCarreras = $this->lista_carreras();
        return view('profile.about-roomie', compact('roomie_v', 'carrera', 'rutaImagenPerfil', 'roomiesRecomendados', 'listaCarreras'));
    }

    public function ver_detalles_roomie($roomie){
        if($roomie == Auth::id()){
            return redirect(route('mi_perfil'));
        }

        $user = User::where('id', $roomie)->first();
        $rutaImagenPerfil = $user->archivos()->where('archivo_type', 'img_perf')->first()->ruta_archivo;
        
        if($user->tipo == 'A'){
            $roomie_detalle = $user->user_a;
        }else if($user->tipo == 'B'){
            $roomie_detalle = $user->user_b;
        }

        $carrera = $this->obtener_nombre_carrera($roomie_detalle->carrera);

        return view('profile.roomie-details', compact('roomie_detalle', 'carrera', 'rutaImagenPerfil'));
    }

    public function listado_roomies(){
        

        return view('profile.roomies-list');
    }

    public function obtener_nombre_carrera($llave){
        $carreras = $this->lista_carreras();
        return $carreras[$llave];
    }

    public function lista_carreras(){
        $carreras = ['ing_alim_biot' => 'Ing. en Alimentos y Biotecnología',
        'ing_biom' => 'Ing. Biómedica',
        'ing_civi' => 'Ing. Civil',
        'ing_comp' => 'Ing. en Computación',
        'ing_com_elec' => 'Ing. en Comunicaciones y Eléctrónica',
        'ing_log_trans' => 'Ing. en Logística y Transporte',
        'ing_topo' => 'Ing. en Topografía Geomática',
        'ing_foto' => 'Ing. Fotónica',
        'ing_indu' => 'Ing. Industrial',
        'ing_info' => 'Ing. Informática',
        'ing_meca' => 'Ing. Mecánica Eléctrica',
        'ing_quim' => 'Ing. Química',
        'ing_robo' => 'Ing. Robótica',
        'lic_cien_mate' => 'Lic. en Ciencia de Materiales',
        'lic_fis' => 'Lic. en Física',
        'lic_mate' => 'Lic. en Matemáticas',
        'lic_quim' => 'Lic. en Química',
        'lic_qfb' => 'Lic. en Químico Farmacéutico Biólogo'];

        return $carreras;
    }

    public function ver_favoritos(){
        if (Auth::user()->tipo == 'A'){
            $favoritos = Auth::user()->user_a->favoritos_roomies()->with(['user.archivos' => function ($query) {
                $query->where('archivo_type', 'img_perf');}])->get();

            $carreras = $this->lista_carreras();

            return view('profile.favsA', compact('favoritos', 'carreras'));
        }else if(Auth::user()->tipo == 'B'){
            $favoritos = Auth::user()->user_b->favoritos_casas()->with(['archivos' => function ($query) {
                $query->where('clasificacion_archivo', 'img_cuarto');}])->get();

            return view('profile.favsB', compact('favoritos'));
        }
    }

    
}
