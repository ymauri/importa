<?php

use Illuminate\Database\Seeder;

class StatesProvinciaCubaTablr extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
	public function run() {
	//

		$municipios = array(	('name' => 'Sandino', 'province' => 'Pinar del Rio', 'cubapack_code' => '010100'),
		('name' =>  'Mantua', 'province' => 'Pinar del Rio', 'cubapack_code' => '010200'),
		( 'name' => 'Minas de Matahambre', 'province' => 'Pinar del Rio', 'cubapack_code' => '010300'),
		( 'name' => 'Viñales', 'province' => 'Pinar del Rio', 'cubapack_code' => '010400'),
		( 'name' => 'La Palma', 'province' => 'Pinar del Rio', 'cubapack_code' => '010500'),
		( 'name' => 'Candelaria', 'province' => 'Pinar del Rio', 'cubapack_code' => '010700'),
		( 'name' => 'San Cristobal', 'province' => 'Pinar del Rio', 'cubapack_code' => '010800'),
		( 'name' => 'Los Palacios', 'province' => 'Pinar del Rio', 'cubapack_code' => '010900'),
		('name' => 'Consolacion del Sur', 'province' => 'Pinar del Rio', 'cubapack_code' => '011000'),
		('name' => 'Pinar del Rio', 'province' => 'Pinar del Rio', 'cubapack_code' => '011100'),
		('name' => 'San Luis', 'province' => 'Pinar del Rio', 'cubapack_code' => '011200'),
		('name' => 'San Juan y Martinez', 'province' => 'Pinar del Rio', 'cubapack_code' => '011300'),
		('name' => 'Guane', 'province' => 'Pinar del Rio', 'cubapack_code' => '011400'),
		('name' => 'Mariel', 'province' => 'Artemisa', 'cubapack_code' => '020100'),
		('name' => 'Guanajay', 'province' => 'Artemisa', 'cubapack_code' => '020200'),
		('name' => 'Caimito', 'province' => 'Artemisa', 'cubapack_code' => '020300'),
		('name' => 'Bauta', 'province' => 'Artemisa', 'cubapack_code' => '020400'),
		('name' => 'San Antonio de los Banos', 'province' => 'Artemisa', 'cubapack_code' => '020500'),
		('name' => 'Guira de Melena', 'province' => 'Artemisa', 'cubapack_code' => '021700'),
		('name' => 'Alquizar', 'province' => 'Artemisa', 'cubapack_code' => '021800'),
		('name' => 'Artemisa', 'province' => 'Artemisa', 'cubapack_code' => '021900'),
		('name' => 'Bahia Honda', 'province' => 'Artemisa', 'cubapack_code' => '022000'),
		('name' => 'San Cristobal', 'province' => 'Artemisa', 'cubapack_code' => '022100'),
		('name' => 'Candelaria', 'province' => 'Artemisa', 'cubapack_code' => '022200'),
		('name' => 'Playa', 'province' => 'La Habana', 'cubapack_code' => '030100'),
		('name' => 'Plaza de la Revolución', 'province' => 'La Habana', 'cubapack_code' => '030200'),
		('name' => 'Centro Habana', 'province' => 'La Habana', 'cubapack_code' => '030300'),
		('name' => 'La Habana Vieja', 'province' => 'La Habana', 'cubapack_code' => '030400'),
		('name' => 'Regla', 'province' => 'La Habana', 'cubapack_code' => '030500'),
		('name' => 'La Habana del Este', 'province' => 'La Habana', 'cubapack_code' => '030600'),
		('name' => 'Guanabacoa', 'province' => 'La Habana', 'cubapack_code' => '030700'),
		('name' => 'San Miguel del Padrón', 'province' => 'La Habana', 'cubapack_code' => '030800'),
		('name' => 'Diez de Octubre', 'province' => 'La Habana', 'cubapack_code' => '030900'),
		('name' => 'Cerro', 'province' => 'La Habana', 'cubapack_code' => '031000'),
		('name' => 'Marianao', 'province' => 'La Habana', 'cubapack_code' => '031100'),
		('name' => 'La Lisa', 'province' => 'La Habana', 'cubapack_code' => '031200'),
		('name' => 'Boyeros', 'province' => 'La Habana', 'cubapack_code' => '031300'),
		('name' => 'Arroyo Naranjo', 'province' => 'La Habana', 'cubapack_code' => '031400'),
		('name' => 'Cotorro', 'province' => 'La Habana', 'cubapack_code' => '031500'),
		('name' => 'Matanzas', 'province' => 'Matanzas', 'cubapack_code' => '040100'),
		('name' => 'Cárdenas', 'province' => 'Matanzas', 'cubapack_code' => '040200'),
		('name' => 'Varadero', 'province' => 'Matanzas', 'cubapack_code' => '040300'),
		('name' => 'Martí', 'province' => 'Matanzas', 'cubapack_code' => '040400'),
		('name' => 'Colon', 'province' => 'Matanzas', 'cubapack_code' => '040500'),
		('name' => 'Perico', 'province' => 'Matanzas', 'cubapack_code' => '040600'),
		('name' => 'Jovellanos', 'province' => 'Matanzas', 'cubapack_code' => '040700'),
		('name' => 'Pedro Betancourt', 'province' => 'Matanzas', 'cubapack_code' => '040800'),
		('name' => 'Limonar', 'province' => 'Matanzas', 'cubapack_code' => '040900'),
		('name' => 'Union de Reyes', 'province' => 'Matanzas', 'cubapack_code' => '041000'),
		('name' => 'Cienaga de Zapata', 'province' => 'Matanzas', 'cubapack_code' => '041100'),
		('name' => 'Jaguey Grande', 'province' => 'Matanzas', 'cubapack_code' => '041200'),
		('name' => 'Calimete', 'province' => 'Matanzas', 'cubapack_code' => '041300'),
		('name' => 'Los Arabos', 'province' => 'Matanzas', 'cubapack_code' => '041400'),
		('name' => 'Corralillo', 'province' => 'Villa Clara', 'cubapack_code' => '050100'),
		('name' => 'Quemado de Guines', 'province' => 'Villa Clara', 'cubapack_code' => '050200'),
		('name' => 'Sagua la Grande', 'province' => 'Villa Clara', 'cubapack_code' => '050300'),
		('name' => 'Encrucijada', 'province' => 'Villa Clara', 'cubapack_code' => '050400'),
		('name' => 'Camajuani', 'province' => 'Villa Clara', 'cubapack_code' => '050500'),
		('name' => 'Caibarien', 'province' => 'Villa Clara', 'cubapack_code' => '050600'),
		('name' => 'Remedios', 'province' => 'Villa Clara', 'cubapack_code' => '050700'),
		('name' => 'Placetas', 'province' => 'Villa Clara', 'cubapack_code' => '050800'),
		('name' => 'Santa Clara', 'province' => 'Villa Clara', 'cubapack_code' => '050900'),
		('name' => 'Cifuentes', 'province' => 'Villa Clara', 'cubapack_code' => '051000'),
		('name' => 'Santo Domingo', 'province' => 'Villa Clara', 'cubapack_code' => '051100'),
		('name' => 'Ranchuelo', 'province' => 'Villa Clara', 'cubapack_code' => '051200'),
		('name' => 'Manicaragua', 'province' => 'Villa Clara', 'cubapack_code' => '051300'),
		('name' => 'Aguada de Pasajeros', 'province' => 'Cienfuegos', 'cubapack_code' => '060100'),
		('name' => 'Rodas', 'province' => 'Cienfuegos', 'cubapack_code' => '060200'),
		('name' => 'Palmira', 'province' => 'Cienfuegos', 'cubapack_code' => '060300'),
		('name' => 'Lajas', 'province' => 'Cienfuegos', 'cubapack_code' => '060400'),
		('name' => 'Cruces', 'province' => 'Cienfuegos', 'cubapack_code' => '060500'),
		('name' => 'Cumanayagua', 'province' => 'Cienfuegos', 'cubapack_code' => '060600'),
		('name' => 'Cienfuegos', 'province' => 'Cienfuegos', 'cubapack_code' => '060700'),
		('name' => 'Abreus', 'province' => 'Cienfuegos', 'cubapack_code' => '060800'),
		('name' => 'Yaguajay', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070100'),
		('name' => 'Jatibonico', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070200'),
		('name' => 'Taguasco', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070300'),
		('name' => 'Cabaiguan', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070400'),
		('name' => 'Fomento', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070500'),
		('name' => 'Trinidad', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070600'),
		('name' => 'Sancti Spiritus', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070700'),
		('name' => 'La Sierpe', 'province' => 'Sancti Spiritus', 'cubapack_code' => '070800'),
		('name' => 'Chambas', 'province' => 'Ciego de Avila', 'cubapack_code' => '080100'),
		('name' => 'Moron', 'province' => 'Ciego de Avila', 'cubapack_code' => '080200'),
		('name' => 'Bolivia', 'province' => 'Ciego de Avila', 'cubapack_code' => '080300'),
		('name' => 'Primero de Enero', 'province' => 'Ciego de Avila', 'cubapack_code' => '080400'),
		('name' => 'Ciro Redondo', 'province' => 'Ciego de Avila', 'cubapack_code' => '080500'),
		('name' => 'Florencia', 'province' => 'Ciego de Avila', 'cubapack_code' => '080600'),
		('name' => 'Majagua', 'province' => 'Ciego de Avila', 'cubapack_code' => '080700'),
		('name' => 'Ciego de Avila', 'province' => 'Ciego de Avila', 'cubapack_code' => '080800'),
		('name' => 'Venezuela', 'province' => 'Ciego de Avila', 'cubapack_code' => '080900'),
		('name' => 'Baragua', 'province' => 'Ciego de Avila', 'cubapack_code' => '081000'),
		('name' => 'Esmeralda', 'province' => 'Camaguey', 'cubapack_code' => '090200'),
		('name' => 'Sierra de Cubitas', 'province' => 'Camaguey', 'cubapack_code' => '090300'),
		('name' => 'Minas', 'province' => 'Camaguey', 'cubapack_code' => '090400'),
		('name' => 'Nuevitas', 'province' => 'Camaguey', 'cubapack_code' => '090500'),
		('name' => 'Guaimaro', 'province' => 'Camaguey', 'cubapack_code' => '090600'),
		('name' => 'Sibanicu', 'province' => 'Camaguey', 'cubapack_code' => '090700'),
		('name' => 'Camaguey', 'province' => 'Camaguey', 'cubapack_code' => '090800'),
		('name' => 'Florida', 'province' => 'Camaguey', 'cubapack_code' => '090900'),
		('name' => 'Vertientes', 'province' => 'Camaguey', 'cubapack_code' => '091000'),
		('name' => 'Jimaguayu', 'province' => 'Camaguey', 'cubapack_code' => '091100'),
		('name' => 'Najasa', 'province' => 'Camaguey', 'cubapack_code' => '091200'),
		('name' => 'Santa Cruz del Sur', 'province' => 'Camaguey', 'cubapack_code' => '091300'),
		('name' => 'Manati', 'province' => 'Las Tunas', 'cubapack_code' => '100100'),
		('name' => 'Jesus Menendez', 'province' => 'Las Tunas', 'cubapack_code' => '100300'),
		('name' => 'Majibacoa', 'province' => 'Las Tunas', 'cubapack_code' => '100400'),
		('name' => 'Las Tunas', 'province' => 'Las Tunas', 'cubapack_code' => '100500'),
		('name' => 'Jobabo', 'province' => 'Las Tunas', 'cubapack_code' => '100600'),
		('name' => 'Colombia', 'province' => 'Las Tunas', 'cubapack_code' => '100700'),
		('name' => 'Amancio', 'province' => 'Las Tunas', 'cubapack_code' => '100800'),
		('name' => 'Holguin', 'province' => 'Holguin', 'cubapack_code' => '110100'),
		('name' => 'Gibara', 'province' => 'Holguin', 'cubapack_code' => '110200'),
		('name' => 'Banes', 'province' => 'Holguin', 'cubapack_code' => '110400'),
		('name' => 'Antilla', 'province' => 'Holguin', 'cubapack_code' => '110500'),
		('name' => 'Baguanos', 'province' => 'Holguin', 'cubapack_code' => '110600'),
		('name' => 'Calixto Garcia', 'province' => 'Holguin', 'cubapack_code' => '110700'),
		('name' => 'Cacocum', 'province' => 'Holguin', 'cubapack_code' => '110800'),
		('name' => 'Urbano Noris', 'province' => 'Holguin', 'cubapack_code' => '110900'),
		('name' => 'Cueto', 'province' => 'Holguin', 'cubapack_code' => '111000'),
		('name' => 'Mayari', 'province' => 'Holguin', 'cubapack_code' => '111100'),
		('name' => 'Frank Pais', 'province' => 'Holguin', 'cubapack_code' => '111200'),
		('name' => 'Sagua de Tanamo', 'province' => 'Holguin', 'cubapack_code' => '111300'),
		('name' =>  'Moa', 'province' => 'Holguin', 'cubapack_code' => '111400'),
		('name' =>  'Rio Cauto', 'province' => 'Granma', 'cubapack_code' => '120100'),
		('name' => 'Cauto Cristo', 'province' => 'Granma', 'cubapack_code' => '120200'),
		('name' => 'Jiguani', 'province' => 'Granma', 'cubapack_code' => '120300'),
		('name' => 'Yara', 'province' => 'Granma', 'cubapack_code' => '120500'),
		('name' => 'Manzanillo', 'province' => 'Granma', 'cubapack_code' => '120600'),
		('name' => 'Campechuela', 'province' => 'Granma', 'cubapack_code' => '120700'),
		('name' => 'Niquero', 'province' => 'Granma', 'cubapack_code' => '120900'),
		('name' => 'Media Luna', 'province' => 'Granma', 'cubapack_code' => '120800'),
		('name' => 'Pilon', 'province' => 'Granma', 'cubapack_code' => '121000'),
		('name' => 'Bartolome Maso', 'province' => 'Granma', 'cubapack_code' => '121100'),
		('name' => 'Buey Arriba', 'province' => 'Granma', 'cubapack_code' => '121200'),
		('name' => 'Guisa', 'province' => 'Granma', 'cubapack_code' => '121300'),
		('name' => 'Contramaestre', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130100'),
		('name' => 'Mella', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130200'),
		('name' => 'San Luis', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130300'),
		('name' => 'Segundo Frente', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130400'),
		('name' => 'Santiago de Cuba', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130600'),
		('name' => 'Palma Soriano', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130700'),
		('name' => 'Tercer Frente', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130800'),
		('name' => 'Guama', 'province' => 'Santiago de Cuba', 'cubapack_code' => '130900'),
		('name' => 'El Salvador', 'province' => 'Guantánamo', 'cubapack_code' => '140100'),
		('name' =>  'Guantanamo', 'province' => 'Guantánamo', 'cubapack_code' => '140200'),
		('name' => 'Yateras', 'province' => 'Guantánamo', 'cubapack_code' => '140300'),
		('name' => 'Baracoa', 'province' => 'Guantánamo', 'cubapack_code' => '140400'),
		('name' => 'Maisi', 'province' => 'Guantánamo', 'cubapack_code' => '140500'),
		('name' => 'Imias', 'province' => 'Guantánamo', 'cubapack_code' => '140600'),
		('name' => 'San Antonio del Sur', 'province' => 'Guantánamo', 'cubapack_code' => '140700'),
		('name' => 'Manuel Tames', 'province' => 'Guantánamo', 'cubapack_code' => '140800'),
		('name' => 'Caimanera', 'province' => 'Guantánamo', 'cubapack_code' => '140900'),
		('name' => 'Niceto Perez', 'province' => 'Guantánamo', 'cubapack_code' => '141000'),
		('name' => 'Gerona', 'province' => 'Isla de la Juventud', 'cubapack_code' => '150100'),
		('name' => 'La Fe', 'province' => 'Isla de la Juventud', 'cubapack_code' => '150200'),
		('name' => 'Bejucal', 'province' => 'Mayabeque', 'cubapack_code' => '160100'),
		('name' => 'Quivican', 'province' => 'Mayabeque', 'cubapack_code' => '160200'),
		('name' => 'Batabano', 'province' => 'Mayabeque', 'cubapack_code' => '160300'),
		('name' => 'San Jose de las Lajas', 'province' => 'Mayabeque', 'cubapack_code' => '160400'),
		('name' => 'Melena del Sur', 'province' => 'Mayabeque', 'cubapack_code' => '160500'),
		('name' => 'Guines', 'province' => 'Mayabeque', 'cubapack_code' => '160600'),
		('name' => 'San Nicolas', 'province' => 'Mayabeque', 'cubapack_code' => '160700'),
		('name' => 'Nueva Paz', 'province' => 'Mayabeque', 'cubapack_code' => '160800'),
		('name' => 'Madruga', 'province' => 'Mayabeque', 'cubapack_code' => '160900'),
		('name' => 'Jaruco', 'province' => 'Mayabeque', 'cubapack_code' => '161000'),
		('name' => 'Santa Cruz del Norte', 'province' => 'Mayabeque', 'cubapack_code' => '161100'),
		('name' => 'Bayamo', 'province' => 'Granma', 'cubapack_code' => '120400'));

		$states = array(
				array('name' => "Pinar del Rio",'id_country' => 55)
				array('name' => "Artemisa",'id_country' => 55)
				array('name' => "La Habana",'id_country' => 55)
				array('name' => "Mayabeque",'id_country' => 55)
				array('name' => "Matanzas",'id_country' => 55)
				array('name' => "Villa Clara",'id_country' => 55)
				array('name' => "Cienfuegos",'id_country' => 55)
				array('name' => "Sancti Spiritus",'id_country' => 55)
				array('name' => "Ciego de Avila",'id_country' => 55)
				array('name' => "Camaguey",'id_country' => 55)
				array('name' => "Las Tunas",'id_country' => 55)
				array('name' => "Holguin",'id_country' => 55)
				array('name' => "Granma",'id_country' => 55)
				array('name' => "Santiago de Cuba",'id_country' => 55)
				array('name' => "Guantánamo",'id_country' => 55)
				array('name' => "Isla de la Juventud",'id_country' => 55)
				

			);
			foreach($states as $value){
				$id_state = DB::table('imp_state')->insertGetId(
					'name' => $value['name'],
					'id_country' => $value['id_country']
				);
				foreach ($municipios as $key) {
					if($value['name'] == $key['province']){
						DB::table('imp_city')->insert(
									'name' => $key['name'],
									'cubapack_code' => $key['cubapack_code'],
									'id_state' => $id_state
						);
					}
				}
			}
		
	}
}