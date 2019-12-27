<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function findUserByid($id)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM users where id =? LIMIT 1");
    $stmt -> execute(array($id));
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function finUserByEmail($email)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM users Where email = ? LIMIT 1");
    $stmt -> execute(array($email));
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function finUserByEmail1($email)
{
    global $db;
    $stmt = $db ->prepare("SELECT * From users where email = ? limit 1");
    $stmt -> execute(array($email));
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);
    return $user;
}

function findUserByemail($email)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM users where email =? LIMIT 1");
    $stmt -> execute(array($email));
    $user = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function createUser($email,$fullname,$passwordHash)
{
    global $db;
    $stmt = $db -> prepare("INSERT INTO users(email, password, fullname) values(?,?,?)");
    $stmt -> execute(array($email,$fullname, $passwordHash));
    return $db->lastInsertId();
}
function findAllPost()
{
    global $db;
    $stmt = $db -> prepare("SELECT p.*, u.fullname,u.image1 FROM posts as p left join users as u on u.id = p.userId ORDER BY createdAt DESC");
    $stmt -> execute();
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function findCNPost($id)
{
    global $db;
    $stmt = $db -> prepare("SELECT p.*, u.fullname,u.image1 FROM posts as p left join users as u on u.id = p.userId ORDER BY createdAt DESC");
    $stmt -> execute($id);
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function NewPosts($content,$idpost,$userId,$image)
{
    global $db;
    $stmt = $db -> prepare("INSERT INTO posts(content,idpost,userId, image) values(?,?,?,?)");
    $stmt -> execute(array($content,$idpost,$userId,$image));
    $posts = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $db->lastInsertId();
}
function findAllBL()
{
    global $db;
    $stmt = $db -> prepare("SELECT p.*, u.fullname,u.image1 FROM binhluan as p left join users as u on u.id = p.userId ORDER BY createdAt DESC");
    $stmt -> execute(); 
    $bl = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $bl; 
}
function NewBL($userId,$Binhluan,$ippost)
{
    global $db;
    $stmt = $db -> prepare("INSERT INTO binhluan(userId,Binhluan,ippost) values(?,?,?)");
    $stmt -> execute(array($userId,$Binhluan,$ippost));
    $posts = $stmt ->fetch(PDO::FETCH_ASSOC);
    return $db->lastInsertId();
}
function Update($email, $fullname, $sdt,$id,$image)
{
    global $db;
    $dulieu = [
        ':email' => $email,
        ':fullname' => $fullname,
        ':sdt' => $sdt,
        ':userId' => $id,
        ':image1' => $image
    ];
    $sql = 'UPDATE  users set email = :email, fullname = :fullname,
    sdt =:sdt, image1 = :image1 where id = :userId';
    $stmt = $db -> prepare($sql);
    return $stmt -> execute($dulieu);
    
}
function findAllPW()
{
    global $db;
    $stmt = $db -> prepare("SELECT *  FROM passwordnew ");
    $stmt -> execute(); 
    $bl = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $bl; 
}
function UpdatePass($password,$id)
{
    global $db;
    $dulieu = [
        ':password' => $password,
        'userId' => $id 
    ];
    $sql = 'UPDATE  users set password = :password where id = :userId';
    $stmt = $db -> prepare($sql);
    return $stmt -> execute($dulieu);
    
}
function findAllLike()
{
    global $db;
    $stmt = $db -> prepare("SELECT p.*, u.fullname FROM posts as p left join users as u on u.id = p.userId ORDER BY createdAt DESC");
    $stmt -> execute();
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function findRelationship($user1id, $user2id)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM friends where user1id = ? and user2id= ? OR user1id= ? and user2id = ?");
    $stmt -> execute(array($user1id,$user2id,$user2id,$user1id));
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function addRelationship($user1id, $user2id)
{
    global $db;
    $stmt = $db -> prepare("INSERT INTO friends(user1id,user2id)VALUES(?,?)");
    $stmt -> execute(array($user1id,$user2id));

}
function removeRelationship($user1id, $user2id)
{
    global $db;
    $stmt = $db -> prepare("DELETE FROM friends WHERE (user1id= ? and user2id= ?) OR (user1id= ? and user2id= ?)");
    $stmt -> execute(array($user1id,$user2id,$user2id,$user1id));
}
function DanhSachBan()
{
    global $db;
    $stmt = $db -> prepare("SELECT p.*,u.id ,u.fullname,u.image1 FROM friends as p left join users as u on u.id = p.user1id  ORDER BY createdAt DESC");
    $stmt -> execute();
    $posts = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function generateRandomString($length = 10)
{
    $characters = '123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    $charactersLength = strlen($characters);
    $ramdomString = '';
    for($i = 0; $i < $length; $i++ )
    {
        $ramdomString .= $characters[rand(0,$charactersLength -1)]; 
    }
    return $ramdomString;
}
function createResetPassword($userid)
{
    global $db;
    $secret = generateRandomString();
    $stmt = $db -> prepare("INSERT INTO passwordnew (userid,secret,used) values(?,?,0)");
    $stmt -> execute(array($userid,$secret));
    return $secret;
}
function findResetPassword($secret)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM passwordnew where secret =? LIMIT 1");
    $stmt -> execute(array($secret));
    return $stmt ->fetch(PDO::FETCH_ASSOC);
}
function updatePassword($userid, $password)
{
    global $db;
    $secret = generateRandomString();
    $stmt = $db -> prepare("UPDATE  users set password = ? where id = ?");
    $stmt -> execute(array($password,$userid));
}
function markResetPassword($secret)
{
    global $db;
    $secret = generateRandomString();
    $stmt = $db -> prepare("UPDATE  passwordnew set userid = 1 where secret = ?");
    $stmt -> execute(array($secret));
}
function sendEmail($email,$receiver, $subject, $content)
{
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    //try {
        //Server settings
        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'ltweb1.cd2018@gmail.com';                 // SMTP username
        $mail->Password = 'abc123XYZ~';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('ltweb1.cd2018@gmail.com', 'LTWeb1');
        $mail->addAddress($email, $receiver);     // Add a recipient

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        $mail->send();
        return true;
    //} catch (Exception $e) {
    //	return false;
    //}
}

function addFollow($idFollowed, $idCurent)
{
    global $db;
    $stmt = $db -> prepare("INSERT INTO follow (users,usersfollow) VALUES (?,?)");
    $stmt ->execute(array($idCurent,$idFollowed));
}
function isUserFollowed($idFollowed) {
    global $db;
    $stmt = $db -> prepare("select * from follow where usersfollow = ?");
    $stmt ->execute(array($idFollowed));
    $posts=$stmt -> fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}
function findRelationshipfollow($user1Id,$user2Id)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM follow WHERE user1Id=? OR user2Id=? OR user1Id=? OR user2Id=?");
    $stmt ->execute(array($user1Id,$user2Id,$user2Id,$user1Id));
    $follow=$stmt -> fetchAll(PDO::FETCH_ASSOC);
    return  $follow;
}
function searchUser($content)
{
    global $db; 
    $stmt = $db ->prepare("SELECT users.id,users.fullname,users.image1 FROM users where fullname like '%$content%'");
    $stmt ->execute();
    $user = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $user;		
}

function searchPost($content)
{
    global $db; 
    $stmt = $db ->prepare("SELECT * from posts as p join users as tk on p.userid = tk.id and content like '%$content%'");
    $stmt ->execute();
    $post = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $post;
}
function testEmail($email)
{
    global $db;
    $stmt = $db -> prepare("SELECT * FROM users WHERE email = '$email'");
    $stmt ->execute();
    return $stmt -> fetch(PDO::FETCH_ASSOC);
}