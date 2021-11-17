<?php

use App\Models\File;
use App\Models\Tree;
use App\Models\User;

/* * * * * ÁRBOL  * * * * */

// Verifica si una persona existe
function existePersona($id){
    return Tree::find($id);
}

// Obtener sexo
function GetSexo($id){
    try{
        return Tree::find($id)->sexo;
    }catch(Exception $e){
        return null;
    }
}

/* * * PADRES * * */

// Obtener id de padre
function GetIdPadre($id){
    try{
        return Tree::find($id)->id_padre;
    }catch(Exception $e){
        return null;
    }
}

// Obtener id de madre
function GetIdMadre($id){
    try{
        return Tree::find($id)->id_madre;
    }catch(Exception $e){
        return null;
    }
}

// Obtener id de padres
function GetIdPadres($id){
    return [ 
        GetIdPadre($id),  
        GetIdMadre($id)
    ];      
}

// Obtener persona de padres
function GetPersonaPadres(){
    return [ 
        'Padre',  
        'Madre'
    ];      
}

/* * * ABUELOS * * */

// Obtener id de abuelos
function GetIdAbuelos($id){
    return [
        GetIdPadre(GetIdPadre($id)),    // Abuelo Paterno
        GetIdMadre(GetIdPadre($id)),    // Abuela Paterna
        GetIdPadre(GetIdMadre($id)),    // Abuelo Materno
        GetIdMadre(GetIdMadre($id))     // Abuela Materna
    ];      
}

// Obtener persona de abuelos
function GetPersonaAbuelos(){
    return [ 
        'Abuelo Paterno',  
        'Abuela Paterna',
        'Abuelo Materno',
        'Abuela Materna'
    ];      
}

/* * * BISABUELOS * * */

// Obtener id de bisabuelos
function GetIdBisabuelos($id){
    return [
        GetIdPadre(GetIdPadre(GetIdPadre($id))),    // Bisabuelo PP
        GetIdMadre(GetIdPadre(GetIdPadre($id))),    // Bisabuela PP

        GetIdPadre(GetIdMadre(GetIdPadre($id))),    // Bisabuelo PM
        GetIdMadre(GetIdMadre(GetIdPadre($id))),    // Bisabuela PM

        GetIdPadre(GetIdPadre(GetIdMadre($id))),    // Bisabuelo MP
        GetIdMadre(GetIdPadre(GetIdMadre($id))),    // Bisabuela MP

        GetIdPadre(GetIdMadre(GetIdMadre($id))),    // Bisabuelo MM
        GetIdMadre(GetIdMadre(GetIdMadre($id))),    // Bisabuela MM
    ];      
}

// Obtener persona de bisabuelos
function GetPersonaBisabuelos(){
    return [ 
        'Bisabuelo PP',  
        'Bisabuela PP',
        'Bisabuelo PM',
        'Bisabuela PM',
        'Bisabuelo MP',  
        'Bisabuela MP',
        'Bisabuelo MM',
        'Bisabuela MM'
    ];      
}

/* * * TATARABUELOS * * */

// Obtener id de tatarabuelos
function GetIdTatarabuelos($id){
    return [
        GetIdPadre(GetIdPadre(GetIdPadre(GetIdPadre($id)))),    // Tatarabuelo PPP
        GetIdMadre(GetIdPadre(GetIdPadre(GetIdPadre($id)))),    // Tatarabuela PPP

        GetIdPadre(GetIdMadre(GetIdPadre(GetIdPadre($id)))),    // Tatarabuelo PPM
        GetIdMadre(GetIdMadre(GetIdPadre(GetIdPadre($id)))),    // Tatarabuela PPM

        GetIdPadre(GetIdPadre(GetIdMadre(GetIdPadre($id)))),    // Tatarabuelo PMP
        GetIdMadre(GetIdPadre(GetIdMadre(GetIdPadre($id)))),    // Tatarabuela PMP

        GetIdPadre(GetIdMadre(GetIdMadre(GetIdPadre($id)))),    // Tatarabuelo PMM
        GetIdMadre(GetIdMadre(GetIdMadre(GetIdPadre($id)))),    // Tatarabuela PMM

        GetIdPadre(GetIdPadre(GetIdPadre(GetIdMadre($id)))),    // Tatarabuelo MPP
        GetIdMadre(GetIdPadre(GetIdPadre(GetIdMadre($id)))),    // Tatarabuela MPP

        GetIdPadre(GetIdMadre(GetIdPadre(GetIdMadre($id)))),    // Tatarabuelo MPM
        GetIdMadre(GetIdMadre(GetIdPadre(GetIdMadre($id)))),    // Tatarabuela MPM

        GetIdPadre(GetIdPadre(GetIdMadre(GetIdMadre($id)))),    // Tatarabuelo MMP
        GetIdMadre(GetIdPadre(GetIdMadre(GetIdMadre($id)))),    // Tatarabuela MMP

        GetIdPadre(GetIdMadre(GetIdMadre(GetIdMadre($id)))),    // Tatarabuelo MMM
        GetIdMadre(GetIdMadre(GetIdMadre(GetIdMadre($id)))),    // Tatarabuela MMM
    ];      
}

// Obtener persona de tatarabuelos
function GetPersonaTatarabuelos(){
    return [ 
        'Tatarabuelo PPP',  
        'Tatarabuela PPP',
        'Tatarabuelo PPM',
        'Tatarabuela PPM', 
        'Tatarabuelo PMP',  
        'Tatarabuela PMP',
        'Tatarabuelo PMM',
        'Tatarabuela PMM',
        'Tatarabuelo MPP',  
        'Tatarabuela MPP',
        'Tatarabuelo MPM',
        'Tatarabuela MPM', 
        'Tatarabuelo MMP',  
        'Tatarabuela MMP',
        'Tatarabuelo MMM',
        'Tatarabuela MMM'
    ];      
}

/* * * HIJOS * * */

// Obtener hijos
function GetHijos($id){
    try{
        if(Tree::find($id)->sexo == 'M'){
            return Tree::where('id_padre', 'LIKE', $id)->get();
        }else{
            return Tree::where('id_madre', 'LIKE', $id)->get();
        }
    }catch(Exception $e){
        return null;
    }
}

function GetIdHijo($id, $persona){
    $idHijo = null;
    switch ($persona) {
        /* PADRES */
        case 'Padre': $idHijo = $id; break;
        case 'Madre': $idHijo = $id; break;
        /* ABUELOS */
        case 'Abuelo Paterno': $idHijo = GetIdPadre($id); break;
        case 'Abuela Paterna': $idHijo = GetIdPadre($id); break;
        case 'Abuelo Materno': $idHijo = GetIdMadre($id); break;
        case 'Abuela Materna': $idHijo = GetIdMadre($id); break;
        /* BISABUELOS */
        case 'Bisabuelo PP': $idHijo = GetIdPadre(GetIdPadre($id)); break;
        case 'Bisabuela PP': $idHijo = GetIdPadre(GetIdPadre($id)); break;
        case 'Bisabuelo PM': $idHijo = GetIdMadre(GetIdPadre($id)); break;
        case 'Bisabuela PM': $idHijo = GetIdMadre(GetIdPadre($id)); break;
        case 'Bisabuelo MP': $idHijo = GetIdPadre(GetIdMadre($id)); break;
        case 'Bisabuela MP': $idHijo = GetIdPadre(GetIdMadre($id)); break;
        case 'Bisabuelo MM': $idHijo = GetIdMadre(GetIdMadre($id)); break;
        case 'Bisabuela MM': $idHijo = GetIdMadre(GetIdMadre($id)); break;
        /* TATARABUELOS */
        case 'Tatarabuelo PPP': $idHijo = GetIdPadre(GetIdPadre(GetIdPadre($id))); break;
        case 'Tatarabuela PPP': $idHijo = GetIdPadre(GetIdPadre(GetIdPadre($id))); break;
        case 'Tatarabuelo PPM': $idHijo = GetIdMadre(GetIdPadre(GetIdPadre($id))); break;
        case 'Tatarabuela PPM': $idHijo = GetIdMadre(GetIdPadre(GetIdPadre($id))); break;
        case 'Tatarabuelo PMP': $idHijo = GetIdPadre(GetIdMadre(GetIdPadre($id))); break;
        case 'Tatarabuela PMP': $idHijo = GetIdPadre(GetIdMadre(GetIdPadre($id))); break;
        case 'Tatarabuelo PMM': $idHijo = GetIdMadre(GetIdMadre(GetIdPadre($id))); break;
        case 'Tatarabuela PMM': $idHijo = GetIdMadre(GetIdMadre(GetIdPadre($id))); break;
        case 'Tatarabuelo MPP': $idHijo = GetIdPadre(GetIdPadre(GetIdMadre($id))); break;
        case 'Tatarabuela MPP': $idHijo = GetIdPadre(GetIdPadre(GetIdMadre($id))); break;
        case 'Tatarabuelo MPM': $idHijo = GetIdMadre(GetIdPadre(GetIdMadre($id))); break;
        case 'Tatarabuela MPM': $idHijo = GetIdMadre(GetIdPadre(GetIdMadre($id))); break;
        case 'Tatarabuelo MMP': $idHijo = GetIdPadre(GetIdMadre(GetIdMadre($id))); break;
        case 'Tatarabuela MMP': $idHijo = GetIdPadre(GetIdMadre(GetIdMadre($id))); break;
        case 'Tatarabuelo MMM': $idHijo = GetIdMadre(GetIdMadre(GetIdMadre($id))); break;
        case 'Tatarabuela MMM': $idHijo = GetIdMadre(GetIdMadre(GetIdMadre($id))); break;
    }

    return $idHijo;
}

/* * * UNIONES * * */

// Obtener uniones
function GetUniones($id){
    $idU = 0;
    $uniones = [];
    try{
        if(Tree::find($id)->sexo == 'M'){
            $hijos = Tree::where('id_padre', 'LIKE', $id)->orderBy('id','ASC')->get();
            foreach ($hijos as $hijo) {
                if(($hijo->id_madre != $idU) && !(is_null($hijo->id_madre))){
                    array_push($uniones, $hijo->id_madre);
                }
                $idU = $hijo->id_madre;
            }
        }else{
            $hijos = Tree::where('id_madre', 'LIKE', $id)->orderBy('id','ASC')->get();
            foreach ($hijos as $hijo) {
                if(($hijo->id_padre != $idU) && !(is_null($hijo->id_padre))){
                    array_push($uniones, $hijo->id_padre);
                }
                $idU = $hijo->id_padre;
            }
        }
        return array_unique($uniones);
    }catch(Exception $e){
        return 'exeption';
    }
}

/* * * NOMBRES * * */

// Obtener nombres
function GetNombres($id){
    try{
        return Tree::find($id)->nombres;
    }catch(Exception $e){
        return null;
    }
}

// Obtener apellido paterno
function GetApellidoPaterno($id){
    try{
        return Tree::find($id)->apellido_padre;
    }catch(Exception $e){
        return null;
    }
}

// Obtener apellido materno
function GetApellidoMaterno($id){
    try{
        return Tree::find($id)->apellido_madre;
    }catch(Exception $e){
        return null;
    }
}

// Obtener apellidos
function GetApellidos($id){
    $paterno = GetApellidoPaterno($id);
    $materno = GetApellidoMaterno($id);
    return $paterno . ' ' . $materno;
}

// Obtener nombre completo
function GetNombreCompleto($id){
    $nombres = GetNombres($id);
    $apellidos = GetApellidos($id);
    return $nombres . ' ' . $apellidos;
}

/* * * NACIMIENTO * * */

// Obtener lugar de nacimiento
function GetLugarNacimiento($id){
    try{
        return Tree::find($id)->lugar_nac;
    }catch(Exception $e){
        return null;
    }
}

// Obtener día de nacimiento
function GetDiaNacimiento($id){
    try{
        return Tree::find($id)->dia_nac;
    }catch(Exception $e){
        return null;
    }
}

// Obtener mes de nacimiento
function GetMesNacimiento($id){
    try{
        return Tree::find($id)->mes_nac;
    }catch(Exception $e){
        return null;
    }
}

// Obtener año de nacimiento
function GetAnhoNacimiento($id){
    try{
        return Tree::find($id)->anho_nac;
    }catch(Exception $e){
        return null;
    }
}

// Obtener datos completos de nacimiento
function GetDatosNacimiento($id){
    $lugar = GetLugarNacimiento($id);
    $dia = GetDiaNacimiento($id);
    $mes = GetMesNacimiento($id);
    $anho = GetAnhoNacimiento($id);
    $datosCompletos = 'Nacimiento: ' . ($lugar ? ($lugar . ', ') : '') . ($dia ? $dia : '--') . ' / '
        . ($mes ? $mes : '--') . ' / ' . ($anho ? $anho : '--');
    return $datosCompletos;
}

/* * * MATRIMONIO * * */

// Obtener lugar de matrimonio
function GetLugarMatrimonio($id){
    try{
        return Tree::find($id)->lugar_matr;
    }catch(Exception $e){
        return null;
    }
}

// Obtener día de matrimonio
function GetDiaMatrimonio($id){
    try{
        return Tree::find($id)->dia_matr;
    }catch(Exception $e){
        return null;
    }
}

// Obtener mes de matrimonio
function GetMesMatrimonio($id){
    try{
        return Tree::find($id)->mes_matr;
    }catch(Exception $e){
        return null;
    }
}

// Obtener año de matrimonio
function GetAnhoMatrimonio($id){
    try{
        return Tree::find($id)->anho_matr;
    }catch(Exception $e){
        return null;
    }
}

// Obtener datos completos de matrimonio
function GetDatosMatrimonio($id){
    $lugar = GetLugarMatrimonio($id);
    $dia = GetDiaMatrimonio($id);
    $mes = GetMesMatrimonio($id);
    $anho = GetAnhoMatrimonio($id);
    $datosCompletos = 'Matrimonio: ' . ($lugar ? ($lugar . ', ') : '') . ($dia ? $dia : '--') . ' / '
        . ($mes ? $mes : '--') . ' / ' . ($anho ? $anho : '--');
    return $datosCompletos;
}

/* * * DEFUNCIÓN * * */

// Obtener lugar de defunción
function GetLugarDefuncion($id){
    try{
        return Tree::find($id)->lugar_def;
    }catch(Exception $e){
        return null;
    }
}

// Obtener día de defunción
function GetDiaDefuncion($id){
    try{
        return Tree::find($id)->dia_def;
    }catch(Exception $e){
        return null;
    }
}

// Obtener mes de defunción
function GetMesDefuncion($id){
    try{
        return Tree::find($id)->mes_def;
    }catch(Exception $e){
        return null;
    }
}

// Obtener año de defunción
function GetAnhoDefuncion($id){
    try{
        return Tree::find($id)->anho_def;
    }catch(Exception $e){
        return null;
    }
}

// Obtener datos completos de defunción
function GetDatosDefuncion($id){
    $lugar = GetLugarDefuncion($id);
    $dia = GetDiaDefuncion($id);
    $mes = GetMesDefuncion($id);
    $anho = GetAnhoDefuncion($id);
    $datosCompletos = 'Defunción: ' . ($lugar ? ($lugar . ', ') : '') . ($dia ? $dia : '--') . ' / '
        . ($mes ? $mes : '--') . ' / ' . ($anho ? $anho : '--');
    return $datosCompletos;
}

/* * * VIDA Y MUERTE * * */
function GetVidaAnho($id){
    $nacimiento = GetAnhoNacimiento($id);
    $defuncion = GetAnhoDefuncion($id);
    return ($nacimiento ? $nacimiento : '--') . ' / ' . ($defuncion ? $defuncion : '--');
}

function GetVidaLugarAnho($id){
    $nacimiento = GetDatosNacimiento($id);
    $defuncion = GetDatosDefuncion($id);
    return $nacimiento . ' - ' . $defuncion;
}

/* * * * * OTRAS FUNCIONES  * * * * */

// Verificar si una persona tiene documentos
function TieneDocumentos($id){
    $documentos = File::where('tree_id', 'LIKE', $id);
    return $documentos->count() ? true : false;
}

// Obtener apellido principal de la aplicación
function GetApellidoPrincipal(){
    try{
        $nombre = null;

        if (Auth()->user()->default_name_family){
            $nombre = Auth()->user()->default_name_family;
        }else{
            if(User::find(1)->default_name_family){
                $nombre = User::find(1)->default_name_family;
            }else{
                $nombre = 'familiar';
            }
        }
        return 'Árbol genealógico ' . $nombre;
    }catch(Exception $e){
        return 'Árbol genealógico familiar';
    }
}

// Obtener persona por defecto
function GetDefaultPerson(){
    try{
        $tree_id = 1;

        if (Auth()->user()->default_tree_id){
            $tree_id = Auth()->user()->default_tree_id;
        }else{
            if(User::find(1)->default_tree_id){
                $tree_id = User::find(1)->default_tree_id;
            }
        }
        return $tree_id;
    }catch(Exception $e){
        return 1;
    }  
}