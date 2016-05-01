[![Twitter Follow](https://img.shields.io/twitter/follow/codeforspain.svg?style=social?maxAge=2592000)](https://twitter.com/codeforspain)

# ds-impuestos-municipales

Histórico de tipos impositivos municipales desde 2000 hasta la fecha. Incluye tipos para el cálculo de:



    IBI	  		Impuesto sobre Bienes Inmuebles
    IAE    		Impuesto sobre Actividades Económicas
    IVTM   		Impuesto Vehículos Tracción Mecánica
    IIVTNU  	Impuesto sobre el Incremento del Valor de los Terrenos de Naturaleza Urbana
  	ICIO		Impuesto sobre Construcciones, Instalaciones y Obras      


Este dataset es parte del proyecto abierto y colaborativo CodeForSpain. Puedes obtener más información en:

- Wiki: [CodeForSpain Wiki](https://github.com/codeforspain/datos/wiki)
- Twitter: [@codeforspain](https://twitter.com/codeforspain)
- Web: [www.codeforspain.org](http://www.codeforspain.org)


## Impuestos Municipales


- Fuente: [Oficina Virtual Para la Cooordinación Financiera con las Entidades Locales - MHAP](https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/listado_municipios.aspx)
- URL: `https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/ImpuestosExcel.aspx?provincia=TODAS&anosel=[YYYY]` donde `YYYY` es el año, (desde 2000 hasta la actualidad))
- Tipo: Excel (xls) 
- Datos procesados: [/data/impuestos_municipales.csv](data/impuestos_municipales.csv) 
 
Este recurso ofrece un histórico de información impositiva municipal. Es comunicada por parte de los ayuntamientos a la Oficina Virtual Para la Cooordinación Financiera con las Entidades Locales. 

Se completa a lo largo del primer semestre del año en curso, por lo que **el último año puede estar incompleto**. Por lo tanto, hay que actualizar frecuentemente el datasat, forzando la descarga del último año.   

### Formato de los datos


Incluye un número elevado de campos.


Ejemplo en CSV:

| municipio_id | year | codigo    | ayuntamiento | poblacion | ibi_urbana | ibi_coef_actualizacion | ibi_rev_catastral | ibi_rustica | ibi_especial | iae_coef_max | iae_coef_min | ivtm_0_8 | ivtm_8_12 | ivtm_12_16 | ivtm_16_20 | ivtm_20_inf | ivtm_aut_0_21 | ivtm_aut_21_50 | ivtm_aut_50_inf | ivtm_cam_0_1000 | ivtm_cam_1000_3000 | ivtm_cam_3000_10000 | ivtm_cam_10000_inf | ivtm_tra_0_16 | ivtm_tra_16_25 | ivtm_tra_25_inf | ivtm_rem_750_1000 | ivtm_rem_1000_3000 | ivtm_rem_3000_inf | ivtm_ciclomotor | ivtm_moto_0_125 | ivtm_moto_125_250 | ivtm_moto_250_500 | ivtm_moto_500_1000 | ivtm_moto_1000_inf | iivtnu_porcentaje_5 | iivtnu_tipo_5 | iivtnu_porcentaje_10 | iivtnu_tipo_10 | iivtnu_porcentaje_15 | iivtnu_tipo_15 | iivtnu_porcentaje_20 | iivtnu_tipo_20 | iivtnu_porcentaje_reduccion | icio_tipo_gravamen | fecha_de_alta | 
|--------------|------|-----------|--------------|-----------|------------|------------------------|-------------------|-------------|--------------|--------------|--------------|----------|-----------|------------|------------|-------------|---------------|----------------|-----------------|-----------------|--------------------|---------------------|--------------------|---------------|----------------|-----------------|-------------------|--------------------|-------------------|-----------------|-----------------|-------------------|-------------------|--------------------|--------------------|---------------------|---------------|----------------------|----------------|----------------------|----------------|----------------------|----------------|-----------------------------|--------------------|---------------| 
| 02001        | 2015 | 08-02-001 | Abengibre    | 775       | 0.63000    | 1.10000                | 1990              | 0.90000     | 0.60000      | 1.00         | 1.00         | 17.04    | 46.00     | 97.12      | 120.97     | 151.20      | 112.46        | 160.16         | 200.20          | 53.36           | 105.12             | 149.72              | 187.15             | 23.85         | 37.49          | 112.45          | 23.85             | 37.49              | 112.45            | 5.97            | 5.97            | 10.22             | 20.45             | 40.89              | 81.78              | 2.80                | 20.00         | 2.80                 | 20.00          | 2.80                 | 20.00          | 2.80                 | 20.00          | 0.00                        | 2.50               | 2015-02-04    | 
| 02002        | 2015 | 08-02-002 | Alatoz       | 580       | 0.41600    |                        | 2012              | 0.65000     | 1.30000      | 1.00         | 1.00         | 12.62    | 34.08     | 71.94      | 89.61      | 112.00      | 83.30         | 118.64         | 148.30          | 42.28           | 83.30              | 118.64              | 148.30             | 17.67         | 27.77          | 83.30           | 17.67             | 27.77              | 83.30             | 4.42            | 4.42            | 7.57              | 15.15             | 30.29              | 60.58              | 2.20                | 16.00         | 2.00                 | 16.00          | 2.10                 | 16.00          | 2.20                 | 16.00          | 60.00                       | 2.00               | 2015-05-26    | 
| 02003        | 2015 | 08-02-003 | Albacete     | 172.487   | 0.45400    | 0.83000                | 2006              | 0.79300     | 0.88600      | 3.15         | 1.05         | 24.48    | 66.12     | 139.56     | 173.84     | 217.28      | 161.60        | 230.16         | 287.70          | 82.02           | 161.60             | 230.16              | 287.70             | 34.28         | 53.87          | 161.60          | 34.28             | 53.87              | 161.60            | 7.87            | 7.87            | 13.47             | 26.97             | 53.92              | 107.83             | 2.02                | 24.50         | 1.88                 | 23.52          | 1.84                 | 26.46          | 1.78                 | 29.40          | 0.00                        | 3.84               | 2015-05-20    | 


## Tipo Modificado IBI 2012


- Fuente: [Oficina Virtual Para la Cooordinación Financiera con las Entidades Locales - MHAP](https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/listado_municipios.aspx)
- URL: https://serviciostelematicos.minhap.gob.es/TiposImpositivos/aspx/ImpuestosExcel.aspx?provincia=TODAS&anosel=2012
- Tipo: Excel (xls) 
- Datos procesados: [/data/ibi_2012-rd_20_2011.csv](data/ibi_2012-rd_20_2011.csv) 
 
El [Artículo 8  del Real Decreto-ley 20/2011, de 30 de diciembre, de medidas urgentes en materia presupuestaria, tributaria y financiera para la corrección del déficit público](http://noticias.juridicas.com/base_datos/Fiscal/rdl20-2011.html#art_8) establece que para los años 2012 y 2013 los tipos de gravamen del Impuesto sobre Bienes Inmuebles urbano serán modificados al alza siguiendo un procedimiento descrito en el propio artículo. 

Para el año 2012, este valor ya modificado es proporcionado por la fuente e incluido en una nueva columna. Para 2013, esta columna no está presente. Cabe esperar que sustituya a la columna `ibi_urbana` (pendiente de comprobar). 

Se ha optado por incluirlo como un recurso separado, pues el dato es solo relevante al año 2012.

### Formato de los datos


Ejemplo en CSV:

| municipio_id | ibi_urbana_rd_20_2011 | year | 
|--------------|-----------------------|------| 
| 02001        | 0.69300               | 2012 | 
| 02002        | 0.41600               | 2012 | 
| 02003        | 0.40500               | 2012 | 



## Script

El script se puede encontrar en [/scripts/](/scripts/).
