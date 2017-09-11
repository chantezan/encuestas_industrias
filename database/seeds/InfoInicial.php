<?php

use Illuminate\Database\Seeder;

class InfoInicial extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            array(
                array(
                    'id'            => 1,
                    'nombre'          => 'profesor'),
                array(
                    'id'            => 2,
                    'nombre'          => 'auxiliar'),
                array(
                    'id'            => 3,
                    'nombre'          => 'coordinador')
            )
        );

        DB::table('tipos')->insert(
            array(
                array(
                    'id'            => 1,
                    'nombre'          => 'TEÓRICO'),
                array(
                    'id'            => 2,
                    'nombre'          => 'TALLER'),
                array(
                    'id'            => 3,
                    'nombre'          => 'TEÓRICO COORDINADO'),
                array(
                    'id'            => 4,
                    'nombre'          => 'TALLER COORDINADO')
            )
        );

        DB::table('preguntas')->insert(
            array(
                array(
                    'id'            => 1,
                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se expresa de forma clara, facilitando que se logren los resultados de aprendizajes esperados?',
                    'profesor'          => 1,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'id_tipo'          =>   2),
                array(
                    'id'            => 2,
                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se da tiempo para responder dudas que presentan los alumnos?',
                    'profesor'          => 1,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'id_tipo'          =>   2),
                array(
                    'id'            => 3,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Clases expositivas',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 4,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Material de apoyo',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 5,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Clases auxiliares',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 6,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Proyecto semestral',
                    'id_tipo'          =>   2),
                array(
                    'id'            =>7,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Presentaciones orales',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 9,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de contenido',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 10,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de dificultad',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 11,
                    'auxiliar'      =>1,
                    'profesor'          => 0,
                    'coordinador' =>       0,
                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar ha mostrado dominio en las habilidades que requiere el curso?',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 12,
                    'profesor'          => 0,
                    'coordinador' =>       0,
                    'auxiliar'      =>1,
                    'nombre'          => '¿Qué nota le pondría a las herramientas y consejos que ha entregado el/la auxiliar REEMPLAZAR auxiliar a los alumnos en torno a los proyectos del curso?',
                    'id_tipo'          =>   2),
                array(
                    'id'            => 13,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Comentarios Positivos',
                    'id_tipo'          =>   2), //taller
                array(
                    'id'            => 55,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Comentarios Negativos',
                    'id_tipo'          =>   2), //taller
            )
        );

        DB::table('preguntas')->insert(
            array(

                array(
                    'id'            => 14,
                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se expresa de forma clara, facilitando que se logren los resultados de aprendizajes esperados?',
                    'profesor'          => 1,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'id_tipo'          =>   4),
                array(
                    'id'            => 15,
                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se da tiempo para responder dudas que presentan los alumnos?',
                    'profesor'          => 1,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'id_tipo'          =>   4),
                array(
                    'id'            => 16,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Clases expositivas',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 17,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Material de apoyo',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 18,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Clases auxiliares',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 19,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Proyecto semestral',
                    'id_tipo'          =>   4),
                array(
                    'id'            =>20,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Presentaciones orales',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 22,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de contenido',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 23,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de dificultad',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 24,
                    'auxiliar'      =>1,
                    'profesor'          => 0,
                    'coordinador' =>       0,
                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar ha mostrado dominio en las habilidades que requiere el curso?',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 25,
                    'auxiliar'      =>1,
                    'profesor'          => 0,
                    'coordinador' =>       0,
                    'nombre'          => '¿Qué nota le pondría a las herramientas y consejos que ha entregado el/la auxiliar REEMPLAZAR auxiliar a los alumnos en torno a los proyectos del curso?',
                    'id_tipo'          =>   4),
                array(
                    'id'            => 28,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Comentarios Positivos',
                    'id_tipo'          =>   4), ////taller coordinado
                array(
                    'id'            => 56,
                    'profesor'          => 0,
                    'auxiliar' =>       0,
                    'coordinador' =>       0,
                    'nombre'          => 'Comentarios Negativos',
                    'id_tipo'          =>   4), ////taller coordinado
            )
        );

                        DB::table('preguntas')->insert(
                            array(
                                array(
                                    'id'            => 29,
                                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se expresa de forma clara, facilitando que se logren los resultados de aprendizajes esperados?',
                                    'profesor'          => 1,
                                    'auxiliar'      =>  0,
                                    'coordinador'   =>  0,
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 30,
                                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se da tiempo para responder dudas que presentan los alumnos?',
                                    'profesor'          => 1,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 31,
                                    'nombre'          => 'Clases expositivas',
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 32,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Material de apoyo',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 33,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Clases auxiliares',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            =>35,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Tareas',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 36,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de contenido',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 37,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de dificultad',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 38,
                                    'auxiliar'      =>1,
                                    'profesor'          => 0,
                                    'coordinador' =>       0,
                                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar ha mostrado dominio de los contenidos del curso?',
                                    'id_tipo'          =>   1),
                                array(
                                    'id'            => 39,
                                    'auxiliar'      =>1,
                                    'profesor'          => 0,
                                    'coordinador' =>       0,
                                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar explica con claridad los contenidos del curso?',
                                    'id_tipo'          =>   1),

                                array(
                                    'id'            => 40,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Comentarios Positivos',
                                    'id_tipo'          =>   1), //teorico
                                array(
                                    'id'            => 57,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Comentarios Negativos',
                                    'id_tipo'          =>   1), //teorico
                            )
                        );



                        DB::table('preguntas')->insert(
                            array(
                                array(
                                    'id'            => 41,
                                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se expresa de forma clara, facilitando que se logren los resultados de aprendizajes esperados?',
                                    'profesor'          => 1,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 42,
                                    'nombre'          => '¿El/la profesor/a REEMPLAZAR se da tiempo para responder dudas que presentan los alumnos?',
                                    'profesor'          => 1,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 43,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Clases expositivas',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 44,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Material de apoyo',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 45,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Clases auxiliares',
                                    'id_tipo'          =>   3),

                                array(
                                    'id'            =>47,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Tareas',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 48,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de contenido',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 49,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Las actividades evaluativas han sido apropiadas en términos de dificultad',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 50,
                                    'auxiliar'      =>1,
                                    'profesor'          => 0,
                                    'coordinador' =>       0,
                                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar ha mostrado dominio de los contenidos del curso?',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 51,
                                    'auxiliar'      =>1,
                                    'profesor'          => 0,
                                    'coordinador' =>       0,
                                    'nombre'          => '¿El/la auxiliar REEMPLAZAR auxiliar explica con claridad los contenidos del curso?',
                                    'id_tipo'          =>   3),
                                array(
                                    'id'            => 52,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Comentarios Positivos',
                                    'id_tipo'          =>   3), //teorico coordinado
                                array(
                                    'id'            => 58,
                                    'profesor'          => 0,
                                    'auxiliar' =>       0,
                                    'coordinador' =>       0,
                                    'nombre'          => 'Comentarios Negativos',
                                    'id_tipo'          =>   3), //teorico coordinado
                            )
                        );

    }
}
