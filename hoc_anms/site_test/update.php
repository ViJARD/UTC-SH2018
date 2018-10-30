<?php
/**
 * Created by PhpStorm.
 * User: Hoc_Anms
 * Date: 10/4/2018
 * Time: 9:07 AM
 */
?>
<?php
if(isset($_GET['temp']) ){
    $temp = $_GET['temp'];
    $b = array(
        'temp'=>$temp
    );
    //$filedata = fopen("data.json", "w");
    if( $filedata == false )
    {
        echo "error make file ";
        exit();
    }
    $data = json_encode($b);
    fwrite($filedata, $data );
    fclose($filedata);
    echo($data);
}
else{
    echo "no data";
}
?>
