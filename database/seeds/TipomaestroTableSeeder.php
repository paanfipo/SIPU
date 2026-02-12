<?php

use Illuminate\Database\Seeder;
use App\TipoMaestro;
use App\TipoMaestroItem;
use App\User;

class TipomaestroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::role('Administrador')->get();

        DB::table('tipomaestro')->insert([

            'nombre' => 'Documentos',
            'estado' => true,
            'observacion' => "TIPO DE DOCUMENTO DE IDENTIFICACIÓN"
        ]);
            DB::table('tipomaestroitem')->insert([

                'tipomaestro_id' => 1,
                'nombre' => 'CEDULA DE CIUDADANIA',
                'numitem' => 1,
                'estado' => true,
                'observacion' => ""
            ]);

            DB::table('tipomaestroitem')->insert([

                'tipomaestro_id' => 1,
                'nombre' => 'CEDULA EXTRANJERIA',
                'numitem' => 2,
                'estado' => true,
                'observacion' => ""
            ]);

            DB::table('tipomaestroitem')->insert([

                'tipomaestro_id' => 1,
                'nombre' => 'PASAPORTE',
                'numitem' => 3,
                'estado' => true,
                'observacion' => ""
            ]);


        $sexo = new TipoMaestro;
        $sexo->nombre = "Sexo";
        $sexo->observacion = "Sexo";
        $sexo->estado = 1;
        $sexo->user_created_at = $user[0]->id;
        $sexo->save();
                
                $hombre = new TipoMaestroItem();
                $hombre->nombre = "Hombre";
                $hombre->numitem = 1;
                $hombre->observacion = "Hombre";
                $hombre->estado = 1;
                $hombre->tipomaestro_id = $sexo->id;
                $hombre->user_created_at = $user[0]->id;
                $hombre->save();

                $mujer = new TipoMaestroItem();
                $mujer->nombre = "Mujer";
                $mujer->numitem = 2;
                $mujer->observacion = "Mujer";
                $mujer->estado = 1;
                $mujer->tipomaestro_id = $sexo->id;
                $mujer->user_created_at = $user[0]->id;
                $mujer->save();

        $etnia = new TipoMaestro;
        $etnia->nombre = "Etnia";
        $etnia->observacion = "Etnia";
        $etnia->estado = 1;
        $etnia->user_created_at = $user[0]->id;
        $etnia->save();
                
                $afro = new TipoMaestroItem();
                $afro->nombre = "Afrocolombiana";
                $afro->numitem = 1;
                $afro->observacion = "Afrocolombiana";
                $afro->estado = 1;
                $afro->tipomaestro_id = $etnia->id;
                $afro->user_created_at = $user[0]->id;
                $afro->save();

                $indigena = new TipoMaestroItem();
                $indigena->nombre = "Indígena";
                $indigena->numitem = 2;
                $indigena->observacion = "Indígena";
                $indigena->estado = 1;
                $indigena->tipomaestro_id = $etnia->id;
                $indigena->user_created_at = $user[0]->id;
                $indigena->save();

                $mestiza = new TipoMaestroItem();
                $mestiza->nombre = "Mestiza";
                $mestiza->numitem = 3;
                $mestiza->observacion = "Mestiza";
                $mestiza->estado = 1;
                $mestiza->tipomaestro_id = $etnia->id;
                $mestiza->user_created_at = $user[0]->id;
                $mestiza->save();

                $ninguna = new TipoMaestroItem();
                $ninguna->nombre = "Ninguna";
                $ninguna->numitem = 4;
                $ninguna->observacion = "Ninguna";
                $ninguna->estado = 1;
                $ninguna->tipomaestro_id = $etnia->id;
                $ninguna->user_created_at = $user[0]->id;
                $ninguna->save();

        $nivel_estudio = new TipoMaestro;
        $nivel_estudio->nombre = "Nivel de estudios";
        $nivel_estudio->observacion = "Nivel de estudios";
        $nivel_estudio->estado = 1;
        $nivel_estudio->user_created_at = $user[0]->id;
        $nivel_estudio->save();
                
                $primaria = new TipoMaestroItem();
                $primaria->nombre = "Primaria";
                $primaria->numitem = 1;
                $primaria->observacion = "Primaria";
                $primaria->estado = 1;
                $primaria->tipomaestro_id = $nivel_estudio->id;
                $primaria->user_created_at = $user[0]->id;
                $primaria->save();

                $secundaria = new TipoMaestroItem();
                $secundaria->nombre = "Secundaria";
                $secundaria->numitem = 2;
                $secundaria->observacion = "Secundaria";
                $secundaria->estado = 1;
                $secundaria->tipomaestro_id = $nivel_estudio->id;
                $secundaria->user_created_at = $user[0]->id;
                $secundaria->save();

                $tecnico = new TipoMaestroItem();
                $tecnico->nombre = "Tecnico";
                $tecnico->numitem = 3;
                $tecnico->observacion = "Tecnico";
                $tecnico->estado = 1;
                $tecnico->tipomaestro_id = $nivel_estudio->id;
                $tecnico->user_created_at = $user[0]->id;
                $tecnico->save();

                $tecnologo = new TipoMaestroItem();
                $tecnologo->nombre = "Tecnológico";
                $tecnologo->numitem = 4;
                $tecnologo->observacion = "Tecnológico";
                $tecnologo->estado = 1;
                $tecnologo->tipomaestro_id = $nivel_estudio->id;
                $tecnologo->user_created_at = $user[0]->id;
                $tecnologo->save();

                $uni = new TipoMaestroItem();
                $uni->nombre = "Universitario";
                $uni->numitem = 5;
                $uni->observacion = "Universitario";
                $uni->estado = 1;
                $uni->tipomaestro_id = $nivel_estudio->id;
                $uni->user_created_at = $user[0]->id;
                $uni->save();

                $pos = new TipoMaestroItem();
                $pos->nombre = "Posgrado";
                $pos->numitem = 5;
                $pos->observacion = "Posgrado";
                $pos->estado = 1;
                $pos->tipomaestro_id = $nivel_estudio->id;
                $pos->user_created_at = $user[0]->id;
                $pos->save();

                $capa = new TipoMaestroItem();
                $capa->nombre = "Capacitaciones o cursos de emprendimiento";
                $capa->numitem = 5;
                $capa->observacion = "Capacitaciones o cursos de emprendimiento";
                $capa->estado = 1;
                $capa->tipomaestro_id = $nivel_estudio->id;
                $capa->user_created_at = $user[0]->id;
                $capa->save();

        $fase_emprendimiento = new TipoMaestro;
        $fase_emprendimiento->nombre = "Fases del emprendimiento";
        $fase_emprendimiento->observacion = "Fases del emprendimiento";
        $fase_emprendimiento->estado = 1;
        $fase_emprendimiento->user_created_at = $user[0]->id;
        $fase_emprendimiento->save();
                
                $vision = new TipoMaestroItem();
                $vision->nombre = "Visión de la idea";
                $vision->numitem = 1;
                $vision->observacion = "Visión de la idea";
                $vision->estado = 1;
                $vision->tipomaestro_id = $fase_emprendimiento->id;
                $vision->user_created_at = $user[0]->id;
                $vision->save();

                $idea = new TipoMaestroItem();
                $idea->nombre = "Idea sin validación";
                $idea->numitem = 2;
                $idea->observacion = "Idea sin validación";
                $idea->estado = 1;
                $idea->tipomaestro_id = $fase_emprendimiento->id;
                $idea->user_created_at = $user[0]->id;
                $idea->save();

                $proto = new TipoMaestroItem();
                $proto->nombre = "Prototipo sin validación";
                $proto->numitem = 3;
                $proto->observacion = "Prototipo sin validación";
                $proto->estado = 1;
                $proto->tipomaestro_id = $fase_emprendimiento->id;
                $proto->user_created_at = $user[0]->id;
                $proto->save();

                $idea_pro = new TipoMaestroItem();
                $idea_pro->nombre = "Idea/prototipo validado";
                $idea_pro->numitem = 4;
                $idea_pro->observacion = "Idea/prototipo validado";
                $idea_pro->estado = 1;
                $idea_pro->tipomaestro_id = $fase_emprendimiento->id;
                $idea_pro->user_created_at = $user[0]->id;
                $idea_pro->save();

                $formulacion = new TipoMaestroItem();
                $formulacion->nombre = "Formulación de modelo de negocio";
                $formulacion->numitem = 5;
                $formulacion->observacion = "Formulación de modelo de negocio";
                $formulacion->estado = 1;
                $formulacion->tipomaestro_id = $fase_emprendimiento->id;
                $formulacion->user_created_at = $user[0]->id;
                $formulacion->save();

                $puesta_marcha = new TipoMaestroItem();
                $puesta_marcha->nombre = "Puesta en marcha (1-6 meses de funcionamiento)";
                $puesta_marcha->numitem = 6;
                $puesta_marcha->observacion = "Puesta en marcha (1-6 meses de funcionamiento)";
                $puesta_marcha->estado = 1;
                $puesta_marcha->tipomaestro_id = $fase_emprendimiento->id;
                $puesta_marcha->user_created_at = $user[0]->id;
                $puesta_marcha->save();

                $incubacion = new TipoMaestroItem();
                $incubacion->nombre = "Incubación(6-12 meses)";
                $incubacion->numitem = 7;
                $incubacion->observacion = "Incubación(6-12 meses)";
                $incubacion->estado = 1;
                $incubacion->tipomaestro_id = $fase_emprendimiento->id;
                $incubacion->user_created_at = $user[0]->id;
                $incubacion->save();

                $crecimiento = new TipoMaestroItem();
                $crecimiento->nombre = "Crecimiento (1-3 años)";
                $crecimiento->numitem = 8;
                $crecimiento->observacion = "Crecimiento (1-3 años)";
                $crecimiento->estado = 1;
                $crecimiento->tipomaestro_id = $fase_emprendimiento->id;
                $crecimiento->user_created_at = $user[0]->id;
                $crecimiento->save();

        $tipo_zona = new TipoMaestro;
        $tipo_zona->nombre = "Tipo de zona";
        $tipo_zona->observacion = "Tipo de zona";
        $tipo_zona->estado = 1;
        $tipo_zona->user_created_at = $user[0]->id;
        $tipo_zona->save();
                
                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Urbana";
                $urbana->numitem = 1;
                $urbana->observacion = "Urbana";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $tipo_zona->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Rural";
                $urbana->numitem = 2;
                $urbana->observacion = "Rural";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $tipo_zona->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

        $sector_economico = new TipoMaestro;
        $sector_economico->nombre = "Sector Económico";
        $sector_economico->observacion = "Sector Económico";
        $sector_economico->estado = 1;
        $sector_economico->user_created_at = $user[0]->id;
        $sector_economico->save();
                        
                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Agrícola";
                $urbana->numitem = 1;
                $urbana->observacion = "Agrícola";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Transporte";
                $urbana->numitem = 2;
                $urbana->observacion = "Transporte";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Servicios";
                $urbana->numitem = 3;
                $urbana->observacion = "Servicios";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Agroindustrial";
                $urbana->numitem = 4;
                $urbana->observacion = "Agroindustrial";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Educación";
                $urbana->numitem = 5;
                $urbana->observacion = "Educación";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $urbana = new TipoMaestroItem();
                $urbana->nombre = "Social";
                $urbana->numitem = 6;
                $urbana->observacion = "Social";
                $urbana->estado = 1;
                $urbana->tipomaestro_id = $sector_economico->id;
                $urbana->user_created_at = $user[0]->id;
                $urbana->save();

                $ninguna = new TipoMaestroItem();
                $ninguna->nombre = "Ninguna";
                $ninguna->numitem = 7;
                $ninguna->observacion = "Ninguna";
                $ninguna->estado = 1;
                $ninguna->tipomaestro_id = $sector_economico->id;
                $ninguna->user_created_at = $user[0]->id;
                $ninguna->save();

        $tipo_contrato = new TipoMaestro;
        $tipo_contrato->nombre = "TIPO CONTRATO";
        $tipo_contrato->observacion = "TIPO CONTRATO";
        $tipo_contrato->estado = 1;
        $tipo_contrato->user_created_at = $user[0]->id;
        $tipo_contrato->save();

            DB::table('tipomaestroitem')->insert([
                
                'tipomaestro_id' => $tipo_contrato->id,
                'nombre' => 'TERMINO FIJO',
                'numitem' => 1,
                'estado' => true,
                'observacion' => ""
            ]);

            DB::table('tipomaestroitem')->insert([

                'tipomaestro_id' => $tipo_contrato->id,
                'nombre' => 'OBRA O LABOR',
                'numitem' => 2,
                'estado' => true,
                'observacion' => ""
            ]);
            
            DB::table('tipomaestroitem')->insert([

                'tipomaestro_id' => $tipo_contrato->id,
                'nombre' => 'TERMINO INDEFINIDO',
                'numitem' => 3,
                'estado' => true,
                'observacion' => ""
            ]);

        $tipo_empresa = new TipoMaestro;
        $tipo_empresa->nombre = "Tipos de empresas";
        $tipo_empresa->observacion = "Tipos de empresas";
        $tipo_empresa->estado = 1;
        $tipo_empresa->user_created_at = $user[0]->id;
        $tipo_empresa->save();
                            
            $individual = new TipoMaestroItem();
            $individual->nombre = "Individual";
            $individual->numitem = 1;
            $individual->observacion = "Individual";
            $individual->estado = 1;
            $individual->tipomaestro_id = $tipo_empresa->id;
            $individual->user_created_at = $user[0]->id;
            $individual->save();

            $sociedad = new TipoMaestroItem();
            $sociedad->nombre = "Sociedad";
            $sociedad->numitem = 1;
            $sociedad->observacion = "Sociedad";
            $sociedad->estado = 1;
            $sociedad->tipomaestro_id = $tipo_empresa->id;
            $sociedad->user_created_at = $user[0]->id;
            $sociedad->save();

            $familiar = new TipoMaestroItem();
            $familiar->nombre = "Familiar";
            $familiar->numitem = 1;
            $familiar->observacion = "Familiar";
            $familiar->estado = 1;
            $familiar->tipomaestro_id = $tipo_empresa->id;
            $familiar->user_created_at = $user[0]->id;
            $familiar->save();

            $asociativa = new TipoMaestroItem();
            $asociativa->nombre = "Asociativa o de economía solidaria";
            $asociativa->numitem = 1;
            $asociativa->observacion = "Asociativa o de economía solidaria";
            $asociativa->estado = 1;
            $asociativa->tipomaestro_id = $tipo_empresa->id;
            $asociativa->user_created_at = $user[0]->id;
            $asociativa->save();

        $ruta_empresarial = new TipoMaestro;
        $ruta_empresarial->nombre = "Ruta empresarial";
        $ruta_empresarial->observacion = "Ruta empresarial";
        $ruta_empresarial->estado = 1;
        $ruta_empresarial->user_created_at = $user[0]->id;
        $ruta_empresarial->save();
                            
            $ruta_modulo = new TipoMaestroItem();
            $ruta_modulo->nombre = "Ruta módulos";
            $ruta_modulo->numitem = 1;
            $ruta_modulo->observacion = "Módulos";
            $ruta_modulo->estado = 1;
            $ruta_modulo->tipomaestro_id = $ruta_empresarial->id;
            $ruta_modulo->user_created_at = $user[0]->id;
            $ruta_modulo->save();

            $ruta_acompañamiento = new TipoMaestroItem();
            $ruta_acompañamiento->nombre = "Ruta tipo de acompañamiento";
            $ruta_acompañamiento->numitem = 1;
            $ruta_acompañamiento->observacion = "Ruta tipo de acompañamiento";
            $ruta_acompañamiento->estado = 1;
            $ruta_acompañamiento->tipomaestro_id = $ruta_empresarial->id;
            $ruta_acompañamiento->user_created_at = $user[0]->id;
            $ruta_acompañamiento->save();


        
        $ruta_modulo = new TipoMaestro;
        $ruta_modulo->nombre = "Ruta Módulo";
        $ruta_modulo->observacion = "Ruta Módulo";
        $ruta_modulo->estado = 1;
        $ruta_modulo->user_created_at = $user[0]->id;
        $ruta_modulo->save();
                                
                $ruta_mercado = new TipoMaestroItem();
                $ruta_mercado->nombre = "Mercados (Investigación, Estrategias, Proyección de ventas)";
                $ruta_mercado->numitem = 1;
                $ruta_mercado->observacion = "Mercados (Investigación, Estrategias, Proyección de ventas)";
                $ruta_mercado->estado = 1;
                $ruta_mercado->tipomaestro_id = $ruta_modulo->id;
                $ruta_mercado->user_created_at = $user[0]->id;
                $ruta_mercado->save();

                $ruta_operacion = new TipoMaestroItem();
                $ruta_operacion->nombre = "Operaciones (Plan de Compras, Operación, Costos de Producción, Infraestructura)";
                $ruta_operacion->numitem = 2;
                $ruta_operacion->observacion = "Operaciones (Plan de Compras, Operación, Costos de Producción, Infraestructura)";
                $ruta_operacion->estado = 1;
                $ruta_operacion->tipomaestro_id = $ruta_modulo->id;
                $ruta_operacion->user_created_at = $user[0]->id;
                $ruta_operacion->save();

                $ruta_organizacional = new TipoMaestroItem();
                $ruta_organizacional->nombre = "Organizacional (Estrategia, Estructura, Aspectos legales, Costos Ad/tivos) Finanzas (Ingresos, Egresos, Capital de Trabajo)";
                $ruta_organizacional->numitem = 3;
                $ruta_organizacional->observacion = "Organizacional (Estrategia, Estructura, Aspectos legales, Costos Ad/tivos) Finanzas (Ingresos, Egresos, Capital de Trabajo)";
                $ruta_organizacional->estado = 1;
                $ruta_organizacional->tipomaestro_id = $ruta_modulo->id;
                $ruta_organizacional->user_created_at = $user[0]->id;
                $ruta_organizacional->save();

                $ruta_operativo = new TipoMaestroItem();
                $ruta_operativo->nombre = "Plan Operativo (Cronograma Actividades, Metas Sociales)";
                $ruta_operativo->numitem = 4;
                $ruta_operativo->observacion = "Plan Operativo (Cronograma Actividades, Metas Sociales)";
                $ruta_operativo->estado = 1;
                $ruta_operativo->tipomaestro_id = $ruta_modulo->id;
                $ruta_operativo->user_created_at = $user[0]->id;
                $ruta_operativo->save();

                $ruta_operativo = new TipoMaestroItem();
                $ruta_operativo->nombre = "Inclusión y reconocimiento social";
                $ruta_operativo->numitem = 5;
                $ruta_operativo->observacion = "Inclusión y reconocimiento social";
                $ruta_operativo->estado = 1;
                $ruta_operativo->tipomaestro_id = $ruta_modulo->id;
                $ruta_operativo->user_created_at = $user[0]->id;
                $ruta_operativo->save();

        $ruta_acompañamiento = new TipoMaestro;
        $ruta_acompañamiento->nombre = "Ruta tipo acompañamiento";
        $ruta_acompañamiento->observacion = "Ruta tipo acompañamiento";
        $ruta_acompañamiento->estado = 1;
        $ruta_acompañamiento->user_created_at = $user[0]->id;
        $ruta_acompañamiento->save();

                $ruta_mercado = new TipoMaestroItem();
                $ruta_mercado->nombre = "Asesoría específica";
                $ruta_mercado->numitem = 1;
                $ruta_mercado->observacion = "Asesoría específica";
                $ruta_mercado->estado = 1;
                $ruta_mercado->tipomaestro_id = $ruta_acompañamiento->id;
                $ruta_mercado->user_created_at = $user[0]->id;
                $ruta_mercado->save();

                $ruta_mercado = new TipoMaestroItem();
                $ruta_mercado->nombre = "Pasantía / Práctica";
                $ruta_mercado->numitem = 2;
                $ruta_mercado->observacion = "Pasantía / Práctica";
                $ruta_mercado->estado = 1;
                $ruta_mercado->tipomaestro_id = $ruta_acompañamiento->id;
                $ruta_mercado->user_created_at = $user[0]->id;
                $ruta_mercado->save();

        $ofertas = new TipoMaestro;
        $ofertas->nombre = "Ofertas";
        $ofertas->observacion = "Ofertas";
        $ofertas->estado = 1;
        $ofertas->user_created_at = $user[0]->id;
        $ofertas->save();
                                
                $laboral = new TipoMaestroItem();
                $laboral->nombre = "Laborales";
                $laboral->numitem = 1;
                $laboral->observacion = "Laborales";
                $laboral->estado = 1;
                $laboral->tipomaestro_id = $ofertas->id;
                $laboral->user_created_at = $user[0]->id;
                $laboral->save();

                $laboral = new TipoMaestroItem();
                $laboral->nombre = "Practicas";
                $laboral->numitem = 2;
                $laboral->observacion = "Practicas";
                $laboral->estado = 1;
                $laboral->tipomaestro_id = $ofertas->id;
                $laboral->user_created_at = $user[0]->id;
                $laboral->save();

                $laboral = new TipoMaestroItem();
                $laboral->nombre = "Monitorias";
                $laboral->numitem = 3;
                $laboral->observacion = "Monitorias";
                $laboral->estado = 1;
                $laboral->tipomaestro_id = $ofertas->id;
                $laboral->user_created_at = $user[0]->id;
                $laboral->save();

        $estado_civil = new TipoMaestro;
        $estado_civil->nombre = "Estado Civil";
        $estado_civil->observacion = "Estado Civil";
        $estado_civil->estado = 1;
        $estado_civil->user_created_at = $user[0]->id;
        $estado_civil->save();
                                        
            $solter = new TipoMaestroItem();
            $solter->nombre = "Soltero";
            $solter->numitem = 1;
            $solter->observacion = "Soltero";
            $solter->estado = 1;
            $solter->tipomaestro_id = $estado_civil->id;
            $solter->user_created_at = $user[0]->id;
            $solter->save();

            $casado = new TipoMaestroItem();
            $casado->nombre = "Casado";
            $casado->numitem = 1;
            $casado->observacion = "Casado";
            $casado->estado = 1;
            $casado->tipomaestro_id = $estado_civil->id;
            $casado->user_created_at = $user[0]->id;
            $casado->save();

            $divorciado = new TipoMaestroItem();
            $divorciado->nombre = "Divorciado";
            $divorciado->numitem = 1;
            $divorciado->observacion = "Divorciado";
            $divorciado->estado = 1;
            $divorciado->tipomaestro_id = $estado_civil->id;
            $divorciado->user_created_at = $user[0]->id;
            $divorciado->save();

            $unionlibre = new TipoMaestroItem();
            $unionlibre->nombre = "Unión Libre";
            $unionlibre->numitem = 1;
            $unionlibre->observacion = "Unión Libre";
            $unionlibre->estado = 1;
            $unionlibre->tipomaestro_id = $estado_civil->id;
            $unionlibre->user_created_at = $user[0]->id;
            $unionlibre->save();

        $universidad = new TipoMaestro();
        $universidad->nombre = "Universidad";
        $universidad->observacion = "Universidad";
        $universidad->estado = 1;
        $universidad->user_created_at = $user[0]->id;
        $universidad->save();

            $universidadValle = new TipoMaestroItem();
            $universidadValle->nombre = "Universidad del Valle";
            $universidadValle->numitem = 1;
            $universidadValle->observacion = "Salones de UniValle";
            $universidadValle->estado = 1;
            $universidadValle->tipomaestro_id = $universidad->id;
            $universidadValle->user_created_at = $user[0]->id;
            $universidadValle->save();

            $universidadCauca = new TipoMaestroItem();
            $universidadCauca->nombre = "Universidad del Cauca";
            $universidadCauca->numitem = 2;
            $universidadCauca->observacion = "Salones de UniCauca";
            $universidadCauca->estado = 1;
            $universidadCauca->tipomaestro_id = $universidad->id;
            $universidadCauca->user_created_at = $user[0]->id;
            $universidadCauca->save();
        
    }
}
