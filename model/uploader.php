<?php
class Uploader
{
    public function __construct()
    {
    }
    public function upload($name)
    {
        $msg = "";
        $uploadedfileload = 'true';
        $uploadedfile_size = $_FILES['uploadedfile']['size'];
        $name_temp = $_FILES['uploadedfile']['name'];
        $extension = pathinfo($name_temp, PATHINFO_EXTENSION);
        $_FILES['uploadedfile']['name'] = $name.'.'.$extension;

        if (!($_FILES['uploadedfile']['type'] == 'file/jpeg' or $_FILES['uploadedfile']['type'] == 'image/gif' or $_FILES['uploadedfile']['type'] == 'image/png') or $_FILES['uploadedfile']['type'] == 'image/JPG')) {
            $msg = $msg.' Tu archivo tiene que ser .ZIP o .RAR Otros archivos no son permitidos<BR>';
            $uploadedfileload = 'false';
        }
        $file_name = $_FILES['uploadedfile']['name'];
        $add = "uploads/$file_name";
        if ($uploadedfileload == 'true') {
            if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $add)) {
                return FILE_DIR . $file_name;
            // echo ' Ha sido subido satisfactoriamente';
            } else {
                return '';
            // echo 'Error al subir el archivo';
            }
        } else {
            return '';
        // echo $msg;
        }
    //return "uploads/".$file_name;
    }
}
?>
