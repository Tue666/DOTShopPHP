<?php 
class Ajax extends ViewModel{
    public $account;
    public $product;
    public function __construct(){
        $this->account = $this->getModel('AccountDAL');
        $this->product = $this->getModel('ProductDAL');
    }
    public function loadUserAdmin(){
        $listAccountJSON = json_decode($this->account->getListAccount(),true);
        $output = '';
        foreach ($listAccountJSON as $item){
            $type = $item['Type']==0?'User':'Admin';
            $status = $item['Status']==1?'<label style="color: green; font-weight: bold;">Activated</label>':'<label style="color: red; font-weight: bold;">Locked</label>';
            $switchLock = $item['Status']==1?
            '<button title="Lock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>'
            :
            '<button title="Unlock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-lock-open"></i></button>';
            $output .= 
            '
            <tr>
                <td>'.$item['ID'].'</td>
                <td>'.$item['UserName'].'</td>
                <td>'.$item['Name'].'</td>
                <td>'.$item['Email'].'</td>
                <td>'.$item['Phone'].'</td>
                <td>'.$item['CreatedDay'].'</td>
                <td>'.$type.'</td>
                <td>'.$status.'</td>
                <td>
                    <span
                        onclick="passDataEditUser(
                            '.$item['ID'].',
                            \''.$item['Name'].'\',
                            \''.$item['Email'].'\',
                            \''.$item['Phone'].'\',
                            \''.$item['Address'].'\',
                            '.$item['Type'].'
                        );"
                        data-toggle="modal"
                        data-target="#editModal">
                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                    </span>
                    <span onclick="passDataRemove('.$item['ID'].',\''.$item['UserName'].'\');" data-toggle="modal" data-target="#removeModal">
                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                    </span>
                    <span>
                        '.$switchLock.'
                    </span>
                    <span onclick="passDataReset('.$item['ID'].');" data-toggle="modal" data-target="#resetPassModal">
                        <button title="Reset Password" class="btn btn-warning mb-2"><i class="fas fa-key"></i></button>
                    </span>
                </td>
            </tr>
            ';
        }
        echo $output;
    }
    public function checkNameAdmin(){
        if (json_decode($this->account->checkExist($_POST['inputName']))){
            echo '<label style="color:red;margin:0;font-style:italic;">This name is already existed!</label>';
        }
    }
    public function insertUser(){
        $userName = $_POST['addName'];
        $passWord = password_hash($_POST['addPass'], PASSWORD_DEFAULT);
        $isAdmin = $_POST['isAdmin'];
        echo json_decode($this->account->insertAccount($userName,$passWord,$isAdmin));
    }
    public function editUser(){
        echo json_decode($this->account->editAccount($_POST['id'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['isAdmin']));
    }
    public function loadProductAdmin(){
        $listProductJSON = json_decode($this->product->getListProduct(),true);
        $output = '';
        foreach ($listProductJSON as $item){
            $status = $item['Status']==1?'<label style="color: green; font-weight: bold;">Activated</label>':'<label style="color: red; font-weight: bold;">Locked</label>';
            $linkImage = IMAGE_URL.'/'.$item['Image'];
            $switchLock = $item['Status']==1?
            '<button title="Lock" onclick="switchStatus('.$item['ID'].',1);" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>'
            :
            '<button title="Unlock" onclick="switchStatus('.$item['ID'].',1);" class="btn btn-danger mb-2"><i class="fas fa-lock-open"></i></button>';
            $output .= 
            '
            <tr>
                <td>'.$item['ID'].'</td>
                <td>'.$item['ProductName'].'</td>
                <td>'.$item['CateName'].'</td>
                <td><img style="width: 70px; height: 70px;" src="'.$linkImage.'"/></td>
                <td>'.number_format($item['Price'],0,'',',').'</td>
                <td>'.$item['Quantity'].'</td>
                <td>'.$item['Warranty'].' month</td>
                <td>'.$item['Discount'].' %</td>
                <td>'.$item['CreatedDay'].'</td>
                <td>'.$status.'</td>
                <td>
                    <span
                        onclick="passDataEditProduct(
                            \''.IMAGE_URL.'\',
                            '.$item['ID'].',
                            \''.$item['ProductName'].'\',
                            \''.$item['CateName'].'\',
                            \''.$item['Description'].'\',
                            \''.$item['Image'].'\',
                            '.$item['Price'].',
                            '.$item['Quantity'].',
                            '.$item['Warranty'].',
                            '.$item['Discount'].',
                            '.$item['VATFee'].'
                        );"
                        data-toggle="modal"
                        data-target="#editModal">
                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                    </span>
                    <span onclick="passDataRemove('.$item['ID'].',\''.$item['ProductName'].'\');" data-toggle="modal" data-target="#removeModal">
                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                    </span>
                    <span>
                        '.$switchLock.'
                    </span>
                </td>
            <tr>
            ';
        }
        echo $output;
    }
    public function addProduct(){
        $type = 0;
        $message = '';
        if(isset($_FILES['file']['name'])){
            $fileName = $_FILES['file']['name'];
            $fileExt = explode('.',$fileName);
            $imageFileType = strtolower(end($fileExt));

            $allowed = array("jpg","jpeg","png");

            if(in_array($imageFileType, $allowed)) {
                $location = 'Public/images/'.$fileName;
                if (move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                    $productCate = $this->getModel('ProductCategoryDAL');
                    $cateIDJSON = json_decode($productCate->getIDByCateName($_POST['inputCate']),true);
                    json_decode($this->product->insertProduct($_POST['inputName'],$cateIDJSON,"",$_FILES['file']['name'],$_POST['inputPrice'],0,$_POST['inputQuantity'],$_POST['inputWarranty'],0,$_POST['inputDiscount'],0));
                    $type = 1;
                    $message = 'Add Product Success! :D';
                }
                else{
                    $message = 'Something may error, try again!';
                }
            }
            else{
                $message = '.jpg | .jpeg | .png files only';
            }
        }
        else{
            $message = 'Select an image, please :D';
        }
        $data = array(
            'message'=>$message,
            'type'=>$type
        );
        echo json_encode($data);
    }
    public function editProduct(){
        $type = 0;
        $message = '';
        $linkImage = $_POST['image'];
        if (isset($_FILES['file']['name'])){
            $linkImage = $_FILES['file']['name'];
        }
        $linkImage = explode('/',$linkImage);
        $image = end($linkImage);
        $productCate = $this->getModel('ProductCategoryDAL');
        $cateIDJSON = json_decode($productCate->getIDByCateName($_POST['productCate']),true);
        if (json_decode($this->product->editProduct($_POST['id'],$_POST['productName'],$cateIDJSON,$_POST['description'],$image,$_POST['price'],$_POST['quantity'],$_POST['warranty'],$_POST['discount'],$_POST['vatfee']),true)){
            if (!file_exists('Public/images/'.$image)){
                $fileName = $_FILES['file']['name'];
                $fileExt = explode('.',$fileName);
                $imageFileType = strtolower(end($fileExt));

                $allowed = array("jpg","jpeg","png");
                $location = 'Public/images/'.$fileName;
                move_uploaded_file($_FILES['file']['tmp_name'],$location);
            }
            $type = 1;
            $message = 'Edit Product Success!';
        }
        $message = 'Edit Product Failed!';
        $data = array(
            'type'=>$type,
            'message'=>$message
        );
        echo json_encode($data);
    }
    public function switchLock(){
        if ($_POST['type']==0){
            echo json_decode($this->account->switchStatus($_POST['ID']));
        }
        else{
            echo json_decode($this->product->switchStatus($_POST['ID']));
        }
    }
    public function removeItem(){
        if ($_POST['type']==0){
            echo json_decode($this->account->removeAccount($_POST['itemID']));
        }
        else{
            echo json_decode($this->product->removeProduct($_POST['itemID']));
        }
    }
    public function resetPass(){
        $newPass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
        echo json_decode($this->account->resetPassword($_POST['id'],$newPass));
    }
}
?>