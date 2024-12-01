<?php
include_once('session.php');
$updated_at = date('Y-m-d H:i:s');

if(isset($_POST['table'])){
    
}

if(isset($_POST['action'])){
/** MAIN PAGE */
    if($_POST['action'] == 'create_barangay_info'){

        $result = $conn->query("TRUNCATE TABLE brgy_info;");
        if(isset($result) == true){
            //get image file
            $file = $_FILES['file']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $imageType = $_FILES['file']['type']; // Get the image type

            // Prepare the data URI
            $dataUri = 'data:' . $imageType . ';base64,' . $base64;

            $arr_data = array(
                'header'     => addslashes($_POST['header']),
                'name'       => addslashes($_POST['name']),
                'title'      => addslashes($_POST['title']),
                'content'    => addslashes($_POST['content']),
                'footer'     => addslashes($_POST['footer']),
                'footer_logo' => $dataUri
            );

            $columns = implode(",", array_keys($arr_data));
            $values = implode("','", array_values($arr_data));

            $sql = "INSERT INTO brgy_info ($columns) VALUES ('$values')";
            $result = $conn->query($sql);
            if (isset($result) == true) {
                $response = array(
                    'status' => 'ok',
                    'title' => 'Success!',
                    'html' => 'Details has been updated!',
                    'icon' => 'success',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'title' => 'Error!',
                    'html' => 'Please try again later!',
                    'icon' => 'error',
                );
            }
        }else{
            $response = array(
                'title' => 'Error!',
                'html' => 'Failed to truncate table, please try again later!',
                'icon' => 'error',
            );
        }
        

    }
/** ANNOUNCEMENT */
    if($_POST['action'] == 'create_announcement'){
        //get image file
        $file = $_FILES['file']['tmp_name'];
        $imageData = file_get_contents($file);
        $base64 = base64_encode($imageData);
        $imageType = $_FILES['file']['type']; // Get the image type

        // Prepare the data URI
        $dataUri = 'data:' . $imageType . ';base64,' . $base64;

        $arr_data = array(
            'date_content'  => addslashes($_POST['date']),
            'news_title'    => addslashes($_POST['title']),
            'content'       => addslashes($_POST['content']),
            'is_published'  => 'false',
            'content_image' => $dataUri,
            'updated_at'    => '',
            'updated_by'    => $_SESSION['id']
        );

        $columns = implode(",", array_keys($arr_data));
        $values = implode("','", array_values($arr_data));

        $sql = "INSERT INTO announcement ($columns) VALUES ('$values')";
        $result = $conn->query($sql);
        if (isset($result) == true) {
            $response = array(
                'status' => 'ok',
                'title' => 'Success!',
                'html' => 'Announcement has been added!',
                'icon' => 'success',
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error!',
                'html' => 'Please try again later!',
                'icon' => 'error',
            );
        }
    }
    if($_POST['action'] == 'edit_announcement'){
        $id = $_POST['id'];
        // Check if image file is actual file
        if( isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ){
            //get image file
            $file = $_FILES['file']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $imageType = $_FILES['file']['type']; // Get the image type
            // Prepare the data URI
            $dataUri = 'data:' . $imageType . ';base64,' . $base64;
            
            $date_content  = addslashes($_POST['date']);
            $news_title    = addslashes($_POST['title']);
            $content       = addslashes($_POST['content']);
            $content_image = $dataUri;
            $updated_by    = $_SESSION['id'];           

            $sql = "UPDATE announcement SET
                    date_content  = '$date_content',
                    news_title    = '$news_title',
                    content       = '$content',
                    content_image = '$dataUri',
                    updated_at    = '$updated_at',
                    updated_by    = '$updated_by'
                    WHERE id = $id
                    ";
        }else{
            $date_content  = addslashes($_POST['date']);
            $news_title    = addslashes($_POST['title']);
            $content       = addslashes($_POST['content']);
            $updated_by    = $_SESSION['id'];

            $sql = "UPDATE announcement SET 
                    date_content  = '$date_content', 
                    news_title    = '$news_title', 
                    content       = '$content', 
                    updated_at    = '$updated_at', 
                    updated_by    = '$updated_by'
                    WHERE id = $id
                    ";
        }

        $result = $conn->query($sql);
        if (isset($result) == true) {
            $response = array(
                'status' => 'ok',
                'title' => 'Success!',
                'html' => 'Announcement has been added!',
                'icon' => 'success',
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error!',
                'html' => 'Please try again later!',
                'icon' => 'error',
            );
        }

        // $response = $sql;
    }
    if($_POST['action'] == 'delete_announcement'){
        $id = $_POST['id'];
        $sql = "DELETE from announcement WHERE id = $id";
        $result = $conn->query($sql);
        if($result){
            $response = array(
                'title' => 'Deleted!',
                'html' => 'Announcement has bedd deleted.',
                'icon' => 'success',
            );
        }else{
            $response = array(
                'title' => 'Failed!',
                'html' => 'Failed to delete data.',
                'icon' => 'error',
            );                
        }        
    }
    if($_POST['action'] == 'fetch_announcement'){
        $id = $_POST['id'];
        $sql = "SELECT * FROM announcement WHERE id = $id";
        $row = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $response = array(
            'id' => $row['id'],
            'date' => $row['date_content'],
            'title' => $row['news_title'],
            'content' => $row['content'],
            'image' => $row['content_image'],
        );

    }
    if($_POST['action'] == 'change_publish_status'){
        $id = $_POST['id'];
        $is_published = $_POST['switchValue'];
        
        switch ($is_published) {
            case 'true':
                $title = 'Publish On';
                $html = 'published turned ON';
                break;
            
            default:
                $title = 'Publish Off';
                $html = 'published turned OFF';
                break;
        }

        $sql = "UPDATE announcement
                SET is_published = $is_published
                WHERE id = $id";
        $result = $conn->query($sql);
        if($result){
            $response = array(
                'title' => $title,
                'html' => $html,
                'icon' => 'success',
                );
        }else{
            $response = array(
                'title' => 'Failed!',
                'html' => 'failed to change publish status.',
                'icon' => 'error',
            );
        }
    }

/** USER PROFILES */
    if($_POST['action'] == 'create_user_profile'){
        // Check if image file is actual file
        if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            //get image file
            $file = $_FILES['file']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $imageType = $_FILES['file']['type']; // Get the image type
            // Prepare the data URI
            $dataUri = 'data:' . $imageType . ';base64,' . $base64;            
        } else {
            $dataUri = '';
        }
       

        $arr_data = array(
            'lname'     => addslashes($_POST['lname']),
            'fname'     => addslashes($_POST['title']),
            'mname'     => addslashes($_POST['content']),
            'suffix'    => addslashes($_POST['']),
            'gender'    => $_POST['gender'],
            'bdate'         => $_POST['bdate'],
            'birth_place'   => $_POST['birth_place'],
            'civil_status'  => $_POST['civil_status'],
            'voter_status'  => $_POST['voter_status'],
            'occupation'        => $_POST['occupation'],
            'address_region'    => $_POST['region'],
            'address_province'  => $_POST['province'],
            'address_city'      => $_POST['city'],
            'address_brgy'      => $_POST['brgy'],
            'address_street'    => $_POST['street'],
            'contact_no'        => $_POST['contact_no'],
            'email_address'     => $_POST['email'],
            'photo'             => $dataUri,
            'updated_by'        => $_SESSION['id']
        );

        $columns = implode(",", array_keys($arr_data));
        $values = implode("','", array_values($arr_data));

        $sql = "INSERT INTO user_profiles ($columns) VALUES ('$values')";
        $result = $conn->query($sql);
        if (isset($result) == true) {
            $response = array(
                'status' => 'ok',
                'title' => 'Success!',
                'html' => 'Data has been added!',
                'icon' => 'success',
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error!',
                'html' => 'Please try again later!',
                'icon' => 'error',
            );
        }

        $response = $dataUri;
    }
    if($_POST['action'] == 'edit_user_profile'){
        $id = $_POST['id'];
        // Check if image file is actual file
        if( isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ){
            //get image file
            $file = $_FILES['file']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $imageType = $_FILES['file']['type']; // Get the image type
            // Prepare the data URI
            $dataUri = 'data:' . $imageType . ';base64,' . $base64;
            
            $date_content  = addslashes($_POST['date']);
            $news_title    = addslashes($_POST['title']);
            $content       = addslashes($_POST['content']);
            $content_image = $dataUri;
            $updated_by    = $_SESSION['id'];           

            $sql = "UPDATE announcement SET
                    date_content  = '$date_content',
                    news_title    = '$news_title',
                    content       = '$content',
                    content_image = '$dataUri',
                    updated_at    = '$updated_at',
                    updated_by    = '$updated_by'
                    WHERE id = $id
                    ";
        }else{
            $date_content  = addslashes($_POST['date']);
            $news_title    = addslashes($_POST['title']);
            $content       = addslashes($_POST['content']);
            $updated_by    = $_SESSION['id'];

            $sql = "UPDATE announcement SET 
                    date_content  = '$date_content', 
                    news_title    = '$news_title', 
                    content       = '$content', 
                    updated_at    = '$updated_at', 
                    updated_by    = '$updated_by'
                    WHERE id = $id
                    ";
        }

        $result = $conn->query($sql);
        if (isset($result) == true) {
            $response = array(
                'status' => 'ok',
                'title' => 'Success!',
                'html' => 'Announcement has been added!',
                'icon' => 'success',
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error!',
                'html' => 'Please try again later!',
                'icon' => 'error',
            );
        }

        // $response = $sql;
    }
    if($_POST['action'] == 'delete_user_profile'){
        $id = $_POST['id'];
        $sql = "DELETE from announcement WHERE id = $id";
        $result = $conn->query($sql);
        if($result){
            $response = array(
                'title' => 'Deleted!',
                'html' => 'Announcement has bedd deleted.',
                'icon' => 'success',
            );
        }else{
            $response = array(
                'title' => 'Failed!',
                'html' => 'Failed to delete data.',
                'icon' => 'error',
            );                
        }        
    }
    if($_POST['action'] == 'fetch_user_profile'){
        $id = $_POST['id'];
        $sql = "SELECT * FROM announcement WHERE id = $id";
        $row = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);
        $response = array(
            'id' => $row['id'],
            'date' => $row['date_content'],
            'title' => $row['news_title'],
            'content' => $row['content'],
            'image' => $row['content_image'],
        );

    }
    if($_POST['action'] == 'change_publish_status'){
        $id = $_POST['id'];
        $is_published = $_POST['switchValue'];
        
        switch ($is_published) {
            case 'true':
                $title = 'Publish On';
                $html = 'published turned ON';
                break;
            
            default:
                $title = 'Publish Off';
                $html = 'published turned OFF';
                break;
        }

        $sql = "UPDATE announcement
                SET is_published = $is_published
                WHERE id = $id";
        $result = $conn->query($sql);
        if($result){
            $response = array(
                'title' => $title,
                'html' => $html,
                'icon' => 'success',
                );
        }else{
            $response = array(
                'title' => 'Failed!',
                'html' => 'failed to change publish status.',
                'icon' => 'error',
            );
        }
    }
/** SETTINGS */
    if ($_POST['action'] == 'update_settings') {
        $result = $conn->query("TRUNCATE TABLE settings;");
        if (isset($result) == true) {
            //get image file
            $file = $_FILES['file']['tmp_name'];
            $imageData = file_get_contents($file);
            $base64 = base64_encode($imageData);
            $imageType = $_FILES['file']['type']; // Get the image type

            // Prepare the data URI
            $dataUri = 'data:' . $imageType . ';base64,' . $base64;

            $arr_data = array(
                'sys_name'   => addslashes($_POST['sys_name']),
                'logo'      => $dataUri
            );

            $columns = implode(",", array_keys($arr_data));
            $values = implode("','", array_values($arr_data));

            $sql = "INSERT INTO settings ($columns) VALUES ('$values')";
            $result = $conn->query($sql);
            if (isset($result) == true) {
                $response = array(
                    'status' => 'ok',
                    'title' => 'Success!',
                    'html' => 'Settings has been updated!',
                    'icon' => 'success',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'title' => 'Error!',
                    'html' => 'Please try again later!',
                    'icon' => 'error',
                );
            }
        } else {
            $response = array(
                'title' => 'Error!',
                'html' => 'Failed to truncate table, please try again later!',
                'icon' => 'error',
            );
        }
    }
    echo json_encode($response);
}
?>