<?php 

/*

if (isset($_FILES['file'])):

    $path = '../app/Libraries/Upload.php';

    include $path;
    $upload = new Upload();
    // $upload->image($img($_FILES['file'], 'test'));
    // $upload->image($img($_FILES['file'], null, 'products'));

    if($upload->getResult()):
        echo 'Uploaded successfully, ' . $upload->getResult();
    else:
        echo $upload->getError();
    endif;

    echo '<hr>';
    var_dump($upload);

endif;

/* 

var_dump($_FILES);
echo '<hr>';

$fileName = 'File_00';

if (file_exists('../public/uploads/'. $fileName)):
    unlink('../public/uploads/'. $fileName);
    echo 'File successfully deleted';
endif;

if(isset($_FILES['file'])) :
    $dir = '../public/uploads/';
    $file_tmp = $_FILES['file']['tmp_name'];
    $file = $_FILES['file']['name'];
    $type = $_FILES['file']['type'];
    $size = $_FILES['file']['size'];

    $ext = pathinfo($file, PATHINFO_EXTENSION);
    // var_dump($ext);

    // $validExts = array('png', 'jpg');
    $validExts = ['png', 'jpg'];

    // valids MIME Types
    $validTypes = ['image/jpeg', 'image/png'];

    if(!in_array($_FILES['file']['name'], $validExts)) :
        echo 'File extension not permitted';
    elseif(!in_array($type, $validTypes)):
        echo 'Invalid Type';
    elseif($size > 2 * (1024 * 1024 * 1024) ):
        echo 'File too big';    
    else:
        echo 'You can send this file';

        if(!file_exists($dir) && !is_dir($dir)):
            // ($directory, $mode)
            mkdir($dir, 0777);
        endif;
    
        if(file_exists($dir) . '/' . $file):
            // echo 'File already exists';
            $newFileName = pathinfo($file, PATHINFO_FILENAME);
            // strrchr find the last ocurrence of a character in a string ($haystack,      $needle), the string, and the point after dot
            $file = $newFileName. '-' .date('d-m-Y-h_i-s'). strrchr($file, '.');
        endif;
        
       
            // ($filename, $destination);
        if(move_uploaded_file($file_tmp,  $dir . $file)):
            echo '<br> File Successfully Uploaded';
        else:
            echo '<br> Error during Upload';
        endif; 

    endif; 

endif;



echo '<hr>';

?>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Send">
</form>

