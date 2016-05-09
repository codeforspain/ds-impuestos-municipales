<?php

require_once('Config.php');

use ConsoleKit\Widgets\ProgressBar;

/**
 * Procesa los archivos fuente y graba a disco los datos en CSV
 *
 */
class ProcessCommand extends ConsoleKit\Command
{


    /*
     * Overriding para que invoque all por defecto.
     */
    public function execute(array $args, array $options = array())
    {
        //si se invoca sin sucomando, ejecuta todo
        if (!count($args)) {
            $args=['all'];
        }

        return parent::execute($args, $options);
    }

    /*
     * Procesa todos los archivos fuente
     *
     */
    public function executeAll(array $args, array $options = array())
    {


        $box = new ConsoleKit\Widgets\Box($this->getConsole(), 'Procesando archivos fuente');
        $box->write();$this->getConsole()->writeln("");

        $file = fopen(BASE_PATH . DS . Config::DATA_FOLDER . DS . Config::MUNICIPIOS_DEST_FILE . ".csv", 'w+');

        $this->writeHeaderToFile($file,Config::$datapackage['resources']['0']['schema']['fields']);

        for ($year = Config::MUNCIPIOS_YEAR_START; $year <= date('Y'); $year++) {
            $this->parseYearToFile($year,$file);
        }

        $this->executeIbi2012( $args, $options);
    }


    /*
     * Procesa el archivo fuente correspondiente al año especificado
     *
     * @arg year año a procesar
     *
     */
    public function executeYear(array $args, array $options = array()){


        if (empty($args[0])) {
            $this->writeerr("Error: Year missing\n");
            die();
        }

        $file = fopen(BASE_PATH . DS . Config::DATA_FOLDER . DS . Config::MUNICIPIOS_DEST_FILE . ".csv", 'w+');

        $this->writeHeaderToFile($file,Config::$datapackage['resources']['0']['schema']['fields']);
        $this->parseYearToFile($args[0],$file);
    }


    /*
     * Graba el el cabecero con el nombre de las columnas a disco
     *
     * @param resource $file identificador del archivo
     *
     */
    private function writeHeaderToFile($file,$columns)
    {
        fputcsv($file, array_map(function($var){ return $var['name']; }, $columns));
        return;
    }



    /*
     * Procesa el archivo fuente del año especificado y lo graba a disco
     *
     * @param int $year año a procesar
     * @param resource $file identificador del archivo
     *
     */
    private function parseYearToFile($year,$file){

        $columns = Config::$datapackage['resources']['0']['schema']['fields'];

        $fileName = sprintf(Config::MUNICIPIOS_SOURCE_FILE, $year);

        $html=trim(file_get_contents(
                BASE_PATH . DS . Config::ARCHIVE_FOLDER . DS . $fileName)
        );

        $DOM = new DOMDocument;
        $DOM->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $x_path = new DOMXPath($DOM);
        $domRows = $x_path->query('//html/body/table/tr[position()>3]');

        $progress = new ProgressBar($this->getConsole(), $domRows->length);

        foreach ($domRows as $domRow) {
            $row=[];

            if ($year==2012) {
                $domCols = $x_path->query('td[position()!=3 and position()!=6]', $domRow);
            } else {
                $domCols = $x_path->query('td[position()!=3]', $domRow);
            }

            $row['municipio_id']=(int) implode('',array_slice(explode("-",trim($domCols->item(0)->nodeValue)),1));
            $row['year']=$year;

            $k=1;
            foreach ($domCols as $domCol){
                $k++;

                // Añadimos columna que falta (coef_actualizacion)
                if ($year<=2013 && $columns[$k]['name']=="ibi_coef_actualizacion") {
                    $row['ibi_coef_actualizacion'] = "";
                    $k++;
                }

                if ($year<2004 && $columns[$k]['name']=="ibi_especial") {
                    $row[$columns[$k]['name']] = "";  //establecemos ibi_especial a ""
                    continue;
                }

                if (empty(trim($domCol->nodeValue))) {
                    $row[$columns[$k]['name']]="";  //si está vacío, lo dejamos vacío.
                } else if ($columns[$k]['type']=='integer') {
                    $row[$columns[$k]['name']] = trim(str_replace(",", ".", str_replace(".", "", $domCol->nodeValue)));
                } else if ($columns[$k]['type']=='number') {
                    $row[$columns[$k]['name']] = (float) trim(str_replace(",", ".", str_replace(".", "", $domCol->nodeValue)));
                } else {
                    $row[$columns[$k]['name']] = trim($domCol->nodeValue);
                }
            }


            fputcsv($file, $row);
            $progress->incr();
        }
        $progress->stop();
    }


    /*
      * Procesa el ibi Urbana de 2012 (RD 20/2011)
      *
      * @param int $year año a procesar
      * @param resource $file identificador del archivo
      *
      */
    public function executeIbi2012(array $args, array $options = array()){

        $columns = Config::$datapackage['resources']['1']['schema']['fields'];

        $file = fopen(BASE_PATH . DS . Config::DATA_FOLDER . DS . Config::MUNICIPIOS_2012_IBI_DEST_FILE . ".csv", 'w+');

        $this->writeHeaderToFile($file,$columns);


        $fileName = sprintf(Config::MUNICIPIOS_SOURCE_FILE, 2012);

        $html=trim(file_get_contents(
                BASE_PATH . DS . Config::ARCHIVE_FOLDER . DS . $fileName)
        );

        $DOM = new DOMDocument;
        $DOM->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        $x_path = new DOMXPath($DOM);
        $domRows = $x_path->query('//html/body/table/tr[position()>3]');        //Saltamos las tres primeras filas.
        $progress = new ProgressBar($this->getConsole(), $domRows->length);

        foreach ($domRows as $domRow) {
            $row=[];
            $domCols = $x_path->query('td[position()=1 or position()=6]',$domRow);
            $row['municipio_id']=(int) implode('',array_slice(explode("-",trim($domCols->item(0)->nodeValue)),1));
            $row['year']=2012;
            $row['ibi_urbana_rd_20_2011']=(float) trim(str_replace(",", ".", $domCols->item(1)->nodeValue));

            fputcsv($file, $row);
            $progress->incr();
        }

        $progress->stop();
    }
}