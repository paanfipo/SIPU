<?php

use Illuminate\Database\Seeder;
use App\Departamento;

class CiudadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $departamento = Departamento::select("*")->where("nombre","VALLE DEL CAUCA")->get();

        if(count($departamento) > 0){

            DB::table('ciudades')->insert([
                'nombre' => 'Alcalá',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Andalucía',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Ansermanuevo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Argelia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Bolívar',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Buenaventura',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Buga',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Bugalagrande',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Caicedonia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Cali',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Calima - El Darién',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Candelaria',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Cartago',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Dagua',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Águila',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Cairo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Cerrito',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Dovio',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Florida',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Ginebra',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Guacarí',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Jamundí',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Cumbre',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Unión',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Victoria',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Obando',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Palmira',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Pradera',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Restrepo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Riofrío',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Roldanillo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'San Pedro',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Sevilla',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Toro',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Tuluá',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Ulloa',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Versalles',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Vijes',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Yotoco',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Yumbo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Zarzal',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);


        }

        $departamento = Departamento::select("*")->where("nombre","CALDAS")->get();

        if(count($departamento) > 0){

            DB::table('ciudades')->insert([
                'nombre' => 'Filadelfia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Merced',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Marmato',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Riosucio',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Supía',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Manzanares',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Marquetalia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Marulanda',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Pensilvania',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Anserma',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Belalcázar',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Risaralda',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'San José',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Viterbo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Chinchiná',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Manizales',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Neira',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Palestina',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Villamaría',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Dorada',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Norcasia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Samaná',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Victoria',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Aguadas',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Aranzazu',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Pácora',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Salamina',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

        }

        $departamento = Departamento::select("*")->where("nombre","CAQUETA")->get();

        if(count($departamento) > 0){

            DB::table('ciudades')->insert([
                'nombre' => 'Albania',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Belén de los Andaquíes',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Cartagena del Chairá',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Curillo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Doncello',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Paujil',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Florencia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Montañita',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Morelia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Puerto Milán',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Puerto Rico',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'San José del Fragua',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'San Vicente del Caguán',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Solano',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Solita',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Valparaíso',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

        }

        $departamento = Departamento::select("*")->where("nombre","CAUCA")->get();

        if(count($departamento) > 0){

            DB::table('ciudades')->insert([
                'nombre' => 'Buenos Aires',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Caloto',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Corinto',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Guachené',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Miranda',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Padilla',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Puerto Tejada',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Santander de Quilichao',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Suárez',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Villa Rica',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Cajibío',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'El Tambo',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Sierra',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Morales',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Piendamó',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Popayán',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Rosas',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Sotará',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Timbío',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Almaguer',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Argelia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Balboa',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Bolívar',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Florencia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'La Vega',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Mercaderes',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Patía',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Piamonte',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'San Sebastián',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Santa Rosa',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Sucre',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Guapi',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'López de Micay',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Timbiquí',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Caldono',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Inzá',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Jambaló',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Páez',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Puracé - Coconuco',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Silvia',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Toribío',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);

            DB::table('ciudades')->insert([
                'nombre' => 'Totoró',
                'codigo_dane' => '',
                'observacion' => '',
                'departamento_id' => $departamento[0]->id,
                'estado' => true,
            ]);
        }


    }
}
