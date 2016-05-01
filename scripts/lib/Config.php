<?php

class Config
{



    const MUNCIPIOS_URL="https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/ImpuestosExcel.aspx?provincia=TODAS&anosel=%d";
    const MUNCIPIOS_YEAR_START = 2000;
    const DATA_FOLDER ="data";
    const ARCHIVE_FOLDER = "archive";
    const MUNICIPIOS_SOURCE_FILE = "municipios-%d.xls";
    const MUNICIPIOS_DEST_FILE = "impuestos_municipales";
    const MUNICIPIOS_2012_IBI_DEST_FILE = "ibi_2012-rd_20_2011";

    static $datapackage = [
        "name" => "ds-impuestos-municipales",
        "title" => "Información Impositiva de los Municipios Españoles",
        "descriptions" => "Información Impositiva de los municipios de España (salvo País Vasco y Navarra) desde el año 2000",
        "licenses" => [
            [
                "type" => "odc-pddl",
                "url" => "http://opendatacommons.org/licenses/pddl/"
            ]
        ],
        "author" => [
            "name" => "Code for Spain",
            "web" => "http://www.codeforspain.org"
        ],
        "keywords" => [ "Impuestos Municipales", "IBI", "Plusvalia", "Vehiculos"],

        "sources" => [
             [
                "name" => "Oficina Virtual Para la Cooordinación Financiera con las Entidades Locales - MHAP",
                "web" => "https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/listado_municipios.aspx"
             ]
        ],
        "resources" => [
            [
                "name" => "ds_im_municipios",
                "title"=> "Información Impositiva Municipal",
                "format"=> "csv",
                "path"=> "data/municipios.csv",
                "schema"=> [
                    "fields"=> [
                        [
                            "name" => "municipio_id",
                            "type" => "number",
                            "description" => "Código INE del municipio",
                            "pattern" => "[0-9]{5}"
                        ],
                        [
                            "name" => "year",
                            "type" => "number",
                            "description" => "Año del dato",
                        ],
                        [
                            "name" => "codigo",
                            "type" => "string",
                            "description" => "Código INE de la autonomia, provincia y municipios concatenados mediante el carácter -",
                            "pattern" => "[0-9]{2}\-[0-9]{2}\-[0-9]{3}"

                        ],
                        [
                            "name" => "ayuntamiento",
                            "type" => "string",
                            "description" => "Denominación oficial del municipio",
                        ],
    /*                        [
                            "name" => "provincia",
                            "type" => "string",
                            "description" => "Denominación oficial de la provincia",
                        ],*/
                        [
                            "name" => "poblacion",
                            "type" => "number",
                            "description" => "Número de habitantes",
                        ],
                        [
                            "name" => "ibi_urbana",
                            "type" => "number",
                            "description" => "Tipo para el cálculo del IBI en urbana",
                        ],
                        //<----'ibi_urbana_rd_20_2011', //solo existe en 2012?
                        [
                            "name" => "ibi_coef_actualizacion",
                            "type" => "number",
                            "description" => "Coeficiente por el que se multiplica el valor catastral del año anterior para obtener el de este año",
                        ],
                        [
                            "name" => "ibi_rev_catastral",
                            "type" => "number",
                            "description" => "Año de la última ponencia de valores catastrales del municipios",
                            "pattern" => "[0-9]{4}"
                        ],
                        [
                            "name" => "ibi_rustica",
                            "type" => "number",
                            "description" => "Tipo para el cálculo del IBI en rústica",
                        ],
                        [
                            "name" => "ibi_especial", //en 2003 a cero, a partir de 2004  datos. Antes no existe la columna
                            "type" => "number",
                            "description" => "Tipo para el cálculo del IBI en rústica",
                        ],

                        //'iae_coef',  //a cero en 2000 2002
                        [
                            "name" => "iae_coef_max",
                            "type" => "number",
                            "description" => "",
                        ],
                        [
                            "name" => "iae_coef_min",
                            "type" => "number",
                            "description" => "",
                        ],

                        // Turismos
                        [
                            "name" => "ivtm_0_8",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Turismos de menos de 8 CV",
                        ],
                        [
                            "name" => "ivtm_8_12",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Turismos de 8 a 11,99 CV",
                        ],
                        [
                            "name" => "ivtm_12_16",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Turismos de 12 a 15,99 CV",
                        ],
                        [
                            "name" => "ivtm_16_20",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Turismos de 16 a 19,99 CV",
                        ],
                        [
                            "name" => "ivtm_20_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Turismos de 20 CV o más",
                        ],

                        // Autobuses
                        [
                            "name" => "ivtm_aut_0_21",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Autobuses de menos de 21 plazas",
                        ],
                        [
                            "name" => "ivtm_aut_21_50",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Autobuses de 21 a 50 plazas",
                        ],
                        [
                            "name" => "ivtm_aut_50_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Autobuses de mas de 50 plazas",
                        ],

                        // Camiones
                        [
                            "name" => "ivtm_cam_0_1000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Camiones de menos de 1000 Kg de carga útil",
                        ],
                        [
                            "name" => "ivtm_cam_1000_3000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Camiones de 1000 a 2999 Kg de carga útil",
                        ],
                        [
                            "name" => "ivtm_cam_3000_10000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Camiones de 3000 a 9999 Kg de carga útil",
                        ],
                        [
                            "name" => "ivtm_cam_10000_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Camiones de mas de 9999 Kg de carga útil",
                        ],


                        // Tractores
                        [
                            "name" => "ivtm_tra_0_16",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Tractores de menos de 16 CV",
                        ],
                        [
                            "name" => "ivtm_tra_16_25",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Tractores de 16 a 25 CV",
                        ],
                        [
                            "name" => "ivtm_tra_25_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Tractores de mas de 25 CV",
                        ],
                        // Remolques
                        [
                            "name" => "ivtm_rem_750_1000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Remolques de 750 a 1000 Kg de carga útil",
                        ],
                        [
                            "name" => "ivtm_rem_1000_3000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Remolques de 1000 a 2999 Kg de carga útil",
                        ],
                        [
                            "name" => "ivtm_rem_3000_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Remolques de mas de 2999 Kg de carga útil",
                        ],

                        // Otros vehículos
                        [
                            "name" => "ivtm_ciclomotor",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Ciclomotores",
                        ],
                        [
                            "name" => "ivtm_moto_0_125",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Motocicletas hasta 125 cc",
                        ],
                        [
                            "name" => "ivtm_moto_125_250",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Motocicletas de más de 125 hasta 250 cc",
                        ],
                        [
                            "name" => "ivtm_moto_250_500",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Motocicletas de más de 250 hasta 500 cc",
                        ],
                        [
                            "name" => "ivtm_moto_500_1000",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Motocicletas de más de 500 hasta 1000 cc",
                        ],
                        [
                            "name" => "ivtm_moto_1000_inf",
                            "type" => "number",
                            "description" => "Impuesto Vehículos Tracción Mecánica - Motocicletas de más de 1000 cc",
                        ],

                        // IIVTNU - Impuesto sobre Incremento sobre el Valor de los Terrenos de Naturaleza Urbana

                        [
                            "name" => "iivtnu_porcentaje_5",
                            "type" => "number",
                            "description" => "IIVTNU - Porcentaje de incremento hasta 5 años",
                        ],
                        [
                            "name" => "iivtnu_tipo_5",
                            "type" => "number",
                            "description" => "IIVTNU - Tipo de gravamen hasta 5 años",
                        ],
                        [
                            "name" => "iivtnu_porcentaje_10",
                            "type" => "number",
                            "description" => "IIVTNU - Porcentaje de incremento hasta 10 años",
                        ],
                        [
                            "name" => "iivtnu_tipo_10",
                            "type" => "number",
                            "description" => "IIVTNU - Tipo de gravamen hasta 10 años",
                        ],
                        [
                            "name" => "iivtnu_porcentaje_15",
                            "type" => "number",
                            "description" => "IIVTNU - Porcentaje de incremento hasta 15 años",
                        ],
                        [
                            "name" => "iivtnu_tipo_15",
                            "type" => "number",
                            "description" => "IIVTNU - Tipo de gravamen hasta 15 años",
                        ],
                        [
                            "name" => "iivtnu_porcentaje_20",
                            "type" => "number",
                            "description" => "IIVTNU - Porcentaje de incremento hasta 20 años",
                        ],
                        [
                            "name" => "iivtnu_tipo_20",
                            "type" => "number",
                            "description" => "IIVTNU - Tipo de gravamen hasta 20 años",
                        ],
                        [
                            "name" => "iivtnu_porcentaje_reduccion",
                            "type" => "number",
                            "description" => "IIVTNU - Porcentaje de reducción sobre el valor catastral (Art. 107.3 RDL 2/2004)",
                        ],
                        [
                            "name" => "icio_tipo_gravamen",
                            "type" => "number",
                            "description" => "Impuesto sobre Construcciones, Instalaciones y Obras - Tipo de gravamen",
                        ],
                        [
                            "name" => "fecha_de_alta",
                            "type" => "number",
                            "description" => "Fecha en que se comunica el dato por parte del ayuntamiento en format YYYY-MM-DD",
                        ],

                    ]
                ]
            ],
            [
                "name" => "ds_im_ibi_2012",
                "title"=> "Tipo Modificado del IBI Municipal para el año 2012",
                "format"=> "csv",
                "path"=> "data/ibi_modificado_2012",
                "schema"=> [
                    "fields"=> [
                        [
                            "name" => "municipio_id",
                            "type" => "number",
                            "description" => "Código INE del municipio",
                            "pattern" => "[0-9]{5}"
                        ],
                        [
                            "name" => "ibi_urbana_rd_20_2011",
                            "type" => "number",
                            "description" => "IBI Urbana modificado segun el Real Decreto 20/2011",
                        ],
                        [
                            "name" => "year",
                            "type" => "number",
                            "description" => "Año del dato",
                        ],


                    ]

                ]
            ]
        ]
    ];


}